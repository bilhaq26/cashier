<?php

namespace App\Http\Livewire\Admin\Discount;

use App\Models\Diskon;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Index extends Component
{
    public $search, $nama, $total_belanja, $diskon, $dataId;
    public $selectedItems = [];
    public $selectAll = false;
    public $perPage = 10;

    protected $listeners = [
        'appointments:delete' => 'delete',
        'appointments:deleteSelect' => 'deleteSelect',
    ];

    public function render()
    {
        $datas = Diskon::orderBy('id', 'desc')->
        when($this->search, function ($q) {
            $q->where(function ($query) {
                $query->where('nama', 'like', '%' . $this->search . '%');
            });
        })->paginate($this->perPage);
        return view('livewire.admin.discount.index',[
            'datas' => $datas,
        ])->layout('admin.layout')->layoutData(['title' => 'Diskon']);
    }

    public function resetInput()
    {
        $this->nama = null;
        $this->total_belanja = null;
        $this->diskon = null;
    }

    public function store()
    {
        $this->total_belanja = str_replace('Rp. ', '', $this->total_belanja);
        $this->total_belanja = str_replace('.', '', $this->total_belanja);
        $this->diskon = str_replace('Rp. ', '', $this->diskon);
        $this->diskon = str_replace('.', '', $this->diskon);

        $validate = $this->validate([
            'nama' => 'required',
            'total_belanja' => 'required|numeric',
            'diskon' => 'required|numeric'
        ],[
            'nama' => 'Masukan Nama Diskon',
            'total_belanja' => 'Masukan Total Belanja Untuk Mendapatkan Diskon',
            'diskon' => 'Masukan Diskon untuk Total Belanja yang tertera'
        ]);

        if($validate){
            $data = new Diskon();
            $data->nama = $this->nama;
            $data->total_belanja = $this->total_belanja;
            $data->diskon = $this->diskon;
            activity()
            ->causedBy(Auth::user()->id)
            ->performedOn($data)
            ->withProperties(['attributes' => ['nama' => $this->nama, 'total_belanja' => $this->total_belanja, 'diskon' => $this->diskon]])
            ->log('Menambahkan Diskon'. $this->nama, 'dengan total belanja '. $this->total_belanja, 'dan diskon '. $this->diskon);
            $data->save();
            $this->resetInput();
            $this->emit('closeModal');
            $this->showToastr('success','Diskon Berhasil Di Tambah');
        }
    }

    public function edit($id)
    {
        $data = Diskon::find($id);
        $this->dataId = $data->id;
        $this->nama = $data->nama;
        $this->total_belanja = $data->total_belanja;
        $this->diskon = $data->diskon;
    }

    public function update()
    {
        $this->total_belanja = str_replace('Rp. ', '', $this->total_belanja);
        $this->total_belanja = str_replace('.', '', $this->total_belanja);
        $this->diskon = str_replace('Rp. ', '', $this->diskon);
        $this->diskon = str_replace('.', '', $this->diskon);

        $validate = $this->validate([
            'nama' => 'required',
            'total_belanja' => 'required|numeric',
            'diskon' => 'required|numeric'
        ]);

        if($validate){
            $data = Diskon::find($this->dataId);
            $data->nama = $this->nama;
            $data->total_belanja = $this->total_belanja;
            $data->diskon = $this->diskon;
            activity()
            ->causedBy(Auth::user()->id)
            ->performedOn($data)
            ->withProperties(['attributes' => ['nama' => $this->nama, 'total_belanja' => $this->total_belanja, 'diskon' => $this->diskon]])
            ->log('Mengubah Data Diskon'. $this->nama, 'dengan total belanja '. $this->total_belanja, 'dan diskon '. $this->diskon);
            $data->save();
            $this->resetInput();
            $this->emit('closeModal');
            $this->showToastr('success','Diskon Berhasil Di Update');
        }
    }

    public function destroy($dataId)
    {
        $this->emit("swal:confirm", [
            'icon'        => 'warning',
            'title'       => 'Hapus Pengguna!',
            'text'        => "Anda yakin untuk menghapus Diskon ini?",
            'confirmText' => 'Hapus!',
            'cancelText' => 'Tidak!',
            'method'      => 'appointments:delete',
            'onConfirmed' => 'confirmed',
            'params'      => $dataId, // optional, send params to success confirmation
            'callback'    => '', // optional, fire event if no confirmed
        ]);
    }

    public function delete($id)
    {
        $data = Diskon::find($id);
        activity()
        ->causedBy(Auth::user()->id)
        ->performedOn($data)
        ->withProperties(['attributes' => ['nama' => $this->nama, 'total_belanja' => $this->total_belanja, 'diskon' => $this->diskon]])
        ->log('Menghapus Data Diskon'. $this->nama, 'dengan total belanja '. $this->total_belanja, 'dan diskon '. $this->diskon);
        $data->delete();
        $this->showToastr('success', 'Data Diskon Berhasil Dihapus');
    }

    // Select All

    public function updated($field)
    {
        if($field == 'selectAll'){
            if($this->selectAll){
                $this->selectedItems = Diskon::pluck('id');
            }else{
                $this->reset(['selectedItems']);
            }
        }
    }

    public function destroySelect()
    {
        if($this->selectedItems){
            $this->emit("swal:confirm", [
                'icon'        => 'warning',
                'title'       => 'Hapus Pengguna!',
                'text'        => "Anda yakin untuk menghapus Diskon ini?",
                'confirmText' => 'Hapus!',
                'cancelText' => 'Tidak!',
                'method'      => 'appointments:deleteSelect',
                'onConfirmed' => 'confirmed',
                'params'      => $this->selectedItems, // optional, send params to success confirmation
                'callback'    => '', // optional, fire event if no confirmed
            ]);
        }else{
            $this->showToastr('error', 'Tidak ada data yang dipilih');
        }
    }

    public function deleteSelect()
    {
        $data = Diskon::whereIn('id', $this->selectedItems);
        $data->delete();
        $this->showToastr('success', 'Data Jenis Barang Berhasil Dihapus');
        $this->reset(['selectedItems', 'selectAll']);
    }

    public function showAlert($icon, $title, $text)
    {
        $this->emit('swal:modal', [
            'icon'  => $icon,
            'title' => $title,
            'text'  => $text,
        ]);
    }

    // TOASTR
    public function showToastr($icon, $title)
    {
        $this->emit('swal:alert', [
            'icon'    => $icon,
            'title'   => $title,
            'timeout' => 10000
        ]);
    }
}

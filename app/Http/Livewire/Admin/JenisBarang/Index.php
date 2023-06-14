<?php

namespace App\Http\Livewire\Admin\JenisBarang;

use Livewire\Component;
use App\Models\JenisBarang;
use Illuminate\Support\Facades\Auth;

class Index extends Component
{
    public $nama_jenis, $search;
    public $perPage = 10;
    public $selectedItems = [];
    public $selectAll = false;
    public $items, $dataId;

    protected $listeners = [
        'appointments:delete' => 'delete',
        'appointments:deleteSelect' => 'deleteSelect',
    ];

    public function render()
    {
        $datas = JenisBarang::orderBy('id', 'desc')->
        when($this->search, function ($q) {
            $q->where(function ($query) {
                $query->where('nama_jenis', 'like', '%' . $this->search . '%');
            });
        })->paginate($this->perPage);
        return view('livewire.admin.jenis-barang.index',[
            'datas' => $datas
        ])->layout('admin.layout')->layoutData(['title' => 'Jenis Barang']);
    }

    public function resetInput()
    {
        $this->nama_jenis = null;
    }

    public function store()
    {
        $validate = $this->validate([
            'nama_jenis' => 'required'
        ],[
            'nama_jenis.required' => 'Nama Jenis Barang tidak boleh kosong'
        ]);

        if($validate){
            $data = new JenisBarang();
            $data->nama_jenis = $this->nama_jenis;
            activity()
                ->causedBy(Auth::user()->id)
                ->performedOn($data)
                ->withProperties(['attributes' => ['nama_jenis' => $this->nama_jenis]])
                ->log('Menambahkan data jenis barang' . $this->nama_jenis);
            $data->save();
            $this->showToastr('success', 'Data Jenis Barang Berhasil Ditambahkan');
            $this->resetInput();
            $this->emit('closeModal');
        }
    }

    public function edit($id)
    {
        $data = JenisBarang::find($id);
        $this->dataId = $data->id;
        $this->nama_jenis = $data->nama_jenis;
    }

    public function update()
    {
        $validate = $this->validate([
            'nama_jenis' => 'required'
        ],[
            'nama_jenis.required' => 'Nama Jenis Barang tidak boleh kosong'
        ]);

        if($validate){
            $data = JenisBarang::find($this->dataId);
            $data->nama_jenis = $this->nama_jenis;
            activity()
            ->causedBy(Auth::user()->id)
            ->performedOn($data)
            ->withProperties(['attributes' => ['nama_jenis' => $this->nama_jenis]])
            ->log('Mengubah data jenis barang' . $this->nama_jenis);
            $data->save();
            $this->showToastr('success', 'Data Jenis Barang Berhasil Diubah');
            $this->resetInput();
            $this->emit('closeModal');
        }
    }

    public function destroy($dataId)
    {
        $this->emit("swal:confirm", [
            'icon'        => 'warning',
            'title'       => 'Hapus Pengguna!',
            'text'        => "Anda yakin untuk menghapus Jenis Barang ini?",
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
        $data = JenisBarang::find($id);
        activity()
                ->causedBy(Auth::user()->id)
                ->performedOn($data)
                ->withProperties(['attributes' => ['nama_jenis' => $this->nama_jenis]])
                ->log('Menghapus data jenis barang' . $this->nama_jenis);
        $data->delete();
        $this->showToastr('success', 'Data Jenis Barang Berhasil Dihapus');
    }

    // select

    public function updated($field)
    {
        if($field == 'selectAll'){
            if($this->selectAll){
                $this->selectedItems = JenisBarang::pluck('id');
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
                'text'        => "Anda yakin untuk menghapus Jenis Barang ini?",
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
        $data = JenisBarang::whereIn('id', $this->selectedItems);
        $data->delete();
        $this->showToastr('success', 'Data Jenis Barang Berhasil Dihapus');
        $this->reset(['selectedItems', 'selectAll']);
    }


    // SWEET ALERT

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

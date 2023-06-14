<?php

namespace App\Http\Livewire\Admin\Paket;

use App\Models\Paket;
use App\Models\Barang;
use Livewire\Component;
use App\Models\DetailPaket;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class Index extends Component
{
    public $perPage = 10;
    public $selectedItems = [];
    public $selectAll = false;
    public $nama_paket, $keterangan, $harga_paket, $id_barang, $qty, $barang, $dataId, $search;
    public $items = [];

    protected $listeners = [
        'appointments:delete' => 'delete',
        'appointments:deleteSelected' => 'deleteSelected',
    ];

    public function render()
    {
        $datas = Paket::orderBy('nama_paket', 'ASC')->
        when($this->search, function($query) {
            $query->where('nama_paket', 'like', '%'.$this->search.'%')
            ->orWhere('keterangan', 'like', '%'.$this->search.'%')
            ->orWhere('harga_paket', 'like', '%'.$this->search.'%');
        })->paginate($this->perPage);

        $barangs = Barang::orderBy('nama_barang', 'asc')->get();
        return view('livewire.admin.paket.index',[
            'datas' => $datas,
            'barangs' => $barangs,
        ])->layout('admin.layout')->layoutData(['title' => 'Paket']);
    }

    public function updated($field)
    {
        if($field == 'selectAll'){
            if($this->selectAll){
                $this->selectedItems = Paket::pluck('id');
            }else{
                $this->reset(['selectedItems']);
            }
        }
    }

    public function addChart()
    {
        $barang = Barang::find($this->id_barang);
        if($this->qty <= $barang->stok){
            $temp_cart = $this->items;
            if(count($temp_cart) > 0){
                $barang_cart = in_array($this->id_barang, array_column($temp_cart, 'id_barang'));
                if($barang_cart){
                    foreach($this->items as $key => $value){
                        if($this->id_barang == $value['id_barang']){
                            $barang = Barang::find($this->id_barang);
                            $stok = $barang->stok;
                            if($this->qty + $value['qty'] <= $stok){
                                $this->items[$key]['qty'] += $this->qty;
                                $this->showToastr('success', 'Barang berhasil ditambahkan');
                            }else{
                                $this->showToastr('error', 'Stok tidak mencukupi');
                            }
                        }
                    }
                }else{
                    $this->items[] = [
                        'id_barang' => $this->id_barang,
                        'qty' => $this->qty,
                        'nama_barang' => $barang->nama_barang,
                        'harga' => $barang->harga,
                    ];
                    $this->showToastr('success', 'Barang berhasil ditambahkan');
                }
            }else{
                $this->items[] = [
                    'id_barang' => $this->id_barang,
                    'qty' => $this->qty,
                    'nama_barang' => $barang->nama_barang,
                    'harga' => $barang->harga,
                ];
                $this->showToastr('success', 'Barang berhasil ditambahkan');
            }
        }else{
            $this->showToastr('error', 'Stok tidak mencukupi');
        }
    }

    public function removeChart($id)
    {
        // arr pull
        Arr::pull($this->items, $id);
        $this->showToastr('success', 'Barang berhasil dihapus');
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
                'method'      => 'appointments:deleteSelected',
                'onConfirmed' => 'confirmed',
                'params'      => $this->selectedItems, // optional, send params to success confirmation
                'callback'    => '', // optional, fire event if no confirmed
            ]);
        }else{
            $this->showToastr('error', 'Tidak ada data yang dipilih');
        }
    }

    public function deleteSelected()
    {
        // delete paket and detail paket
        $datas = Paket::whereIn('id', $this->selectedItems)->get();
        foreach($datas as $data){
            $detail = DetailPaket::where('id_paket', $data->id)->get();
            foreach($detail as $d){
                $d->delete();
            }
            $data->delete();
        }
        $this->reset(['selectAll', 'selectedItems']);
        $this->showToastr('success', 'Data berhasil dihapus');
    }

    public function resetInput()
    {
        $this->nama_paket = null;
        $this->keterangan = null;
        $this->harga_paket = null;
    }

    public function store()
    {
        $this->harga_paket = str_replace('Rp. ', '', $this->harga_paket);
        $this->harga_paket = str_replace('.', '', $this->harga_paket);
        if (count($this->items) == 0) {
            $this->showToastr('error', 'Pilih barang terlebih dahulu');
        }else{
            $validate = $this->validate([
                'nama_paket' => 'required',
                'keterangan' => 'nullable',
                'harga_paket' => 'required',
            ]);

            if($validate){
                $data = new Paket();
                $data->nama_paket = $this->nama_paket;
                $data->keterangan = $this->keterangan;
                $data->harga_paket = $this->harga_paket;
                activity()
                ->causedBy(Auth::user()->id)
                ->performedOn($data)
                ->withProperties(['attributes' => ['nama_paket' => $this->nama_paket, 'keterangan' => $this->keterangan, 'harga_paket' => $this->harga_paket]])
                ->log('Menambahkan data paket'. $this->nama_paket, 'dengan Harga Paket Rp. '. number_format($this->harga_paket, 0, ',', '.'));
                $data->save();
                if($data){
                    foreach($this->items as $key => $value){
                        $detail = new DetailPaket();
                        $detail->id_paket = $data->id;
                        $detail->id_barang = $value['id_barang'];
                        $detail->qty = $value['qty'];
                        $detail->save();
                    }
                    $this->showToastr('success', 'Data berhasil disimpan');
                    $this->resetInput();
                    $this->emit('closeModal');
                    $this->items = [];
                }
            }
        }
    }

    public function edit($dataId)
    {
        $data = Paket::find($dataId);
        $this->dataId = $dataId;
        $this->nama_paket = $data->nama_paket;
        $this->keterangan = $data->keterangan;
        $this->harga_paket = $data->harga_paket;
        $this->items = [];
        $detail = DetailPaket::where('id_paket', $dataId)->get();
        foreach($detail as $d){
            $this->items[] = [
                'id_barang' => $d->id_barang,
                'qty' => $d->qty,
                'nama_barang' => $d->barang->nama_barang,
                'harga' => $d->barang->harga,
            ];
        }
    }

    public function update()
    {
        $this->harga_paket = str_replace('Rp. ', '', $this->harga_paket);
        $this->harga_paket = str_replace('.', '', $this->harga_paket);
        if (count($this->items) == 0) {
            $this->showToastr('error', 'Pilih barang terlebih dahulu');
        }else{
            $validate = $this->validate([
                'nama_paket' => 'required',
                'keterangan' => 'nullable',
                'harga_paket' => 'required',
            ]);

            if($validate){
                $data = Paket::find($this->dataId);
                $data->nama_paket = $this->nama_paket;
                $data->keterangan = $this->keterangan;
                $data->harga_paket = $this->harga_paket;
                activity()
                ->causedBy(Auth::user()->id)
                ->performedOn($data)
                ->withProperties(['attributes' => ['nama_paket' => $this->nama_paket, 'keterangan' => $this->keterangan, 'harga_paket' => $this->harga_paket]])
                ->log('Mengubah data paket'. $this->nama_paket, 'dengan Harga Paket Rp. '. number_format($this->harga_paket, 0, ',', '.'));
                $data->save();
                if($data){
                    $detail = DetailPaket::where('id_paket', $this->dataId)->get();
                    foreach($detail as $d){
                        $d->delete();
                    }
                    foreach($this->items as $key => $value){
                        $detail = new DetailPaket();
                        $detail->id_paket = $data->id;
                        $detail->id_barang = $value['id_barang'];
                        $detail->qty = $value['qty'];
                        $detail->save();
                    }
                    $this->showToastr('success', 'Data berhasil disimpan');
                    $this->resetInput();
                    $this->emit('closeModal');
                    $this->items = [];
                }
            }
        }
    }

    public function destroy($dataId)
    {
        $this->emit("swal:confirm", [
            'icon'        => 'warning',
            'title'       => 'Hapus Pengguna!',
            'text'        => "Anda yakin untuk menghapus Paket ini?",
            'confirmText' => 'Hapus!',
            'cancelText' => 'Tidak!',
            'method'      => 'appointments:delete',
            'onConfirmed' => 'confirmed',
            'params'      => $dataId, // optional, send params to success confirmation
            'callback'    => '', // optional, fire event if no confirmed
        ]);
    }

    public function delete($dataId)
    {
        $data = Paket::find($dataId);
        $detail = DetailPaket::where('id_paket', $dataId)->get();
        foreach($detail as $d){
            $d->delete();
        }
        activity()
        ->causedBy(Auth::user()->id)
        ->performedOn($data)
        ->withProperties(['attributes' => ['nama_paket' => $this->nama_paket, 'keterangan' => $this->keterangan, 'harga_paket' => $this->harga_paket]])
        ->log('Menghapus data paket'. $this->nama_paket, 'dengan Harga Paket Rp. '. number_format($this->harga_paket, 0, ',', '.'));
        $data->delete();
        $this->showToastr('success', 'Data berhasil dihapus');
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

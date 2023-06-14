<?php

namespace App\Http\Livewire\Admin\Transaksi;

use App\Models\Paket;
use App\Models\Barang;
use App\Models\Diskon;
use Livewire\Component;
use App\Models\Transaksi;
use Illuminate\Support\Arr;
use App\Models\DetailTransaksi;
use Illuminate\Support\Facades\Auth;

class Create extends Component
{
    public $no_transaksi, $barang_id, $qty, $total, $items = [];
    public $totalQty, $totalHarga, $nama_pembeli, $tgl_transaksi, $diskon, $diskonId, $bayar, $kembalian, $image, $total_harga, $id_paket;

    public function render()
    {
        $barangs = Barang::orderBy('nama_barang', 'asc')->get();
        $diskons = Diskon::orderBy('nama', 'asc')->when($this->totalHarga, function($query){
            $query->where('total_belanja', '<=', $this->totalHarga);
        })->get();
        $pakets = Paket::orderBy('nama_paket', 'asc')->get();

        return view('livewire.admin.transaksi.create', [
            'barangs' => $barangs,
            'diskons' => $diskons,
            'pakets' => $pakets
        ])->layout('admin.layout')->layoutData(['title' => 'Buat Transaksi']);
    }

    public function mount()
    {
        $this->no_transaksi = $this->getNextNoTransaksi();
    }

    public function getNextNoTransaksi()
    {
        $code = Transaksi::generateCode();
        return $code;
    }
    // Chart

    public function resetInputChart()
    {
        $this->barang_id = null;
        $this->qty = null;
    }

    public function resetinputField()
    {
        $this->kembalian = $kembalian = (int) $this->bayar - (int) $this->total();
    }

    public function updated($field)
    {
        if ($field == 'bayar' || $field == 'diskonId' ) {
            $this->kembalian = (int) $this->bayar - (int) $this->total();
        }

        if($field == 'diskonId'){
            if($this->diskonId){
                $this->diskon = Diskon::find($this->diskonId)->diskon;
            }
        }

        if($field == 'id_paket'){
            // if change another id_paket reset input field
            $paket = Paket::find($this->id_paket);
            // make detail paket
            if($paket){
                foreach($paket->detailPaket as $detail){
                    $barang = Barang::find($detail->id_barang);
                    if($barang->stok < $detail->qty){
                        $this->showToastr('error', 'Stok barang '.$barang->nama_barang.' tidak cukup');
                        $this->id_paket = null;
                        return false;
                    }
                }
                $this->items = [];
                $this->totalQty = 0;
                foreach($paket->detailPaket as $detail){
                    $barang = Barang::find($detail->id_barang);
                    $this->items[] = [
                        'image' => $barang->image,
                        'barang_id' => $detail->id_barang,
                        'nama_barang' => $barang->nama_barang,
                        'qty' => $detail->qty,
                        'harga' => $barang->harga,
                        'subtotal' => $paket->harga_paket,
                    ];
                    $this->totalQty += $detail->qty;
                    $this->totalHarga = $paket->harga_paket;
                }
                $this->showToastr('success', 'Berhasil menambahkan paket ke keranjang');
            }

        }

    }

    public function addToChart()
    {
        $barang = Barang::find($this->barang_id);
        if ($this->qty <= $barang->stok) {
            $temp_cart = $this->items;
            if (count($temp_cart) > 0) {
                $barang_cart = in_array($this->barang_id, array_column($temp_cart, 'barang_id'));
                if ($barang_cart) {

                    foreach ($this->items as $key => $value) {
                        if ($this->barang_id == $value['barang_id']) {
                            $barang = Barang::find($this->barang_id);
                            $stok = $barang->stok;
                            // cek qty + qty cart <= stok
                            if ($this->qty + $value['qty'] <= $stok) {
                                $this->items[$key]['qty'] += $this->qty;
                                $this->items[$key]['subtotal'] += $this->qty * $barang->harga;
                                $this->totalQty += $this->qty;
                                $this->totalHarga += $this->qty * $barang->harga;
                                $this->resetInputChart();
                                $this->resetinputField();
                                $this->showToastr('success', 'Berhasil menambahkan barang ke keranjang');
                                $this->emit('closeModal');
                            } else {
                                $this->showToastr('error', 'Stok tidak cukup');
                            }
                        }
                    }
                }else{
                    $this->items[] = [
                        'image' => $barang->image,
                        'barang_id' => $this->barang_id,
                        'nama_barang' => $barang->nama_barang,
                        'qty' => $this->qty,
                        'harga' => $barang->harga,
                        'subtotal' => $this->qty * $barang->harga
                    ];
                    $this->totalQty += $this->qty;
                    $this->totalHarga += $this->qty * $barang->harga;
                    $this->resetinputField();
                    $this->resetInputChart();
                    $this->showToastr('success', 'Berhasil menambahkan barang ke keranjang');
                    $this->emit('closeModal');
                }
            } else {
                $this->items[] = [
                    'image' => $barang->image,
                    'barang_id' => $this->barang_id,
                    'nama_barang' => $barang->nama_barang,
                    'qty' => $this->qty,
                    'harga' => $barang->harga,
                    'subtotal' => $this->qty * $barang->harga
                ];
                $this->totalQty += $this->qty;
                $this->totalHarga += $this->qty * $barang->harga;
                $this->resetinputField();
                $this->resetInputChart();
                $this->showToastr('success', 'Berhasil menambahkan barang ke keranjang');
                $this->emit('closeModal');
            }

            if (count($this->items) > 0) {
                $diskon = Diskon::find($this->diskonId);
                if($diskon && $this->totalHarga < $diskon->total_belanja){
                    $this->diskon = null;
                    $this->diskonId = null;
                }
            }
        } else {
            $this->showToastr('error', 'Stok tidak cukup');
        }
    }

    public function removeItemChart($id)
    {
        Arr::pull($this->items, $id);
        $this->totalQty = 0;
        foreach ($this->items as $key => $value) {
            $this->totalQty += $value['qty'];
        }
        $this->totalHarga = 0;
        foreach ($this->items as $key => $value) {
            $this->totalHarga += $value['subtotal'];
        }
        $this->resetinputField();
        $this->showToastr('success', 'Berhasil menghapus barang dari keranjang');
    }

    public function store()
    {
        // jika item kosong tidak bisa save
        if (count($this->items) == 0) {
            $this->showToastr('error', 'Keranjang masih kosong');
            return false;
        }elseif($this->bayar < $this->total()){
            $this->showToastr('error', 'Pembayaran kurang');
            return false;
        }else{
            $validate = $this->validate([
                'no_transaksi' => 'required',
                'nama_pembeli' => 'required',
                'tgl_transaksi' => 'required',
                'diskon' => 'nullable',
                'id_paket' => 'nullable',
                'bayar' => 'required',
            ]);

            if($validate){
                $data = new Transaksi();
                    $data->no_transaksi = $this->no_transaksi;
                    $data->nama_pembeli = $this->nama_pembeli;
                    $data->tgl_transaksi = $this->tgl_transaksi;
                    $data->diskon = $this->diskon;
                    $data->id_paket = $this->id_paket;
                    $data->total_harga = $this->totalHarga;
                    $data->bayar = $this->bayar;
                    $data->kembalian = $this->kembalian;
                    $data->status = 'Dipinjam';

                    activity()
                        ->causedBy(Auth::user()->id)
                        ->performedOn($data)
                        ->withProperties(['attributes' => ['no_transaksi' => $this->no_transaksi, 'nama_pembeli' => $this->nama_pembeli, 'tgl_transaksi' => $this->tgl_transaksi, 'diskon' => $this->diskon, 'id_paket' => $this->id_paket, 'total_harga' => $this->total_harga, 'bayar' => $this->bayar, 'kembalian' => $this->kembalian]])
                        ->log('Menambahkan Transaksi a.n '. $this->nama_pembeli, 'dengan total harga '. number_format($this->totalHarga, 0, ',', '.'), 'dan bayar '. number_format($this->bayar, 0, ',', '.'), 'serta kembalian '. number_format($this->kembalian, 0, ',', '.'));
                    $data->save();
                    if($data){
                        foreach($this->items as $item){
                            DetailTransaksi::create([
                                'no_transaksi' => $data->no_transaksi,
                                'id_barang' => $item['barang_id'],
                                'qty' => $item['qty'],
                                'harga' => $item['harga'],
                            ]);
                            if($item){
                                $barang = Barang::find($item['barang_id']);
                                $barang->stok -= $item['qty'];
                                $barang->save();
                            }
                        }
                    }
                    $this->showToastr('success', 'Berhasil menambahkan transaksi');
                    return redirect()->route('transaksi');
            }
        }
    }

    public function total()
    {
        $total = 0;
        if (count($this->items) > 0) {
            $diskon = Diskon::find($this->diskonId);
            if($diskon){
                $total = $this->totalHarga - $diskon->diskon;
            }else{
                $total = $this->totalHarga;
            }
        };
        return $total;
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

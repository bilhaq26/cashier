<?php

namespace App\Http\Livewire\Admin\Transaksi;

use Carbon\Carbon;
use App\Models\Barang;
use Livewire\Component;
use App\Models\Transaksi;
use App\Models\DetailTransaksi;
use Illuminate\Support\Facades\Auth;

class Index extends Component
{
    public $no_transaksi, $tgl_transaksi, $diskon, $total_harga, $kembalian, $search, $today, $from, $to;
    public $perPage = 10;

    protected $listeners = [
        'appointments:delete' => 'delete',
    ];
    public function render()
    {
        $datas = Transaksi::orderBy('created_at', 'DESC')
        ->when($this->search, function($query) {
            $query->where('no_transaksi', 'like', '%'.$this->search.'%')
            ->orWhere('nama_pembeli', 'like', '%'.$this->search.'%')
            ->orWhere('tgl_transaksi', 'like', '%'.$this->search.'%')
            ->orWhere('diskon', 'like', '%'.$this->search.'%')
            ->orWhere('total_harga', 'like', '%'.$this->search.'%')
            ->orWhere('kembalian', 'like', '%'.$this->search.'%');
        })
        ->when($this->from, function ($query) {
            $query->whereBetween('tgl_transaksi', [$this->from, $this->to])
            ->oldest('tgl_transaksi', 'asc');
        })
        ->paginate($this->perPage);


        return view('livewire.admin.transaksi.index',[
            'datas' => $datas
        ])->layout('admin.layout')->layoutData(['title' => 'Transaksi']);
    }

    public function destroy($dataId)
    {
        $this->emit("swal:confirm", [
            'icon'        => 'warning',
            'title'       => 'Hapus Pengguna!',
            'text'        => "Anda yakin untuk menghapus Transaksi ini?",
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
        // if delete transaksi stok kembali
        $transaksi = Transaksi::find($id);
        $detailTransaksi = DetailTransaksi::where('no_transaksi', $transaksi->no_transaksi)->get();
        foreach ($detailTransaksi as $key => $value) {
            $value->delete();
        }
        foreach ($detailTransaksi as $key => $value) {
            $barang = Barang::find($value->id_barang);
            $stok = $barang->stok;
            $barang->stok = $stok + $value->qty;
            $barang->save();
        }
        activity()
            ->causedBy(Auth::user()->id)
            ->performedOn($transaksi)
            ->withProperties(['attributes' => [
                'no_transaksi' => $transaksi->no_transaksi,
                'nama_pembeli' => $transaksi->nama_pembeli,
                'tgl_transaksi' => $transaksi->tgl_transaksi,
                'diskon' => $transaksi->diskon,
                'total_harga' => $transaksi->total_harga,
                'kembalian' => $transaksi->kembalian,
            ]])
            ->log('Menghapus transaksi a.n'. $transaksi->nama_pembeli);
        $transaksi->delete();
        $this->showToastr('success', 'Transaksi berhasil dihapus');
    }

    public function changeStatus($id)
    {
        // if status transaksi = done stok barang kemabli
        $transaksi = Transaksi::find($id);
        $barang = Barang::whereIn('id', [1,2])->get();
        foreach ($barang as $key => $value) {
            $stok = $value->stok;
            $value->update([
                'stok' => $stok + 1
            ]);
        }
        $transaksi->update([
            'status' => 'Dikembalikan'
        ]);
        $this->showToastr('success', 'Transaksi berhasil diubah');
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

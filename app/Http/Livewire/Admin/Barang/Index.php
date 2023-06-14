<?php

namespace App\Http\Livewire\Admin\Barang;

use App\Models\Barang;
use Livewire\Component;
use App\Models\JenisBarang;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class Index extends Component
{
    use WithFileUploads;
    public $search;
    public $perPage = 10;
    public $nama_barang, $id_jenis, $harga, $stok, $keterangan, $image, $dataId, $prevImage, $satuan, $jumlah;

    protected $listeners = [
        'appointments:delete' => 'delete',
        'appointments:deleteSelect' => 'deleteSelect',
        'appointments:changeStatusSelect' => 'changeStatusSelect',
    ];

    public function render()
    {
        $datas = Barang::with('jenis')->
        when($this->search, function($query){
            $query->where('nama_barang', 'like', '%'.$this->search.'%');
        })->paginate($this->perPage);

        $jBarang = JenisBarang::orderBy('nama_jenis', 'asc')->get();
        return view('livewire.admin.barang.index',[
            'datas' => $datas,
            'jBarang' => $jBarang,
        ])->layout('admin.layout')->layoutData(['title' => 'Barang']);
    }

    public function resetInput()
    {
        $this->image = null;
        $this->nama_barang = null;
        $this->id_jenis = null;
        $this->harga = null;
        $this->stok = null;
        $this->jumlah = null;
        $this->satuan = null;
    }

    public function removeImage()
    {
        if($this->image){
            Storage::delete($this->image);
            $this->image = null;
        }
    }

    public function store()
    {
        $this->harga = str_replace('Rp. ', '', $this->harga);
        $this->harga = str_replace('.', '', $this->harga);
        $validate = $this->validate([
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'keterangan' => 'nullable',
            'nama_barang' => 'required',
            'id_jenis' => 'required',
            'harga' => 'required',
            'stok' => 'required',
            'jumlah' => 'required',
        ],[
            'image.image' => 'File harus berupa gambar',
            'image.mimes' => 'File harus berupa gambar',
            'image.max' => 'Ukuran file terlalu besar, maksimal 2MB',
            'nama_barang.required' => 'Nama barang tidak boleh kosong',
            'id_jenis.required' => 'Jenis barang tidak boleh kosong',
            'harga.required' => 'Harga barang tidak boleh kosong',
            'stok.required' => 'Stok barang tidak boleh kosong',
            'jumlah.required' => 'Jumlah Berat tidak boleh kosong',
        ]);

        if($validate){
            $data = new Barang();
            if($this->image){
                if($this->image){
                    $image = $this->image;
                    $imageName = 'barang-'.Str::slug($this->nama_barang).'.'.$image->extension();

                    $destinationPath = public_path('img/barang');
                    $img = Image::make($image->getRealPath());
                    $img->resize(500, 500, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($destinationPath.'/'.$imageName);
                    $data->image = $imageName;
                }
            }
            $data->nama_barang = $this->nama_barang;
            $data->keterangan = $this->keterangan;
            $data->id_jenis = $this->id_jenis;
            $data->harga = $this->harga;
            $data->stok = $this->stok;
            $data->jumlah = $this->jumlah;
            $data->satuan = $this->satuan;
            activity()
            ->causedBy(Auth::user()->id)
            ->performedOn($data)
            ->withProperties(['attributes' => ['nama_barang' => $this->nama_barang, 'id_jenis' => $this->id_jenis, 'harga' => $this->harga, 'stok' => $this->stok, 'jumlah' => $this->jumlah, 'satuan' => $this->satuan, 'keterangan' => $this->keterangan]])
            ->log('Menambahkan data barang'. $this->nama_barang,'dengan Stok '. $this->stok, '-'. $this->jumlah .' '. $this->satuan, 'dengan Harga Paket Rp. '. number_format($this->harga, 0, ',', '.'));
            $data->save();
            $this->resetInput();
            $this->showToastr('success', 'Data Barang Berhasil Ditambahkan');
            $this->emit('closeModal');
        }
    }

    public function edit($id)
    {
        $data = Barang::find($id);
        $this->dataId = $data->id;
        $this->nama_barang = $data->nama_barang;
        $this->id_jenis = $data->id_jenis;
        $this->harga = $data->harga;
        $this->stok = $data->stok;
        $this->jumlah = $data->jumlah;
        $this->satuan = $data->satuan;
        $this->keterangan = $data->keterangan;
        $this->prevImage = $data->image;
    }

    public function update()
    {
        $this->harga = str_replace('Rp. ', '', $this->harga);
        $this->harga = str_replace('.', '', $this->harga);
        $validate = $this->validate([
            'nama_barang' => 'required',
            'keterangan' => 'nullable',
            'id_jenis' => 'required',
            'harga' => 'required',
            'satuan' => 'required',
            'stok' => 'required',
        ]);

        if($validate){
            $data = Barang::find($this->dataId);
            if($this->image){
                if($this->image){
                    $image = $this->image;
                    $imageName = 'barang-'.Str::slug($this->nama_barang).'.'.$image->extension();

                    $destinationPath = public_path('img/barang');
                    $img = Image::make($image->getRealPath());
                    $img->resize(500, 500, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($destinationPath.'/'.$imageName);
                    $data->image = $imageName;
                }
            }
            $data->nama_barang = $this->nama_barang;
            $data->keterangan = $this->keterangan;
            $data->id_jenis = $this->id_jenis;
            $data->harga = $this->harga;
            $data->stok = $this->stok;
            $data->jumlah = $this->jumlah;
            $data->satuan = $this->satuan;
            activity()
            ->causedBy(Auth::user()->id)
            ->performedOn($data)
            ->withProperties(['attributes' => ['nama_barang' => $this->nama_barang, 'id_jenis' => $this->id_jenis, 'harga' => $this->harga, 'stok' => $this->stok, 'jumlah' => $this->jumlah, 'satuan' => $this->satuan, 'keterangan' => $this->keterangan]])
            ->log('Mengubah data barang'. $this->nama_barang,'dengan Stok '. $this->stok, '-'. $this->jumlah .' '. $this->satuan, 'dengan Harga Paket Rp. '. number_format($this->harga, 0, ',', '.'));
            $data->save();
            $this->resetInput();
            $this->showToastr('success', 'Data Barang Berhasil Diubah');
            $this->emit('closeModal');
        }
    }

    public function destroy($dataId)
    {
        $this->emit("swal:confirm", [
            'icon'        => 'warning',
            'title'       => 'Hapus Pengguna!',
            'text'        => "Anda yakin untuk menghapus Barang ini?",
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
        // delete image in storage
        $data = Barang::find($id);
        if($data->image){
            Storage::delete($data->image);
        }
        activity()
        ->causedBy(Auth::user()->id)
        ->performedOn($data)
        ->withProperties(['attributes' => ['nama_barang' => $this->nama_barang, 'id_jenis' => $this->id_jenis, 'harga' => $this->harga, 'stok' => $this->stok, 'jumlah' => $this->jumlah, 'satuan' => $this->satuan, 'keterangan' => $this->keterangan]])
        ->log('Menghapus data barang'. $this->nama_barang,'dengan Stok '. $this->stok, '-'. $this->jumlah .' '. $this->satuan, 'dengan Harga Paket Rp. '. number_format($this->harga, 0, ',', '.'));
        $data->delete();
        $this->showToastr('success', 'Data Barang Berhasil Dihapus');

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

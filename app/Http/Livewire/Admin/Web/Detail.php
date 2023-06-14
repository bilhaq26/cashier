<?php

namespace App\Http\Livewire\Admin\Web;

use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\Web\Identitas;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class Detail extends Component
{
    use WithFileUploads;
    public $name, $email, $phone, $address, $facebook, $instagram, $twitter, $youtube, $logo, $about, $favicon, $logoPrev, $faviconPrev, $data, $tiktok;

    public function render()
    {
        return view('livewire.admin.web.detail')->layout('admin.layout')->layoutData(['title' => 'Identitas Website']);
    }

    public function mount()
    {
        $this->data = Identitas::first();
        $this->name = $this->data->name;
        $this->email = $this->data->email;
        $this->phone = $this->data->phone;
        $this->address = $this->data->address;
        $this->facebook = $this->data->facebook;
        $this->instagram = $this->data->instagram;
        $this->twitter = $this->data->twitter;
        $this->youtube = $this->data->youtube;
        $this->tiktok = $this->data->tiktok;
        $this->about = $this->data->about;
        $this->logoPrev = $this->data->logo;
        $this->faviconPrev = $this->data->favicon;
    }

    public function resetInput()
    {
        $this->name = '';
        $this->email = '';
        $this->phone = '';
        $this->address = '';
        $this->facebook = '';
        $this->instagram = '';
        $this->twitter = '';
        $this->youtube = '';
        $this->tiktok = '';
        $this->about = '';
        $this->logo = '';
        $this->favicon = '';
    }

    public function update()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'address' => 'required',
            'facebook' => 'required',
            'instagram' => 'required',
            'twitter' => 'required',
            'youtube' => 'required',
            'about' => 'required',
            'logo' => 'nullable|image|max:1024',
            'favicon' => 'nullable|image|max:1024',
        ]);

        $data = Identitas::first();
        $data->name = $this->name;
        $data->email = $this->email;
        $data->phone = $this->phone;
        $data->address = $this->address;
        $data->facebook = $this->facebook;
        $data->instagram = $this->instagram;
        $data->twitter = $this->twitter;
        $data->youtube = $this->youtube;
        $data->tiktok = $this->tiktok;
        $data->about = $this->about;
        if ($this->logo) {
            if ($this->logo) {
                $logo = $this->logo;
                $logo_name = Str::slug($this->name) . '.' . $logo->extension();

                $destinationPath = public_path('/img/identitas/');
                $img = Image::make($logo->getRealPath());
                $QuploadImage = $img->resize(700, 700, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destinationPath . $logo_name, 100);
                $data->logo = $logo_name;
            }
        }
        if ($this->favicon) {
            if ($this->favicon) {
                $favicon = $this->favicon;
                $favicon_name = Str::slug($this->name) . '.' . $favicon->extension();

                $destinationPath = public_path('/img/identitas/');
                $img = Image::make($favicon->getRealPath());
                $QuploadImage = $img->resize(700, 700, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destinationPath . $favicon_name, 100);
                $data->favicon = $favicon_name;
            }
        }

        activity()
            ->causedBy(Auth::user()->id)
            ->performedOn($data)
            ->withProperties(['attributes' => ['name' => $this->name, 'email' => $this->email, 'phone' => $this->phone, 'address' => $this->address, 'facebook' => $this->facebook, 'instagram' => $this->instagram, 'twitter' => $this->twitter, 'youtube' => $this->youtube, 'tiktok' => $this->tiktok, 'about' => $this->about, 'logo' => $this->logo, 'favicon' => $this->favicon]])
            ->log('Mengubah data identitas website');
        $data->save();
        $this->resetInput();
        $this->showAlert('success', 'Berhasil!', 'Data berhasil diubah.');
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

<?php

namespace App\Http\Livewire\Admin\Users;

use App\Models\Role;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class Detail extends Component
{
    use WithFileUploads;
    public $dataId, $name, $email, $role_id, $photo, $photoPrev, $password, $password_confirmation, $data, $username, $datas;
    public function render()
    {
        $roles = Role::where('id', '!=', 1)->get();
        return view('livewire.admin.users.detail',[
            'roles' => $roles,
        ])->layout('admin.layout')->layoutData(['title' => 'Detail User']);
    }

    public function mount($id)
    {
        $this->data = User::findOrFail($id);
        $this->dataId = $this->data->id;
        $this->name = $this->data->name;
        $this->username = $this->data->username;
        $this->email = $this->data->email;
        $this->role_id = $this->data->role_id;
        $this->photoPrev = $this->data->photo;
    }

    public function update()
    {
        $validate = $this->validate([
            'name' => 'required',
            'email' => 'required|email',
            'role_id' => 'required',
            'username' => 'required',
        ]);

        if($validate)
        {
            $data = User::findOrFail($this->dataId);
            $data->name = $this->name;
            $data->username = $this->username;
            $data->email = $this->email;
            $data->role_id = $this->role_id;
            if ($this->photo) {
                if ($this->photo) {
                    $photo = $this->photo;
                    $photo_name = Str::slug($this->name) . '.' . $photo->extension();

                    $destinationPath = public_path('/img/user/');
                    $img = Image::make($photo->getRealPath());
                    $QuploadImage = $img->resize(480, 480, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($destinationPath . $photo_name, 100);
                    $data->photo = $photo_name;
                }
            }
            activity()
            ->causedBy(Auth::user()->id)
            ->performedOn($data)
            ->withProperties(['attributes' => [
                'name' => $this->name,
                'username' => $this->username,
                'email' => $this->email,
                'role_id' => $this->role_id,
            ]])
            ->log('Identitas User "'.$data->username.'" Berhasil Diubah');
            $data->save();
            $this->showToastr('success', 'Data Berhasil Diubah');
        }
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

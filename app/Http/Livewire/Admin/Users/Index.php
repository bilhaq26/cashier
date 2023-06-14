<?php

namespace App\Http\Livewire\Admin\Users;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class Index extends Component
{
    use WithFileUploads;
    public $search;
    public $name, $username, $email, $password, $confirm_password, $role_id, $photo, $userId;
    public $page = [];
    public $selectedItems = [];
    public $selectAll = false;
    public $items;

    protected $listeners = [
        'appointments:delete' => 'delete',
        'appointments:deleteSelect' => 'deleteSelect',
        'appointments:changeStatusSelect' => 'changeStatusSelect',
    ];
    public function render()
    {
        $datas = User::where('id', '!=', 1)->orderBy('id', 'desc')
        ->when($this->search, function ($q) {
            $q->where('id', '!=', 1)
            ->where(function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('username', 'like', '%' . $this->search . '%')
                    ->orWhere('email', 'like', '%' . $this->search . '%');
            });
        })->paginate(10, ['*'], 'page');

        $roles = Role::where('id', '!=', 1)->get();
        return view('livewire.admin.users.index', [
            'datas' => $datas,
            'roles' => $roles,
        ])->layout('admin.layout')->layoutData(['title' => 'Users']);
    }

    public function resetInput()
    {
        $this->photo = null;
        $this->name = null;
        $this->username = null;
        $this->email = null;
        $this->password = null;
        $this->confirm_password = null;
        $this->role_id = null;
    }

    public function store()
    {
        $validate = $this->validate([
            'photo' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'name' => 'required',
            'username' => 'required|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'confirm_password' => 'required|same:password',
            'role_id' => 'required',
        ]);

        if ($validate) {
            $data = new User();
            $data->name = $this->name;
            $data->username = $this->username;
            $data->email = $this->email;
            $data->password = Hash::make($this->password);
            $data->role_id = $this->role_id;
            $data->status = 'Non-Active';
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
            ->withProperties(['attributes' => ['photo' => $data->photo, 'name' => $data->name, 'username' => $data->username, 'email' => $data->email, 'password' => $data->password, 'role_id' => $data->role_id, 'status' => $data->status]])
            ->log('menambahkan pengguna baru "' . $data->username . '"');
            $data->save();
            $this->showToastr('success', 'Pengguna Berhasil Ditambahkan');
            $this->emit('closeModal');
            $this->resetInput();
        }
    }

    public function changeStatus($id)
    {
        $data = User::find($id);
        if($data->status == 'Active'){
            activity()
            ->causedBy(Auth::user()->id)
            ->performedOn($data)
            ->withProperties(['attributes' => ['status' => 'Non-Active']])
            ->log('mengganti status "' . $data->username . '" menjadi Non-Active');
            $data->status = 'Non-Active';
        }else{
            activity()
            ->causedBy(Auth::user()->id)
            ->performedOn($data)
            ->withProperties(['attributes' => ['status' => 'Active']])
            ->log('mengganti statu "' . $data->username . '" menjadi Active');
            $data->status = 'Active';
        }
        $data->save();
        $this->showToastr('success', 'Status Pengguna Berhasil Diubah');
    }

    public function destroy($dataId)
    {
        $this->emit("swal:confirm", [
            'icon'        => 'warning',
            'title'       => 'Hapus Pengguna!',
            'text'        => "Anda yakin untuk menghapus Pengguna ini?",
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
        $data = User::find($id);
        $data->delete();
        $this->showToastr('success', 'Pengguna Berhasil Dihapus');
    }

    public function impersonate($userId)
    {
        $user = User::find($userId);

        if ($user->role_id != 1) {
            auth()->user()->impersonate($user);
            $this->showAlert('success', 'Impersonate', 'You are now impersonating ' . $user->name . '.');
            return redirect()->route('dashboard');
        } else {
            $this->showAlert('error', 'Impersonate', 'You cannot impersonate a non-admin user.');
        }
    }

    public function updated($field)
    {
        if($field == 'selectAll'){
            if($this->selectAll){
                $this->selectedItems = User::where('id', '!=', 1)->pluck('id');
            }else{
                $this->selectedItems = [];
            }
        }
    }

    public function status()
    {
        if($this->selectedItems){
            $this->emit("swal:confirm", [
                'icon'        => 'warning',
                'title'       => 'Ubah Status Pengguna!',
                'text'        => "Anda yakin untuk mengubah status Pengguna ini?",
                'confirmText' => 'Ubah!',
                'cancelText' => 'Tidak!',
                'method'      => 'appointments:changeStatusSelect',
                'onConfirmed' => 'confirmed',
                'params'      => $this->selectedItems, // optional, send params to success confirmation
                'callback'    => '', // optional, fire event if no confirmed
            ]);
        }else{
            $this->showToastr('error', 'Pilih Pengguna Terlebih Dahulu');
        }
    }

    public function changeStatusSelect()
    {
        $data = User::whereIn('id', $this->selectedItems)->get();
        foreach ($data as $key => $value) {
            if($value->status == 'Active'){
                activity()
                ->causedBy(Auth::user()->id)
                ->performedOn($value)
                ->withProperties(['attributes' => ['status' => 'Non-Active']])
                ->log('mengganti status "' . $value->username . '" menjadi Non-Active');
                $value->status = 'Non-Active';
            }else{
                activity()
                ->causedBy(Auth::user()->id)
                ->performedOn($value)
                ->withProperties(['attributes' => ['status' => 'Active']])
                ->log('mengganti statu "' . $value->username . '" menjadi Active');
                $value->status = 'Active';
            }
            $value->save();
        }
        $this->showToastr('success', 'Status Pengguna Berhasil Diubah');
    }

    public function mount()
    {
        $this->items = User::where('id', '!=', 1)->get();
    }

    public function destroySelect()
    {
        if($this->selectedItems){
            $this->emit("swal:confirm", [
                'icon'        => 'warning',
                'title'       => 'Hapus Pengguna!',
                'text'        => "Anda yakin untuk menghapus Pengguna ini?",
                'confirmText' => 'Hapus!',
                'cancelText' => 'Tidak!',
                'method'      => 'appointments:deleteSelect',
                'onConfirmed' => 'confirmed',
                'params'      => $this->selectedItems, // optional, send params to success confirmation
                'callback'    => '', // optional, fire event if no confirmed
            ]);
        }else{
            $this->showToastr('error', 'Pilih Pengguna Terlebih Dahulu');
        }
    }

    public function deleteSelect()
    {
        $data = User::whereIn('id', $this->selectedItems)->get();
        foreach ($data as $key => $value) {
            $value->delete();
        }
        $this->showToastr('success', 'Pengguna Berhasil Dihapus');
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

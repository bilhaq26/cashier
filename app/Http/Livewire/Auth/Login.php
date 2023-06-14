<?php

namespace App\Http\Livewire\Auth;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Login extends Component
{
    public $username, $password, $captchaImg, $captcha;

    public function render()
    {
        if (Auth::check()) {
            redirect()->route('dashboard');
        }
        return view('livewire.auth.login')->layout('auth.layout');
    }

    public function login()
    {
        $validate = $this->validate([
            'username' => 'required|alpha_dash',
            'password' => 'required',
            'captcha' => 'required|captcha'
        ],[
            'username.required' => 'Username tidak boleh kosong',
            'password.required' => 'Password tidak boleh kosong',
            'captcha.required' => 'Captcha tidak boleh kosong',
        ]);

        if ($validate) {
            $check = User::where('username', $this->username)->first();
            // make username status active
            if ($check->status == 'Active') {
                if (Auth::attempt([
                    'username' => $this->username,
                    'password' => $this->password,
                    'status' => 'Active'])) {
                        activity()
                        ->causedBy(Auth::user()->id)
                        ->withProperties(['username' => $this->username])
                        ->log('User Sedang Login');
                    $this->showToastr('success', 'Success', 'Login berhasil');
                    return redirect()->route('dashboard');
                } else {
                    $this->showToastr('error', 'Error', 'Password salah');
                }
            } else {
                $this->showToastr('error', 'Error', 'Username tidak aktif');
            }
        }

    }

    public function updated($field)
    {
        if ($field == 'username') {
            $validate = $this->validateOnly($field, [
                'username' => 'required|exists:users,username',
            ], [
                'username.exists' => 'Username tidak terdaftar'
            ]);

            // $check = \App\Models\User::where('username', $this->username)->first();
            // if (!$check) {
            //     $this->showAlert('error', 'Error', 'Username tidak ditemukan');
            // }
        }
    }

    public function mount()
    {
        $this->captchaImg = captcha_img('math');
    }

    public function refreshCaptcha()
    {
        $this->captchaImg = captcha_img('math');
        $this->captcha = null;
        $this->resetErrorBag('captcha');
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
    public function showToastr($icon, $title, $text)
    {
        $this->emit('swal:alert', [
            'icon'    => $icon,
            'title'   => $title,
            'text'  => $text,
            'timeout' => 10000000
        ]);
    }
}

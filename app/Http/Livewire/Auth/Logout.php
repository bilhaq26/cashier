<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Logout extends Component
{
    public $username;
    public function mount()
    {
        activity()
            ->causedBy(Auth::user()->id)
            ->withProperties(['username' => Auth::user()->username])
            ->log('User Sedang Logout');
        auth()->logout();


        return redirect()->route('login');
    }
}

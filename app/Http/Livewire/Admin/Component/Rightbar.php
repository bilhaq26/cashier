<?php

namespace App\Http\Livewire\Admin\Component;

use Livewire\Component;

class Rightbar extends Component
{
    public $user;
    public function render()
    {
        $this->user = auth()->user();
        return view('livewire.admin.component.rightbar');
    }
}

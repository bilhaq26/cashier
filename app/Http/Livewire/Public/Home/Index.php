<?php

namespace App\Http\Livewire\Public\Home;

use App\Models\Post\Linked;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.public.home.index',[
        ])->layout('public.layout')->layoutData(['title' => 'Home']);
    }
}

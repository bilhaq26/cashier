<?php

namespace App\Http\Livewire\Admin\Laporan;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.admin.laporan.index')->layout('admin.layout')->layoutData(['title' => 'Laporan']);
    }
}

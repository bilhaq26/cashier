<?php

namespace App\Http\Livewire\Admin\Component;

use App\Models\Web\Identitas;
use Livewire\Component;

class Sidebar extends Component
{
    public function render()
    {
        $identitas = Identitas::first();
        return view('livewire.admin.component.sidebar',[
            'identitas' => $identitas,
        ]);
    }
}

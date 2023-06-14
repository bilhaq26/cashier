<?php

namespace App\Http\Livewire\Public\Component;

use App\Models\Web\Identitas;
use Livewire\Component;

class Footer extends Component
{
    public function render()
    {
        $identitas = Identitas::first();
        return view('livewire.public.component.footer',[
            'identitas' => $identitas
        ]);
    }
}

<?php

namespace App\Livewire\Student;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.student')]
#[Title('Pembayaran - Student Portal')]
class Pembayaran extends Component
{
    public function render()
    {
        return view('livewire.student.pembayaran', [
            'user' => Auth::user(),
        ]);
    }
}

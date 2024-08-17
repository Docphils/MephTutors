<?php

namespace App\Livewire;

use Livewire\Component;

class TextRotator extends Component
{
    public $texts = ['Home Tutoring', 'Coding', 'Music Tutors'];
    public $currentIndex = 0;

    public function mount()
    {
        $this->currentIndex = 0;
    }

    public function showNextText()
    {
        $this->currentIndex = ($this->currentIndex + 1) % count($this->texts);
    }

    public function render()
    {
        return view('livewire.text-rotator', [
            'currentText' => $this->texts[$this->currentIndex]
        ]);
    }

}

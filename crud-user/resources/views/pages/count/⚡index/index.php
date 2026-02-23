<?php

use Livewire\Component;


new class extends Component {
    public $count = 1;

    public function increment()
    {
        $this->count++;
    }
    public function decrement()
    {
        $this->count--;
    }
};

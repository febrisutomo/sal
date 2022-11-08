<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Surat extends Component

{

    public $judul;
    public $pengambilan;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($judul, $pengambilan)
    {
        $this->judul = $judul;
        $this->pengambilan = $pengambilan;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.surat');
    }
}

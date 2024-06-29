<?php

namespace App\Livewire;

use Livewire\Component;

class CrudUpdate extends Component
{
    public $s_id;
    public $name;
    public $email;
    public $phone;
    
    public function render()
    {
        return view('livewire.crud-update');
    }
}

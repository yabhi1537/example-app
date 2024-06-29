<?php

namespace App\Livewire;

use App\Models\CrudModel;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class CrudOpration extends Component
{

    public $name;
    public $email;
    public $phone;

    public function render()
    {
        return view('livewire.crud-opration');
    }

    public function submit()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required'
        ]);
  
        if ($this->name)
        {
     CrudModel::create([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
        ]);
       
        }
       $this->render();
    }

    public function resetFilter()
    {
        $this->reset(['name','email','phone']);
    }


}

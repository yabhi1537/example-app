<?php

namespace App\Livewire;

use App\Models\CrudModel;
use Livewire\Component;

class CrudList extends Component
{
    public $data;
    public $s_id;
    public $name;
    public $email;
    public $phone;
    public $check = true;

    public $search;

    public function mount()
    {
        $this->search = CrudModel::get();
    }

    public function render() 
    {
        return view('livewire.crud-list');
       
    }

    public function deleteType($typeID)
    {
            $types = CrudModel::findOrFail($typeID);
            $types->delete();
            $this->mount();
    }

    public function updateData($id)
    {
        $s_id = $id;
        $data = CrudModel::findOrFail($id);
        $data->name = $this->name;
        $data->email = $this->email;
        $data->phone = $this->phone;
        $this->check = false;
    }
}

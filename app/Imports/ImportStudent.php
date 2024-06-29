<?php

namespace App\Imports;

use App\Models\Student;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;

class ImportStudent implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        $value = [];
        foreach($collection as $data)
        {
            $value[] = array(
                
                'name' => $data[1],
                'email' => $data[2],
                'course' => $data[3],
                'phone' => $data[4],
                'catname' => $data[5],
            );
        }
       
        Student::insert($value);
    }
}

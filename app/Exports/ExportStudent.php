<?php

namespace App\Exports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportStudent implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
       return Student::select("id", "name", "email","course","catname","phone")->get();
    }

    public function headings(): array
    {
        return ["ID", "Name", "Email","Course","Catname","Phone"];
    }
}

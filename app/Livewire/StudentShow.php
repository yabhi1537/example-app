<?php

namespace App\Livewire;

use App\Exports\ExportStudent;
use App\Imports\ImportStudent;
use App\Models\CategoryModel;
use Livewire\WithPagination;
use App\Models\Student;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;
use App\Events\PostCreated;

use function PHPUnit\Framework\isEmpty;

class StudentShow extends Component
{
    use WithPagination;
    use WithFileUploads;

    protected $paginationTheme = 'bootstrap';
   

    public $name, $email, $course, $student_id;
    public $search;
    protected $queryString = ['search'];

    public $showdiv = false;
    public $records;
    public $empDetails;
    public $photos;
    public $filename;
    public $csvfilename;
    public $fileStu;
    public $catname;
    public $phone;
    

    protected function rules()
    {
        return [
            'name' => 'required|string',
            'email' => ['required','email'],
            'course' => 'required|string',
            'photos' => 'required',
            'phone' => 'required',
            'catname' => 'required',
        ];
    }



    public function importStudent() 
    {
       
        Excel::import(new ImportStudent, $this->fileStu);
    }

    public function exportStudent(){
        return Excel::download(new ExportStudent, 'student.csv');
    }

    public function export($filename)
    {
      return response()->download(storage_path('app/public/photos/' .$filename));   
    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function saveStudent()
    {
        $validatedData = $this->validate();

        $name1 = md5($this->photos . microtime()).'.'.$this->photos->extension();
        $this->photos->storeAs('photos', $name1,'public');

            $data = new Student();
            $data->name = $this->name;
            $data->email = $this->email;
            $data->course = $this->course;
            $data->phone = $this->phone;
            $data->catname = $this->catname;
            $data->photos = $name1;
            $data->save();
            event(new PostCreated($data));
        session()->flash('message','Student Added Successfully');
        $this->resetInput();
        $this->dispatch('close-modal');
    }

    public function editStudent(int $student_id)
    {
        $student = Student::find($student_id);
        if($student){
            $this->student_id = $student->id;
            $this->name = $student->name;
            $this->email = $student->email;
            $this->course = $student->course;
            $this->photos = $student->photos;
            $this->phone = $student->phone;
            $this->catname = $student->catname;
        }else{
            return redirect()->to('/students');
        }
    }

    public function updateStudent()
    {
        $validatedData = $this->validate();

    // $photo = Student::select('photos')->where('id',$this->student_id)->first();
            $name1 = md5($this->photos . microtime()).'.'.$this->photos->extension();
            $this->photos->storeAs('photos', $name1,'public');

        Student::where('id',$this->student_id)->update([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'course' => $validatedData['course'],
            'phone' => $validatedData['phone'],
            'catname' => $validatedData['catname'],
            'photos' => $name1
        ]);
        session()->flash('message','Student Updated Successfully');
        $this->resetInput();
        $this->dispatch('close-modal');
    }

    public function deleteStudent(int $student_id)
    {
        $this->student_id = $student_id;
    }

    public function destroyStudent()
    {
        Student::find($this->student_id)->delete();
        session()->flash('message','Student Deleted Successfully');
     
        $this->dispatch('close-modal');
    }

    public function closeModal()
    {
        $this->resetInput();
    }

    public function resetInput()
    {
        $this->name = '';
        $this->email = '';
        $this->course = '';
        $this->phone = '';
        $this->catname = '';
    }
         
    public function render()
    {
        $catname = CategoryModel::get();
        return view('livewire.student-show',
         ['students'=> Student::where('name', 'like', '%'.$this->search.'%')
         ->orwhere('email', 'like', '%'.$this->search.'%')
         ->orwhere('phone', 'like', '%'.$this->search.'%')
         ->orwhere('course', 'like', '%'.$this->search.'%')
         ->paginate(4)],['catnameall'=>$catname]);
    }
}
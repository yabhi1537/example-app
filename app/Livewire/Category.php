<?php
namespace App\Livewire;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\CategoryModel;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Category extends Component
{
    use WithFileUploads;
    public $categories, $name, $description, $category_id, $photos;
    public $updateCategory = false;

    protected $listeners = [
        'deleteCategory'=>'destroy'
    ];

    protected $rules = [
        'name'=>'required',
        'description'=>'required',
        'photos' => 'required'
    ];

    public $product;
    public $search;
    public $error = '';

    public function searchProduct(){
        try {
            $this->product = CategoryModel::where('name', 'like', '%'.$this->search.'%')
           ->orwhere('description', 'like', '%'.$this->search.'%')->get();
            $this->reset(['error']); 
        } catch(ModelNotFoundException $e) {
            $this->error = 'Product not found.'; 
        }
    }


    public function render()
    {
        $this->categories = CategoryModel::select('id','name','description','photos')->get();
        return view('livewire.category');
    }
    public function resetFields(){
        $this->name = '';
        $this->description = '';
        $this->photos = '';
    }
    public function store(){
   
        $this->validate();
        try{
              $name1 = md5($this->photos . microtime()).'.'.$this->photos->extension();
              $this->photos->storeAs('photos', $name1,'public');

             $data = new CategoryModel();
             $data->name = $this->name;
             $data->description = $this->description;
             $data->photos = $name1;
             $data->save();
            session()->flash('success','Category Created Successfully!!');
            $this->resetFields();
        }catch(\Exception $e){
            session()->flash('error','Something goes wrong while creating category!!');
            $this->resetFields();
        }
    }
    public function edit($id){
        $category = CategoryModel::findOrFail($id);
        $this->name = $category->name;
        $this->description = $category->description;
        $this->category_id = $category->id;
        $this->updateCategory = true;
    }
    public function cancel()
    {
        $this->updateCategory = false;
        $this->resetFields();
    }
    public function update(){
        $this->validate();
        try{
            CategoryModel::find($this->category_id)->fill([
                'name'=>$this->name,
                'description'=>$this->description
            ])->save();
            session()->flash('success','Category Updated Successfully!!');
    
            $this->cancel();
        }catch(\Exception $e){
            session()->flash('error','Something goes wrong while updating category!!');
            $this->cancel();
        }
    }
    public function destroy($id){
       
        try{
            CategoryModel::find($id)->delete();
            session()->flash('success',"Category Deleted Successfully!!");
        }catch(\Exception $e){
            session()->flash('error',"Something goes wrong while deleting category!!");
        }
    }
}
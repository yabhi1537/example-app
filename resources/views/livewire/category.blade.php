<div>
    <div class="col-md-10 mb-2">
        <div class="card">
            <div class="card-body">
                @if(session()->has('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session()->get('success') }}
                    </div>
                @endif
                @if(session()->has('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ session()->get('error') }}
                    </div>
                @endif
                @if($updateCategory)
                    @include('livewire.update')
                @else
                    @include('livewire.create')
                @endif
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
           <div>
                <form wire:submit="searchProduct">
                    <input type="text" wire:model="search" placeholder="Searching now">
                    <button type="submit" >Search item</button>
                </form>
            </div>
            
                    <table class="table">
                        <thead>
                            <tr>

                                <th>Name</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($product))

                                @foreach ($product as $categorys)
                                    <tr>
                                        <td>
                                            {{$categorys->name}}
                                        </td>
                                        <td>
                                            {{$categorys->description}}
                                        </td>
                                        <td>
                                        <div class="w-1/2 p-2">
                                            <div class="w-full h-full border">
                                                <img src="{{Storage::url('public/photos/' . $categorys->photos) }}" width="50px" height="50px">
                                            </div>
                                        </div>
                                        </td>
                                        <td>

                                            <button wire:click="edit({{$categorys->id}})" class="btn btn-primary btn-sm">Edit</button>
                                            <button
                                             class="btn btn-danger btn-sm"
                                                type="button"
                                                wire:click="destroy({{$categorys->id}})"
                                                wire:confirm="Are you sure you want to delete this post?"
                                            >
                                                Delete post 
                                            </button>
                                        </td>
                                    </tr>

                                @endforeach
                            @else
                                @foreach ($categories as $category)
                                    <tr>
                                        <td>
                                            {{$category->name}}
                                        </td>
                                        <td>
                                            {{$category->description}}
                                        </td>
                                        <td>
                                        <div class="w-1/2 p-2">
                                            <div class="w-full h-full border">
                                                <img src="{{Storage::url('public/photos/' . $category->photos) }}" width="50px" height="50px">
                                            </div>
                                        </div>
                                        </td>
                                        <td>

                                            <button wire:click="edit({{$category->id}})" class="btn btn-primary btn-sm">Edit</button>
                                            <button
                                             class="btn btn-danger btn-sm"
                                                type="button"
                                                wire:click="destroy({{$category->id}})"
                                                wire:confirm="Are you sure you want to delete this post?"
                                            >
                                                Delete post 
                                            </button>
                                        </td>
                                    </tr>
                                    @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script>
        function deleteCategory(id){
            if(confirm("Are you sure to delete this record?"))
                window.livewire.emit('deleteCategory',id);
        }
    </script>
</div>

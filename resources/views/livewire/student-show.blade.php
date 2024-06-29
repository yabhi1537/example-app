<div>
    @include('livewire.studentmodal')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
  <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
  <script>
    Pusher.logToConsole = true;

    var pusher = new Pusher('e6f86185590c8fcfb19e', {
      cluster: 'ap2'
    });

    var channel = pusher.subscribe('my-channel');
    channel.bind('form-submitted', function(data) {
      if (data && data.post && data.post.name && data.post.catname) {
        toastr.success('New Post Created', 'Name: ' + data.post.name + '<br>Course: ' + data.post.catname, {
          timeOut: 0,  
          extendedTimeOut: 0,  
        });
      } else {
        console.error('Invalid data structure received:', data);
      }
    });
  </script>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                @if (session()->has('message'))
                    <h5 class="alert alert-success">{{ session('message') }}</h5>
                @endif
               
                <div class="card">
                <div class="card-header">
                <a href="{{ route('logouts') }}" class="btn btn-warning float-end mx-2">logout</a>
                <button type="submit" class="btn btn-info float-end mx-2" wire:click="exportStudent">export csv</button>
                <a href="http://127.0.0.1:8000/post" class="btn btn-dark float-end mx-2">News Post</a>
                <a href="http://127.0.0.1:8000/phonepe" class="btn btn-sm float-end mx-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" viewBox="0 0 24 24"><path fill="currentColor" d="M10.206 9.941h2.949v4.692c-.402.201-.938.268-1.34.268c-1.072 0-1.609-.536-1.609-1.743zm13.47 4.816c-1.523 6.449-7.985 10.442-14.433 8.919C2.794 22.154-1.199 15.691.324 9.243C1.847 2.794 8.309-1.199 14.757.324c6.449 1.523 10.442 7.985 8.919 14.433m-6.231-5.888a.887.887 0 0 0-.871-.871h-1.609l-3.686-4.222c-.335-.402-.871-.536-1.407-.402l-1.274.401c-.201.067-.268.335-.134.469l4.021 3.82H6.386c-.201 0-.335.134-.335.335v.67c0 .469.402.871.871.871h.938v3.217c0 2.413 1.273 3.82 3.418 3.82c.67 0 1.206-.067 1.877-.335v2.145c0 .603.469 1.072 1.072 1.072h.938a.43.43 0 0 0 .402-.402V9.874h1.542c.201 0 .335-.134.335-.335z"/></svg> Pay with PhonePe
                </a>
                <a href="http://127.0.0.1:8000/stripe" class="btn float-end mx-2">
                Pay with 
                <svg xmlns="http://www.w3.org/2000/svg" width="2.4em" height="1em" viewBox="0 0 512 214"><path fill="#635bff" d="M512 110.08c0-36.409-17.636-65.138-51.342-65.138c-33.85 0-54.33 28.73-54.33 64.854c0 42.808 24.179 64.426 58.88 64.426c16.925 0 29.725-3.84 39.396-9.244v-28.445c-9.67 4.836-20.764 7.823-34.844 7.823c-13.796 0-26.027-4.836-27.591-21.618h69.547c0-1.85.284-9.245.284-12.658m-70.258-13.511c0-16.071 9.814-22.756 18.774-22.756c8.675 0 17.92 6.685 17.92 22.756zm-90.31-51.627c-13.939 0-22.899 6.542-27.876 11.094l-1.85-8.818h-31.288v165.83l35.555-7.537l.143-40.249c5.12 3.698 12.657 8.96 25.173 8.96c25.458 0 48.64-20.48 48.64-65.564c-.142-41.245-23.609-63.716-48.498-63.716m-8.534 97.991c-8.391 0-13.37-2.986-16.782-6.684l-.143-52.765c3.698-4.124 8.818-6.968 16.925-6.968c12.942 0 21.902 14.506 21.902 33.137c0 19.058-8.818 33.28-21.902 33.28M241.493 36.551l35.698-7.68V0l-35.698 7.538zm0 10.809h35.698v124.444h-35.698zm-38.257 10.524L200.96 47.36h-30.72v124.444h35.556V87.467c8.39-10.951 22.613-8.96 27.022-7.396V47.36c-4.551-1.707-21.191-4.836-29.582 10.524m-71.112-41.386l-34.702 7.395l-.142 113.92c0 21.05 15.787 36.551 36.836 36.551c11.662 0 20.195-2.133 24.888-4.693V140.8c-4.55 1.849-27.022 8.391-27.022-12.658V77.653h27.022V47.36h-27.022zM35.982 83.484c0-5.546 4.551-7.68 12.09-7.68c10.808 0 24.461 3.272 35.27 9.103V51.484c-11.804-4.693-23.466-6.542-35.27-6.542C19.2 44.942 0 60.018 0 85.192c0 39.252 54.044 32.995 54.044 49.92c0 6.541-5.688 8.675-13.653 8.675c-11.804 0-26.88-4.836-38.827-11.378v33.849c13.227 5.689 26.596 8.106 38.827 8.106c29.582 0 49.92-14.648 49.92-40.106c-.142-42.382-54.329-34.845-54.329-50.774"/></svg> 
                </a>
                <a href="{{ url('weather') }}" class="btn btn-warning float-end mx-2">Weather Search</a>
                <a href="{{ url('pusher') }}" class="btn btn-warning float-end mx-2">Notification</a>
            </div>
                    <div class="card-header">
                        <form wire:submit="importStudent">
                        <button type="submit" class="btn btn-secondary float-end mx-2">Import Data</button>
                        <input type="file"  wire:model.live="fileStu" class="form-control float-end mx-2" style="width: 235px">
                        </form>
                            <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#studentModal">
                                Add New Student
                            </button>
                            <input type="search" wire:model.live.debounce.1s="search"  class="form-control float-end mx-2" placeholder="Search..." style="width: 230px" />

                    </div>
                    <div class="card-body">
                        <table class="table table-borderd table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Course</th>
                                    <th>Phone</th>
                                    <th>Course Name</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($students as $student)
                                    <tr>
                                        <td>{{ $student->id }}</td>
                                        <td>{{ $student->name }}</td>
                                        <td>{{ $student->email }}</td>
                                        <td>{{ $student->course }}</td>
                                        <td>{{ $student->phone }}</td>
                                        <td>{{ $student->catname }}</td>
                                        <td>
                                        <div class="w-1/2 p-2">
                                            <div class="w-full h-full">
                                                <img src="{{Storage::url('public/photos/' . $student->photos) }}" width="50px" height="50px">
                                            </div>
                                        </div>
                                        </td>
                                               <?php 
                                               $filename = $student->photos;
                                               ?>
                                        <td>
                                        <button type="submit" class="btn btn-outline-success" wire:click="export('{{ $filename }}')">
                                            Download File
                                        </button>
                                            <button type="button" data-bs-toggle="modal" data-bs-target="#updateStudentModal" wire:click="editStudent({{$student->id}})" class="btn btn-outline-primary">
                                                Edit
                                            </button>
                                            <button type="button" data-bs-toggle="modal" data-bs-target="#deleteStudentModal" wire:click="deleteStudent({{$student->id}})" class="btn btn-outline-danger">Delete</button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5">No Record Found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div>
                        {{ $students->links() }}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
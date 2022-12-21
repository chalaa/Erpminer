<x-user-layout>
    <section class="content pt-3 pl-5 pr-5">
        <div class="container-fluid">
            <div class="card card-default">
                <div class="card-body ">
                   @php
                   // dd($layout->column[0]->column_number);
                   @endphp
                    {{-- <x-auth-validation-errors class="mb-2 " :errors="$errors" /> --}}
                    <form method="POST" enctype="multipart/form-data" action="{{ route('layoutUpdate',$layout->id) }}">
                        @csrf
                        @method('put')
                        <div class="card-body">
                            <div class="form-group">
                                <label>Report name:  {{ $layout->report_name }}</label>
                            </div>
                            <div class="form-group">
                                <label>Layout Name</label>
                                <input type="text" name="layout_name" class="form-control" placeholder="Layout Name" value="{{ $layout->layout_name }}" required>
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control" name="description" rows="4" placeholder="Enter about the layout description..." required>{{ $layout->description }}</textarea>
                            </div>
                            
                        </div>
                         <div class="display-flex">
                            <button  type="submit" class="btn btn-primary bg-primary mb-3 mr-3 btn-md float-right">Save Current Layout</button>
                        </div>
                </form> 
                </div>
            </div>
        </div>
    </section>
</x-user-layout>
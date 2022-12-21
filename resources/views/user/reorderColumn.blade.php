<x-user-layout>
    <section class="content pt-3 pl-5 pr-5">
        <div class="container-fluid">
            <div class="card card-default">
                <div class="card-body ">
                   @php
                   // dd($layout->column[0]->column_number);
                   @endphp
                    {{-- <x-auth-validation-errors class="mb-2 " :errors="$errors" /> --}}
                    <form method="POST" enctype="multipart/form-data" action="{{ route('columnUpdate',$layout->id) }}">
                        @csrf
                        @method('put')
                        <div class="card-body">
                            <div class="form-group">
                                <label>Layout name:  {{ $layout->layout_name }}</label>
                            </div>
                            <div class="row">
                                @for($i = 0; $i < $layout->report->column_number; $i++)
                                    <div class="col-md-6 ">
                                        <div class="form-group">
                                            <label>{{ $layout->column[$i]->column_name }}</label>
                                            <input type="hidden" name="column_name[]" class="form-control" placeholder="Enter Column number" value="{{ $layout->column[$i]->column_name }}" required>
                                            <input type="number" name="column_number[]" class="form-control" placeholder="Enter Column number" value="{{ $layout->column[$i]->column_number  }}" required>
                                    </div>
                                    </div>
                                @endfor
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
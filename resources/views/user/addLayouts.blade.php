<x-user-layout>
    <section class="content pt-3 pl-5 pr-5">
        <div class="container-fluid">
            <div class="card card-default">
                <div class="card-body ">
                    
                    {{-- <x-auth-validation-errors class="mb-2 " :errors="$errors" /> --}}
                    <form method="POST" enctype="multipart/form-data" action="{{ route('user.layout.store',$report->id) }}">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label>Report name:  {{ $report->report_name }}</label>
                            </div>
                            <div class="form-group">
                                <label>Layout Name</label>
                                <input type="text" name="layout_name" class="form-control" placeholder="Layout Name" value="{{ old('layout_name') }}" required>
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control" name="description" rows="4" placeholder="Enter about the layout description..." required>{{ old('description') }}</textarea>
                            </div>
                            <div class="row">
                                @for($i = 0; $i < $report->column_number; $i++)
                                   
                                    <div class="col-md-6 ">
                                        <div class="form-group">
                                            <label>{{ $report->column[$i]->column_name }}</label>
                                            <input type="hidden" name="column_name[]" class="form-control" placeholder="Enter Column number" value="{{ $report->column[$i]->column_name }}" required>
                                            <input type="number" name="column_number[]" class="form-control" placeholder="Enter Column number" value="{{ old("column_number[$i]") }}" required>
                                    </div>
                                    </div>
                                @endfor
                            </div>
                        </div>
                         <div class="display-flex">
                            <button name="addDrug" type="submit" class="btn btn-primary bg-primary mb-3 mr-3 btn-md float-right">Save Current Layout</button>
                        </div>
                </form> 
                </div>
            </div>
        </div>
    </section>
</x-user-layout>
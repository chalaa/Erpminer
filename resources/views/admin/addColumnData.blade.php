<x-admin-layout>
    <section class="content pt-3 pl-5 pr-5">
        <div class="container-fluid">
            <div class="card card-default">
                <div class="card-body ">
                    {{-- <x-auth-validation-errors class="mb-2 " :errors="$errors" /> --}}
                    <form method="POST" enctype="multipart/form-data" action="{{ route('column.store',$reports[0]->report_id) }}">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                @foreach ($reports as $report)
                                <div class="col-md-6 ">
                                    <div class="form-group">
                                        <label>{{ $report->column_name }}</label>
                                        <input type="text" name="column_name[]" class="form-control" placeholder="report_name" value="" required>
                                    </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                         <div class="display-flex">
                            <button name="addDrug" type="submit" class="btn btn-primary bg-primary mb-3 mr-3 btn-md float-right">Add</button>
                        </div>
                </form> 
                </div>
            </div>
        </div>
    </section>
</x-admin-layout>
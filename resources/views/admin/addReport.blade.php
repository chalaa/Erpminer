<x-admin-layout>
        <section class="content pt-3 pl-5 pr-5">
            <div class="container-fluid">
                <div class="card card-default">
                    <div class="card-body ">
                        {{-- <x-auth-validation-errors class="mb-2 " :errors="$errors" /> --}}
                        <form method="POST" enctype="multipart/form-data" action="{{ route('report.store') }}">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Report name</label>
                                    <input type="text" name="report_name" class="form-control" placeholder="report_name" value="" required>
                                </div>
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea class="form-control" name="description" rows="4" placeholder="Enter about the report description..." required></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">File</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" name="report_file" class="custom-file-input" value="{{old('report_file')}}" required>
                                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Column Number</label>
                                    <input type="number" name="column_number" class="form-control" placeholder="Column Number" value="" required>
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
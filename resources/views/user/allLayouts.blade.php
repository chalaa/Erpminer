<x-user-layout>
    <div class="content pt-5 ml-5 mr-5">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Report Layout List</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0" style="height: 400px;">
                            <table class="table table-head-fixed text-nowrap">
                                <thead>
                                    <tr>
                                        <th>Layout ID</th>
                                        <th>Report Name</th>
                                        <th>Layout name</th>
                                        <th class="w-50">description</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($reports as $report)
                                    <tr>
                                        <td>{{ $report->id }}</td>
                                        <td>{{ $report->report_name }}</td>
                                        <td>{{ $report->layout_name }}</td>
                                        <td class="w-50">{{ $report->description }}</td>
                                        <td>
                                            <a href="{{ route('layoutEdit',$report->id) }}" class="btn bg-primary btn-sm btn-info ml-3 mr-2">Edit layout</a>
                                            <a href="{{ route('reordercolumn',$report->id) }}" class="btn bg-primary btn-sm btn-info ml-3">Reorder column</a>
                                           <form action="{{ route('updateDefault',[$report->report_id,$report->id]) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="report_name" class="form-control" value="{{ $report->report_name }}" required>
                                                <input type="hidden" name="layout_name" class="form-control" value="{{ $report->layout_name }}" required>
                                                <button type="submit" class="btn btn-sm btn-info mt-3 ml-3 mb-3 bg-primary ">set Default</button>
                                            </form>
                                            <form action="{{ route('deletelayout',$report->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-info ml-3 btn-danger bg-danger">Delete</button>
                                            </form>
                                            
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </div>
</x-user-layout>
<x-user-layout>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-1000">
            <div class="row">
                <div class="col-12">
                  <div class="card">
                    <div class="card-header">
                      <h3 class="card-title">{{ $report->report_name }}</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive pt-2">
                      <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                          
                          <tr>
                            @for($i = 1; $i <= sizeof($arr); $i++)
                                <th>{{ $arr[$i] }}</th>
                            @endfor
                          </tr>
                        </thead>
                        <tbody>
                            @for($i = 0; $i < sizeof($datas); $i++)
                                @php
                                    $coldata= $datas[$i];
                                @endphp
                                <tr>
                                    @for($j = 1; $j <= sizeof($arr); $j++)  
                                        <td>{{ $datas[$i][$j] }}</td>
                                    @endfor
                                </tr>     
                            @endfor
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
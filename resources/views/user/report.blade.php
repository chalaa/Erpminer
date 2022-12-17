<x-user-layout>
    @php
        $columns = $report->column->where('layout_id', $reportDefault[0]->layout_id);
        $arr = [];
        $columnIds = [];
        $datas = [];
        $colnum= [];
        foreach ($columns as $column) {
            $arr[$column->column_number] = $column->column_name;
            $columnIds[$column->id] = $column->id;
            $colnum[$column->id] = $column->column_number;
        }
        // dd(sizeof($columnIds));
        
        $data =  $report->columnData->whereIn('column_id',$columnIds);
        $coldat =$report->column;
        $tmp = 0;
      
        for($i = 0; $i < (sizeof($data)/sizeof($columnIds)); $i++) {
            $arrdata = [];
            for($j = 0; $j < sizeof($columnIds); $j++){
                $arrdata[$colnum[$columnIds[$data[$tmp]->column_id]]] = $data[$tmp]->column_data;
                $tmp++;
            }
            $datas[$i] = $arrdata;
        }
       
    @endphp
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-1000">
            <div class="row">
                <div class="col-12">
                  <div class="card">
                    <div class="card-header">
                      <h3 class="card-title">{{ $report->report_name }}</h3>
        
                      <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                          <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
        
                          <div class="input-group-append">
                            <button type="submit" class="btn btn-default">
                              <i class="fas fa-search"></i>
                            </button>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0" style="height: 300px;">
                      <table class="table table-head-fixed text-nowrap">
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
                                    @for($j = 1; $j <= sizeof($datas[$i]); $j++)  
                                        <td>{{ $coldata[$j] }}</td>
                                    @endfor
                                <tr>
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
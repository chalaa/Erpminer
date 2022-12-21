<?php

namespace App\Http\Controllers;

use App\Models\ReportColumnData;
use App\Models\ReportLayoutColumn;
use Illuminate\Http\Request;
use App\Models\Report;
use App\Models\ReportLayoutDefault;
use Illuminate\Support\Facades\Auth;

class ReportColumnDataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        //
        $userid = Auth::user()->id;
       

        if(ReportLayoutDefault::where('report_id', $id)->where('user_id',$userid)->get()->isEmpty()){
            $report =  Report::find($id);
            $reportDefault =  ReportLayoutDefault::where('report_id', $id)->where('user_id',1)->get();
        }else{
            $report =  Report::find($id);
            $reportDefault =  ReportLayoutDefault::where('report_id', $id)->where('user_id',$userid)->get();
        }

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
       

       return view('user.report',[
        'report' => $report,
        'arr' => $arr,
        'json_data' => json_encode($datas,JSON_FORCE_OBJECT),
        'datas' => $datas,
        'coldat' => $coldat,
    ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        //
        

        return view('admin.addColumnData',[
            'reports' =>ReportLayoutColumn::where('report_id', $id)->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        //
        $request->validate([
            'column_name' => ['required','array'],
            'column_name.*' => ['required','string']
        ]);

        $report=ReportLayoutColumn::where('report_id', $id)->get();

        
        foreach($request->column_name as $key=>$value){
            ReportColumnData::create([
                'report_id' => $report[$key]->report_id,
                'column_id' => $report[$key]->id,
                'column_data' => $value
            ]);
        }

        return redirect('dashboard')->with('success_msg', 'Layout created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

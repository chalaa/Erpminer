<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\ReportLayout;
use App\Models\ReportLayoutColumn;
use App\Models\ReportLayoutDefault;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ReportLayoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        //
        return view('admin.addLayouts',[
            'report' => Report::find($id)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request , $id)
    {
        //
        $report = Report::find($id);
        $request->validate([
            'layout_name' => ['required','string','unique:report_layouts'],
            'description' => ['required','string'],
            'column_name' => ['required','array'],
            'column_name.*' => ['required','string'],
            'column_number' => ['required','array'],
            'column_number.*' => ['required','integer',"max:$report->column_number","min:1"],
        ]);
        
       

        $layout = ReportLayout::create([
            'report_id' => $report->id,
            'layout_name' => $request->layout_name,
            'report_name' => $report->report_name,
            'description' => $request->description
        ]);

        $columnNumber = $request->column_number;
        foreach($request->column_name as $key => $value) {
            ReportLayoutColumn::create([
                'column_number' => $columnNumber[$key],
                'report_id'=>$report->id,
                'layout_id'=> $layout->id,
                'layout_name'=> $layout->layout_name,
                'report_name'=> $report->report_name,
                'column_name' => $value,
                'column_number'=> $columnNumber[$key]
            ]);
        }
        // for($i = 0; $i < $report->column_number;$i++){
        //     ReportLayoutColumn::create([
        //         'report_id'=>$report->id,
        //         'layout_id'=> $layout->id,
        //         'layout_name'=> $layout->layout_name,
        //         'report_name'=> $report->report_name,
        //         'column_name'=> $columnName[$i],
        //         'column_number'=> $columnNumber[$i]
        //     ]);
        // }

        $user_id = Auth::user()->id;
        ReportLayoutDefault::create([
            'report_id'=> $report->id,
            'layout_id' => $layout->id,
            'user_id' => $user_id,
            'layout_name' => $layout->layout_name,
            'report_name' => $report->report_name
        ]);
        
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

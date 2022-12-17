<?php

namespace App\Http\Controllers;

use App\Models\ReportColumnData;
use App\Models\ReportLayoutColumn;
use Illuminate\Http\Request;

class ReportColumnDataController extends Controller
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

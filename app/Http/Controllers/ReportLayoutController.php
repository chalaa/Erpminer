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
        
        $columnNumber = $request->column_number;
        if(count(array_unique($columnNumber))==count($columnNumber)){
            $layout = ReportLayout::create([
                'report_id' => $report->id,
                'layout_name' => $request->layout_name,
                'report_name' => $report->report_name,
                'description' => $request->description
            ]);
    
            foreach($request->column_name as $key => $value) {
                ReportLayoutColumn::create([
                    'report_id'=>$report->id,
                    'layout_id'=> $layout->id,
                    'layout_name'=> $layout->layout_name,
                    'report_name'=> $report->report_name,
                    'column_name' => $value,
                    'column_number'=> $columnNumber[$key]
                ]);
            }
            
    
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
       else{
        return redirect("addlayout/$id")->with('success_msg', 'Layout created Successfully');
       }
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
        $report = ReportLayout::find($id);

        $report->column->each->delete();

        $report->default->each->delete();

        $report->delete();

        return redirect('dashboard')->with('success_msg', 'Layout created Successfully');

    }

    public function userlayout(){
        return view('user.allreport',[
                'reports' => Report::all()
            ]);
    }

    

    public function createuserlayout($id){
        return view('user.addLayouts',[
            'report' => Report::find($id)
        ]);
    }
    public function layoutList(){
        
        return view('user.allLayouts',[
            'reports' => ReportLayout::all()
        ]);
    }

    public function layoutEdit($id){
        $layout = ReportLayout::find($id);
        return view('user.editLayout',[
            'layout' => $layout
        ]);
    }

    public function reordercolumn($id){
        $layout = ReportLayout::find($id);
        return view('user.reorderColumn',[
            'layout' => $layout
        ]);
    }

    public function userlayoutstore(Request $request , $id){
        $report = Report::find($id);
        $request->validate([
            'layout_name' => ['required','string','unique:report_layouts'],
            'description' => ['required','string'],
            'column_name' => ['required','array'],
            'column_name.*' => ['required','string'],
            'column_number' => ['required','array'],
            'column_number.*' => ['required','integer',"max:$report->column_number","min:1"],
        ]);
        
        $columnNumber = $request->column_number;
        if(count(array_unique($columnNumber))==count($columnNumber)){
            $layout = ReportLayout::create([
                'report_id' => $report->id,
                'layout_name' => $request->layout_name,
                'report_name' => $report->report_name,
                'description' => $request->description
            ]);
    
            
            foreach($request->column_name as $key => $value) {
                ReportLayoutColumn::create([
                    'report_id'=>$report->id,
                    'layout_id'=> $layout->id,
                    'layout_name'=> $layout->layout_name,
                    'report_name'=> $report->report_name,
                    'column_name' => $value,
                    'column_number'=> $columnNumber[$key]
                ]);
            }
    
            return redirect('dashboard')->with('success_msg', 'Layout created Successfully');
        }else{
            return redirect("userlayout/$id")->with('success_msg', 'Layout created Successfully');
           }
       
    }

    public function layoutUpdate(Request $request , $id){
      //  $layout = ReportLayout::find($id);
        $request->validate([
            'layout_name' => ['required','string'],
            'description' => ['required','string']
        ]);
        
        $reportlayout = ReportLayout::find($id);
        $layoutDefault = ReportLayoutDefault::where('layout_id', $id)->first();
        $reportcolumns =ReportLayoutColumn::where('layout_id', $reportlayout->id)->get();
        $reportlayout->update([
            'layout_name' => $request->layout_name,
            'description' => $request->description
        ]);

        $layoutDefault->update([
            'layout_name' => $request->layout_name
        ]);

        $i=0;
        foreach($reportcolumns as $reportcolumn) {
          $reportcolumn->update([
              'layout_name' => $reportlayout->layout_name,
          ]);
          $i++;
      }

        return redirect('dashboard')->with('success_msg', 'Layout created Successfully');
    }

    public function columnUpdate(Request $request , $id){
        $reportlayout = ReportLayout::find($id);

        $columnnumber=$reportlayout->report->column_number;
          $request->validate([
            'column_name' => ['required','array'],
            'column_name.*' => ['required','string'],
            'column_number' => ['required','array'],
            'column_number.*' => ['required','integer',"max: $columnnumber","min:1"],
          ]);
          $reportcolumns =ReportLayoutColumn::where('layout_id', $reportlayout->id)->get();
        // dd($reportcolumns[0]->column_name);
        $i=0;
          foreach($reportcolumns as $reportcolumn) {
            $reportcolumn->update([
                'layout_name' => $reportlayout->layout_name,
                'column_name'=> $request->column_name[$i],
                'column_number'=> $request->column_number[$i],
            ]);
            $i++;
        }
          return redirect('dashboard')->with('success_msg', 'Layout created Successfully');
      }


      public function updateDefault(Request $request, $id,$id2){
            $userId = Auth::user()->id;
            $layoutDefault = ReportLayoutDefault::where('report_id',$id)->where('user_id',$userId)->first();
            if($layoutDefault == null){
                ReportLayoutDefault::create([
                    'report_id' => $id,
                    'layout_id' => $id2,
                    'user_id' => $userId,
                    'report_name' => $request->report_name,
                    'layout_name' => $request->layout_name
                ]);
            }else{
                $layoutDefault->update([
                    'layout_id' => $id2,
                    'layout_name' => $request->layout_name
                ]);
            }
            return redirect('dashboard')->with('success_msg', 'Layout created Successfully');
    }
}

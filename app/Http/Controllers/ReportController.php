<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
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
    public function create()
    {
        //
        if(!(Auth::user()->is_admin == 1)){
            abort(403,"an authorizated Action");
        }
        return view('admin.addReport');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'report_name' => ['required','string','unique:reports,report_name'],
            'description' => ['required','string','min:30'],
            'column_number' => ['required','integer'],
            'report_file' => ['required','file'],
        ]);

        $filename = $request->report_name . '.' . $request->report_file->extension();

        $filePath = $request->report_file->storeAs('reports',$filename,'public');

        Report::create([
            'report_name' => $request->report_name,
            'description' => $request->description,
            'file_name' => $filename,
            'location' => $filePath,
            'column_number' => $request->column_number
        ]);

        return redirect()->route('dashboard')->with('success','Report Added successfully');
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


    public function reportList(){

        return view('admin.allReport',[
            'reports' => Report::all()
        ]);
    }
}

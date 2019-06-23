<?php

namespace App\Http\Controllers;

use App\r_financial_title;
use App\r_student_profile;
use App\t_financial_assistance;
use Illuminate\Http\Request;

class assistance extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $assistances = t_financial_assistance::with('rStudentProfile','rFinancialTitle')->where('stat',1)->get();
        $assTitles = r_financial_title::where('stat',1)->get();
        $students = r_student_profile::with('rCourse','tFinancialAssistances','tSanctions')->get();

        return view('pages.students.assistance',compact('assistances','assTitles','students'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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

        $fin = new t_financial_assistance();
        $fin->studP_id = $request->get('studP_id');
        $fin->finT_id = $request->get('finT_id');
        $fin->finStatus = $request->status;
        $fin->remarks = $request->remarks;
        $fin->save();

        return redirect()->back();
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
        $fin = t_financial_assistance::where('finA_id',$id)->first();
        $fin->finStatus = $request->fin_status;
        $fin->remarks = $request->fin_remarks;
        $fin->save();

        return redirect()->back();
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

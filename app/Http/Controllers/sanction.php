<?php

namespace App\Http\Controllers;

use App\r_office;
use App\r_sanction_title;
use App\r_student_profile;
use App\t_sanction;
use Illuminate\Http\Request;

class sanction extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $sanctionTitles = r_sanction_title::where('stat',1)->get();
        $designatedOffices = r_office::where('stat',1)->get();
        $sanctions = t_sanction::with('rOffice','rSanctionTitle','rStudentProfile')->get();
        $students = r_student_profile::with('rCourse','tFinancialAssistances','tSanctions')->get();
        return view('pages.students.sanction',compact('sanctions','sanctionTitles','designatedOffices','students'));
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

        $sanc = new t_sanction();
        $sanc->studP_id = $request->get('studP_id');
        $sanc->sancT_id = $request->get('sancT_id');
        $sanc->off_id = $request->get('off_id');
        $sanc->totalHours = $request->hours;
        $sanc->caseDesc = $request->case;
        $sanc->dateSanctioned = $request->Ddate;
        $sanc->completionDate = $request->Cdate;
        $sanc->remarks = $request->remarks;
        $sanc->isFinished = $request->input('finish');

        $sanc->save();
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
        $sanctions = t_sanction::with('rOffice','rSanctionTitle','rStudentProfile')->where('studP_id',$id)->get();

        return view('pages.students.sanction-view',compact('sanctions'));
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

        $sanc = t_sanction::where('sanc_id',$id)->first();
        $sanc->totalHours = $request->hours;
        $sanc->completionDate = $request->Cdate;
        $sanc->remarks = $request->remarks;
        $sanc->isFinished = ($request->input('finish'))?1:0;

        $sanc->save();

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

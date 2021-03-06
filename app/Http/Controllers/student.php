<?php

namespace App\Http\Controllers;

use App\r_office;
use App\r_sanction_title;
use App\r_student_profile;
use App\t_sanction;
use Illuminate\Http\Request;

class student extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $students = r_student_profile::with('rCourse','tFinancialAssistances','tSanctions')->get();
        return view('pages.students.student',compact('students'));
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

        $stud = new r_student_profile();

        $stud->stud_no = $request->stud_no;
        $stud->course_id = $request->get('course');
        $stud->section = $request->section;
        $stud->fname = $request->fname;
        $stud->mname = $request->mname;
        $stud->lname = $request->lname;
        $stud->email = $request->email;
        $stud->civilStatus = $request->civil;
        $stud->mobileNo = $request->phone;
        $stud->telephoneNo = $request->tel;
        $stud->gender = $request->get('gender');
        $stud->birthdate = $request->bdate;
        $stud->homeno = $request->home;
        $stud->street = $request->street;
        $stud->province = $request->prov;
        $stud->city = $request->city;
        $stud->brgy = $request->brgy;
        $stud->save();

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

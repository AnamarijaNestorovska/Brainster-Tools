<?php

namespace App\Http\Controllers;

use App\Course;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard');
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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function dashboardShow()
    {
        $courses = Course::with('subcategories', 'versions', 'user', 'type', 'medium', 'level', 'versions', 'language')->get();

        return response()->json($courses);
    }

    public function approveCourse(Request $request){
        Course::where('id', $request->id)->update([
            'status' => 0
        ]);

        $courses = Course::with('subcategories', 'versions', 'user', 'type', 'medium', 'level', 'versions', 'language')->get();
        return response()->json($courses);
    }

    public function disapproveCourse(Request $request){
        Course::where('id', $request->id)->update([
            'status' => 1
        ]);

        $courses = Course::with('subcategories', 'versions', 'user', 'type', 'medium', 'level', 'versions', 'language')->get();
        return response()->json($courses);
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
    public function destroyCourse(Request $request)
    {
        $course = Course::find($request->id);
        $course->subcategories()->detach();
        $course->versions()->detach();
        $course->userVotes()->detach();

        Course::destroy($request->id);

        $courses = Course::with('subcategories', 'versions', 'user', 'type', 'medium', 'level', 'versions', 'language')->get();
        return response()->json($courses);    }
}

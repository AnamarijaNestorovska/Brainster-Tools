<?php

namespace App\Http\Controllers;

use App\Course;
use App\Subcategory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CoursesController extends Controller
{
    public function index(){
        $subcategory = Subcategory::with('courses')->where('slug', \Request('slug'))->first();
        $related = Subcategory::where('category_id', $subcategory->category_id)->inRandomOrder()->limit(6)->get();

        
// dd($related);

        // dd($subcategory->courses);

        $pivotTable = DB::table('courses_subcategories')->where('subcategory_id', $subcategory->id)->get();
        $coursesList = [];
        $testniza = [];
        foreach($pivotTable as $test){
            $testniza[] = Course::with('type', 'level', 'medium', 'language', 'userVotes')->where('id', $test->course_id)->first();
        }
        // dd($testniza);
        foreach($testniza as $t) {
            if($t->status == 1) {
                $coursesList[] = $t;
            }
        }
        // dd($coursesList);
        $typeArray = [];
        foreach($coursesList as $c) {

            $typeArray[] = $c->type['id'];
        }
        $countedType = array_count_values($typeArray);
        $finalType = [];
        foreach($countedType as $t => $v) {
            $type = \App\Type::where('id', $t)->first();
            $finalType[] = ['id' => $t, 'type' => $type->type, 'number' => $v];
        }
        array_multisort(array_column($finalType, 'id'), SORT_ASC, $finalType);

        $mediumArray = [];
        foreach($coursesList as $c) {

            $mediumArray[] = $c->medium['id'];
        }
        $countedType = array_count_values($mediumArray);
        $finalMedium = [];
        foreach($countedType as $t => $v) {
            $medium = \App\Medium::where('id', $t)->first();
            $finalMedium[] = ['id' => $t, 'medium' => $medium->medium, 'number' => $v];
        }
        array_multisort(array_column($finalMedium, 'id'), SORT_ASC, $finalMedium);

        $levelArray = [];
        foreach($coursesList as $c) {

            $levelArray[] = $c->level['id'];
        }
        $countedType = array_count_values($levelArray);
        $finalLevel = [];
        foreach($countedType as $t => $v) {
            $level = \App\Level::where('id', $t)->first();
            $finalLevel[] = ['id' => $t, 'level' => $level->level, 'number' => $v];
        }
        array_multisort(array_column($finalLevel, 'id'), SORT_ASC, $finalLevel);


        $versionsArray = [];
        foreach($coursesList as $c) {
            foreach($c->versions as $version) {
                $versionsArray[] = $version->id;
            }
        }
        $countedType = array_count_values($versionsArray);
        $finalVersions = [];
        foreach($countedType as $t => $v) {
            $version = \App\Version::where('id', $t)->first();
            $finalVersions[] = ['id' => $t, 'name' => $version->name, 'number' => $v];

        }
        array_multisort(array_column($finalVersions, 'id'), SORT_ASC, $finalVersions);
// dd($finalVersions);
        $languageArray = [];
        foreach($coursesList as $c) {

            $languageArray[] = $c->language['id'];
        }
        $countedType = array_count_values($languageArray);
        $finalLanguage = [];
        foreach($countedType as $t => $v) {
            $language = \App\Language::where('id', $t)->first();
            $finalLanguage[] = ['id' => $t, 'language' => $language->language, 'number' => $v];
        }
        array_multisort(array_column($finalLanguage, 'id'), SORT_ASC, $finalLanguage);



        //dd($finalType);
        // dd(\Request('slug'));
        // dd($subcategory);
        return view('courses', [
            'subcategory' => $subcategory,
            'related' => $related,
            'coursesList' => $coursesList,
            'finalType' => $finalType,
            'finalMedium' => $finalMedium,
            'finalLevel' => $finalLevel,
            'finalVersions' => $finalVersions,
            'finalLanguage' => $finalLanguage,
            'testniza' => $testniza
            ]);
    }

    public function showCourses(){

    }

    // public function vote($id, Request $request){
    //     if($request->)
    // }

    public function vote($id, Request $request){
        if($request->voted == 'notVoted'){
            Course::where('id', $id)->increment('votes', 1);
            $course = Course::where('id', $id)->first();
            $course->userVotes()->attach(\Auth::user()->id);
        } else {
           Course::where('id', $id)->decrement('votes', 1);
           $course = Course::where('id', $id)->first();
           $course->userVotes()->detach(\Auth::user()->id);
        }
        return response()->json($course);
    }

    public function filtersAll(Request $request){
        $subcategory = Subcategory::with('courses')->where('slug', $request->slug)->first();
        $courses = $subcategory->courses()->filter($request)->get();


        return response()->json($courses);

    }

    public function sortByVotes(Request $request) {
        $subcategory = Subcategory::with('courses')->where('id', $request->id)->first();
        $allcourses = $subcategory->courses;
        $courses  = [];
        foreach($allcourses as $course) {
            $courses[] = $course;
        }

        $sortParameter = array_column($courses, $request->sortParameter);
        array_multisort($sortParameter, SORT_DESC, $courses);

        return response()->json($courses);
    }

    public function sortByRecent(Request $request) {
        $subcategory = Subcategory::with('courses')->where('id', $request->id)->first();
        $allcourses = $subcategory->courses;
        $courses  = [];
        foreach($allcourses as $course) {
            $courses[] = $course;
        }

        $sortParameter = array_column($courses, $request->sortParameter);
        array_multisort($sortParameter, SORT_DESC, $courses);

        return response()->json($courses);
    }
}

<?php

namespace App\Http\Controllers;

use App\Category;
use App\Course;
use Illuminate\Http\Request;

class WebController extends Controller
{
    public function index(){
        if(\Request('slug') == 'dashboard') {
            return redirect()->route('dashboard');
        }

        if(empty(\Request('slug'))){
            $category = Category::with('subcategories')->get();
        }

        else{
            $category = Category::with('subcategories')->where('slug', \Request('slug'))->first();
        }

        return view('index', ['category' => $category]);
    }

    public function show(){
        if(empty(\Request('slug'))){
            $category = Category::with('subcategories')->get();
        }
        else{
            $category = Category::with('subcategories')->where('slug', \Request('slug'))->first();
        }

        return response()->json($category);
    }

    public function store(Request $request){
        $courses = new Course;
        $courses->name = $request->get('name');
        $courses->link = $request->get('link');
        $courses->type_id = $request->get('type_id');
        $courses->medium_id = $request->get('medium_id');
        $courses->level_id = $request->get('level_id');
        $courses->language_id = $request->get('language_id');
        $courses->user_id = \Auth::user()->id;
        $courses->votes = 0;
        $courses->status = 0;
        $courses->save();

        foreach($request->subcategory_id as $s){
            $courses->subcategories()->attach($s);
        }

        foreach($request->version_id as $v){
            $courses->versions()->attach($v);
        }



        return redirect()->route('index');

        // $subcategories = $request->get('subcategories');
        // $courses->subcategories()->attach($subcategories);
        // $versions = $request->get('versions');
        // $courses->versions()->attach($versions);






        // return redirect()->route('index');
    }


    }


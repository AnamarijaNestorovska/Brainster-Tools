<?php

namespace App\Http\Controllers;

use App\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{

    public function search(Request $request)
    {

        $subcategories = Subcategory::where('name', 'LIKE', $request->get('search')."%")->get();
        return response()->json($subcategories);

    }
}

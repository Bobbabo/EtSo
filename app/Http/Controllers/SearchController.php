<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class SearchController extends Controller
{
    public function index()
    {
        return view('search');
    }

    public function autocomplete(Request $request)
    {
        $data = User::select("username")
                ->where("username","LIKE","%{$request->q}%")
                ->get(); 

        return response()->json($data);
    }

    public function search(Request $request){
        // Get the search value from the request
        $search = $request->input('search');
    
        // Search in the title and body columns from the posts table
        $users = User::query()
            ->where('username', 'LIKE', "%{$search}%")
            ->orWhere('name', 'LIKE', "%{$search}%")
            ->get();
        
        // Return the search view with the resluts compacted
        return view('search', compact('users'));
    }
}

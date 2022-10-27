<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Platform;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class PlatformController extends Controller
{
    public function index(Request $request) {
        if(isset($_GET['q'])){
            $search_text = $_GET['q'];
            $platforms = DB::table('platforms')
                ->where('title','LIKE','%' . $search_text . '%')
                ->paginate(15);
            $platforms->appends($request->all());
            return view('admin.platform.index', ['platforms' => $platforms]);
        } else {
            $platforms = Platform::sortable()
                ->orderBy('created_at', 'DESC')
                ->paginate(15);
            return view('admin.platform.index', ['platforms' => $platforms]);
        }
    }

    public function store(Request $request) {
        Platform::create([
            'title' =>  $request->title,
            'slug'  =>  Str::slug($request->title),
            'color' =>  $request->color
        ]);
        return redirect()->back()->with('message', 'New platform added successfully');

    }
}

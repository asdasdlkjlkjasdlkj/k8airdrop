<?php

namespace App\Http\Controllers;
use App\Models\Promo;
use App\Models\Code;
use App\Models\User;
use Illuminate\Http\Request;

class CodeController extends Controller
{
    public function store(Request $request) {
        $promo_code = Code::create([
            'name' => $request->name,
            'promo_id' => $request->id
        ]);
        $promo_code->promos()->attach($request->id);
        return redirect()->back()->with('message', 'New promo code added successfully.');
    }

    public function update(Request $request) {
        $promo_code = Code::findOrfail($request->id);
        $promo_code->update([
            'name' => $request->name,
            'promo_id' => $request->id
        ]);
        $promo_code->promos()->syncWithoutDetaching($request->promo_id);
        return redirect()->back()->with('message', 'New promo code added successfully.');
    }
}

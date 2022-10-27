<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Participant;

class ParticipantController extends Controller
{
    public function store(Request $request) {
        $participant = Participant::create([
            'name' => $request->name,
            'email' => $request->email,
            'k8_username' => $request->k8_username,
            'promo_id' => $request->id,
            'winner' => $request->winner,
        ]);
        $participant->promos()->attach($request->id);
        return redirect()->back()->with('message', 'New participant added successfully.');
    }

    public function update(Request $request) {
        $participant = Participant::findOrfail($request->id);
        $participant->update([
            'name' => $request->name,
            'email' => $request->email,
            'winner' => $request->winner,
            'k8_username' => $request->k8_username
        ]);
        $participant->promos()->syncWithoutDetaching($request->promo_id);
        return redirect()->back()->with('message', 'Participant updated successfully');

    }

    public function winner(Request $request) {
        $participant = Participant::findOrfail($request->id);
        $participant->update([
            'name' => $request->name,
            'winner' => "Yes",
        ]);
        $participant->promos()->syncWithoutDetaching($request->promo_id);
        return redirect()->back()->with('message', 'Participant updated successfully');
    }
}

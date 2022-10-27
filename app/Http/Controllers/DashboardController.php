<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Promo;
use App\Models\Participant;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
        $promo = Promo::with('platforms', 'participants');
        $participant = Participant::all();
        $user = User::all();
        $promo_all_count = $promo->count();
        $promo_active_count = $promo->where('status', 'Active')->count();
        return view('admin.dashboard.index', [
            'promos' =>  $promo->get(),
            'promo_all_count' =>  $promo_all_count,
            'promo_active_count' =>  $promo_active_count,
            'participants' =>  $participant,
            'users' =>  $user,
            
        ]);
    }




}

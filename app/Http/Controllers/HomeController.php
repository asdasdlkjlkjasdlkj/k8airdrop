<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Promo;
use App\Models\Participant;
use App\Models\Code;
use Illuminate\Support\Carbon;
class HomeController extends Controller
{
    //

    public function index() {
        $promo = Promo::where('status', 'Active');

        return view('home/index', [
            'promos' => $promo->get(),
        ]);
    }

    public function register_redeem($slug, $url_id) {
        $promo = Promo::with('participants', 'codes')->where('slug', $slug)->where('url_id', $url_id)->first();

        if($promo->status == "Active") {
            $start_date = Carbon::parse($promo->start_date);
            $end_date = Carbon::parse($promo->end_date);
            $days_left = $start_date->diffInDays($end_date);
            
            if($promo->end_date <= Carbon::now()->format('Y-m-d') || $promo->end_date == Carbon::now()->format('Y-m-d')) {
                return view('home/promo_ended', [
                    'promos' => $promo,
                ]);
            }elseif($promo){
                return view('home/register_redeem', [
                    'promos' => $promo,
                    'days_left' => $days_left,
                ]);
            }
            else {
                abort(403, 'Unauthorized action.');
            }
        } else {
            return view('home/promo_ended', [
                'promos' => $promo,
            ]);
        }
    }


    public function store_register(Request $request, $slug, $url_id) {
        $promo = Promo::where('slug', $slug)->where('url_id', $url_id)->first();
        $participant = Participant::create([
            'name' => $request->name,
            'email' => $request->email,
            'k8_username' => $request->k8_username,
            'winner' => "No",
            'promo_id' => $promo->id,
            'participant_ip' => request()->ip(),
        ]);
        $participant->promos()->attach($promo->id);
        return redirect('/participant_registered');
    }

    public function participant_registered() {
        return view('home/participant_registered');
    }
}

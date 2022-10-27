<?php

namespace App\Http\Controllers;
use App\Models\Promo;
use App\Models\Participant;
use Illuminate\Http\Request;

class ResultController extends Controller
{
    public function index() {
        $promo = Promo::with('participants', 'platforms')->where('status', 'Archive')->orderBy('start_date', 'DESC');
        return view('home/results', [
            'promos' => $promo->get()
        ]);
    }

    public function result_single($slug, $url_id) {
        $promo = Promo::with('participants', 'platforms')->where('slug', $slug)->where('url_id', $url_id)->where('status', 'Archive')->first();

        return view('home/results-single', [
            'promos' => $promo,
        ]);
    }
}

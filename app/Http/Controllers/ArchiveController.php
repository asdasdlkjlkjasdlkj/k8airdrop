<?php

namespace App\Http\Controllers;
use App\Models\Platform;
use App\Models\Promo;
use App\Models\Code;
use App\Models\Participant;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class ArchiveController extends Controller
{
    public function index(Request $request) {

        $platform = Platform::all();
        $promo = Promo::where('status', '=', 'Archive');
        
        //SEARCH AND SORT BY SUPER ADMIN
        if(Auth::user()->isSuperAdmin()) {
            if($request->search){ //SEARCH
                $promo->where('title', 'LIKE', "%{$request->search}%");
                return view('admin.promo.archive.index', [
                    'promos' =>  $promo->get(),
                    'platforms' => $platform,
                ]);
            }

            //VIEW ALL, ACTIVE OR INACTIVE AND PLATFORM
            if($request->status || $request->platform || $request->start_date) {
                if($request->status == "All" && $request->platform == "" && $request->start_date == "") {
                    return view('admin.promo.archive.index', [
                        'promos' => $promo->get(),
                        'platforms' => $platform,
                    ]);
                }elseif($request->status == "All" && $request->platform != "" && $request->start_date == ""){
                    $promo->where('platform_id', $request->platform);
                    return view('admin.promo.archive.index', [
                        'promos' => $promo->get(),
                        'platforms' => $platform,
                    ]);
                }elseif($request->status != "All" && $request->platform != "" && $request->start_date == ""){
                    $promo->where('status', $request->status)->where('platform_id', $request->platform);
                    return view('admin.promo.archive.index', [
                        'promos' => $promo->get(),
                        'platforms' => $platform,
                    ]);
                }elseif($request->status == "All" && $request->platform == "" && $request->start_date != "")  {
                    $promo->whereBetween('start_date', [$request->start_date, $request->end_date]);
                    return view('admin.promo.archive.index', [
                        'promos' => $promo->get(),
                        'platforms' => $platform,
                    ]);
                }elseif($request->status != "All" && $request->platform == "" && $request->start_date != "")  {
                    $promo->whereBetween('start_date', [$request->start_date, $request->end_date])->where('status', $request->status);
                    return view('admin.promo.archive.index', [
                        'promos' => $promo->get(),
                        'platforms' => $platform,
                    ]);
                }elseif($request->status == "All" && $request->platform != "" && $request->start_date != "")  {
                    $promo->whereBetween('start_date', [$request->start_date, $request->end_date])->where('platform_id', $request->platform);
                    return view('admin.promo.archive.index', [
                        'promos' => $promo->get(),
                        'platforms' => $platform,
                    ]);
                }elseif($request->status != "All" && $request->platform != "" && $request->start_date != "")  {
                    $promo->whereBetween('start_date', [$request->start_date, $request->end_date])->where('status', $request->status)->where('platform_id', $request->platform);
                    return view('admin.promo.archive.index', [
                        'promos' => $promo->get(),
                        'platforms' => $platform,
                    ]);
                }else{
                    $promo->where('status', $request->status);
                    return view('admin.promo.archive.index', [
                        'promos' => $promo->get(),
                        'platforms' => $platform,
                    ]);
                }
            }else{
                
                return view('admin.promo.archive.index', [
                    'promos' => $promo->get(),
                    'platforms' => $platform,
                ]);
            }

            

        //SEARCH AND SORT BY ADMIN
        } else {

            $promo = Promo::whereHas('users', fn ($q) => $q->whereKey(Auth::id()))->where('status', '=', 'Archive');
            $platform_user = User::with('platforms')->where('id', Auth::id());

            if($request->search){
                $promo->when($request->search, fn ($q, $input) => $q->where('title', 'LIKE', "%$input%"));
                return view('admin.promo.archive.index',[
                    'promos' => $promo->get(),
                    'platform_users' => $platform_user->get(),
                ]);
            }
            
            if($request->status || $request->platform || $request->start_date) {
                if($request->status == "All" && $request->platform == "" && $request->start_date == "") {
                    return view('admin.promo.archive.index', [
                        'promos' => $promo->get(),
                        'platform_users' => $platform_user->get(),
                    ]);
                }elseif($request->status == "All" && $request->platform != "" && $request->start_date == ""){
                    $promo->where('platform_id', $request->platform);
                    return view('admin.promo.archive.index', [
                        'promos' => $promo->get(),
                        'platform_users' => $platform_user->get(),
                    ]);
                }elseif($request->status != "All" && $request->platform != "" && $request->start_date == ""){
                    $promo->where('status', $request->status)->where('platform_id', $request->platform);
                    return view('admin.promo.archive.index', [
                        'promos' => $promo->get(),
                        'platform_users' => $platform_user->get(),
                    ]);
                }elseif($request->status == "All" && $request->platform == "" && $request->start_date != "")  {
                    $promo->whereBetween('start_date', [$request->start_date, $request->end_date]);
                    return view('admin.promo.archive.index', [
                        'promos' => $promo->get(),
                        'platform_users' => $platform_user->get(),
                    ]);
                }elseif($request->status != "All" && $request->platform == "" && $request->start_date != "")  {
                    $promo->whereBetween('start_date', [$request->start_date, $request->end_date])->where('status', $request->status);
                    return view('admin.promo.archive.index', [
                        'promos' => $promo->get(),
                        'platform_users' => $platform_user->get(),
                    ]);
                }elseif($request->status == "All" && $request->platform != "" && $request->start_date != "")  {
                    $promo->whereBetween('start_date', [$request->start_date, $request->end_date])->where('platform_id', $request->platform);
                    return view('admin.promo.archive.index', [
                        'promos' => $promo->get(),
                        'platform_users' => $platform_user->get(),
                    ]);
                }elseif($request->status != "All" && $request->platform != "" && $request->start_date != "")  {
                    $promo->whereBetween('start_date', [$request->start_date, $request->end_date])->where('status', $request->status)->where('platform_id', $request->platform);
                    return view('admin.promo.archive.index', [
                        'promos' => $promo->get(),
                        'platform_users' => $platform_user->get(),
                    ]);
                }else{
                    $promo->where('status', $request->status);
                    return view('admin.promo.archive.index', [
                        'promos' => $promo->get(),
                        'platform_users' => $platform_user->get(),
                    ]);
                }
            }else{
                return view('admin.promo.archive.index',[
                    'promos' => $promo->get(),
                    'platform_users' => $platform_user->get(),
                ]);
            }

           
        }
    }
}

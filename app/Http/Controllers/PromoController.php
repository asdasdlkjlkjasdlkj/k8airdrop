<?php

namespace App\Http\Controllers;
use App\Models\Platform;
use App\Models\Promo;
use App\Models\Code;
use App\Models\Participant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class PromoController extends Controller
{
    public function index(Request $request) {

        $platform = Platform::all();
        $promo = Promo::where('status', '!=', 'Archive');
        
        //SEARCH AND SORT BY SUPER ADMIN
        if(Auth::user()->isSuperAdmin()) {
            if($request->search){ //SEARCH
                $promo->where('title', 'LIKE', "%{$request->search}%");
                return view('admin.promo.index', [
                    'promos' =>  $promo->get(),
                    'platforms' => $platform,
                ]);
            }

            //VIEW ALL, ACTIVE OR INACTIVE AND PLATFORM
            if($request->status || $request->platform || $request->start_date) {
                if($request->status == "All" && $request->platform == "" && $request->start_date == "") {
                    return view('admin.promo.index', [
                        'promos' => $promo->get(),
                        'platforms' => $platform,
                    ]);
                }elseif($request->status == "All" && $request->platform != "" && $request->start_date == ""){
                    $promo->where('platform_id', $request->platform);
                    return view('admin.promo.index', [
                        'promos' => $promo->get(),
                        'platforms' => $platform,
                    ]);
                }elseif($request->status != "All" && $request->platform != "" && $request->start_date == ""){
                    $promo->where('status', $request->status)->where('platform_id', $request->platform);
                    return view('admin.promo.index', [
                        'promos' => $promo->get(),
                        'platforms' => $platform,
                    ]);
                }elseif($request->status == "All" && $request->platform == "" && $request->start_date != "")  {
                    $promo->whereBetween('start_date', [$request->start_date, $request->end_date]);
                    return view('admin.promo.index', [
                        'promos' => $promo->get(),
                        'platforms' => $platform,
                    ]);
                }elseif($request->status != "All" && $request->platform == "" && $request->start_date != "")  {
                    $promo->whereBetween('start_date', [$request->start_date, $request->end_date])->where('status', $request->status);
                    return view('admin.promo.index', [
                        'promos' => $promo->get(),
                        'platforms' => $platform,
                    ]);
                }elseif($request->status == "All" && $request->platform != "" && $request->start_date != "")  {
                    $promo->whereBetween('start_date', [$request->start_date, $request->end_date])->where('platform_id', $request->platform);
                    return view('admin.promo.index', [
                        'promos' => $promo->get(),
                        'platforms' => $platform,
                    ]);
                }elseif($request->status != "All" && $request->platform != "" && $request->start_date != "")  {
                    $promo->whereBetween('start_date', [$request->start_date, $request->end_date])->where('status', $request->status)->where('platform_id', $request->platform);
                    return view('admin.promo.index', [
                        'promos' => $promo->get(),
                        'platforms' => $platform,
                    ]);
                }else{
                    $promo->where('status', $request->status);
                    return view('admin.promo.index', [
                        'promos' => $promo->get(),
                        'platforms' => $platform,
                    ]);
                }
            }else{
                
                return view('admin.promo.index', [
                    'promos' => $promo->get(),
                    'platforms' => $platform,
                ]);
            }

            

        //SEARCH AND SORT BY ADMIN
        } else {

            $promo = Promo::whereHas('users', fn ($q) => $q->whereKey(Auth::id()))->where('status', '!=', 'Archive');
            $platform_user = User::with('platforms')->where('id', Auth::id());

            if($request->search){
                $promo->when($request->search, fn ($q, $input) => $q->where('title', 'LIKE', "%$input%"));
                return view('admin.promo.index',[
                    'promos' => $promo->get(),
                    'platform_users' => $platform_user->get(),
                ]);
            }
            
            if($request->status || $request->platform || $request->start_date) {
                if($request->status == "All" && $request->platform == "" && $request->start_date == "") {
                    return view('admin.promo.index', [
                        'promos' => $promo->get(),
                        'platform_users' => $platform_user->get(),
                    ]);
                }elseif($request->status == "All" && $request->platform != "" && $request->start_date == ""){
                    $promo->where('platform_id', $request->platform);
                    return view('admin.promo.index', [
                        'promos' => $promo->get(),
                        'platform_users' => $platform_user->get(),
                    ]);
                }elseif($request->status != "All" && $request->platform != "" && $request->start_date == ""){
                    $promo->where('status', $request->status)->where('platform_id', $request->platform);
                    return view('admin.promo.index', [
                        'promos' => $promo->get(),
                        'platform_users' => $platform_user->get(),
                    ]);
                }elseif($request->status == "All" && $request->platform == "" && $request->start_date != "")  {
                    $promo->whereBetween('start_date', [$request->start_date, $request->end_date]);
                    return view('admin.promo.index', [
                        'promos' => $promo->get(),
                        'platform_users' => $platform_user->get(),
                    ]);
                }elseif($request->status != "All" && $request->platform == "" && $request->start_date != "")  {
                    $promo->whereBetween('start_date', [$request->start_date, $request->end_date])->where('status', $request->status);
                    return view('admin.promo.index', [
                        'promos' => $promo->get(),
                        'platform_users' => $platform_user->get(),
                    ]);
                }elseif($request->status == "All" && $request->platform != "" && $request->start_date != "")  {
                    $promo->whereBetween('start_date', [$request->start_date, $request->end_date])->where('platform_id', $request->platform);
                    return view('admin.promo.index', [
                        'promos' => $promo->get(),
                        'platform_users' => $platform_user->get(),
                    ]);
                }elseif($request->status != "All" && $request->platform != "" && $request->start_date != "")  {
                    $promo->whereBetween('start_date', [$request->start_date, $request->end_date])->where('status', $request->status)->where('platform_id', $request->platform);
                    return view('admin.promo.index', [
                        'promos' => $promo->get(),
                        'platform_users' => $platform_user->get(),
                    ]);
                }else{
                    $promo->where('status', $request->status);
                    return view('admin.promo.index', [
                        'promos' => $promo->get(),
                        'platform_users' => $platform_user->get(),
                    ]);
                }
            }else{
                return view('admin.promo.index',[
                    'promos' => $promo->get(),
                    'platform_users' => $platform_user->get(),
                ]);
            }

           
        }
    }

    public function create() {
        $id = Auth::id();
        $user = User::all();
        $user_platform = User::with('platforms')->find($id);
        $platform = Platform::all();
        return view('admin.promo.create', [
            'platforms' => $platform,
            'user_platforms' => $user_platform,
            'users' =>  $user
        ]);
    }

    public function store(Request $request) {
        $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $user = Auth::user();
        $newImageName = uniqid() . '.' . $request->image->extension();
        $request->image->move(public_path('images'), $newImageName);
        $randomString = Str::random(6);
        $promo = Promo::create([
            'title'         =>  $request->title,
            'slug'          =>  Str::slug($request->title),
            'prize_pool'    =>  $request->prize_pool,
            'platform_id'   =>  $request->platform,
            'start_date'    =>  $request->start_date,
            'type'          =>  $request->type,
            'end_date'      =>  $request->end_date,
            'status'        =>  $request->status,
            'link'          =>  $request->link,
            'embedded_code' =>  $request->embedded_code,
            'url_id'        =>  $randomString,  
            'image'         =>  $request->image = $newImageName
        ]);        
        
        // Promo::update([
        //     'url_register'  =>  env('APP_URL') . "/promo" . "/" . $promo->id . "/" . Str::slug($request->title) . "/register",
        // ]);
        
        if(Auth::user()->isSuperAdmin()) {
            $user_checkboxes = $request->get('users_check');
            $promo->users()->sync($user_checkboxes);
        } else {
            $promo->users()->attach($user);
        }
        $promo->platforms()->attach($request->platform);
        
        return redirect('admin/airdrop/promo')->with('message', 'New Promo added successfully.');
    }
    

    public function edit(Request $request, $id) {
        $user = User::all();
        $user_checkboxes = Promo::with('users')->where('id', $id);
        $user_platform = User::with('platforms')->find(Auth::id());
        $promo = Promo::findOrfail($id);
        $platform = Platform::all();
        $promos = Promo::with('platforms')->where('id', $id);
        return view('admin.promo.edit', [
            'platforms'         => $platform,
            'promos'            => $promo,
            'promo_pivot'       => $promos->get(),
            'user_platforms'    => $user_platform,
            'users'             => $user,
            'user_assigns'      => $user_checkboxes->get(),
            
        ]);
    }


    public function update(Request $request, $id) {
        $promo = Promo::findOrfail($id);
        if($request->image == "") {
            
            $promo->update([
                'title'         =>  $request->title,
                'prize_pool'    =>  $request->prize_pool,
                'start_date'    =>  $request->start_date,
                'platform_id'    => $request->platform,
                'end_date'      =>  $request->end_date,
                'type'          =>  $request->type,
                'status'        =>  $request->status,
                'link'          =>  $request->link,
                'embedded_code' =>  $request->embedded_code,
            ]);
        } else {
            $request->validate([
                'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
    
            $newImageName = uniqid() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $newImageName);

            $promo->update([
                'title'         =>  $request->title,
                'prize_pool'    =>  $request->prize_pool,
                'start_date'    =>  $request->start_date,
                'end_date'      =>  $request->end_date,
                'type'          =>  $request->type,
                'status'        =>  $request->status,
                'platform_id'    => $request->platform,
                'link'          =>  $request->link,
                'embedded_code' =>  $request->embedded_code,
                'image'         =>  $request->image = $newImageName
            ]);
        }
        if(Auth::user()->isSuperAdmin()) {
            $user_checkboxes = $request->get('users_check');
            $promo->users()->sync($user_checkboxes);
        }
        $promo->platforms()->sync($request->platform);
        return redirect('admin/airdrop/promo')->with('message', 'Promo updated successfully.');
    }

    public function generate_url(Request $request, $id) {
        $promo = Promo::find($id);
        
        
        $promo->update([
            'url_register'  =>  env('APP_URL') . "/promo" . "/" . $promo->slug . "/" . $promo->url_id,
        ]);
        
        return redirect()->back()->with('message', 'URL generated successfully');
       
    }

    public function view(Request $request, $id) {
        $promo = Promo::with('platforms', 'codes', 'participants')->find($id);
        $count = Promo::with('platforms', 'codes', 'participants')->find($id);
        
        $promo = Promo::with(['participants' => function ($q) {
            $q->orderBy('winner', 'desc')->orderBy('created_at', 'desc');
        }])->find($id);
        
        //GENRATE WINNER
        $generate_winner = Promo::with(['participants' => function ($q) {
            $q->inRandomOrder()->where('winner', 'No')->first();
        }])->find($id);


        if($request->search) { //SEARCH
            $promo = Promo::with(['participants' => function ($q) use($request) {
                return $q->where('name', 'LIKE', "%{$request->search}%");
            }])->find($id);

            return view('admin/promo/view', [
                'promos' => $promo,
                'counts' => $count,
                'generated_winners' => $generate_winner,
            ]);
        }



        return view('admin/promo/view', [
            'promos' => $promo,
            'counts' => $count,
            'generated_winners' => $generate_winner,
        ]);
    }
}

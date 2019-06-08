<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use Auth;

class AdminController extends Controller
{

    public function __construct(){
        $this->middleware('auth:api', ['only' => ['index','destroy']]);
    }

    public function showPage()
    {
        return view('admin.index',['user'=>User::with('roles')->find(Auth::id())]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return User::with('roles')->get()->transform(function($value,$key){
            unset($value->api_token);
            return $value;
        });
    }
    public function changePassword(Request $request, User $user)
    {
        if(Hash::check($request->oldPassword,$user->password)){
            $user->update(['password' => Hash::make($request->newPassword)]);;
            return $user;
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,User $user)
    {
        try {
            if($request->user()->authorizeRoles('Owner')){
                $user->delete();
                return ['error'=>false,'message'=>'Uživatel smazán.'];
            }else return ['error'=>true,'message'=>'Na tuto akci nemáte oprávnění.'];
        } catch (\Throwable $th) {
            throw $th;
        }

    }
}

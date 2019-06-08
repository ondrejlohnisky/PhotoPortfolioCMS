<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\RegistrationInvite;
use App\Invitation;
use Illuminate\Support\Facades\Mail;

class InvitationController extends Controller
{
    public function __construct(){
        $this->middleware('auth:api')->except(['verify']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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
        try {
            if($request->user()->authorizeRoles('Owner')){
                $token=str_random(20);
                $invitation = new Invitation;
                $invitation->email = $request->email;
                $invitation->token = $token;
                $invitation->save();
                Mail::to($request->email)->send(new RegistrationInvite($request->email,$token));
                return ['error'=>false,'message'=>'Uživatel <strong>'.$request->email.'</strong> byl pozván k registraci.'];
            }else{
                return ['error'=>true,'message'=>'Na tuto akci nemáte oprávnění.'];
            }
            
        } catch (\Throwable $th) {
            return $th;
        }
    }

    public function verify(Request $request,Invitation $invitation){
        if($request->token==$invitation->token)
            return true;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Invitation  $invitation
     * @return \Illuminate\Http\Response
     */
    public function show(Invitation $invitation)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Invitation  $invitation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Invitation $invitation)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Invitation  $invitation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invitation $invitation)
    {
        //
    }
}

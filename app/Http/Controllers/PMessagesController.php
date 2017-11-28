<?php

namespace App\Http\Controllers;


use App\Events\PMessagePosted;
use App\PersonalChat;
use App\User;
use Illuminate\Http\Request;

class PMessagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $messages = PersonalChat::with('user')->get();
        return ['messages' => $messages];
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
        $message = PersonalChat::create([
            'message' => $request->get('message'),
            'from_id' => Auth()->user()->id,
            'to_id' => $request->get('to_id'),
        ]);
        broadcast(new PMessagePosted($message,Auth()->user()))->toOthers();
        return ['status' => 'success','pmessage' => $message];
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
    public function destroy($id)
    {
        //
    }


    public function personalChat($id)
    {
        $pchat = [];
        $pchat = PersonalChat::whereRaw('(from_id = ? and to_id = ?) or (from_id = ? and to_id = ?)', [
            Auth()->user()->id,
            $id,
            $id,
            Auth()->user()->id
        ])->with('user')->get();

        return ['pmessages' => $pchat];

    }
}

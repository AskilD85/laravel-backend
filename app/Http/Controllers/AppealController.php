<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Appeal;
use App\User;
use Mail;

class AppealController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $appeal = Appeal::orderBy('updated_at', 'desc')->get();
       // return response()->json(User::all(),200);
        return response()->json($appeal, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $appeal = Appeal::create($request->all());
        if ($appeal) {
        	$data = array(
        			'username' => $request->input('name'),
        			'text' =>$request->input('body'),
        			'title' =>$request->input('theme'),
        		);
        	Mail::send(['html'=>'mail/appeal'], $data, function($message) {
        	$message->to('askildar@yandex.ru')
	    			->subject('Новое обращение на сайте!');
	        $message->from('info@master702.ru');
	    	});	
        }
        return response()->json($appeal, 200);
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
    public function destroy(Appeal $appeal)
    {
        $appeal->delete();
        return response()->json(null, 204);
    }
}

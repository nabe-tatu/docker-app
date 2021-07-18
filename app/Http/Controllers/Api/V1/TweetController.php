<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\TweetResource;
use App\Models\Tweet;
use Illuminate\Http\Request;

class TweetController extends Controller
{

    /**
     * つぶやき一覧
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return TweetResource::collection(Tweet::paginate(10));
    }

//    /**
//     * Show the form for creating a new resource.
//     *
//     * @return \Illuminate\Http\Response
//     */
//    public function create()
//    {
//        //
//    }
//
//    /**
//     * Store a newly created resource in storage.
//     *
//     * @param  \Illuminate\Http\Request  $request
//     * @return \Illuminate\Http\Response
//     */
//    public function store(Request $request)
//    {
//        //
//    }
//
//    /**
//     * Display the specified resource.
//     *
//     * @param  \App\Models\Tweet  $tweet
//     * @return \Illuminate\Http\Response
//     */
//    public function show(Tweet $tweet)
//    {
//        //
//    }
//
//    /**
//     * Show the form for editing the specified resource.
//     *
//     * @param  \App\Models\Tweet  $tweet
//     * @return \Illuminate\Http\Response
//     */
//    public function edit(Tweet $tweet)
//    {
//        //
//    }
//
//    /**
//     * Update the specified resource in storage.
//     *
//     * @param  \Illuminate\Http\Request  $request
//     * @param  \App\Models\Tweet  $tweet
//     * @return \Illuminate\Http\Response
//     */
//    public function update(Request $request, Tweet $tweet)
//    {
//        //
//    }
//
//    /**
//     * Remove the specified resource from storage.
//     *
//     * @param  \App\Models\Tweet  $tweet
//     * @return \Illuminate\Http\Response
//     */
//    public function destroy(Tweet $tweet)
//    {
//        //
//    }
}

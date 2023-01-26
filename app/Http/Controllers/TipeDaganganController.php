<?php

namespace App\Http\Controllers;

use App\Models\TipeDagangan;
use App\Http\Requests\StoreTipeDaganganRequest;
use App\Http\Requests\UpdateTipeDaganganRequest;

class TipeDaganganController extends Controller
{
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
     * @param  \App\Http\Requests\StoreTipeDaganganRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTipeDaganganRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TipeDagangan  $tipeDagangan
     * @return \Illuminate\Http\Response
     */
    public function show(TipeDagangan $tipeDagangan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TipeDagangan  $tipeDagangan
     * @return \Illuminate\Http\Response
     */
    public function edit(TipeDagangan $tipeDagangan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTipeDaganganRequest  $request
     * @param  \App\Models\TipeDagangan  $tipeDagangan
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTipeDaganganRequest $request, TipeDagangan $tipeDagangan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TipeDagangan  $tipeDagangan
     * @return \Illuminate\Http\Response
     */
    public function destroy(TipeDagangan $tipeDagangan)
    {
        //
    }
}

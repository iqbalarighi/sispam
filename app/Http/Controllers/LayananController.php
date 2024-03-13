<?php

namespace App\Http\Controllers;

use App\Models\LayananModel;
use Illuminate\Http\Request;

class LayananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('layanan.index');
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
     * @param  \App\Models\LogistikModel  $logistikModel
     * @return \Illuminate\Http\Response
     */
    public function show(LogistikModel $logistikModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LogistikModel  $logistikModel
     * @return \Illuminate\Http\Response
     */
    public function edit(LogistikModel $logistikModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LogistikModel  $logistikModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LogistikModel $logistikModel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LogistikModel  $logistikModel
     * @return \Illuminate\Http\Response
     */
    public function destroy(LogistikModel $logistikModel)
    {
        //
    }
}

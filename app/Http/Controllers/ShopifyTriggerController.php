<?php

namespace App\Http\Controllers;

use App\ShopifyTrigger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShopifyTriggerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $triggers = ShopifyTrigger::latest()->get();
        return view('triggers', compact('triggers'));
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
        $formData = $request->validate([
            'trigger_name' => 'required',
        ]);

        $addTrigger = new ShopifyTrigger();
        $addTrigger->user_id = Auth::id();
        $addTrigger->trigger_name = $request->trigger_name;

        $addTrigger->save();
        return back();


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ShopifyTrigger  $shopifyTrigger
     * @return \Illuminate\Http\Response
     */
    public function show(ShopifyTrigger $shopifyTrigger)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ShopifyTrigger  $shopifyTrigger
     * @return \Illuminate\Http\Response
     */
    public function edit(ShopifyTrigger $shopifyTrigger)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ShopifyTrigger  $shopifyTrigger
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ShopifyTrigger $shopifyTrigger)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ShopifyTrigger  $shopifyTrigger
     * @return \Illuminate\Http\Response
     */
    public function destroy(ShopifyTrigger $shopifyTrigger)
    {
        //
    }
}

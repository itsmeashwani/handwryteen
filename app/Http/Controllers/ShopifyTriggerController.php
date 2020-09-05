<?php

namespace App\Http\Controllers;

use App\ShopifyTrigger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;
use App\HandwryttenApi;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Response;

class ShopifyTriggerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $triggers = ShopifyTrigger::where('user_id', Auth::id())->latest()->get();
        // $handwrytten = HandwryttenApi::latest()->first();
        $handwrytten = DB::table('handwrytten_apis')->where('user_id', '=', Auth::id())->first();
        // dd($handwrytten);

        if(is_null($handwrytten)){
            return view('handwrytten-app.login');
        } else{
            $responseStyle = Http::withToken($handwrytten->token)->get('https://api.handwrytten.com/v1/fonts/list');
            $responseInsert = Http::withToken($handwrytten->token)->get('https://api.handwrytten.com/v1/inserts/list');
            $responseGiftCard = Http::withToken($handwrytten->token)->get('https://api.handwrytten.com/v1/giftCards/list');
            $responseCategory = Http::withToken($handwrytten->token)->get('https://api.handwrytten.com/v1/categories/list');
            $style = json_decode($responseStyle);
            $insertData = json_decode($responseInsert);
            $giftCard = json_decode($responseGiftCard);
            $category = json_decode($responseCategory);
            // dd($Category);
            return view('triggers', compact('triggers', 'handwrytten', 'style', 'insertData', 'giftCard', 'category'));
        }
        // dd($triggers);
        
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
            // 'trigger_name' => 'required|unique:shopify_triggers,user_id,'. Auth::id(),
            'trigger_name'      => 'required|string|unique:shopify_triggers,trigger_name,NULL,id,user_id,'.Auth::id(),
        ]);

        $addTrigger = new ShopifyTrigger();
        $addTrigger->user_id = Auth::id();
        $addTrigger->trigger_name = $request->trigger_name;

        $addTrigger->save();
        return back()->with('success', 'Trigger has been added');


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
    public function update(Request $request, $id)
    {
        // dd($request->all());
        $formData = $request->validate([
            'trigger_card' => '',
            'trigger_message' => 'string',
            'trigger_signoff' => 'string',
            'trigger_handwriting_style' => 'string',
            'trigger_insert' => 'string',
            'trigger_gift_card' => 'string',
            'trigger_status' => 'string'
        ]);

        $formData['user_id'] = Auth::id();

        // if($request->hasFile('trigger_card')){
        //     $card = $request->file('trigger_card');
        //     $card = $request->trigger_card;
        //     // $name = $card->getClientOriginalName();
        //     $extension = $card->extension();
        //     $cardName = time().'.'.$extension;
        //     $path = $card->storeAs('cards', $cardName, 'public');
        //     $url = Storage::url('app/public/'.$path);

        //     $formData['trigger_card'] = $url;
        // }
        // else{
        //     $formData['trigger_card'] = $request->old_trigger_card;
        // }

        if($request->trigger_card){

            $formData['trigger_card'] = $request->trigger_card;

        } else{

            $formData['trigger_card'] = $request->old_trigger_card;
        }


        ShopifyTrigger::whereId($id)->update($formData);
        return back()->with('update', 'Trigger has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ShopifyTrigger  $shopifyTrigger
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $trigger = DB::table('shopify_triggers')->where('id', $id)->delete();
        return back()->with('delete', 'Trigger has been deleted');
    }
}

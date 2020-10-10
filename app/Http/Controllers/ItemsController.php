<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Item;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;


class ItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items= Item::all();
        return response()->json($items);

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
        $validator = Validator::make($request->all(),[
            'text'=> 'required',
            'body'=> 'required'

        ]);
        if ($validator->fails()){
            //Show the fail report
            $response = ['response'=> $validator->messages(), 'success'=>false];
            return $response;
        }else{
            //Create a new Item

            $item = new Item();
            $item->text = $request->input('text');
            $item->body = $request->input('body');
            $item->save();

            return response()->json($item);
        }

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
        $item = Item::find($id);
        return response()->json($item);
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
        $validator = Validator::make($request->all(),[
            'text'=> 'required',
            'body'=> 'required'

        ]);
        if ($validator->fails()){
            //Show the fail report
            $response = ['response'=> $validator->messages(), 'success'=>false];
            return $response;
        }else{
            //Update a new Item

            $item = Item::find($id);
            $item->text = $request->input('text');
            $item->body = $request->input('body');
            $item->save();

            return response()->json($item);
        }
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
        Item::find($id)->delete();
        $response = ['response'=>'The item is deleted', 'success'=>True];
        return $response;
    }
}

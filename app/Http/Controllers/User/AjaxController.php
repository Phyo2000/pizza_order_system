<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AjaxController extends Controller
{
    // return pizza list
    public function pizzaList(Request $request){
        //logger($request->all());
        if($request->status == 'desc'){
            $data = Product::orderBy('created_at', 'desc')->get();
        }else{
            $data = Product::orderBy('created_at', 'asc')->get();
        }

        return $data;
    }

    // return pizza List
    public function addToCart(Request $request){
        $data1 = $this->getOrderData($request);
        Cart::create($data1);
        $response = [
            'status' => 'success',
            'message' => 'Add To Cart Complete.'
        ];

        return response()->json($response, 200);
    }

    private function getOrderData($request){
        return [
            'user_id' => $request->userId,
            'product_id' => $request->pizzaId,
            'qty' => $request->count,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()

        ];
    }
}

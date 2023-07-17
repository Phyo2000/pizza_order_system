<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

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

    // order
    public function order(Request $request){
        $total = 0;
        foreach($request->all() as $item){
            $data = OrderList::create([
                'user_id' => $item['user_id'],
                'product_id' => $item['product_id'],
                'qty' => $item['qty'],
                'total' => $item['total'],
                'order_code' => $item['order_code']
            ]);

            $total += $data->total;
        }

        Cart::where('user_id', Auth::user()->id)->delete();

        logger($data->order_code);

        Order::create([
            'user_id' => Auth::user()->id,
            'order_code' => $data->order_code,
            'total_price' => $total + 3000
        ]);

        return response()->json([
            'status' => 'true',
            'message' => 'Order Complete'
        ], 200);

    }

    // get order data
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

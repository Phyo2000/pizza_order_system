<?php

namespace App\Http\Controllers\User;

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
}

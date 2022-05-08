<?php

namespace App\Http\Controllers;

use App\Models\InventorySellerType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InventorySellerTypeController extends Controller
{
    public function sellerTypeShowAll()
    {
        $seller_types=InventorySellerType::all();
        return view('inventory.seller_type.sellerTypeShowAll',compact('seller_types'));
    }

    public function sellerTypeAddProcess(Request $request)
    {
        if ($request->id==null) {
            $request->validate([
                'name' => 'unique:inventory_seller_types,seller_type_name',
            ]);
            $item_type=new InventorySellerType();
            $item_type->seller_type_name=$request->name;
            $item_type->seller_type_des=$request->description;
            $item_type->user_id=Auth::user()->emp_id;
            $item_type->save();
            
            return redirect('/seller-type-show-all')->with('success','Successfully Recorded');
        } else {
            $item_type=InventorySellerType::find($request->id);
            $request->validate([
                'name' => 'unique:inventory_seller_types,seller_type_name,'.$item_type->id,
            ]);
            $item_type->seller_type_name=$request->name;
            $item_type->seller_type_des=$request->description;
            $item_type->save();
          
            return redirect('/seller-type-show-all')->with('success','Successfully Updated');
        }
    }
}

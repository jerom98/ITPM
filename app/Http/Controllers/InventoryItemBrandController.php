<?php

namespace App\Http\Controllers;

use App\Models\InventoryItemBrand;
use App\Models\InventoryItemSubcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InventoryItemBrandController extends Controller
{
    public function itemBrandShowAll()
    {
        $brands=InventoryItemBrand::all();

        //return $brands;
       
        return view('inventory.item_brand.itemBrandShowAll',compact('brands'));
    }

    public function itemBrandAddProcess(Request $request)
    {
         //return $request;
        if ($request->id==null) {
            $request->validate([
                'name' => 'required||unique:inventory_item_brands,brand_name',
                
            ]);
            $brands=new InventoryItemBrand();
            $brands->brand_name=$request->name;
            $brands->brand_des=$request->description;
            $brands->user_id=Auth::user()->emp_id;
            $brands->save();

            $actvity = 'Add New Brand, Brand_id :-  - '. $brands->id;
            $a = app('App\Http\Controllers\ActivityLogController')->index($actvity);

            return redirect('/item-brand-show-all')->with('success','Successfully Recorded');
        } else {
            $brands=InventoryItemBrand::find($request->id);
          

            $request->validate([
                'name' => 'required||unique:inventory_item_brands,brand_name,'.$brands->id,
                
            ]);
            $brands->brand_name=$request->name;
            $brands->brand_des=$request->description;
            $brands->save();

            $actvity = 'Upadte Brand, Brand_id :-  - '. $brands->id;
            $a = app('App\Http\Controllers\ActivityLogController')->index($actvity);

            return redirect('/item-brand-show-all')->with('success','Successfully Updated');
        }
    }

    public function delete($id)

    {
        
        $brands=InventoryItemBrand::find($id);
        $brands->delete();
        //return $id;

        return redirect('/item-brand-show-all')->with('success','Successfully Delete');
    }
}

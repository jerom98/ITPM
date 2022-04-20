<?php

namespace App\Http\Controllers;

use App\Models\InventoryItemSubcategory;
use App\Models\InventoryItemCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InventoryItemSubcategoryController extends Controller
{
    
    public function itemSubcategoryShowAll()
    {
        $item_categories=InventoryItemCategory::all();
        $item_subcategories=InventoryItemSubcategory::join('inventory_item_categories','inventory_item_categories.id','=','inventory_item_subcategories.item_cat_id')
        ->select('inventory_item_subcategories.*','inventory_item_categories.item_cat_name')
        ->get();
        return view('inventory.item_subcategory.itemSubcategoryShowAll',compact('item_categories','item_subcategories'));
    }

    public function itemSubcategoryAddProcess(Request $request)
    {
        if ($request->id==null) {
            $request->validate([
                'name' => 'required||unique:inventory_item_subcategories,item_subcat_name',
                'item_cat_id' => 'required'
            ]);
            $item_subcategory=new InventoryItemSubcategory();
            $item_subcategory->item_subcat_name=$request->name;
            $item_subcategory->item_cat_id =$request->item_cat_id;
            $item_subcategory->item_subcat_des=$request->description;
            $item_subcategory->user_id=Auth::user()->emp_id;
            $item_subcategory->save();

            $actvity = 'Add New Item Subcategory, Subcategory_id :-  - '. $item_subcategory->id;
            $a = app('App\Http\Controllers\ActivityLogController')->index($actvity);

            return redirect('/item-subcategory-show-all')->with('success','Successfully Recorded');
        } else {
            $item_subcategory=InventoryItemSubcategory::find($request->id);
            $request->validate([
                'name' => 'required||unique:inventory_item_subcategories,item_subcat_name,'.$request->id,
                'item_cat_id' => 'required'
            ]);
            $item_subcategory->item_subcat_name=$request->name;
            $item_subcategory->item_cat_id =$request->item_cat_id;
            $item_subcategory->item_subcat_des=$request->description;
            $item_subcategory->save();

            $actvity = 'Update Item Subcategory, Subcategory_id :-  - '. $item_subcategory->id;
            $a = app('App\Http\Controllers\ActivityLogController')->index($actvity);

            return redirect('/item-subcategory-show-all')->with('success','Successfully Updated');
        }
    }
}

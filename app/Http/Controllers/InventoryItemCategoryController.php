<?php

namespace App\Http\Controllers;

use App\Models\InventoryItemCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InventoryItemCategoryController extends Controller
{
   public function itemCategoryShowAll()
   {
    $item_categories=InventoryItemCategory::all();
    return view('inventory.item_category.itemCategoryShowAll',compact('item_categories'));
   }

   public function itemCategoryAddProcess(Request $request)
   {
    
    if ($request->id==null) {
        $request->validate([
            'name' => 'unique:inventory_item_categories,item_cat_name',
        ]);
        $item_category=new InventoryItemCategory();
        $item_category->item_cat_name=$request->name;
        $item_category->item_cat_des=$request->description;
        $item_category->user_id=Auth::user()->emp_id;
        $item_category->save();

        $actvity = 'Add New Item Category Category_id :-  - '. $item_category->id;
        $a = app('App\Http\Controllers\ActivityLogController')->index($actvity);

        return redirect('/item-category-show-all')->with('success','Successfully Recorded');
    } else {
        $item_category=InventoryItemCategory::find($request->id);
        $request->validate([
            'name' => 'unique:inventory_item_categories,item_cat_name,'.$request->id,
        ]);
        $item_category->item_cat_name=$request->name;
        $item_category->item_cat_des=$request->description;
        $item_category->save();

        $actvity = 'Update Item Category Category_id :-  - '. $item_category->id;
        $a = app('App\Http\Controllers\ActivityLogController')->index($actvity);

        return redirect('/item-category-show-all')->with('success','Successfully Updated');
    }
   }
}

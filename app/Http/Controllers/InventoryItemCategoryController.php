<?php

namespace App\Http\Controllers;

use App\Models\InventoryItem;
use App\Models\InventoryItemSubcategory;
use App\Models\InventoryItemCategory;
use Illuminate\Http\Request;


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
       
        $item_category->save();

        

        return redirect('/item-category-show-all')->with('success','Successfully Recorded');
    } else {
        $item_category=InventoryItemCategory::find($request->id);
        $request->validate([
            'name' => 'unique:inventory_item_categories,item_cat_name,'.$request->id,
        ]);
        $item_category->item_cat_name=$request->name;
        $item_category->item_cat_des=$request->description;
        $item_category->save();

        

        return redirect('/item-category-show-all')->with('success','Successfully Updated');
    }
   }

   public function delete($id)

    {
        //return $id;
        $item_category=InventoryItemCategory::find($id);
        $itam=InventoryItem::where('category_id', '=', $item_category->id)->delete();
        $itam=InventoryItemSubcategory::where('item_cat_id', '=', $item_category->id)->delete();
       
        $item_category->delete();

        //return $item_category;

        return redirect('/item-category-show-all')->with('success','Successfully Delete');
    }
}

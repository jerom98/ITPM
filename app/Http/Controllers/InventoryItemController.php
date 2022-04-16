<?php

namespace App\Http\Controllers;

use App\Models\InventoryItem;
use App\Models\InventoryItemCategory;
use App\Models\InventoryItemSubcategory;
use App\Models\InventoryItemBrand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InventoryItemController extends Controller
{
    public function itemShowAll()
    {
        $brands=InventoryItemBrand::all();
        $subcategory=InventoryItemSubcategory::all();
        $category=InventoryItemCategory::all();
        $items=InventoryItem::join('inventory_item_brands','inventory_item_brands.id','=','inventory_items.brand_id')
            ->join('inventory_item_categories','inventory_item_categories.id','=','inventory_items.category_id')
            ->join('inventory_item_subcategories','inventory_item_subcategories.id','=','inventory_items.subcat_id')
            ->select('inventory_items.*','inventory_item_categories.item_cat_name','inventory_item_brands.brand_name','inventory_item_subcategories.item_subcat_name','inventory_item_subcategories.item_cat_id')
            ->get();
        return view('inventory.item.itemShowAll',compact('category','brands','subcategory','items'));   
    }

    public function itemAddProcess(Request $request)
    {
       // return $request;
        if ($request->id==null) {
            $request->validate([
                'name' => 'required||unique:inventory_items,item_name',
                'code' => 'required||unique:inventory_items,item_code',
                'subcategory' => 'required',
                'brand' => 'required',
                'category' => 'required'
            ]);
            $item=new InventoryItem();
            $item->item_name=$request->name;
            $item->item_code=$request->code;
            $item->category_id=$request->category;
            $item->brand_id=$request->brand;
            $item->subcat_id=$request->subcategory;
            $item->item_des=$request->description;
            $item->user_id=Auth::user()->emp_id;
            $item->save();

           

            $actvity = 'Add New Item, Item_id :-  - '. $item->id;
            $a = app('App\Http\Controllers\ActivityLogController')->index($actvity);

            return redirect('/item-show-all')->with('success','Successfully Recorded');
        }else {
            $item=InventoryItem::find($request->id);
            $request->validate([
                'name' => 'required||unique:inventory_items,item_name,'.$item->id,
                'code' => 'required||unique:inventory_items,item_code,'.$item->id,
                'subcategory' => 'required',
                'brand' => 'required'
            ]);
            $item->item_name=$request->name;
            $item->item_code=$request->code;
            $item->category_id=$request->category;
            $item->brand_id=$request->brand;
            $item->subcat_id=$request->subcategory;
            $item->item_des=$request->description;
            $item->save();

            //return  $item;

            $actvity = 'Update Item, Item_id :-  - '. $item->id;
            $a = app('App\Http\Controllers\ActivityLogController')->index($actvity);

            return redirect('/item-show-all')->with('success','Successfully Updated');
        }
    }

    public function getItemQtyType(Request $request)
    {
        // return $request;
        $item=InventoryItem::find($request->product_id);
        return $item;
    }
}

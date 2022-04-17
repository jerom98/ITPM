<?php

namespace App\Http\Controllers;

use App\Models\InventoryItem;
use App\Models\InventorySeller;
use App\Models\InventoryPurchaseOrder;
use App\Models\InventoryPurchaseItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class InventoryPurchaseOrderController extends Controller
{
    public function purchaseShowAll()
    {
        $purchase_orders = InventoryPurchaseOrder::join('inventory_sellers', 'inventory_sellers.id', '=', 'inventory_purchase_orders.seller_id')
            ->select('inventory_purchase_orders.*', 'inventory_sellers.seller_name')
            ->get();
        return view('inventory.purchase.purchaseShowAll', compact('purchase_orders'));
    }

    public function purchaseAdd()
    {
        $sellers = InventorySeller::all();
        $products = InventoryItem::all();
        return view('inventory.purchase.purchaseAdd', compact('sellers', 'products'));
    }

    public function purchaseAddProcess(Request $request)
    {
        $request->validate([
            'bill_no' => 'nullable|unique:inventory_purchase_orders,pur_ord_bill_no',
            'cheque_no' => 'nullable|unique:inventory_purchase_orders,pur_ord_cheque_no',
            'amount' => 'required',
            'seller_id' => 'required',
            'product_id' => 'required',
            'qty' => 'required',
            'qty_type' => 'required',
            'price' => 'required',
            'image_1' => 'nullable|max:2048|mimes:png,gif,jpeg,jpg,pdf,doc',
            'image_2' => 'nullable|max:2048|mimes:png,gif,jpeg,jpg,pdf,doc',
            'image_3' => 'nullable|max:2048|mimes:png,gif,jpeg,jpg,pdf,doc'
        ]);

        $purchase_order = new InventoryPurchaseOrder();
        $purchase_order->pur_ord_bill_no = $request->bill_no;
        $purchase_order->pur_ord_amount = $request->amount;
        $purchase_order->pur_ord_cash = $request->cash_amount;
        $purchase_order->pur_ord_cheque = $request->cheque_amount;
        $purchase_order->pur_ord_cheque_no = $request->cheque_no;
        $purchase_order->pur_ord_cheque_date = $request->cheque_date;
        $purchase_order->pur_ord_online_or_card = $request->online_amount;
        $purchase_order->pur_ord_reference_no = $request->reference_no;
        $purchase_order->pur_ord_credit = $request->credit_amount;
        $purchase_order->seller_id = $request->seller_id;
        $purchase_order->user_id = Auth::user()->emp_id;
        $purchase_order->save();

        $actvity = 'Add New PurchaseOrder, Purchase_order_id :- '. $purchase_order->id;
        $a = app('App\Http\Controllers\ActivityLogController')->index($actvity);

        $length = count($request->qty);
        for ($i = 0; $i < $length; $i++) {
            $purchase_item = new InventoryPurchaseItem();
            $purchase_item->item_id = $request->product_id[$i];
            $purchase_item->pur_item_qty = $request->qty[$i];
            $purchase_item->pur_item_qty_type = $request->qty_type[$i];
            $purchase_item->pur_item_amount = $request->price[$i];
            $purchase_item->purchase_order_id = $purchase_order->id;
            $purchase_item->warranty = $request->warrenty[$i];
            $purchase_item->serial_number = $request->serial_number[$i];
            $purchase_item->description = $request->description[$i];
            $purchase_item->user_id = Auth::user()->emp_id;
            $purchase_item->save();
            
            $actvity = 'Add New InventoryPurchaseItem, Inventory_purchase_item_id :- '. $purchase_item->id;
            $a = app('App\Http\Controllers\ActivityLogController')->index($actvity);
        }

        if ($request->img_1 != null || $request->img_1 != null || $request->img_1 != null) {
            $purchase_order_update = InventoryPurchaseOrder::find($purchase_order->id);

            // img 1
            if ($request->img_1 != null) {
                $image_name = $purchase_order_update->id . '-0.' . $request->img_1->extension();
                $request->img_1->move('inventory_purchase', $image_name);
                $purchase_order_update->bill_img_1 = $image_name;
            }
            // img 2
            if ($request->img_2 != null) {
                $image_name = $purchase_order_update->id . '-1.' . $request->img_2->extension();
                $request->img_2->move('inventory_purchase', $image_name);
                $purchase_order_update->bill_img_2 = $image_name;
            }
            // img 3
            if ($request->img_3 != null) {
                $image_name = $purchase_order_update->id . '-2.' . $request->img_3->extension();
                $request->img_3->move('inventory_purchase', $image_name);
                $purchase_order_update->bill_img_3 = $image_name;
            }

            $purchase_order_update->save();
        }
        return redirect('/purchase-show-all')->with('success', 'Successfully Recorded');
    }

}

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

}

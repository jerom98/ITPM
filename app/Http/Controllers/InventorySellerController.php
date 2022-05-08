<?php

namespace App\Http\Controllers;

use App\Models\InventorySeller;
use App\Models\InventorySellerType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
class InventorySellerController extends Controller
{
   public function sellerShowAll()
   {
       $sellers=InventorySeller::join('inventory_seller_types','inventory_seller_types.id','=','inventory_sellers.seller_type_id')
       ->select('inventory_sellers.*','inventory_seller_types.seller_type_name')
       ->get();
       $seller_types=InventorySellerType::all();
       return view('inventory.seller.sellerShowAll',compact('sellers','seller_types'));
   }

   public function sellerAddProcess(Request $request)
   {
       if ($request->id==null) {
        $request->validate([
            'name' => 'required|unique:inventory_sellers,seller_name',
            'address' => 'required',
            'seller_type_id'=>'required',
            'mobile_no'=>'nullable|unique:inventory_sellers,mobile_no',
            'office_no'=>'nullable|unique:inventory_sellers,contact_no',
            'image_1' => 'nullable|max:2048|mimes:png,gif,jpeg,jpg,pdf,doc',
            'image_2' => 'nullable|max:2048|mimes:png,gif,jpeg,jpg,pdf,doc',
            'image_3' => 'nullable|max:2048|mimes:png,gif,jpeg,jpg,pdf,doc'
        ]);
        
        $seller=new InventorySeller();
        $seller->seller_name=$request->name;
        $seller->seller_reg_no=$request->reg_no;
        $seller->seller_address=$request->address;
        $seller->contact_no=$request->office_no;
        $seller->mobile_no=$request->mobile_no;
        $seller->seller_type_id=$request->seller_type_id;
        $seller->user_id=Auth::user()->emp_id;
        $seller->save();
        
        $actvity = 'Add New Seller , Seller_id :- '. $seller->id;
        $a = app('App\Http\Controllers\ActivityLogController')->index($actvity);

        $seller_update=InventorySeller::find($seller->id);
        if ($request->image_1 != null) {
            $image_name=$seller->id.'-'."1".'.'.$request->image_1->extension();
            $seller_update->seller_img_1=$image_name;
            $request->image_1->move('inventory_seller',$image_name);
        }
        if ($request->image_2 != null) {
            $image_name=$seller->id.'-'."2".'.'.$request->image_2->extension();
            $seller_update->seller_img_2=$image_name;
            $request->image_2->move('inventory_seller',$image_name);
        }
        if($request->image_3 != null) {
            $image_name=$seller->id.'-'."3".'.'.$request->image_3->extension();
            $seller_update->seller_img_3=$image_name;
            $request->image_3->move('inventory_seller',$image_name);
        }

        $seller_update->save();
        return redirect('/seller-show-all')->with('success','Successfully Recorded');

       }else {
        $seller=InventorySeller::find($request->id);
        $request->validate([
            'name' => 'required|unique:inventory_sellers,seller_name,'.$seller->id,
            'address' => 'required',
            'seller_type_id'=>'required',
            'mobile_no'=>'nullable|unique:inventory_sellers,mobile_no,'.$seller->id,
            'office_no'=>'nullable|unique:inventory_sellers,contact_no,'.$seller->id,
            'image_1' => 'nullable|max:2048|mimes:png,gif,jpeg,jpg,pdf,doc',
            'image_2' => 'nullable|max:2048|mimes:png,gif,jpeg,jpg,pdf,doc',
            'image_3' => 'nullable|max:2048|mimes:png,gif,jpeg,jpg,pdf,doc'
        ]);
        
        $seller->seller_name=$request->name;
        $seller->seller_reg_no=$request->reg_no;
        $seller->seller_address=$request->address;
        $seller->contact_no=$request->office_no;
        $seller->mobile_no=$request->mobile_no;
        $seller->seller_type_id=$request->seller_type_id;
        if ($request->image_1 != null) {
            $image_name=$seller->id.'-'."1".'.'.$request->image_1->extension();
            $seller->seller_img_1=$image_name;
            $request->image_1->move('inventory_seller',$image_name);
        }
        if ($request->image_2 != null) {
            $image_name=$seller->id.'-'."2".'.'.$request->image_2->extension();
            $seller->seller_img_2=$image_name;
            $request->image_2->move('inventory_seller',$image_name);
        }
        if($request->image_3 != null) {
            $image_name=$seller->id.'-'."3".'.'.$request->image_3->extension();
            $seller->seller_img_3=$image_name;
            $request->image_3->move('inventory_seller',$image_name);
        }

        $seller->save();

       

        return redirect('/seller-show-all')->with('success','Successfully Updated');
       }
   }

   public function delete($id)

   {
       
       $seller=InventorySeller::find($id);
       //return $id;
       $seller->delete();

       return redirect('/seller-show-all')->with('success','Successfully Delete');


   }

   public function sellerReport()
          {

          
            $from=substr(Carbon::now()->subDays(30),0,10);
            $to=substr(Carbon::now()->tomorrow(),0,10);
            $filter_by='';
            $sellers=[];
            

            $sellers=DB::table('inventory_sellers')
            ->join('inventory_seller_types','inventory_seller_types.id','=','inventory_sellers.seller_type_id')
            ->select('inventory_sellers.seller_name','inventory_sellers.seller_reg_no','inventory_sellers.mobile_no','inventory_seller_types.seller_type_name')
            ->groupBy('inventory_sellers.seller_name','inventory_sellers.seller_reg_no','inventory_sellers.mobile_no','inventory_seller_types.seller_type_name',)
            ->where('inventory_sellers.created_at','>=',$from)
            ->where('inventory_sellers.created_at','<=',$to) ;    

           

            $sellers=$sellers ->get();

            //return $sellers;

            return view('inventory.Report.sellerReport',['filter_by'=>$filter_by,'from'=>$from,'to'=>$to,'sellers'=>$sellers]);

          }

}

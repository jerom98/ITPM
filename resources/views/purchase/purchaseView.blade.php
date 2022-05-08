@extends('layouts.navigation')
@section('purchase_order','active')
@section('content')
<?php 
  $Access=session()->get('Access'); 
?>

      <!-- Main Content -->
      <div class="card">
    <form action="/purchase-order-update-process" method="post" style="width:100%" enctype="multipart/form-data">
      @csrf
      
        <div class="card-header">
          <h4>Purchase Order</h4>
        </div>

        {{-- card body start --}}
        <div class="card-body">

            <input type="hidden" name="id" value="{{$purchase_order->id}}">
          {{-- first row --}}
          <div class="form-row">
            <div class="form-group col-md-4">
              <label>Bill No</label>
              <input type="text" id="bill_no" name="bill_no" value="{{$purchase_order->pur_ord_bill_no}}" class="form-control" readonly>
            </div>
            <div class="form-group col-md-4">
              <label>Total Payment</label>
              <input type="text" id="amount" name="amount" value="{{$purchase_order->pur_ord_amount}}" pattern="^(0|[1-9][0-9]*)$" class="form-control" readonly>
            </div>
            <div class="form-group col-md-4">
                <label>Seller</label>
                <input type="text" id="amount" name="amount" value="{{$purchase_order->seller_name}}" pattern="^(0|[1-9][0-9]*)$" class="form-control" readonly>
            </div>
          </div>

          {{-- second row --}}
          <div class="form-row">
            <div class="form-group col-md-4">
              <label>Cheque Payment</label>
              <input type="text" id="cheque_amount" value="{{$purchase_order->pur_ord_cheque}}" name="cheque_amount" pattern="^(0|[1-9][0-9]*)$" class="form-control" readonly>
            </div>
            <div class="form-group col-md-4">
              <label>Cheque No</label>
              <input type="text" value="{{$purchase_order->pur_ord_cheque_no}}" id="cheque_no" name="cheque_no" class="form-control" readonly>
            </div>
            <div class="form-group col-md-4">
              <label>Cheque Date</label>
              <input type="text" value="{{$purchase_order->pur_ord_cheque_date}}" id="cheque_date" name="cheque_date" class="form-control" readonly>
            </div>
          </div>

          {{-- third row --}}
          <div class="form-row">
            <div class="form-group col-md-6">
              <label>Online/Card Payment</label>
              <input type="text" value="{{$purchase_order->pur_ord_online_or_card}}" id="online_amount" name="online_amount" pattern="^(0|[1-9][0-9]*)$" class="form-control" readonly>
            </div>
            <div class="form-group col-md-6">
              <label>Reference No</label>
              <input type="text" value="{{$purchase_order->pur_ord_reference_no}}" id="reference_no" name="reference_no" class="form-control" readonly>
            </div>
          </div>

          {{-- fourth row --}}
          <div class="form-row">
            <div class="form-group col-md-6">
              <label>Credit Payment</label>
              <input type="text" value="{{$purchase_order->pur_ord_credit}}" id="credit_amount" name="credit_amount" value="0" pattern="^(0|[1-9][0-9]*)$" class="form-control" readonly>
            </div>
            <div class="form-group col-md-6">
              <label>Cash Payment</label>
              <input type="text" value="{{$purchase_order->pur_ord_cash}}" id="cash_amount" name="cash_amount" value="0" pattern="^(0|[1-9][0-9]*)$" class="form-control" readonly>
            </div>
          </div>

           {{-- fifth row --}}
           <div class="form-row">
            <div class="form-group col-md-4">
              <label>File 1</label><br>
              <?php 
                $extension_1 = substr($purchase_order->bill_img_1, strpos($purchase_order->bill_img_1, ".") + 1);    
                $extension_2 = substr($purchase_order->bill_img_2, strpos($purchase_order->bill_img_2, ".") + 1);    
                $extension_3 = substr($purchase_order->bill_img_3, strpos($purchase_order->bill_img_3, ".") + 1);    
              ?>
              @if ($extension_1=="pdf" || $extension_1=="doc") 
                <a href="/inventory_purchase/{{$purchase_order->bill_img_1}}" target="_blank" style="width: 100px; height:100px; border:solid 1px white; border-radius:15px;"><b>View {{$extension_1}} </b></a>
              @endif
              @if ($extension_1=="png" || $extension_1=="gif" || $extension_1=="jpeg" || $extension_1=="jpg")
                <a href="/inventory_purchase/{{$purchase_order->bill_img_1}}" target="_blank"><img src="/inventory_purchase/{{$purchase_order->bill_img_1}}" class="css-class" alt="Null" style="width: 100px; height:100px; border:solid 1px white; border-radius:15px;"></a>
              @endif
            </div>
            <div class="form-group col-md-4">
              <label>File 2</label><br>
              @if ($extension_2=="pdf" || $extension_2=="doc") 
                <a href="/inventory_purchase/{{$purchase_order->bill_img_2}}" target="_blank" style="width: 100px; height:100px; border:solid 1px white; border-radius:15px;"><b>View {{$extension_2}} </b></a>
              @endif
              @if ($extension_2=="png" || $extension_2=="gif" || $extension_2=="jpeg" || $extension_2=="jpg")
                <a href="/inventory_purchase/{{$purchase_order->bill_img_2}}" target="_blank"><img src="/inventory_purchase/{{$purchase_order->bill_img_2}}" class="css-class" alt="Null" style="width: 100px; height:100px; border:solid 1px white; border-radius:15px;"></a>
              @endif
            </div>
            <div class="form-group col-md-4">
              <label>File 3</label><br>
              @if ($extension_3=="pdf" || $extension_3=="doc") 
                <a href="/inventory_purchase/{{$purchase_order->bill_img_3}}" target="_blank" style="width: 100px; height:100px; border:solid 1px white; border-radius:15px;"><b>View {{$extension_3}} </b></a>
              @endif
              @if ($extension_3=="png" || $extension_3=="gif" || $extension_3=="jpeg" || $extension_3=="jpg")
                <a href="/inventory_purchase/{{$purchase_order->bill_img_3}}" target="_blank"><img src="/inventory_purchase/{{$purchase_order->bill_img_3}}" class="css-class" alt="Null" style="width: 100px; height:100px; border:solid 1px white; border-radius:15px;"></a>
              @endif
            </div>
          </div>

          <div class="table">
            <table style="width: 100%">
              <thead>
                <tr>
                  <th>Product</th>
                  <th>Quantity Type</th>
                  <th>Quantity</th>
                  <th>Warranty</th>
                  <th>Serial No</th>
                  <th>Description</th>
                  <th>Price</th>
                  <th></th>
                </tr>                                 
              </thead>
              <tbody>             
                @foreach ($permanent_purchase_items as $permanent_purchase_item)
                <tr>
                    <input type="hidden" name="item_id[]" value="{{$permanent_purchase_item->id}}" readonly>
                    <td>
                      <select id="product_id" name="product_id[]" class="form-control" readonly>
                        <option value="" disabled>Select Product</option>
                        @foreach ($products as $product)
                          <option value="{{$product->id}}" {{$product->id==$permanent_purchase_item->item_id?'selected':''}}>{{$product->item_name}}</option>
                        @endforeach
                      </select>
                    </td>
                    <td>
                      <select name="qty_type[]" id="qty_type" class="form-control" readonly>
                        <option value="" disabled selected>Select Quantity Type</option>
                        <option value="count" {{$permanent_purchase_item->pur_item_qty_type=='count'?'selected':''}}>count</option>
                        
                        <option value="meter" {{$permanent_purchase_item->pur_item_qty_type=='meter'?'selected':''}}>meter</option>
                      </select>
                    </td>
                    <td>
                      <input type="text" value="{{$permanent_purchase_item->pur_item_qty}}" id="qty" name="qty[]" class="form-control" placeholder="Enter the Quantity" pattern="^\d+(\.\d)?\d*$" readonly>
                    </td>
                    <td>
                      <input type="number" name="warrenty[]" id="warrenty" value="{{$permanent_purchase_item->warranty}}" class="form-control" readonly>
                    </td>
                    <td>
                      <input type="text" value="{{$permanent_purchase_item->serial_number}}" id="serial_number" name="serial_number[]" class="form-control" placeholder="Enter the Serial Number" readonly>
                    </td>
                    <td>
                      <textarea name="description[]" class="form-control" id="description" readonly cols="30" rows="1">{{$permanent_purchase_item->description}}</textarea>
                    </td>
                    
                    <td>
                      <input type="text" readonly value="{{$permanent_purchase_item->pur_item_amount}}" id="price" name="price[]" class="form-control" pattern="^\d+(\.\d)?\d*$" placeholder="Enter the Price" required>
                    </td>
                    <td>
                    </td>
                  </tr>     
                @endforeach    
              </tbody>
            </table>
          </div>
        </div>{{--card body end  --}}

       
        <div class="card-footer text-right">
          <a href="/purchase-edit/{{$purchase_order->id}}" class="btn btn-primary btn-edit"><i class="far fa-edit"></i></a>
        </div>
      

        
      
    </form>   
      </div>
@endsection
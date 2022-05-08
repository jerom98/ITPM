@extends('layouts.navigation')
@section('purchase_order','active')
@section('content')
<?php 
  $Access=session()->get('Access'); 
?>

      <!-- Main Content -->
      <div class="card">
    <form action="/purchase-add-process" method="post"  class="needs-validation" novalidate=""  enctype="multipart/form-data">
      @csrf
      
        <div class="card-header">
          <h4>Purchase Order</h4>
        </div>

        {{-- card body start --}}
        <div class="card-body" style="width:100%">
          <input type="hidden" id="pat" value="^\d+(\.\d)?\d*$">
          {{-- first row --}}
          <div class="form-row">
            <div class="form-group col-md-4">
              <label>Bill No</label>
              <input type="text" id="bill_no" name="bill_no" value="{{old('bill_no')}}" class="form-control">
              @error('bill_no')<span class="text-danger error">{{$message}}</span>@enderror
            </div>
            <div class="form-group col-md-4">
              <label>Total Payment</label>
              <input type="text" id="amount" name="amount" value="{{old('amount')}}" pattern="^\d+(\.\d)?\d*$" class="form-control" required>
              @error('amount')<span class="text-danger error">{{$message}}</span>@enderror
            </div>
            <div class="form-group col-md-4">
              <label>Seller</label>
              <select class="form-control" name="seller_id" required>
                <option value="" disabled selected>Select Seller</option>
                @foreach ($sellers as $seller)
                  <option value="{{$seller->id}}" {{$seller->id==old('seller_id')?'selected':''}}>{{$seller->seller_name}}</option>
                @endforeach
              </select>
              @error('seller_id')<span class="text-danger error">{{$message}}</span>@enderror
            </div>
          </div>

          {{-- second row --}}
          <div class="form-row">
            <div class="form-group col-md-4">
              <?php
                  if (old('cheque_amount')) {
                    $cheque_val_amount=old('cheque_amount');
                  }else {
                    $cheque_val_amount=0;
                  }
                  if (old('online_amount')) {
                    $online_val_amount=old('online_amount');
                  }else {
                    $online_val_amount=0;
                  }
                  if (old('credit_amount')) {
                    $credit_val_amount=old('credit_amount');
                  }else {
                    $credit_val_amount=0;
                  }
                  if (old('cash_amount')) {
                    $cash_val_amount=old('cash_amount');
                  }else {
                    $cash_val_amount=0;
                  }
              ?>
              <label>Cheque Payment</label>
              <input type="text" id="cheque_amount" value="{{$cheque_val_amount}}" name="cheque_amount" pattern="^\d+(\.\d)?\d*$" class="form-control">
            </div>
            <div class="form-group col-md-4">
              <label>Cheque No</label>
              <input type="text" id="cheque_no" value="{{old('cheque_no')}}" name="cheque_no" class="form-control">
              @error('cheque_no')<span class="text-danger error">{{$message}}</span>@enderror
            </div>
            <div class="form-group col-md-4">
              <label>Cheque Date</label>
              <input type="date" id="cheque_date" value="{{old('cheque_date')}}" name="cheque_date" class="form-control">
            </div>
          </div>

          {{-- third row --}}
          <div class="form-row">
            <div class="form-group col-md-6">
              <label>Online/Card Payment</label>
              <input type="text" value="{{$online_val_amount}}" id="online_amount" name="online_amount" pattern="^\d+(\.\d)?\d*$" class="form-control">
            </div>
            <div class="form-group col-md-6">
              <label>Reference No</label>
              <input type="text" id="reference_no" name="reference_no" value="{{old('reference_no')}}" class="form-control">
            </div>
          </div>

          {{-- fourth row --}}
          <div class="form-row">
            <div class="form-group col-md-6">
              <label>Credit Payment</label>
              <input type="text" id="credit_amount" name="credit_amount" value="{{$credit_val_amount}}" pattern="^\d+(\.\d)?\d*$" class="form-control">
            </div>
            <div class="form-group col-md-6">
              <label>Cash Payment</label>
              <input type="text" id="cash_amount" name="cash_amount" value="{{$cash_val_amount}}" pattern="^\d+(\.\d)?\d*$" class="form-control">
            </div>
          </div>

           {{-- fifth row --}}
           <div class="form-row">
            <div class="form-group col-md-4">
              <label>Image 1</label>
              <input type="file" id="img_1" name="img_1" class="form-control">
              <span id="er_img_3">(Max 2MB)<br></span>
              @error('img_1')<span class="text-danger error">{{$message}}</span>@enderror
            </div>
            <div class="form-group col-md-4">
              <label>Image 2</label>
              <input type="file" id="img_2" name="img_2" class="form-control">
              <span id="er_img_3">(Max 2MB)<br></span>
              @error('img_2')<span class="text-danger error">{{$message}}</span>@enderror
            </div>
            <div class="form-group col-md-4">
              <label>Image 3</label>
              <input type="file" id="img_3" name="img_3" class="form-control">
              <span id="er_img_3">(Max 2MB)<br></span>
              @error('img_3')<span class="text-danger error">{{$message}}</span>@enderror
            </div>
          </div>

          <div class="table-responsive">
            <table style="width: 100%" class="table table-striped">
              <thead>
                <tr>
                  <th>Item</th>
                  <th>Quantity Type</th>
                  <th>Quantity</th>
                  <th>Warranty (Months)</th>
                  <th>Serial No</th>
                  <th>Description</th>
                  <th>Price</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                
                {{-- <tr>
                  <td>
                    <select id="product_id" name="product_id[]" class="form-control" required>
                      <option value="" disabled selected>Select Product</option>
                      @foreach ($products as $product)
                        <option value="{{$product->id}}">{{$product->product_name}}</option>
                      @endforeach
                    </select>
                  </td>
                  <td>
                    <select name="qty_type[]" id="qty_type" class="form-control" required>
                      <option value="" disabled selected>Select Quantity Type</option>
                      <option value="count">count</option>
                      <option value="meter">meter</option>
                    </select>
                  </td>
                  <td>
                    <input type="text" id="qty" pattern="^\d+(\.\d)?\d*$" name="qty[]" class="form-control" placeholder="Enter the Quantity" required>
                  </td>
                  <td>
                    <input type="date" name="warrenty[]" id="warrenty" class="form-control">
                  </td>
                  <td><input type="text" name="serial_number[]" id="serial_number" class="form-control"></td>
                  <td><textarea name="description[]" id="description" cols="30" class="form-control"></textarea></td>
                  <td>
                    <input type="text" id="price" name="price[]" class="form-control" placeholder="Enter the Price" pattern="^\d+(\.\d)?\d*$" required>
                  </td>
                  <td></td>
                </tr> --}}
                
              </tbody>
            </table>
            <button type="button" data-toggle="modal" data-target="#view" id="pur_product" class="btn btn-primary"><i class="fas fa-plus"></i>&nbsp Add Row</button>
          </div>
        </div>{{--card body end  --}}
        <div class="card-footer text-right">
          <button id="reset" type="reset" class="btn btn-danger">Reset</button>
          <button id="submit" class="btn btn-success">Submit</button>
        </div>
    </form>   
      </div>

    <script>
      var count_row=0;

          $(document).ready(function() {
            
            $('#reset').click(function (e) { 
              $('tbody').html('');
              count_row=0;
              console.log('count : '+count_row);
            });
            $('#pur_product').click(function (e) { 
              e.preventDefault();
                $('#m_product_id').val('');
                $('#m_qty_type').val('');
                $('#m_qty').val('');
                $('#m_price').val('');
                $('#m_warrenty').val('');
                $('#m_serial_number').val('');
                $('#m_description').val('');
                $('#m_product_id').css('border-color','');
                $('#m_qty_type').css('border-color','');
                $('#m_qty').css('border-color','');
                $('#m_price').css('border-color','');
                $('#m_warrenty').css('border-color','');
                $('#m_serial_number').css('border-color','');
                $('#m_description').css('border-color','');      
            });
            
            $('#m_product_id').change(function (e) { 
              e.preventDefault();
              $('#m_product_id').css('border-color','green');
            });

            $('#m_qty_type').change(function (e) { 
              e.preventDefault();
              $('#m_qty_type').css('border-color','green');
            });

            $('#m_qty').keyup(function (e) { 
              console.log($(this).val());
              if ($('#m_qty').val()=='') {
                $('#m_qty').css('border-color','red');
              }else{
                if ($('#m_qty').val().match(/^(?!0\d)\d*(\.\d+)?$/)) {
                  $('#m_qty').css('border-color','green');
                }else{
                  $('#m_qty').css('border-color','red');
                }
              }
            });

            $('#m_price').keyup(function (e) { 
              e.preventDefault();
              if ($(this).val()=='') {
                $('#m_price').css('border-color','red');
              }else{
                if ($('#m_price').val().match(/^(?!0\d)\d*(\.\d+)?$/)) {
                  $('#m_price').css('border-color','green');
                }else{
                  $('#m_price').css('border-color','red');
                }
              }
            });

            $('#m_warrenty').keyup(function (e) { 
              e.preventDefault();
              $('#m_warrenty').css('border-color','green');
            });

            $('#m_serial_number').keyup(function (e) { 
              e.preventDefault();
              $('#m_serial_number').css('border-color','green');
            });

            $('#m_description').keyup(function (e) { 
              e.preventDefault();
              $('#m_description').css('border-color','green');
            });

            $('#modal-reset').click(function (e) { 
                $('#m_product_id').css('border-color','red');
                $('#m_qty_type').css('border-color','red');
                $('#m_qty').css('border-color','red');
                $('#m_price').css('border-color','red');
                $('#m_warrenty').css('border-color','green');
                $('#m_serial_number').css('border-color','green');
                $('#m_description').css('border-color','green');              
            });

            $('#modal-submit').click(function (e) { 
              e.preventDefault();
              var status=true;
              var product_id=$('#m_product_id').val();
              var qty_type=$('#m_qty_type').val();
              var qty=$('#m_qty').val();
              var price=$('#m_price').val();
              var warrenty=$('#m_warrenty').val();
              var serial_number=$('#m_serial_number').val();
              var description=$('#m_description').val();
              if (product_id==null) {
                $('#m_product_id').css('border-color','red');
                status=false
              }
              if (qty_type==null) {
                $('#m_qty_type').css('border-color','red');
                status=false
              }
              if (qty=='') {
                $('#m_qty').css('border-color','red');
                status=false
              }
              if (price=='') {
                $('#m_price').css('border-color','red');
                status=false
              }
              if (warrenty=='') {
                $('#m_warrenty').css('border-color','green');
              }
              if (serial_number=='') {
                $('#m_serial_number').css('border-color','green');
              }
              if (description=='') {
                $('#m_description').css('border-color','green');
              }
              
              if (status) {
                var html='';
                let pat=$('#pat').val();
                html+='<tr>';
                html+='<td>';
                html+='<select id="product_id_'+count_row+'" name="product_id[]" class="form-control" required>';
                html+='<option value="" disabled>Select Product</option>';
                html+='@foreach ($products as $product)';
                html+='<option value="{{$product->id}}">{{$product->item_name}}</option>';
                html+='@endforeach';
                html+='</select>';
                html+='</td>';
                html+='<td>';
                html+='<select name="qty_type[]" id="qty_type_'+count_row+'" class="form-control" required>';
                html+='<option value="" disabled>Select Quantity Type</option>';
                html+='<option value="count">count</option>';
                html+='<option value="capacity">capacity</option>';
                
                html+='<option value="meter">meter</option>';
                html+='</select>';
                html+='</td>';
                html+='<td>';
                html+='<input type="text" value="'+qty+'" id="qty" pattern="'+ pat +'" name="qty[]" class="form-control" placeholder="Enter the Quantity" required>';
                html+='</td>';
                html+='<td>';
                html+='<input type="number" value="'+warrenty+'" name="warrenty[]" id="warrenty" class="form-control">';
                html+='</td>';
                html+='<td><input type="text" value="'+serial_number+'" name="serial_number[]" id="serial_number" class="form-control"></td>';
                html+='<td><textarea name="description[]" id="description" cols="30" class="form-control">'+description+'</textarea></td>';
                html+='<td>';
                html+='<input type="text" value="'+price+'" id="price" pattern="'+pat+'" name="price[]" class="form-control" placeholder="Enter the Price" required>';
                html+='</td>';
                html+='<td><button type="button" id="remove" class="btn btn-icon btn-danger"><i class="fas fa-times"></i></button></td>';
                $('#view').modal('hide');
                $('tbody').append(html);
                $('#qty_type_'+count_row).val(qty_type);
                $('#product_id_'+count_row).val(product_id);
                count_row++;
                console.log('count : '+count_row);
                console.log("pro id :"+product_id);
              }

            });

            $(document).on('click','#remove',function(){
              $(this).closest('tr').remove();
              count_row--;
              console.log('count : '+count_row);
            });

          });

        $(document).on('click','#submit',function(){
          var total_product_amount=parseInt(0);
          var total_amount=parseInt(document.getElementById('amount').value);
          var cheque_amount=parseInt(document.getElementById('cheque_amount').value);
          var online_amount=parseInt(document.getElementById('online_amount').value);
          var credit_amount=parseInt(document.getElementById('credit_amount').value);
          var cash_amount=parseInt(document.getElementById('cash_amount').value);
          var calculated_amount=cheque_amount+online_amount+credit_amount+cash_amount;
          var input = document.getElementsByName('price[]');
  
            for (var i = 0; i < input.length; i++) {
                var a = input[i].value;
                total_product_amount=total_product_amount+parseInt(a);
            } 

          if (total_amount<1) {
            alert('Please enter the total payment');
            return false;
          }

          if (total_amount!=calculated_amount) {
            alert('Please consider the payments');
            return false;
          } 

          if (cheque_amount>0) {
            if (document.getElementById('cheque_no').value=='') {
              alert('Please enter the cheque no');
              return false;
            }
            if (document.getElementById('cheque_date').value=='') {
              alert('Please enter the cheque date');
              return false;
            }
          } 

          if (total_amount!=total_product_amount) {
            alert('Please consider the product amounts');
            return false;
          }       

          if (count_row==0) {
            alert('Please add atleast one product');
            return false;
          } 
        });
      </script>
      
@endsection

{{-- view modal start --}}
<div class="modal fade" id="view" tabindex="-1" role="dialog" aria-labelledby="formModal" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="formModal">Purchase Order</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
              {{-- <div style="padding: 10px 0">
                  <button id="modal-print" class="btn btn-primary">Print</button>
              </div> --}}
            <form class="needs-validation" novalidate="">
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="m_product_id">Product</label>
                  <select id="m_product_id" class="form-control" required>
                    <option value="" disabled selected>Select Product</option>
                    @foreach ($products as $product)
                      <option value="{{$product->id}}">{{$product->item_name}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group col-md-6">
                  <label for="m_qty_type">Quantity Type</label>
                  <select id="m_qty_type" class="form-control" >
                    <option value="" disabled selected>Select Quantity Type</option>
                    <option value="count">count</option>
                    <option value="meter">meter</option>
                  </select>
                </div>
              </div>

              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="m_qty">Quantity</label>
                  <input type="text" id="m_qty" pattern="^\d+(\.\d)?\d*$" class="form-control" placeholder="Enter the Quantity" required>
                </div>
                <div class="form-group col-md-6">
                  <label for="m_price">Price</label>
                  <input type="text" id="m_price" class="form-control" placeholder="Enter the Price" pattern="^\d+(\.\d)?\d*$" required>
                </div>            
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="m_warrenty">Warranty (Months)</label>
                  <input type="number" id="m_warrenty" class="form-control">
                </div>
                <div class="form-group col-md-6">
                  <label for="m_serial_number">Serial Number</label>
                  <input type="text" id="m_serial_number" class="form-control">
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-12">
                  <label for="m_description">Description</label>
                  <textarea id="m_description" cols="30" class="form-control"></textarea>
                </div>    
              </div>
              <div align="right">
                <button id="modal-reset" type="reset" class="btn btn-danger">Reset</button>
                <button id="modal-submit" type="button" class="btn btn-success">Submit</button>
              </div>
            </form>
          </div>
      </div>
  </div>
</div>
{{-- view modal end --}}

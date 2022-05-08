@extends('layouts.navigation')
@section('purchase_order','active')
@section('content')
<?php 
  $Access=session()->get('Access'); 
?>

      <!-- Main Content -->
      <div class="card">
                  <div class="card-header">
                    <h4 class="header">Purchase Order</h4>
                    <a href="/purchase-add" class="btn btn-success">Add</a>
                  </div>
                  
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-striped table-1">
                        <thead>
                          <tr>
                            {{-- <th>Id</th> --}}
                            <th>Bill No</th>
                            <th>Amount</th>
                            <th>Seller Name</th>
                            <th class="action">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($purchase_orders as $purchase_order)
                            <tr>
                              {{-- <td >{{$purchase_order->id}}</td> --}}
                              <td>{{$purchase_order->pur_ord_bill_no}}</td>
                              <td>{{$purchase_order->pur_ord_amount}}</td>
                              <td>{{$purchase_order->seller_name}}</td>
                                <td class="action">
                                  <a href="purchase-view/{{$purchase_order->id}}" title="view" class="btn btn-info btn-edit"><i class="far fa-eye"></i></a>
                                  <a href="purchase-edit/{{$purchase_order->id}}" title="edit" class="btn btn-primary btn-edit"><i class="far fa-edit"></i></a>
                                  <a href="/purchase-delete/{{$purchase_order->id}}" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>
                                </td>
                              </td>
                            </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
      </div>
@endsection
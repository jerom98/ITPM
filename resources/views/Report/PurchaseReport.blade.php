@extends('layouts.navigation')
@section('purchase_report','active')
@section('content')
<?php 
  $Access=session()->get('Access'); 
?>


    <!-- Main Content -->
    <div class="card">
    <form action="/purchase-report" method="POST">
      @csrf
        
        <div class="card-body form">
            <h6>Purchase Report</h6>
            <div class="form-row">

                <div class="form-group col-md-3 ">
                    <label>From</label>
                    <input type="date" id="from" value="{{$from}}" name="from" class="form-control">
                </div>

                <div class="form-group col-md-3">
                    <label>To</label>
                    <input type="date" id="to" value="{{$to}}" name="to" class="form-control">
                </div>

                <div class="col-md-9" align="right">
                  <button type="reset" id="reset" class="btn btn-danger">Reset</button>
                  <button class="btn btn-success mr-1" id="submit" type="submit">Submit</button>
                </div>
                 
        </div>
        

    </form> 
    
    <div class="card-body">
        <div class="table-responsive">
        <table class="table table-striped print_table">
            <thead>
              <tr>
                <th>purchase Bill No</th>
                <th>Item Name</th>
                <th>Quantity </th>
                <th>Warranty</th>
                <th>Amount</th> 
              </tr>
            </thead>

            <tbody>
                @foreach ($Item as $items)
                <tr>
                  <td>{{$items->pur_ord_bill_no}}</td>
                  <td>{{$items->item_name}}</td>
                  <td>{{$items->qty}}</td>
                  <td>{{$items->warranty}}</td>
                <td>{{$items->pur_ord_amount}}</td>
                @endforeach
            </tbody>

          </table>
          
        </div>
      </div>
      {{-- @endif --}}

</div>

<script>
  $(document).ready(function() {
    $('#print_table').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'csv', 'excel', 'print'
        ]
    });

    $('.print_table').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'csv', 'excel', 'print'
        ]
    });
});

</script>
@endsection



@extends('layouts.navigation')
@section('item_seller','active')
@section('content')
<?php 
  $Access=session()->get('Access'); 
?>


      <!-- Main Content -->
      <div class="card">
    <form action="/seller-reports" method="GET">
      @csrf
        
        <div class="card-body form">
                        <h6>Seller Report</h6>

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
                <th>Seller Name</th>
                <th>Register No</th>
                <th>Seller Type </th>
                <th>Mobile No</th>
                
               
              </tr>
            </thead>

            <tbody>
                @foreach ($sellers as $items)
                <tr>
                  
                <td>{{$items->seller_name}}</td>
                <td>{{$items->seller_reg_no}}</td>
                <td>{{$items->mobile_no}}</td>
                <td>{{$items->seller_type_name}}</td>
               
               
              
               
                </tr>                
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



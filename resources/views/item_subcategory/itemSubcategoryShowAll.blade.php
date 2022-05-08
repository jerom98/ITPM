@extends('layouts.navigation')
@section('item_subcategory', 'active')
@section('content')
<?php 
  $Access=session()->get('Access'); 
  $itemTypeAdd=false;
  $itemTypeEdit=false;
  
  if (in_array('inventory.productTypeAddProcess', $Access)) {
    $itemTypeAdd=true;
  }

  if (in_array('inventory.productTypeUpdateProcess', $Access)) {
    $itemTypeEdit=true;
  }
?>

  <!-- Main Content -->
  <div class="card">                
  <div class="card-header">
    <h4 class="header">Item Subcategory</h4>
    {{--  @if ($productTypeAdd)  --}}
        <button data-toggle="modal" data-target="#add" id="btn-add" class="btn btn-success">Add</button>
    {{--  @endif  --}}
  </div>
                  
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-striped table-1">
        <thead>
          <tr>
            <th>Id</th>
            <th>Item Subcategory</th>
            <th>Item Category</th>
            <th>Description</th>
            {{--  @if ($productTypeEdit)  --}}
              <th style="text-align: center">Action</th>
            {{--  @endif  --}}
          </tr>
        </thead>
        
        <tbody>
          @foreach ($item_subcategories as $item_subcategory)
            <tr>
              <td >{{$item_subcategory->id}}</td>
              <td>{{$item_subcategory->item_subcat_name}}</td>
              <td>{{$item_subcategory->item_cat_name }}</td>
              <td>{{$item_subcategory->item_subcat_des}}</td>
              {{--  @if ($productTypeEdit)  --}}
                <td class='action'>
                  <button data-toggle="modal" data-id="{{$item_subcategory->id}}" data-name="{{$item_subcategory->item_subcat_name}}" data-category="{{$item_subcategory->item_cat_id}}" data-des="{{$item_subcategory->item_subcat_des}}" data-target="#add" title="edit" class="btn btn-primary btn-edit"><i class="far fa-edit"></i></button>
                </td>
              {{--  @endif  --}}
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
  </div>

  

<script>
    $(document).ready(function () {
        if(!@json($errors->isEmpty())) {
            console.log("erorr");
            $('#add').modal();
        }
    });

        $('#btn-add').click(function (e) { 
            e.preventDefault();
            $('.__error').hide();
            $('#id').val('');
            $('#name').val('');
            $('#description').val('');
            $('#category').val('');
        });
    
        $('.btn-edit').click(function (e) { 
        e.preventDefault();
            $('.__error').hide();
            $('#id').val('');
            $('#name').val('');
            $('#description').val('');
            $('#category').val('');

            var id=$(this).attr('data-id');
            var name=$(this).attr('data-name');
            var des=$(this).attr('data-des'); 
            var cat=$(this).attr('data-category');    
    
            $('#id').val(id);
            $('#name').val(name);
            $('#description').val(des);
            $('#category').val(cat);
            
        });
</script>


@endsection



    
{{--add and update modal start --}}
<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="formModal" aria-hidden="true">
<div class="modal-dialog modal-lg" role="document" >
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="formModal">Item Subcategory</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body">
      <form action="/item-subcategory-add-process"  class="needs-validation" novalidate="" method="post">
        @csrf
              <input type="hidden" name="id" id="id" value="{{old('id')}}">
              <div class="form-group">
                <label>Name</label>
                <input type="text" id="name" name="name" value="{{old('name')}}" class="form-control" required>
                @error('name')<span class="text-danger __error">{{$message}}</span>@enderror
              </div>

              <div class="form-group">
                <label>Select Category</label>
                <select class="form-control" name="item_cat_id" id="category" required>
                    <option value="" disabled selected>Select Category</option>
                    @foreach ($item_categories as $item_category)
                        <option value="{{ $item_category->id }}" {{old('item_cat_id')==$item_category->id?'selected':''}}>{{ $item_category->item_cat_name }}</option>
                    @endforeach
                </select>
                <span class="text-danger">@error('product_cat_id') {{ $message }}@enderror</span>
              </div>
              
              <div class="form-group">
                <label>Description</label>
                <textarea class="form-control" id="description" name="description">{{old('description')}}</textarea>
              </div>
             
             
              <div align="right">
                <button type="reset" class="btn btn-danger">Reset</button>
                <button class="btn btn-success mr-1" type="submit">Submit</button>
              </div>
          
      </form>
    </div>
  </div>
</div>
</div>
{{--add and update modal end --}}
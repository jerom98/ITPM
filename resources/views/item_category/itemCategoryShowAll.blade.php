@extends('layouts.navigation')
@section('item_category', 'active')
@section('content')
<?php 
  $Access=session()->get('Access'); 
 
?>

  <!-- Main Content -->
  <div class="card">                
  <div class="card-header">
    <h4 class="header">Item Category</h4>
  
        <button data-toggle="modal" data-target="#add" id="btn-add" class="btn btn-success">Add</button>
    
  </div>
                  
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-striped table-1">
        <thead>
          <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Description</th>
           
              <th style="text-align: center">Action</th>
           
          </tr>
        </thead>
        
        <tbody>
          @foreach ($item_categories as $item_category)
            <tr>
              <td >{{$item_category->id}}</td>
              <td>{{$item_category->item_cat_name}}</td>
              <td>{{$item_category->item_cat_des}}</td>
              
                <td class='action'>
                  <button data-toggle="modal" data-id="{{$item_category->id}}" 
                  data-name="{{$item_category->item_cat_name}}" data-des="{{$item_category->item_cat_des}}" 
                  data-target="#add" title="edit" class="btn btn-primary btn-edit"><i class="far fa-edit"></i></button>

                  <a  onclick="return confirm('Are you sure you want to delete this raw?');" href="/item-cat-delete-all/{{$item_category->id}}" class="btn btn-icon btn-danger btn-edit"> <i
                                             class="fas fa-trash-alt"></i></a>
                </td>
              
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
  </div>

  
  <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
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
        });
    
        $('.btn-edit').click(function (e) { 
        e.preventDefault();
            $('.__error').hide();
            $('#id').val('');
            $('#name').val('');
            $('#description').val('');

            var id=$(this).attr('data-id');
            var name=$(this).attr('data-name');
            var des=$(this).attr('data-des');    
    
            $('#id').val(id);
            $('#name').val(name);
            $('#description').val(des);
        });
</script>


@endsection



    
{{--add and update modal start --}}
<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="formModal" aria-hidden="true">
<div class="modal-dialog modal-lg" role="document" >
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="formModal">Item Category</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body">
      <form action="/item-category-add-process"  class="needs-validation" novalidate="" method="post">
        @csrf
              <input type="hidden" name="id" id="id" value="{{old('id')}}">
              <div class="form-group">
                <label>Name</label>
                <input type="text" id="name" name="name" value="{{old('name')}}" class="form-control" required>
                @error('name')<span class="text-danger __error">{{$message}}</span>@enderror
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
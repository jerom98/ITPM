@extends('layouts.navigation')
@section('item_brand','active')
@section('content')

<?php 
  $Access=session()->get('Access'); 
  $brandAdd=true;
  $brandEdit=true;
  if (in_array('inventory.brandAdd', $Access)) {
    $brandAdd=true;
  }
  if (in_array('inventory.brandUpdate', $Access)) {
    $brandEdit=true;
  }
?>


<!-- Main Content -->
<div class="card">
    <div class="card-header">
        <h4 class="header id">Item Brand</h4>
        @if ($brandAdd)
            <button data-toggle="modal" data-target="#add" id="btn-add" class="btn btn-success">Add</button>
           <!-- <a href="/brandGet" class="btn btn-success" id="btn-add" data-toggle="modal" data-target="#add">Add</a> -->
        @endif
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-1">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Brand</th>
                        <th>Description</th>
                        @if ($brandEdit)
                            <th class='action'>Action</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    
                    @foreach ($brands as $brand)
                        <tr>
                            <td>{{$brand->id}}</td>
                            <td>{{ $brand->brand_name }}</td>
                            <td>{{ $brand->brand_des }}</td>
                            
                           
                            @if ($brandEdit)
                            <td class='action'>
                                    <button data-toggle="modal" data-id="{{ $brand->id }}"
                                        data-brand="{{ $brand->brand_name }}" data-des="{{ $brand->brand_des }}"
                                        data-target="#add" title="edit" class="btn btn-primary btn-edit"><i
                                            class="far fa-edit"></i></button>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

    
<script>
    $(document).ready(function() {
        if(!@json($errors->isEmpty())) {
            console.log("erorr");
            $('#add').modal();
        }

  

    $('#btn-add').click(function (e) {
        e.preventDefault();
        $('.error').hide(); 
        $('#id').val('');
        $('#name').val('');
        $('#description').val('');
      
    });


    $('.btn-edit').click(function (e) { 
        e.preventDefault();
        console.log("data");
           $('.__error').hide();
           console.log($('#id').val(''));
           console.log($('#name').val(''));
           console.log($('#description').val(''));

            var id=$(this).attr('data-id');
            var name=$(this).attr('data-brand');
            var des=$(this).attr('data-des');    
    
            $('#id').val(id);
            $('#name').val(name);
            $('#description').val(des);
        });
    });
</script>

@endsection




<!-- Edit Product Brand -->
<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Product Brand</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Main Content -->
                <form action="/item-brand-add-process" method="post" class="needs-validation" novalidate="">
                    <div class="card-body form">
                        @csrf
                        <div class="form-group">
                            <input type="hidden" class="form-control" id="id" name="id" value="{{old('id')}}" required>

                            <label>Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{old('name')}}" required>
                            @error('name')<span class="text-danger error">{{ $message }}</span>@enderror
                        </div>

                        <div class="form-group">
                            <label>Description</label>
                            <textarea class="form-control" id="description" name="description">{{old('description')}}</textarea>
                            @error('description')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>

                      
                            
                        

                        <div align="right">
                            <button class="btn btn-danger" type="reset" id="reset">Reset</button>
                            <button class="btn btn-success mr-1" type="submit">Submit</button>
                        </div>
                    </div>
                </form>        
            </div>        
        </div>        
    </div>
</div>

<!-- Edit Product Brand -->


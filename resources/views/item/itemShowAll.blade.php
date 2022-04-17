@extends('layouts.navigation')
@section('item', 'active')
@section('content')
    <?php
    $Access = session()->get('Access');
    $productAdd = true;
    $productEdit = true;
    if (in_array('inventory.productAdd', $Access)) {
        $productAdd = true;
    }
    if (in_array('inventory.productUpdate', $Access)) {
        $productEdit = true;
    }
    ?>

    <!-- Main Content -->
    <div class="card">
        <div class="card-header">
            <h4 class="header">Item</h4>
            {{-- <a href="/productGet" class="btn btn-primary">Add</a> --}}
            @if ($productAdd)
                <button data-toggle="modal" data-target="#add" title="edit" id="btn-add"
                    class="btn btn-success add">Add</button>
            @endif
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped" id="table-1">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Modal</th>
                            <th>Description</th>
                            <th>Product Brand</th>
                            <th>Product category</th>
                            <th>Product Subcategory</th>
                            @if ($productEdit)
                                <th class='action'>Action</th>
                            @endif
                        </tr>
                    </thead>


                    <tbody>
                        @foreach ($items as $item)
                            <tr>
                                <td>{{$item->id}}</td>
                                <td>{{ $item->item_name }}</td>
                                <td>{{ $item->item_code }}</td>
                                <td>{{ $item->item_des }}</td>
                                <td>{{ $item->brand_name }}</td>
                                <td>{{ $item->item_cat_name }}</td>
                                <td>{{ $item->item_subcat_name }}</td>
                                @if ($productEdit)
                                    <td class='action'>

                                    
                                        <button data-toggle="modal" data-id="{{ $item->id }}"
                                            data-name="{{ $item->item_name }}" data-code="{{ $item->item_code }}"
                                            data-des="{{ $item->item_des }}" data-brand="{{ $item->brand_id }}"
                                            data-subcat="{{ $item->subcat_id }}" data-catid="{{ $item->item_cat_id }}"
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
            if (!@json($errors->isEmpty())) {
                $('#add').modal();
            }
        });

        $("#btn-add").click(function(e) {
            $('#id').val('');
            $('#name').val('');
            $('#code').val('');
            $('#description').val('');
            $('#category').val('');
            $('#subcategory').val('');
            $('#brand').val('');

            $('.subcategory_id').hide();
            $('.brand_id').hide();
            $('.error').hide();
        });

        $(".btn-edit").click(function(e) {
            $('#id').val('');
            $('#name').val('');
            $('#code').val('');
            $('#description').val('');
            $('#category').val('');
            $('#subcategory').val('');
            $('#brand').val('');

            $('.subcategory_id').hide();
            $('.brand_id').hide();
            $('.error').hide();

            var id = $(this).attr('data-id');
            var name = $(this).attr('data-name');
            var code = $(this).attr('data-code');
            var des = $(this).attr('data-des');
            var brand = $(this).attr('data-brand');
            var subcat = $(this).attr('data-subcat');
            var catid = $(this).attr('data-catid');

            $('#id').val(id);
            $('#name').val(name);
            $('#code').val(code);
            $('#description').val(des);
            $('#category').val(catid);
            $('#subcategory').val(subcat);
            $('#brand').val(brand);

            $('.subcategory_id_' + catid).show();
            $('.' + subcat).show();
        });

        $('#category').change(function(e) {
            $('#subcategory').val('');
            $('#brand').val('');
            $('.subcategory_id').hide();
            $('.brand_id').hide();
            var cat_id = $(this).val();
            $('.subcategory_id_' + cat_id).show();
        });

        $('#subcategory').change(function(e) {
            $('#brand').val('');
            $('.brand_id').hide();
            var arr = $(this).val();
            $('.' + arr).show();
        });
    </script>

@endsection




{{-- add and update modal start --}}
<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="formModal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formModal">Item</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/item-add-process" class="needs-validation" novalidate="" method="post">
                    @csrf
                    <input type="hidden" class="form-control" value="{{ old('id') }}" name="id" id="id">

                    {{-- first row --}}
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}"
                                required>
                            @error('name')
                                <span class="text-danger error"> {{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label>Model</label>
                            <input type="text" class="form-control" id="code" name="code" value="{{ old('code') }}"
                                required>
                            @error('code')
                                <span class="text-danger error"> {{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    {{-- second row --}}
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>Category</label>
                            <select class="form-control category" name="category" id="category" required>
                                <option value="" disabled selected>Select Category</option>
                                @foreach ($category as $category)
                                    <option class="cat" id="cat{{ $category->id }}"
                                        value="{{ $category->id }}"
                                        {{ old('category') == $category->id ? 'selected' : '' }}>
                                        {{ $category->item_cat_name }}</option>
                                @endforeach
                                @error('category')
                                    <span class="text-danger error"> {{ $message }}</span>
                                @enderror
                            </select>
                        </div>

                        <div class="form-group col-md-4">
                            <label>Subcategory</label>
                            <select class="form-control subcategory" name="subcategory" id="subcategory" required>
                                <option value="" disabled selected>Select Subcategory</option>
                                @foreach ($subcategory as $subCat)
                                    <option class="subcategory_id subcategory_id_{{ $subCat->item_cat_id }}"
                                        value="{{ $subCat->id }}"
                                        {{ old('subcategory') == $subCat->id ? 'selected' : '' }}>
                                        {{ $subCat->item_subcat_name }}</option>
                                @endforeach
                                @error('subcategory')
                                    <span class="text-danger error"> {{ $message }}</span>
                                @enderror
                            </select>
                        </div>

                        <div class="form-group col-md-4">
                            <label>Brand</label>
                            <select class="form-control brand" name="brand" id="brand" required>
                                <option value="" disabled selected>Select Brand</option>
                                @foreach ($brands as $brand)
                                   
                                
                                    <option class="brand"
                                        id="brand{{ $brand->id }}" value="{{ $brand->id }}"
                                        {{ old('brand') == $brand->id ? 'selected' : '' }}>
                                        {{ $brand->brand_name }}</option>
                                @endforeach
                                @error('brand')
                                    <span class="text-danger error"> {{ $message }}</span>
                                @enderror
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label>Description</label>
                            <textarea class="form-control" id="description"
                                name="description">{{ old('description') }}</textarea>
                        </div>
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
{{-- add and update modal end --}}
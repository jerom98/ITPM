@extends('layouts.navigation')
@section('seller_type', 'active')
@section('content')
    <?php
    $Access = session()->get('Access');
    $sellerTypeAdd = true;
    $sellerTypeEdit = true;
    
    if (in_array('inventory.productTypeAddProcess', $Access)) {
        $sellerTypeAdd = true;
    }
    
    if (in_array('inventory.productTypeUpdateProcess', $Access)) {
        $sellerTypeEdit = true;
    }
    ?>

    <!-- Main Content -->
    <div class="card">
        <div class="card-header">
            <h4 class="header">Seller Type</h4>
            @if ($sellerTypeAdd)
                <button data-toggle="modal" data-target="#add" id="btn-add" class="btn btn-success">Add</button>
            @endif
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            {{-- <th>Id</th> --}}
                            <th>Name</th>
                            <th>Description</th>
                            @if ($sellerTypeEdit)
                                <th style="text-align: center">Action</th>
                            @endif
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($seller_types as $seller_type)
                            <tr>
                                {{-- <td >{{$seller_type->id}}</td> --}}
                                <td>{{ $seller_type->seller_type_name }}</td>
                                <td>{{ $seller_type->seller_type_des }}</td>
                                @if ($sellerTypeEdit)
                                    <td class='action'>
                                        <button data-toggle="modal" data-id="{{ $seller_type->id }}"
                                            data-name="{{ $seller_type->seller_type_name }}"
                                            data-des="{{ $seller_type->seller_type_des }}" data-target="#add" title="edit"
                                            class="btn btn-primary btn-edit"><i class="far fa-edit"></i></button>
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
                console.log("erorr");
                $('#add').modal();
            }
        });

        $('#btn-add').click(function(e) {
            e.preventDefault();
            $('.error').hide();
            $('#id').val('');
            $('#name').val('');
            $('#description').val('');
        });

        $('.btn-edit').click(function(e) {
            e.preventDefault();
            $('.error').hide();
            $('#id').val('');
            $('#name').val('');
            $('#description').val('');

            var id = $(this).attr('data-id');
            var name = $(this).attr('data-name');
            var des = $(this).attr('data-des');

            $('#id').val(id);
            $('#name').val(name);
            $('#description').val(des);
        });
    </script>

@endsection




{{-- add and update modal start --}}
<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="formModal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formModal">Seller Type</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/seller-type-add-process" class="needs-validation" novalidate="" method="post">
                    @csrf
                    <input type="hidden" name="id" id="id" value="{{ old('id') }}">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" class="form-control" required>
                        @error('name')
                                <span class="text-danger error"> {{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control" id="description"
                            name="description">{{ old('description') }}</textarea>
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
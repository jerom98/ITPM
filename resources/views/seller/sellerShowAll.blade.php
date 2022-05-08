@extends('layouts.navigation')
@section('seller', 'active')
@section('content')
    <?php
    $Access = session()->get('Access');
   
    ?>

    <!-- Main Content -->
    <div class="card">
        <div class="card-header">
            <h4 class="header">Seller</h4>
          
                {{-- <a href="/seller-add" class="btn btn-success">Add</a> --}}
                <button class="btn btn-success" data-toggle="modal" data-target="#add" id="btn-add">Add</button>
           
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-1">
                    <thead>
                        <tr>
                            {{-- <th>Id</th> --}}
                            <th>Name</th>
                            <th>Register No</th>
                            <th>Address</th>
                            <th>Office No</th>
                            <th>Mobile No</th>
                            <th>Seller Type</th>
                           
                                <th class="action">Action</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sellers as $seller)
                            <tr>
                                {{-- <td >{{$seller->id}}</td> --}}
                                <td>{{ $seller->seller_name }}</td>
                                <td>{{ $seller->seller_reg_no }}</td>
                                <td>{{ $seller->seller_address }}</td>
                                <td>{{ $seller->contact_no }}</td>
                                <td>{{ $seller->mobile_no }}</td>
                                <td>{{ $seller->seller_type_name }}</td>
                               
                                    <td class="action">

                                                <button class="btn btn-info btn-view" data-toggle="modal" title="View"
                                                data-target="#add" data-id="{{$seller->id}}" data-name="{{$seller->seller_name}}" data-reg_no="{{$seller->seller_reg_no}}"
                                                data-address="{{$seller->seller_address}}" data-contactno="{{$seller->contact_no}}" 
                                                data-mobileno="{{$seller->mobile_no}}" data-sellertypeid="{{$seller->seller_type_id}}"
                                                data-img_1="{{$seller->seller_img_1}}" data-img_2="{{$seller->seller_img_2}}" data-img_3="{{$seller->seller_img_3}}"><i class="far fa-eye"></i></button>
                                       
                                       
                                            <button class="btn btn-primary btn-edit" data-toggle="modal" title="Edit"
                                                data-target="#add" data-id="{{$seller->id}}" data-name="{{$seller->seller_name}}" data-reg_no="{{$seller->seller_reg_no}}"
                                                data-address="{{$seller->seller_address}}" data-contactno="{{$seller->contact_no}}" 
                                                data-mobileno="{{$seller->mobile_no}}" data-sellertypeid="{{$seller->seller_type_id}}"
                                                data-img_1="{{$seller->seller_img_1}}" data-img_2="{{$seller->seller_img_2}}" data-img_3="{{$seller->seller_img_3}}"><i class="far fa-edit"></i></button>
                                       

                                        <a href="/seller-delete-all/{{$seller->id}}" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>
                                    </td>
                                
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        // get errors open modal
        $(document).ready(function() {
            if (!@json($errors->isEmpty())) {
                console.log("erorr");
                $('#add').modal();

                var old_img_1=$('#old_img_1').val();
                var old_img_2=$('#old_img_2').val();
                var old_img_3=$('#old_img_3').val();

                // all files extension get
            var extension_1=old_img_1.substring(old_img_1.indexOf('.') + 1);
            var extension_2=old_img_2.substring(old_img_2.indexOf('.') + 1);
            var extension_3=old_img_3.substring(old_img_3.indexOf('.') + 1);

            // file or image 1 append
            if (extension_1=="pdf" || extension_1=="doc") {
                var img1='<a href="/inventory_seller/'+old_img_1+'" target="_blank" style="width: 100px; height:100px; border:solid 1px white; border-radius:15px;"><b>View '+extension_1+' </b></a>';
                $('#img-1').append(img1);
            }
            if (extension_1=="png" || extension_1=="gif" || extension_1=="jpeg" || extension_1=="jpg") {
                var img1='<a href="/inventory_seller/'+old_img_1+'" target="_blank"><img src="/inventory_seller/'+old_img_1+'" class="css-class" alt="Null" style="width: 100px; height:100px; border:solid 1px white; border-radius:15px;"></a>';
                $('#img-1').append(img1);
            }

            // file or image 2 append
            if (extension_2=="pdf" || extension_2=="doc") {
                var img2='<a href="/inventory_seller/'+old_img_2+'" target="_blank" style="width: 100px; height:100px; border:solid 1px white; border-radius:15px;"><b>View '+extension_2+' </b></a>';
                $('#img-2').append(img2);
            }
            if (extension_2=="png" || extension_2=="gif" || extension_2=="jpeg" || extension_2=="jpg") {
                var img2='<a href="/inventory_seller/'+old_img_2+'" target="_blank"><img src="/inventory_seller/'+old_img_2+'" class="css-class" alt="Null" style="width: 100px; height:100px; border:solid 1px white; border-radius:15px;"></a>';
                $('#img-2').append(img2);
            }

            // file or image 3 append
            if (extension_3=="pdf" || extension_3=="doc") {
                var img3='<a href="/inventory_seller/'+old_img_3+'" target="_blank" style="width: 100px; height:100px; border:solid 1px white; border-radius:15px;"><b>View '+extension_3+' </b></a>';
                $('#img-3').append(img3);
            }
            if (extension_3=="png" || extension_3=="gif" || extension_3=="jpeg" || extension_3=="jpg") {
                var img3='<a href="/inventory_seller/'+old_img_3+'" target="_blank"><img src="/inventory_seller/'+old_img_3+'" class="css-class" alt="Null" style="width: 100px; height:100px; border:solid 1px white; border-radius:15px;"></a>';
                $('#img-3').append(img3);
            }

            }
        });

        $('#btn-add').click(function (e) { 
            $(".img-path").css('all','unset');
            $('.images').show();
            $('.btns').show();

            $('#id').val('');
            $('#name').val('');
            $('#reg_no').val('');
            $('#seller_type_id').val('');
            $('#mobile_no').val('');
            $('#office_no').val('');
            $('#address').val('');
            $('#old_img_1').val('');
            $('#old_img_2').val('');
            $('#old_img_3').val('');
            $('#img-1').html('');
            $('#img-2').html('');
            $('#img-3').html('');
            $('.error').hide();

            $('#id').attr("readonly",false);
            $('#name').attr("readonly",false);
            $('#reg_no').attr("readonly",false);
            $('#seller_type_id').attr("readonly",false);
            $('#mobile_no').attr("readonly",false);
            $('#office_no').attr("readonly",false);
            $('#address').attr("readonly",false);
        });//btn add end

        $('.btn-edit').click(function (e) {
            $('.images').show();
            $('.btns').show();
            $(".img-path").show();            

            // everyone cleared
            $('#id').val('');
            $('#name').val('');
            $('#reg_no').val('');
            $('#seller_type_id').val('');
            $('#mobile_no').val('');
            $('#office_no').val('');
            $('#address').val('');
            $('#old_img_1').val('');
            $('#old_img_2').val('');
            $('#old_img_3').val('');
            $('#img-1').html('');
            $('#img-2').html('');
            $('#img-3').html('');
            $('.error').hide();

            // value get
            var id = $(this).attr('data-id');
            var name = $(this).attr('data-name');
            var reg_no = $(this).attr('data-reg_no');
            var type=$(this).attr('data-sellertypeid');
            var mobile_no = $(this).attr('data-mobileno');
            var contact_no = $(this).attr('data-contactno');
            var address = $(this).attr('data-address');
            var img_1 = $(this).attr('data-img_1');
            var img_2 = $(this).attr('data-img_2');
            var img_3 = $(this).attr('data-img_3');

            $('#id').attr("readonly",false);
            $('#name').attr("readonly",false);
            $('#reg_no').attr("readonly",false);
            $('#seller_type_id').attr("readonly",false);
            $('#mobile_no').attr("readonly",false);
            $('#office_no').attr("readonly",false);
            $('#address').attr("readonly",false);

            // value set 
            $('#id').val(id);
            $('#name').val(name);
            $('#reg_no').val(reg_no);
            $('#seller_type_id').val(type);
            $('#mobile_no').val(mobile_no);
            $('#office_no').val(contact_no);
            $('#address').val(address);

            // all files extension get
            var extension_1=img_1.substring(img_1.indexOf('.') + 1);
            var extension_2=img_2.substring(img_2.indexOf('.') + 1);
            var extension_3=img_3.substring(img_3.indexOf('.') + 1);

            // file or image 1 append
            if (extension_1=="pdf" || extension_1=="doc") {
                var img1='<a href="/inventory_seller/'+img_1+'" target="_blank" style="width: 100px; height:100px; border:solid 1px white; border-radius:15px;"><b>View '+extension_1+' </b></a>';
                $('#img-1').append(img1);
            }
            if (extension_1=="png" || extension_1=="gif" || extension_1=="jpeg" || extension_1=="jpg") {
                var img1='<a href="/inventory_seller/'+img_1+'" target="_blank"><img src="/inventory_seller/'+img_1+'" class="css-class" alt="Null" style="width: 100px; height:100px; border:solid 1px white; border-radius:15px;"></a>';
                $('#img-1').append(img1);
            }

            // file or image 2 append
            if (extension_2=="pdf" || extension_2=="doc") {
                var img2='<a href="/inventory_seller/'+img_2+'" target="_blank" style="width: 100px; height:100px; border:solid 1px white; border-radius:15px;"><b>View '+extension_2+' </b></a>';
                $('#img-2').append(img2);
            }
            if (extension_2=="png" || extension_2=="gif" || extension_2=="jpeg" || extension_2=="jpg") {
                var img2='<a href="/inventory_seller/'+img_2+'" target="_blank"><img src="/inventory_seller/'+img_2+'" class="css-class" alt="Null" style="width: 100px; height:100px; border:solid 1px white; border-radius:15px;"></a>';
                $('#img-2').append(img2);
            }

            // file or image 3 append
            if (extension_3=="pdf" || extension_3=="doc") {
                var img3='<a href="/inventory_seller/'+img_3+'" target="_blank" style="width: 100px; height:100px; border:solid 1px white; border-radius:15px;"><b>View '+extension_3+' </b></a>';
                $('#img-3').append(img3);
            }
            if (extension_3=="png" || extension_3=="gif" || extension_3=="jpeg" || extension_3=="jpg") {
                var img3='<a href="/inventory_seller/'+img_3+'" target="_blank"><img src="/inventory_seller/'+img_3+'" class="css-class" alt="Null" style="width: 100px; height:100px; border:solid 1px white; border-radius:15px;"></a>';
                $('#img-3').append(img3);
            }

            // set file name to hidden text box beacause error vantha modal la show panna
            $('#old_img_1').val(img_1);
            $('#old_img_2').val(img_2);
            $('#old_img_3').val(img_3);
        
        });//btn edit end

        $('.btn-view').click(function (e) { 

            // everyone cleared
            $('#id').val('');
            $('#name').val('');
            $('#reg_no').val('');
            $('#seller_type_id').val('');
            $('#mobile_no').val('');
            $('#office_no').val('');
            $('#address').val('');
            $('#old_img_1').val('');
            $('#old_img_2').val('');
            $('#old_img_3').val('');
            $('#img-1').html('');
            $('#img-2').html('');
            $('#img-3').html('');
            $('.error').hide();
            $('.images').hide();
            $('.btns').hide();

            // value get
            var id = $(this).attr('data-id');
            var name = $(this).attr('data-name');
            var reg_no = $(this).attr('data-reg_no');
            var type=$(this).attr('data-sellertypeid');
            var mobile_no = $(this).attr('data-mobileno');
            var contact_no = $(this).attr('data-contactno');
            var address = $(this).attr('data-address');
            var img_1 = $(this).attr('data-img_1');
            var img_2 = $(this).attr('data-img_2');
            var img_3 = $(this).attr('data-img_3');
            
            // value set 
            $('#id').val(id);
            $('#name').val(name);
            $('#reg_no').val(reg_no);
            $('#seller_type_id').val(type);
            $('#mobile_no').val(mobile_no);
            $('#office_no').val(contact_no);
            $('#address').val(address);

            $('#id').attr("readonly",true);
            $('#name').attr("readonly",true);
            $('#reg_no').attr("readonly",true);
            $('#seller_type_id').attr("readonly",true);
            $('#mobile_no').attr("readonly",true);
            $('#office_no').attr("readonly",true);
            $('#address').attr("readonly",true);

            // all files extension get
            var extension_1=img_1.substring(img_1.indexOf('.') + 1);
            var extension_2=img_2.substring(img_2.indexOf('.') + 1);
            var extension_3=img_3.substring(img_3.indexOf('.') + 1);
            
            // file or image 1 append
            if (extension_1=="pdf" || extension_1=="doc") {
                var img1='<a href="/inventory_seller/'+img_1+'" target="_blank" style="width: 100px; height:100px; border:solid 1px white; border-radius:15px;"><b>View '+extension_1+' </b></a>';
                $('#img-1').append(img1);
            }
            if (extension_1=="png" || extension_1=="gif" || extension_1=="jpeg" || extension_1=="jpg") {
                var img1='<a href="/inventory_seller/'+img_1+'" target="_blank"><img src="/inventory_seller/'+img_1+'" class="css-class" alt="Null" style="width: 100px; height:100px; border:solid 1px white; border-radius:15px;"></a>';
                $('#img-1').append(img1);
            }

            // file or image 2 append
            if (extension_2=="pdf" || extension_2=="doc") {
                var img2='<a href="/inventory_seller/'+img_2+'" target="_blank" style="width: 100px; height:100px; border:solid 1px white; border-radius:15px;"><b>View '+extension_2+' </b></a>';
                $('#img-2').append(img2);
            }
            if (extension_2=="png" || extension_2=="gif" || extension_2=="jpeg" || extension_2=="jpg") {
                console.log(extension_2+" : imgae 2");
                var img2='<a href="/inventory_seller/'+img_2+'" target="_blank"><img src="/inventory_seller/'+img_2+'" class="css-class" alt="Null" style="width: 100px; height:100px; border:solid 1px white; border-radius:15px;"></a>';
                $('#img-2').append(img2);
            }

            // file or image 3 append
            if (extension_3=="pdf" || extension_3=="doc") {
                var img3='<a href="/inventory_seller/'+img_3+'" target="_blank" style="width: 100px; height:100px; border:solid 1px white; border-radius:15px;"><b>View '+extension_3+' </b></a>';
                $('#img-3').append(img3);
            }
            if (extension_3=="png" || extension_3=="gif" || extension_3=="jpeg" || extension_3=="jpg") {
                var img3='<a href="/inventory_seller/'+img_3+'" target="_blank"><img src="/inventory_seller/'+img_3+'" class="css-class" alt="Null" style="width: 100px; height:100px; border:solid 1px white; border-radius:15px;"></a>';
                $('#img-3').append(img3);
            }
        });
        
    </script>
@endsection







{{--add and update modal start --}}
<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="formModal" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formModal">Seller</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/seller-add-process" class="needs-validation" novalidate="" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" id="id" value="{{old('id')}}">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>Name</label>
                            <input type="text" id="name" name="name" value="{{ old('name') }}" class="form-control"
                                pattern="^[a-zA-Z.\\-\\/+=@_ ]*$" required="">
                            @error('name')
                                <span class="text-danger error"> {{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label>Register No</label>
                            <input type="text" id="reg_no" name="reg_no" value="{{ old('reg_no') }}"
                                class="form-control">
                            @error('reg_no')
                                <span class="text-danger error"> {{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label>Seller Type</label>
                            <select class="form-control" name="seller_type_id" id="seller_type_id" required>
                                <option value="" disabled selected>Select Seller Type</option>
                                @foreach ($seller_types as $seller_type)
                                    <option value="{{ $seller_type->id }}"
                                        {{ $seller_type->id == old('seller_type_id') ? 'selected' : '' }}>
                                        {{ $seller_type->seller_type_name }}</option>
                                @endforeach
                            </select>
                            @error('seller_type_id')
                                <span class="text-danger error"> {{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    {{-- second row --}}
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label>Mobile No</label>
                            <input type="text" id="mobile_no" name="mobile_no" value="{{ old('mobile_no') }}"
                                pattern="^\d{2}\d{3}\d{4}$" placeholder="771234567" class="form-control">
                            @error('mobile_no')
                                <span class="text-danger error"> {{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-3">
                            <label>Office Contact No</label>
                            <input type="text" id="office_no" name="office_no" value="{{ old('office_no') }}"
                                pattern="^\d{2}\d{3}\d{4}$" placeholder="212261234" class="form-control">
                            @error('office_no')
                                <span class="text-danger error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label>Address</label>
                            <textarea class="form-control" id="address" name="address"
                                required>{{ old('address') }}</textarea>
                        </div>
                    </div>

                    {{-- third row --}}
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>File 1</label><br>
                            <input type="text" name="old_img_1" id="old_img_1" value="{{old('old_img_1')}}" hidden>
                            <div id="img-1" class=".img-path"></div>
                            <input type="file" class="form-control images" id="image" name="image_1">
                            <span id="er_img_3" class="images">(Max 2MB)<br></span>
                            @error('image_1')
                                <span class="text-danger error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label>File 2</label><br>
                            <input type="text" name="old_img_2" id="old_img_2" value="{{old('old_img_2')}}" hidden>
                            <div id="img-2" class=".img-path"></div>
                            <input type="file" class="form-control images" id="image" name="image_2">
                            <span id="er_img_3" class="images">(Max 2MB)<br></span>
                            @error('image_2')
                                <span class="text-danger error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label>File 3</label><br>
                            <input type="text" name="old_img_3" id="old_img_3" value="{{old('old_img_3')}}" hidden>
                            <div id="img-3" class=".img-path"></div>
                            <input type="file" class="form-control images" id="image" name="image_3">
                            <span id="er_img_3" class="images">(Max 2MB)<br></span>
                            @error('image_3')
                                <span class="text-danger error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div align="right">
                        <button type="reset" class="btn btn-danger btns">Reset</button>
                        <button class="btn btn-success mr-1 btns" type="submit">Submit</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
{{--add and update modal end --}}
@extends('admin.include.layout')
@section('title','Insert a product')
@section('content')
@include('admin.include.report')

<form method="POST" enctype="multipart/form-data" action="{{ route('admin.products.store') }}">

    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4>INSERT A PRODUCT</h4>
            </div>
            <div class="card-body">
                <div class="error_tmp">

                </div>
                <div class="default-tab">
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Infomation</a>
                            <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Images</a>
                            <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Sizes</a>
                        </div>
                    </nav>
                    <div class="tab-content pl-3 pt-2" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                            <div class="row form-group">
                                <div class="col-md-1"><label for="text-input" class=" form-control-label">Name:</label></div>
                                <div class="col-md-10"><input type="text" required="required" id="text-input" name="name" class="form-control"></div>
                                <div class="col-md-1">(<span style="color:red">*</span>)</div>
                            </div>

                            <div class="row form-group">
                                <div class="col col-md-1"><label for="select" class=" form-control-label">Category:</label></div>
                                <div class="col-12 col-md-10">
                                  <select name="cate_id" required="required" id="select" class="form-control">
                                    <option value="0">--None--</option>
                                    <?php cate_parent($cates); ?>
                                </select>
                            </div>
                            <div class="col-md-1">(<span style="color:red">*</span>)</div>
                        </div>


                        <div class="row form-group">
                            <div class="col-md-1"><label for="text-input" class=" form-control-label">Price:</label></div>
                            <div class="col-md-10"><input type="text" required="required" onkeyup="formatNumBerKeyUp(this)" id="text-input" name="price" class="form-control"></div>
                            <div class="col-md-1">(<span style="color:red">*</span>)</div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-1"><label for="text-input" class=" form-control-label">Discount Price:</label></div>
                            <div class="col-md-1"><label class="switch switch-text switch-success switch-pill"><input type="checkbox" class="switch-input" id="discount" checked="true"> <span data-on="On" data-off="Off" class="switch-label"></span> <span class="switch-handle"></span></label></div>
                            <div class="col-md-9">
                                <input placeholder=" Discount price...." onkeyup="formatNumBerKeyUp(this)"  type="text" name="reduce"  id="discount-input" name="reduce" class="form-control">
                            </div>

                        </div>

                        <div class="row form-group">
                            <div class="col-md-1"><label for="text-input" class=" form-control-label">Introduce:</label></div>
                            <div class="col-md-10"><input type="text" required="required" id="text-input" name="intro" class="form-control"></div>
                            <div class="col-md-1">(<span style="color:red">*</span>)</div>
                        </div>

                        <div class="row form-group">
                            <div class="col col-md-1"><label for="textarea-input" class=" form-control-label">Description</label></div>
                            <div class="col-12 col-md-10"><textarea  name="description" id="editor2" required="required" rows="9" placeholder="Content..." class="form-control">{{Request::old('description')}}</textarea>
                            </div>
                            <div class="col-md-1">(<span style="color:red">*</span>)</div>
                        </div>




                    </div>
                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                        <div class="row form-group">
                            <div class="col-md-1"><label for="text-input" class=" form-control-label">Image:</label></div>
                            <div class="col-md-11"><input type="file" required="required" id="image" name="image" class="form-control"></div>
                        </div>

                        <a href="javascript::void(0)" class="btn btn-secondary" id="add-sub-image"><i class="fa fa-plus"></i> Add sub-image</a>
                        <hr>
                        <br>
                        <div class="sub-image">

                        </div>
                        

                    </div>
                    <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                        <a href="javascript::void(0)" class="btn btn-secondary" id="add-sub-size"><i class="fa fa-plus"></i> Add sub size</a>
                        <br><br>
                        <div id="add-size">
                            <div class="row form-group">
                                <div class="col-md-1"><label for="text-input" class=" form-control-label">Size:</label></div>
                                <div class="col-md-4">
                                    <select name="size[]" class="form-control" id="select">
                                        <option value="XS">XS</option>
                                        <option value="S">S</option>
                                        <option value="M">M</option>
                                        <option value="L">L</option>
                                        <option value="XL">XL</option>
                                        <option value="2XL">2XL</option>
                                        <option value="3XL">3XL</option>
                                    </select>
                                </div>
                                <div class="col-md-1"><label for="text-input" class=" form-control-label">Quantity:</label></div>
                                <div class="col-md-4"><input type="text" required="required" onkeyup="formatNumBerKeyUp(this)" id="text-input" name="quantity[]" class="form-control"></div>
                                <button type="button" class="close close-add-size" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>


                        </div>
                        

                    </div>
                </div>

            </div>

            <div style="text-align: center;">
                <button class="btn btn-info" name="insert_pro" type="button" id="insert"> <i class="fa fa-thumbs-o-up"></i> Insert</button>
                <button class="btn btn-danger" onclick="window.location= '{{ route('admin.products.list') }}'" type="button" value="Cancel"><i class="fa fa-reply"></i> Back</button>
            </div>
        </div>

    </div>
    <!-- /# column -->

</form>
<script type="text/javascript" >

    $('#add-sub-image').on('click',function(){
        var html = '';
        html += '<div class="row form-group">';
        html += '<div class="col-md-1"><label for="text-input" class=" form-control-label">Sub-Image:</label></div>';
        html += '<div class="col-md-10"><input type="file" id="text-input" name="sub_image[]" class="form-control"></div>';
        html += '<button type="button" class="close close-add-image" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'
        html += '</div>';
        $('.sub-image').append(html);
    });

    $('#discount').on('click',function(){
        if($('#discount').is(':checked')){
            $('input[name=reduce]').show();

        } else {
            $('input[name=reduce]').val('');
            $('input[name=reduce]').hide();
        }
    });

    $('#add-sub-size').on('click',function(){
        var html = '';
        html += ' <div class="row form-group">';
        html += '<div class="col-md-1"><label for="text-input" class=" form-control-label">Size:</label></div>';
        html += ' <div class="col-md-4">';
        html += ' <select name="size[]" class="form-control" id="select">';
        html += '<option value="XS">XS</option>';
        html += '<option value="S">S</option>';
        html += '<option value="M">M</option>';
        html += '<option value="L">L</option>';
        html += '<option value="XL">XL</option>';
        html += '<option value="2XL">2XL</option>';
        html += '<option value="3XL">3XL</option>';
        html += '</select>';
        html += ' </div>';
        html += '<div class="col-md-1"><label for="text-input" class=" form-control-label">Quantity:</label></div>';
        html += '<div class="col-md-4"><input type="text" required="required" id="text-input" onkeyup="formatNumBerKeyUp(this)" name="quantity[]" class="form-control"></div>';
        html += ' <button type="button" class="close close-add-size" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'
        html += ' </div>';
        $('#add-size').append(html);
    })

    $(document).on('click', '.close-add-size', function () {
        $(this).parent().remove();
    })
    $(document).on('click', '.close-add-image', function () {
        $(this).parent().remove();
    })

    $('#insert').click(function(){
        var html = '';
        var flag = true;
        html += ' <ul  id="error" class="alert alert-danger">';

        if($('input[name=name]').val() == "") {
            html += '<li>Name is required</li>';
            flag = false;
        }
        if($('input[name=price]').val() == ""){
            html += '<li>Price is required</li>';
            flag = false;
        }
        if($('input[name=reduce]').val() == "" && $('#discount').is(':checked')){
            html += '<li>Discount price is required</li>';
            flag = false;
        }
        if(parseFloat($('input[name=reduce]').val()) > parseFloat($('input[name=price]').val()) && $('#discount').is(':checked')){
            html += '<li>Discount price must be smaller than price </li>';
            flag = false;
        }
        if($('input[name=intro]').val() == ""){
            html += '<li>Intro is required</li>';
            flag = false;
        }
        var file_data = $('#image').prop('files')[0];
        if(file_data == null) {
         html += '<li>Image is required</li>';
         flag = false;
     }
     var quantity = 0;
     $('input[name="quantity[]"]').each(function(i,n){
         if($(n).val() == "") {
            html += '<li>Please fill all quantity</li>';
            flag = false;
            return false;

        }
    })
     var check ;
     var len = $('select[name="size[]"').length;
     $('select[name="size[]"').each(function(i,n){
        $('select[name="size[]"').each(function(j,m){
            if($(n).val() == $(m).val() && len > 1 && i != j) {
                html += '<li>Size is unique</li>';
                flag = false;
                check = false; 

            }
            if(check == false)
            {
                return check;
            }
        });
        if(check == false) {
            return check;
        }

    }) ;

     html += '</ul>';
     console.log(flag);  
     if(flag) {
        $('button[name="insert_pro"]').attr("type", "submit");
    } else {
        $('.error_tmp').html(html);
    }
})



</script>
<script> CKEDITOR.replace( 'editor2', {
    filebrowserBrowseUrl: '{{ asset('/public/js/ckfinder/ckfinder.html') }}',
    filebrowserImageBrowseUrl: '{{ asset('/public/js/ckfinder/ckfinder.html?type=Images') }}',
    filebrowserFlashBrowseUrl: '{{ asset('/public/js/ckfinder/ckfinder.html?type=Flash') }}',
    filebrowserUploadUrl: '{{ asset('/public/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}',
    filebrowserImageUploadUrl: '{{ asset('/public/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images') }}',
    filebrowserFlashUploadUrl: '{{ asset('/public/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash') }}'
} ); </script>

@endsection
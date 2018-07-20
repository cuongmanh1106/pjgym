@extends('frontend.include.layout')
@section('title','Home')
@section('content')
<div class="container" style="margin-top: 125px">
    <div class="single">
        <div class="col-md-9 top-in-single">
            <div class="col-md-5 single-top">   
                <ul id="etalage">
                    <li>
                        <a href="optionallink.html">
                            <img class="etalage_thumb_image img-responsive" src="{{asset('/public/admin/images/')}}/{{ $product->image }}" alt="" >
                            <img class="etalage_source_image img-responsive" src="{{asset('/public/admin/images/')}}/{{ $product->image }}" alt="" >
                        </a>
                    </li>

                    <?php
                    $sub_image = json_decode($product->sub_image);
                    ?>
                    @foreach($sub_image as $s)
                    <li>
                        <img class="etalage_thumb_image img-responsive" src="{{asset('/public/admin/images/')}}/{{ $s }}" alt="" >
                        <img class="etalage_source_image img-responsive" src="{{asset('/public/admin/images/')}}/{{ $s }}" alt="" >
                    </li>
                    @endforeach
                    
                </ul>

            </div>  
            <div class="col-md-7 single-top-in">
                <div class="single-para">
                    <h4>{{ $product->name }}</h4>
                    <?php
                    $description = str_replace('<p>','',$product->description);
                    $description = str_replace('</p>','',$description);
                    $description = str_replace('<br />','',$description);
                    ?>
                    <p>{{ $description }}</p>
                    <div class="star">
                        <ul>
                            <li><i> </i></li>
                            <li><i> </i></li>
                            <li><i> </i></li>
                            <li><i> </i></li>
                            <li><i> </i></li>
                        </ul>
                        <div class="review">
                            <a href="#"> {{ $product->view }} views </a>/
                            <a href="#">  Write a review</a>
                        </div>
                        <div class="clearfix"> </div>
                    </div>

                    <label  class="add-to">${{  number_format($product->price, 2) }}</label>
                    <?php 
                    $sizes = json_decode($product->size);

                    ?>
                    <div class="available">
                        <h6>Available Options :</h6>
                        <ul>

                            <li>Size: <select name="size" class="form-group">
                                @foreach($sizes as $k=>$v)
                                <option value="{{ $k }}">{{$k}}</option>
                                @endforeach
                                
                            </select></li>
                            <li>Quantity: <input type="number" class="form-group" value="1" name="qty"></li>

                        </ul>
                    </div>

                    <a href="javascript:void(0)" data-index="{{ $product->id }}" class="cart add_cart "> <i class="fa fa-shopping-cart"></i> Add to cart</a>

                </div>
            </div>
            <div class="clearfix"> </div>
            <h5><b id="total_cmt">{{ count($all_comment) }}</b> comments</h5>
            <input type="hidden" name="total_comments" value="{{count($all_comment)}}">
            <hr style="border:1px solid #FFFFFF">

            <div class="row">
                <div class="col-md-1"><img src="{{asset('/public/admin/images')}}/{{ (Auth::user()!=null && Auth::user()->image!='')?Auth::user()->image:'us.png' }}" width="60px"></div>
                <div class="col-md-11">
                    <textarea name="cmt" class="form-control" placeholder=" Your Comment..."></textarea>
                    <div style="width: 100%; text-align: right; background: #fff; border-radius: 4px">
                        <a style="text-align: right;" id="add_cmt" class="btn btn-success  {{ (Auth::user() == null)?'disabled':''}}">Post</a>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="comment">
                @foreach($comments as $cmt) <!--Danh sách comment-->
                <?php
                $cus = DB::table('users')->where('id',$cmt->user_id)->first();
                
                $count_like = count(DB::table('like')->where('comment_id',$cmt->id)->get());

                ?>
                @if(Auth::user()!=null) <!--Thuc hien nhung chuc nang khi dang nhap-->
                <?php
                $like = count(DB::table('like')->where('user_id',Auth::user()->id)->where('comment_id',$cmt->id)->get());
                ?>
                <div class="row" style="margin-top: 40px">
                    <input type="hidden" name="id_cmt" value="{{ $cmt->id }}">
                    <div class="col-md-1"><img src="{{asset('/public/admin/images')}}/{{ ($cus->image!='')?$cus->image:'us.png' }}" width="60px"></div>
                    <div class="col-md-11">
                        <h4><b>{{ $cus->last_name }}</b></h4>
                        <p>{{ $cmt->comment }}</p>
                        <div>
                            @if($like == 0) <!--Chưa like-->
                            <a href="javascript:void(0)" class="like" data-index="{{ $cmt->id }}" style="color:blue"> Like </a>-
                            @else
                            <a href="javascript:void(0)" class="dislike" data-index="{{ $cmt->id }}" style="color:red"> Dislike </a>-
                            @endif <!--đã like-->
                            <a href="javascript:void(0)" class="rep" style="color:blue"> Reply </a>-
                            <span> <i style="color:blue" class="fa fa-thumbs-o-up"></i><span class="count_like" data-index="{{ $count_like }}"> {{ ($count_like==0)?'':$count_like }}</span></span>-
                            <span> {{ \Carbon\Carbon::createFromTimeStamp(strtotime($cmt->created_at))->diffForHumans()}} </span>
                        </div>
                    </div>

                    <div class="clearfix"></div>
                    <div class="sub-comment">
                        <?php
                        $sub_comment = DB::table('comments')->where('parent',$cmt->id)->where('pro_id',$product->id)->orderBy('created_at','desc')->get();

                        ?>
                        @foreach($sub_comment as $s) <!-- load sub comment -->
                        <?php
                        $sub_cus = DB::table('users')->where('id',$s->user_id)->first();
                        $count_sub_like = count(DB::table('like')->where('comment_id',$s->id)->get()); //Tổng like của sub_comment
                        $sub_like = count(DB::table('like')->where('user_id',Auth::user()->id)->where('comment_id',$s->id)->get()); // = 1 đã like | 0 chưa like
                        ?>


                        <div style="padding:  30px 0px 30px 60px" >
                            <div class="col-md-1"><img src="{{asset('/public/admin/images')}}/{{ ($sub_cus->image!='')?$sub_cus->image:'us.png' }}" width="60px"></div>
                            <div class="col-md-11">
                                <h4><b>{{ $sub_cus->last_name  }}</b></h4>
                                <p>{{ $s->comment}}</p>
                                <div>

                                    @if($sub_like == 0)
                                    <a href="javascript:void(0)" class="like" data-index="{{ $s->id }}" style="color:blue"> Like </a>-
                                    @else
                                    <a href="javascript:void(0)" class="dislike" data-index="{{ $s->id }}" style="color:red"> Dislike </a>-
                                    @endif

                                    <a href="javascript:void(0)" class="sub_rep" style="color:blue"> Reply </a>-
                                    <input type="hidden" value="{{ $sub_cus->last_name }}" name="sub_user">
                                    <span> <i style="color:blue" class="fa fa-thumbs-o-up"></i> <span class="count_like" data-index="{{ $count_sub_like }}"> {{ ($count_sub_like==0)?'':$count_sub_like }}</span></span>-
                                    <span> {{ \Carbon\Carbon::createFromTimeStamp(strtotime($s->created_at))->diffForHumans()}} </span>
                                </div>
                            </div>
                        </div>

                        <div class="clearfix"></div>
                        @endforeach
                        <div class="add_sub_comment hidden" style="padding:  30px 0px 30px 60px"> <!-- form cho add sub comment -->
                            <div class="col-md-1"><img src="{{asset('/public/admin/images')}}/{{ (Auth::user()!=null && Auth::user()->image!='')?Auth::user()->image:'us.png' }}" width="60px"></div>
                            <div class="col-md-11">
                                <textarea name="sub_cmt" class="form-control" placeholder=" Your Comment..."></textarea>
                                <div style="width: 100%; text-align: right; background: #fff; border-radius: 4px">
                                    <a href="javascript:void()" style="text-align: right;" class="add_sub_cmt btn btn-success  {{ (Auth::user() == null)?'disabled':''}}">Post</a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                
                <div class="clearfix"></div>
                @else <!--Thuc hien nhung chuc nang khi chua dang nhap-->
                <div class="row" style="margin-top: 40px">
                    <input type="hidden" name="id_cmt" value="{{ $cmt->id }}">
                    <div class="col-md-1"><img src="{{asset('/public/admin/images')}}/{{ ($cus->image!='')?$cus->image:'us.png' }}" width="60px"></div>
                    <div class="col-md-11">
                        <h4><b>{{ $cus->last_name }}</b></h4>
                        <p>{{ $cmt->comment }}</p>
                        <div>

                            <a href="javascript:void(0)" class="like" data-index="{{ $cmt->id }}" style="color:blue"> Like </a>-
                            <a href="javascript:void(0)" class="rep" style="color:blue"> Reply </a>-
                            <span> <i style="color:blue" class="fa fa-thumbs-o-up"></i> {{ ($count_like==0)?'':$count_like }}</span>-
                            <span> {{ \Carbon\Carbon::createFromTimeStamp(strtotime($cmt->created_at))->diffForHumans()}} </span>
                        </div>
                    </div>

                    <div class="clearfix"></div>
                    <div class="sub-comment">
                        <?php
                        $sub_comment = DB::table('comments')->where('parent',$cmt->id)->where('pro_id',$product->id)->orderBy('created_at','desc')->get();
                        

                        ?>
                        @foreach($sub_comment as $s)
                        <?php
                        $sub_cus = DB::table('users')->where('id',$s->user_id)->first();
                        $count_sub_like = count(DB::table('like')->where('comment_id',$s->id)->get());
                        ?>
                        <div style="padding:  30px 0px 30px 60px" >
                            <div class="col-md-1"><img src="{{asset('/public/admin/images')}}/{{ ($sub_cus->image!='')?$sub_cus->image:'us.png' }}" width="60px"></div>
                            <div class="col-md-11">
                                <h4><b>{{ $sub_cus->last_name  }}</b></h4>
                                <p>{{ $s->comment}}</p>
                                <div>
                                    <a href="javascript:void(0)" class="like" style="color:blue"> Like </a>-
                                    <a href="javascript:void(0)" class="sub_rep" style="color:blue"> Reply </a>-
                                    <input type="hidden" value="{{ $sub_cus->last_name }}" name="sub_user">
                                    <span> <i style="color:blue" class="fa fa-thumbs-o-up"></i>  {{ ($count_like==0)?'':$count_like }}</span>-
                                    <span> {{ \Carbon\Carbon::createFromTimeStamp(strtotime($s->created_at))->diffForHumans()}} </span>
                                </div>
                            </div>
                        </div>

                        <div class="clearfix"></div>
                        @endforeach
                        <div class="add_sub_comment hidden" style="padding:  30px 0px 30px 60px">
                            <div class="col-md-1"><img src="{{asset('/public/admin/images')}}/{{ (Auth::user()!=null && Auth::user()->image!='')?Auth::user()->image:'us.png' }}" width="60px"></div>
                            <div class="col-md-11">
                                <textarea name="sub_cmt" class="form-control" placeholder=" Your Comment..."></textarea>
                                <div style="width: 100%; text-align: right; background: #fff; border-radius: 4px">
                                    <a href="javascript:void()" style="text-align: right;" class="add_sub_cmt btn btn-success  {{ (Auth::user() == null)?'disabled':''}}">Post</a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                
                <div class="clearfix"></div>
                @endif

                @endforeach
                
            </div>


            <?php $count = count($all_comment);
            ?>
            @if($count>10)
            <button class="row btn btn-info" style="width: 100%;  margin-top: 40px; margin-bottom: 40px" name="show_more" >
                <h5 style="text-align: center; line-height: 50px;color:#fff;font-weight: bold">Show more</h5>
                <input type="hidden" name="more" value="{{ count($comments) }}">
            </button>
            @endif
            <hr class="row" style="border:1px solid #FFFFFF"><br> 
        </div>
    </div>
    <div class="col-md-3">
        <div class="single-bottom">
            <h4>Product Categories</h4>
            @foreach($pro_cate as $pc)
            <div class="product-go">
                <img class="img-responsive fashion" src="{{asset('/public/admin/images')}}/{{ $pc->image }}" alt="">
                <div class="grid-product">
                    <a href="#" class="elit">{{ $pc->name }}</a>
                    <span class=" price-in"><small>${{number_format($pc->price, 2)  }}</small> $400.00</span>
                </div>
                <div class="clearfix"> </div>
            </div>
            @endforeach


        </div>
    </div>
    <div class="clearfix"> </div>       
</div>
</div>
<script type="text/javascript">
    <?php
    if(Auth::user() != null){
        ?>
        $('#add_cmt').on('click',function(){ // Thêm  1 comment
            comment = $('textarea[name=cmt]').val();
            pro_id = '{{ $product->id }}';
            user_id = '{{ Auth::user()->id }}';
            total = $('input[name=total_comments]').val();
            console.log(total);
            $.ajax({
                type: "POST",
                url: "{{ route('frontend.products.add_comment') }}",
                data: {'comment':comment,'pro_id':pro_id,'user_id':user_id},
                datatype: 'json',
                success: function(data) {
                    html = '';
                var a = JSON.parse(data);//Parse ra array
                html += '<div class="row" style="margin-top: 40px">';
                html += '<input type="hidden" name="id_cmt" value="'+a.id+'">';
                html += '<div class="col-md-1"><img src="{{asset('/public/admin/images')}}/{{ (Auth::user()!=null && Auth::user()->image!='')?Auth::user()->image:'us.png' }}" width="60px"></div>';
                html += '<div class="col-md-11">';
                html += '<h4><b>'+'{{Auth::user()->last_name}}'+'</b></h4>';
                html += '<p>'+a.comment+'</p>';
                html += '<div>';
                html += '<a href="javascript:void(0)" class="like" data-index="'+a.id+'" style="color:blue"> Like </a>-';
                html += '<a href="javascript:void(0)" class="rep" style="color:blue"> Reply </a>-';
                html += '<span> <i style="color:blue" class="fa fa-thumbs-o-up"></i> <span class="count_like" data-index="0"></span> </span>-';
                html += '1 second ago';
                html += '</div>';
                html += '</div>';
                html += '<div class="clearfix"></div>';
                html += '<div class="sub-comment">';
                html += '<div class="add_sub_comment hidden" style="padding:  30px 0px 30px 60px">';
                html += '<div class="col-md-1"><img src="{{asset('/public/admin/images')}}/{{ (Auth::user()!=null && Auth::user()->image!='')?Auth::user()->image:'us.png' }}" width="60px"></div>';
                html += '<div class="col-md-11">';
                html += '<textarea name="sub_cmt" class="form-control" placeholder=" Your Comment..."></textarea>';
                html += '<div style="width: 100%; text-align: right; background: #fff; border-radius: 4px">';
                html += '<a href="javascript:void(0)" style="text-align: right;" class="add_sub_cmt btn btn-success  {{ (Auth::user() == null)?'disabled':''}}">Post</a>';
                html += '</div>';
                html += '</div>';
                html += '</div>';
                html += '</div>';
                html += '</div>';
                html += '<div class="clearfix"></div>';
                $('textarea[name=cmt]').val('');
                $('#total_cmt').html(parseInt(total)+1);// Tăng total lên 1 hiên ra ở trên
                $('.comment').prepend(html);


            }
        })
        })

        $(document).on('click','.rep',function(){ // hiện form add sub comment
            $(this).parent().parent().parent().find('textarea[name=sub_cmt]').val('');
            $(this).parent().parent().parent().find('.sub-comment').find('.add_sub_comment').removeClass('hidden');

        })

        $(document).on('click','.add_sub_cmt',function(){ // khi click button post trong form sub_comment
            id = $(this).parent().parent().parent().parent().parent().find('input[name=id_cmt]').val();
            comment = $(this).parent().parent().find('textarea[name=sub_cmt]').val();
        $this1 = $(this).parent().parent().find('textarea[name=sub_cmt]');//lay duong dan comment
        $this2 = $(this).parent().parent().parent();//lay duong dan <div add_sub_comment
        $this3 = $(this).parent().parent().parent().parent();
        user_id = '{{ Auth::user()->id }}';
        pro_id = '{{ $product->id }}';
        $.ajax({
            type:'POST',
            url: '{{ route('frontend.products.add_sub_comment') }}',
            data:{'id':id,'comment':comment,'user_id':user_id,'pro_id':pro_id},
            dataType:'json',
            success:function(data){
                html = '';
                html += '<div style="padding:  30px 0px 30px 60px" >';
                html += '<div class="col-md-1"><img src="{{asset('/public/admin/images')}}/{{ (Auth::user()!=null && Auth::user()->image!='')?Auth::user()->image:'us.png' }}" width="60px"></div>';
                html += '<div class="col-md-11">';
                html += '<h4><b>'+'{{Auth::user()->last_name}}'+'</b></h4>';
                html += '<p>'+data.comment.comment+'</p>';
                html += '<div>';
                html += ' <a href="javascript:void(0)" class="like" data-index="'+data.comment.id+'" style="color:blue"> Like </a>-';
                html += '<a  href="javascript:void(0)" class="sub_rep"  style="color:blue"> Reply </a>-';
                html += '<input type="hidden" value="'+data.user_name.last_name+'" name="sub_user">';
                html += '<span> <i style="color:blue" class="fa fa-thumbs-o-up"></i> <span class="count_like" data-index="0"></span></span>-';
                html += '<span> 1 second ago </span>';
                html += '</div>';
                html += '</div>';
                html += '</div>';
                html += ' <div class="clearfix"></div>';
                $this1.val('');//cho textarea bang rong
                $this2.addClass('hidden');//an <div add_sub_comment
                console.log($this3);
                $this3.prepend(html);

            }
        })
    })

        $(document).on('click','.sub_rep',function(){// Rep sub comment
            sub_user = $(this).parent().find('input[name=sub_user]').val();
            console.log(sub_user);
            $(this).parent().parent().parent().parent().find('.add_sub_comment').removeClass('hidden');
            $(this).parent().parent().parent().parent().find('textarea[name=sub_cmt]').val(sub_user+' '); // Hiện tên user của sup_comment ở đâu dòng rồi thực hiện như event trên
        })

        $(document).on('click','.like',function(){ 
            cmt_id = $(this).attr('data-index');
            user_id = '{{ Auth::user()->id }}';
            count_like = $(this).parent().find('.count_like').attr('data-index');
            this1 = $(this);

            $.ajax({
                type:'POST',
                url: '{{ route('frontend.products.like') }}',
                data:{'cmt_id':cmt_id,'user_id':user_id},
                success:function(data){
                    if(data == 'success'){
                        this1.html('Dislike ');//chuyen like thanh dislike
                        this1.attr('class','dislike');
                        this1.css('color','red');
                        count_like = parseInt(count_like) + 1 
                        this1.parent().find('.count_like').attr('data-index',parseInt(count_like));
                        this1.parent().find('.count_like').html(' '+parseInt(count_like));//+ like lên 1
                    }
                    console.log(data);
                }
            })
        })

        $(document).on('click','.dislike',function(){
            comment_id = $(this).attr('data-index');
            user_id = '{{ Auth::user()->id }}';
            count_like = $(this).parent().find('.count_like').attr('data-index');
            this1 = $(this);
            console.log(count_like);

            $.ajax({
                type:'post',
                url: '{{ route('frontend.products.dislike') }}',
                data: {'comment_id':comment_id,'user_id':user_id},
                success:function(data) {
                    if(data == 'success') {
                        this1.html(' Like ');
                        this1.attr('class','like');
                        this1.css('color','blue');
                        count_like = parseInt(count_like) - 1 
                        this1.parent().find('.count_like').attr('data-index',parseInt(count_like));
                        this1.parent().find('.count_like').html(' '+parseInt(count_like));
                    }
                }
            })

        })

        <?php }?>

        $('button[name=show_more]').on('click',function(){
            count = $('input[name=more]').val(); // lấy số comment đang hiện
            pro_id = '{{ $product->id }}';

            $.ajax({
                type: 'POST',
                url: '{{ route('frontend.products.show_more') }}',
            // dataType: 'json',
            data:{'count':count,'pro_id':pro_id},
            success:function(data) {
                // $.each(data,function(index,value){
                //     console.log(value.comment);
                // })
                $('.comment').append(data);
                show_more = parseInt($('input[name=show_more]').val()); // So comment vua dc show ra
                count = parseInt(count) + show_more;
                total_count = '{{ count($all_comment) }}';
                console.log(count);
                console.log(total_count);
                console.log(show_more);
                if(count >= total_count){
                    $('button[name=show_more]').addClass('hidden')
                }

                $('input[name=more]').val(count);
            }
        })

        })


    </script>
    @endsection
    
            @foreach($comments as $cmt)
                <?php
                $cus = DB::table('users')->where('id',$cmt->user_id)->first();
                ?>
                <div class="row" style="margin-top: 40px">
                    <input type="hidden" name="id_cmt" value="{{ $cmt->id }}">
                    <div class="col-md-1"><img src="{{asset('/public/admin/images')}}/{{ ($cus->image!='')?$cus->image:'us.png' }}" width="60px"></div>
                    <div class="col-md-11">
                        <h4><b>{{ $cus->last_name }}</b></h4>
                        <p>{{ $cmt->comment }}</p>
                        <div>
                            <a href="#" style="color:blue"> Like </a>-
                            <a href="javascript:void(0)" class="rep" style="color:blue"> Reply </a>-
                            <span> <i style="color:blue" class="fa fa-thumbs-o-up"></i> </span>-
                            <span> {{ \Carbon\Carbon::createFromTimeStamp(strtotime($cmt->created_at))->diffForHumans()}} </span>
                        </div>
                    </div>

                    <div class="clearfix"></div>
                    <div class="sub-comment">
                        <?php
                        $sub_comment = DB::table('comments')->where('parent',$cmt->id)->where('pro_id',$pro_id)->orderBy('created_at','desc')->get();
                        

                        ?>
                        @foreach($sub_comment as $s)
                        <?php
                            $sub_cus = DB::table('users')->where('id',$s->user_id)->first();
                        ?>
                        <div style="padding:  30px 0px 30px 60px" >
                            <div class="col-md-1"><img src="{{asset('/public/admin/images')}}/{{ ($sub_cus->image!='')?$sub_cus->image:'us.png' }}" width="60px"></div>
                            <div class="col-md-11">
                                <h4><b>{{ $sub_cus->last_name  }}</b></h4>
                                <p>{{ $s->comment}}</p>
                                <div>
                                    <a href="#" style="color:blue"> Like </a>-
                                    <a href="javascript:void(0)" class="sub_rep" style="color:blue"> Reply </a>-
                                    <input type="hidden" value="{{ $sub_cus->last_name }}" name="sub_user">
                                    <span> <i style="color:blue" class="fa fa-thumbs-o-up"></i> </span>-
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
                @endforeach
                <input type="hidden" name="show_more" value="{{count($comments)}}">
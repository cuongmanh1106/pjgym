
     <?php $dem =0;
     $count = 0;
     ?>
     @foreach($products as $p)
     @if($dem == 0)
     <div class="product-top">
        @endif

        <div class="col-md-4 grid-product-in">  
            <div class=" product-grid"> 
                <a href="single.html"><img class="img-responsive " src="{{ asset('/public/admin/images') }}/{{ $p->image }}" alt=""></a>        
                <div class="shoe-in">
                    <h6><a href="single.html">{{ $p->name }} </a></h6>
                    <label>${{ $p->price }}</label>
                    <a href="single.html" class="store">FIND A STORE</a>
                </div>

                <b class="plus-on">+</b>
            </div>  
        </div>
        <?php $dem++; ?>
        <?php if($dem==3): 
        $dem = 0;
        ?>

        <div class="clearfix"> </div>
    </div>  
<?php endif;?>



<?php $count++ ?>
@endforeach

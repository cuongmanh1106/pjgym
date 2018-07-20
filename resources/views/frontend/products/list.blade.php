@extends('frontend.include.layout')
@section('title','Home')
@section('content')
@include('admin.include.report')

<div class="product-grids" style="margin-top: 100px;">
    <div class="container">
        <div class="col-md-3">

            Soft by <select name="soft" class="form-group" style="border-radius: 4px; width: 20%">
                <option value="all">All</option>
                <option value="price_high">Price(High to low)</option>
                <option value="price_low">Price(Low to high)</option>
                <option value="popular">Most Popular</option>
                <option value="newest">Newest</option>
            </select>
            item




        </div>
        <div class="col-md-3">
            Name <input type="text" placeholder="name" name="name">
        </div>
        <div class="col-md-3">
            Discount <select name="discount" class="form-group" style="border-radius: 4px; width: 70%">
                <option value="all">All</option>
                <option value="small,10"> < 10% </option>
                <option value="10-20"> 10% - 20%</option>
                <option value="20-30"> 20% - 30%</option>
                <option value="30-50"> 30% - 50%</option>
                <option value="big,50"> 50%</option>
            </select>
        </div>
        <div class="col-md-3">
            Price <select name="price" class="form-group" style="border-radius: 4px; width: 70%">
                <option value="all">All</option>
                <option value="small,10"> < $10 </option>
                <option value="10-30"> $10 - $30</option>
                <option value="30-50"> $30 - $50</option>
                <option value="50-100"> $50 - $100</option>
                <option value="big,100"> >$100</option>
            </select>
        </div>
    </div>
    <div class="container" id="fil_pro">

     <?php $dem =0;
     $count = 0;
     ?>
     @foreach($products as $p)
     @if($dem == 0)
     <div class="product-top">
        @endif

        <div class="col-md-4 grid-product-in">  
            <div class=" product-grid"> 
                <a href="{{ route('frontend.products.single',$p->id) }}"><img class="img-responsive " src="{{ asset('/public/admin/images') }}/{{ $p->image }}" alt=""></a>        
                <div class="shoe-in">
                    <h6><a href="{{ route('frontend.products.single',$p->id) }}">{{ $p->name }} </a></h6>
                    <label>${{ $p->price }}</label>
                    <a href="{{ route('frontend.products.single',$p->id) }}" class="store"> FIND A STORE</a>
                    <button data-index = "{{ $p->id }}" class="btn btn-primary add-cart"><i class="fa fa-shopping-cart"></i> Add to cart</button>
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
</div>
</div>
</div>
<script type="text/javascript">
    $('select[name=price], select[name=discount], select[name=soft], input[name=name]').on('change',function(){
        var price = $('select[name=price]').val();
        var discount = $('select[name=discount]').val();
        var soft = $('select[name=soft]').val();
        var name = $('input[name=name]').val();

        $.ajax({
            type:'GET',
            url: "{{ route('frontend.products.product_filter') }}",
            data: {'price':price,'discount':discount,'soft':soft,'name':name},
            dataType: 'json',
            success:function(data) {
                console.log(data);
                $('#fil_pro').html(data);
            }
        })

    })
</script>
@endsection
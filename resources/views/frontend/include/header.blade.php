<div class="line">

</div>
<div class="header" style="overflow: hidden;
background-color: #333;
position: fixed;
top: 0;
width: 100%; z-index: 100">
<div class="logo">
    <a href="{{ route('home') }}"><img src="{{asset('/public/frontend/images/logo.png')}}" alt="" ></a>
</div>
<div  class="header-top">
    <div class="header-grid">
        <ul class="header-in">
            <li >
                @if(Auth::user()==null)
                <a href="{{ route('frontend.account.getlogin') }}">Login   </a> 
                @elseif (Auth::user()->image != '')
                <a href="{{ route('frontend.account.profile') }}"><img class="img-circle" src="{{ asset('/public/admin/images')}}/{{Auth::user()->image }}" width="30px"></a>
                @elseif(Auth::user()->image == '')
                <a href="{{ route('frontend.account.profile') }}" ><img class="img-circle" src="{{ asset('/public/admin/images/us.png')}}" width="50px"></a>
            @endif


        </li>
        <li>    
            <select class="in-drop">
              <option value="Dollars" class="in-of">Dollars</option>
              <option value="Euro" class="in-of">Euro</option>
              <option value="Yen" class="in-of">Yen</option>
          </select>
      </li>                   
  </ul>
  <div class="search-box">
    <div id="sb-search" class="sb-search">
        <form>
            <input class="sb-search-input" placeholder="Enter your search term..." type="search" name="search" id="search">
            <input class="sb-search-submit" type="submit" value="">
            <span class="sb-icon-search"> </span>
        </form>
    </div>
</div>
<!-- search-scripts -->
<script src="{{asset('/public/frontend/js/classie.js')}}"></script>
<script src="{{asset('/public/frontend/js/uisearch.js')}}"></script>
<script>
    new UISearch( document.getElementById( 'sb-search' ) );
</script>
<!-- //search-scripts -->
<div class="online">
    <a data-toggle="modal" id="checkout" href="#checkout_cart" data-index="{{Cart::content()->count()}}" ><i style="font-size: 30px" class="fa fa-shopping-cart"></i> (<span id="cart_quantity">{{ (Cart::content()->count()!=0)?Cart::content()->count():'Empty' }}</span>)</a>

</div>
<div class="clearfix"> </div>
</div>
<div class="header-bottom">
    <div class="h_menu4"><!-- start h_menu4 -->
        <a class="toggleMenu" href="#">Menu</a>
        <ul class="nav">
            <li class="active"><a href="{{ route('frontend.products.list') }}">Running</a></li>
            <li><a href="product.html">Fitness</a></li>     
            <li><a href="product.html">Tennis</a>   
            </li>
            <li><a href="product.html">Football</a></li>
            <li><a href="product.html">Golf</a></li>
            <li><a href="product.html">More <i> </i></a>
                <ul>
                    <li><a href="contact.html">Contact</a></li>
                    <li><a href="account.html">Account</a></li>
                    <li><a href="register.html">Register</a></li>
                </ul>
            </li>
        </ul>
        <script type="text/javascript" src="{{asset('/public/frontend/js/nav.js')}}"></script>
    </div><!-- end h_menu4 -->
    <ul class="header-bottom-in">
        <li ><select class="drop">
          <option value="Dollars" class="in-of">Get Active</option>
          <option value="Euro" class="in-of">Get Active1</option>
          <option value="Yen" class="in-of">Get Active2</option>
      </select> </li>
      <li ><select class="drop">
          <option value="Dollars" class="in-of">Community</option>
          <option value="Euro" class="in-of">Community1</option>
          <option value="Yen" class="in-of">Community2</option>
      </select></li>      
  </ul>
  <div class="clearfix"> </div>
</div>
</div>
<div class="clearfix"> </div>
</div>

<div class="clearfix"> </div>

<div class="clearfix"> </div>
<div class="clearfix"> </div>
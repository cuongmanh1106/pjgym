<aside id="left-panel" class="left-panel">
    <nav class="navbar navbar-expand-sm navbar-default">

        <div class="navbar-header">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa fa-bars"></i>
            </button>
            <a class="navbar-brand" href="./"><img src="images/logo.png" alt="Logo"></a>
            <a class="navbar-brand hidden" href="./"><img src="images/logo2.png" alt="Logo"></a>
        </div>

        <div id="main-menu" class="main-menu collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li>
                    <a href="index.html"> <i class="menu-icon fa fa-dashboard"></i>Dashboard </a>
                </li>
                <h3 class="menu-title">UI elements</h3><!-- /.menu-title -->
                <li>
                    <a href="{{ route('admin.chart.list') }}"> <i class="menu-icon ti-email"></i>Chart </a>
                </li>
                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-laptop"></i>Categories</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="fa fa-puzzle-piece"></i><a href="{{ route('admin.categories.list') }}">List</a></li>
                
                        @if(check_permission('insert_category') != 1) 
                        <li><a  onclick="return false" title="You don't have permission to do this action"><i class="fa fa-plus-circle"></i> Add</a></li>
                        @else 
                        <li><a href="javascript:void(0)" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus-circle"></i> Add</a></li>
                        @endif

                    </ul>
                </li>
                <li class="menu-item-has-children active dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-table"></i>Products</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="fa fa-table"></i><a href="{{ route('admin.products.list') }}">List</a></li>
                        <li><i class="fa fa-table"></i><a href="{{ route('admin.products.create') }}">Add</a></li>
                    </ul>
                </li>
                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-th"></i>Uses</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="menu-icon fa fa-th"></i><a href="{{ route('admin.users.list') }}">List</a></li>
                        <li><i class="menu-icon fa fa-th"></i><a href="{{ route('admin.users.create') }}">Add</a></li>
                    </ul>
                </li>

                <li>
                    <a href="{{ route('admin.comments.list') }}"> <i class="menu-icon ti-email"></i>Comments </a>
                </li>
                <li>
                    <a href="{{ route('admin.orders.list') }}"> <i class="menu-icon ti-email"></i>Orders </a>
                </li>
                <li>
                    <a href="{{ route('admin.orders.ship') }}"> <i class="menu-icon ti-email"></i>Shipper </a>
                </li>

                <li>
                    <a href="{{ route('admin.permission.list') }}"> <i class="menu-icon ti-email"></i>Permission </a>
                </li>

            </ul>
        </div><!-- /.navbar-collapse -->
    </nav>
    </aside><!-- /#left-panel -->
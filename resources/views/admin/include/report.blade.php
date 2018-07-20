@foreach(['danger', 'warning', 'success', 'info'] as $msg)
          	@if(Session::has('alert-'.$msg))
          	<h4 class="alert alert-{{ $msg }}">{{ Session::get('alert-'.$msg) }}<button class="close" data-dismiss="alert" aria-label="close">&times;</button></h4>
          	@endif
          @endforeach
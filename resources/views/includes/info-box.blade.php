@if(Session::has('fail'))
	<div class="col-lg-4 col-lg-offset-4 alert alert-danger">
			{{ Session::get('fail') }}
	</div>
@endif

@if(Session::has('success'))
	<div class="col-lg-4 col-lg-offset-4 alert alert-success">
			{{ Session::get('success') }}
		
	</div>
@endif

@if(count($errors)>0))
<div class="col-lg-4 col-lg-offset-4 alert alert-danger">
		<ul>
			@foreach($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>
</div>
@endif

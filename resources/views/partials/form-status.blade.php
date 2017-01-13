@if (session('message'))
	<div class="alert alert-success alert-dismissable flat">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<h4><i class="icon fa fa-info"></i> Message</h4>
		{{ session('message') }}
	</div>
@endif

@if (session('success'))
	<div class="alert alert-success alert-dismissable flat">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<h4><i class="icon fa fa-check"></i> Success</h4>
		{{ session('success') }}
	</div>
@endif

@if (session('error'))
	<div class="alert alert-danger alert-dismissable flat">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<h4>
			<i class="icon fa fa-warning"></i>
			Error
		</h4>
		{{ session('error') }}
	</div>
@endif

@if (count($errors) > 0)
	<div class="alert alert-danger alert-dismissable flat">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<h4>
			<i class="icon fa fa-warning"></i>
			<strong>{{ Lang::get('auth.whoops') }}</strong> {{ Lang::get('auth.someProblems') }}
		</h4>
		<ul>
			@foreach ($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>
	</div>
@endif
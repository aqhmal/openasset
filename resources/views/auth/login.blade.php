@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="login-box">
	<div class="login-box-body">
		<h3 align="center">OpenAsset.io</h3>
		<p class="login-box-msg">Please sign in to continue</p>
		@if($errors->any())
			@foreach($errors->all() as $error)
				<div class="alert alert-danger alert-dismissible">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					{{ $error }}
				</div>
			@endforeach
		@endif
    @if(Session::has('error'))
      <div class="alert alert-danger alert-dismissible">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        {{ Session::get('error') }}
      </div>
    @endif
		<form action="{{ Request::url() }}" method="post">
			@csrf
			<div class="form-group has-feedback">
				<input type="email" name="email" class="form-control" placeholder="Email" required maxlength="20" value="{{ old('email') }}" />
				<span class="form-control-feedback">@</span>
			</div>
			<div class="form-group has-feedback">
				<input type="password" name="password" class="form-control" placeholder="Password" required autocomplete="off" />
				<span class="glyphicon glyphicon-lock form-control-feedback"></span>
			</div>
			@if($user_enabled === 'true')
				<div class="form-group has-feedback">
					<select class="form-control" name="group">
						<option value="admin">Admin</option>
						<option value="user">User</option>
					</select>
				</div>
			@else
				<input type="hidden" name="group" value="admin" />
			@endif
			<div class="row">
				<div class="col-xs-12">
					<button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
				</div>
			</div>
		</form>
	</div>
</div>
@endsection

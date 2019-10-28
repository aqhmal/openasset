@extends('layouts.app')

@section('title', 'Edit User')

@section('content')
<div class="wrapper">
	@include('layouts.header')
  @include('layouts.sidebar')
  <div class="content-wrapper">
    <section class="content-header">
      <h1>@yield('title')</h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('/') }}"><i class="ion ion-person"></i> Home</a></li>
        <li>Users</li>
        <li><a href="{{ route('user.index') }}">Manage Users</a></li>
        <li class="active">@yield('title')</li>
      </ol>
    </section>
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          @if($errors->any())
						@foreach($errors->all() as $error)
							<div class="alert alert-danger alert-dismissible">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<i class="icon fa fa-warning"></i> {{ $error }}
							</div>
						@endforeach
					@endif
					@if(Session::has('error'))
						<div class="alert alert-danger alert-dismissible">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<i class="icon fa fa-warning"></i> {{ Session::get('error') }}
						</div>
					@elseif(Session::has('success'))
						<div class="alert alert-success alert-dismissible">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<i class="icon fa fa-check"></i> {{ Session::get('success') }}
						</div>
					@endif
          <div class="box box-primary" id="box">
            <form role="form" class="form-horizontal" method="post" enctype="multipart/form-data" action="{{ route('user.update', $user->id) }}">
            	@csrf
            	<div class="box-body">
                <br>
								<div class="form-group">
									<label for="image" class="col-sm-3 control-label">Image</label>
									<div class="col-sm-8">
										@if($user->image)
											<img class="img-responsive" height="150" width="150" src="data:image/jpeg;base64,{{$user->image}}"><br>
										@endif
										<input type="file" name="image" class="form-control" id="image" />
									</div>
								</div>
            		<div class="form-group">
            			<label for="name" class="col-sm-3 control-label">Name</label>
            			<div class="col-sm-8">
            				<input type="text" name="name" class="form-control" id="name" placeholder="Enter User Name" required value="{{ $user->name }}" />
            			</div>
            		</div>
            		<div class="form-group">
            			<label for="email" class="col-sm-3 control-label">Email</label>
            			<div class="col-sm-8">
            				<input type="email" name="email" class="form-control" id="email" placeholder="Enter User Email" required value="{{ $user->email }}" />
            			</div>
            		</div>
                <hr>
            		<div class="form-group">
            			<label for="password" class="col-sm-3 control-label">Password</label>
            			<div class="col-sm-8">
            				<input type="password" name="password" class="form-control" id="password" placeholder="Enter User Password" />
            			</div>
            		</div>
            		<div class="form-group">
            			<label for="password_confirmation" class="col-sm-3 control-label">Password Confirmation</label>
            			<div class="col-sm-8">
            				<input type="password" name="password_confirmation" class="form-control" id="password_confirmation" placeholder="Enter Password Confirmation" />
            			</div>
            		</div>
            	</div>
            	<div class="box-footer">
            		<button type="submit" class="btn btn-primary pull-right">Save Changes</button>
            	</div>
            </form>
          </div>
        </div>
      </div>
    </section>
  </div>
  @include('layouts.footer')
</div>
@endsection

@section('post-scripts')
<script type="text/javascript">
  $('#sidebar_user, #user_manage').addClass('active');
  $('#box').hide().show('slide', { direction: 'left' }, 450);
</script>
@endsection

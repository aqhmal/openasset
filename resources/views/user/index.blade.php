@extends('layouts.app')

@section('title', 'Manage Users')

@section('content')
<div class="wrapper">
  @include('layouts.header')
  @include('layouts.sidebar')
  <div class="content-wrapper">
      <section class="content-header">
        <h1>
          @yield('title')
        </h1>
        <ol class="breadcrumb">
          <li><a href="{{ url('/') }}"><i class="ion ion-person"></i> Home</a></li>
  				<li>Users</li>
  				<li class="active">@yield('title')</li>
        </ol>
      </section>
      <section class="content">
        <div class="row">
          <div class="col-xs-12">
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
            <div class="nav-tabs-custom" id="tab">
              <ul class="nav nav-tabs">
                <li class="active">
                  <a href="#list" data-toggle="tab">
                    <i class="fa fa-list-ul"></i> <span>Users List</span>
                  </a>
                </li>
                <li>
                  <a href="#add" data-toggle="tab">
                    <i class="ion ion-person"></i><b>+</b> <span>Add User</span>
                  </a>
                </li>
              </ul>
              <div class="tab-content">
                <div class="tab-pane active" id="list">
                  <UserList url="{{ route('user.json') }}" user_url="{{ route('user.index') }}" csrf='{{ csrf_token() }}' />
                </div>
                <div class="tab-pane" id="add">
                  <form role="form" class="form-horizontal" method="post" enctype="form/multipart-data" action="{{ route('user.add')}}">
                  	@csrf
                  	<div class="box-body">
                  		<div class="form-group">
                  			<label for="name" class="col-sm-3 control-label">Name</label>
                  			<div class="col-sm-8">
                  				<input type="text" name="name" class="form-control" id="name" placeholder="Enter Name" required />
                  			</div>
                  		</div>
                  		<div class="form-group">
                  			<label for="email" class="col-sm-3 control-label">Email</label>
                  			<div class="col-sm-8">
                  				<input type="email" name="email" class="form-control" id="email" placeholder="Enter Email" required />
                  			</div>
                  		</div>
                  		<div class="form-group">
                  			<label for="password" class="col-sm-3 control-label">Password</label>
                  			<div class="col-sm-8">
                  				<input type="password" name="password" class="form-control" id="password" placeholder="Enter Password" required />
                  			</div>
                  		</div>
                  		<div class="form-group">
                  			<label for="password_confirmation" class="col-sm-3 control-label">Password Confirmation</label>
                  			<div class="col-sm-8">
                  				<input type="password" name="password_confirmation" class="form-control" id="password_confirmation" placeholder="Enter Password Confirmation" required />
                  			</div>
                  		</div>
                  	</div>
                  	<div class="box-footer">
                  		<button type="submit" class="btn btn-primary pull-right">Add User</button>
                  	</div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
  </div>
  @include('layouts.footer')
</div>
@endsection

@section('post-scripts')
<script src="{{ asset(mix('/js/user_list.js')) }}"></script>
<script type="text/javascript">
$('#sidebar_user, #user_manage').addClass('active');
$(document).ready(function() {
  $('#tab').hide().show('slide', {
    direction: 'left'
  }, 450);
});
</script>
@endsection

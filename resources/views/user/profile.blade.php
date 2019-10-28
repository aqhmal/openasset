@extends('layouts.app')

@section('title', 'Profile')

@section('content')
<div class="wrapper">
	@include('layouts.header')
  @include('layouts.sidebar')
  <div class="content-wrapper">
    <section class="content-header">
      <h1>@yield('title')</h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('/') }}"><i class="ion ion-person"></i> Home</a></li>
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
            <form role="form" method="post" action="{{ route('profile.update') }}" class="form-horizontal" enctype="multipart/form-data">
              @csrf
              <div class="box-body">
                <br>
								<div class="form-group">
									<label for="image" class="col-sm-3 control-label">Image</label>
									<div class="col-sm-8">
										@if($user->image)
											<img src="data:image/jpeg;base64,{{$user->image}}" height="150" width="150" class="img-circle img-responsive"><br>
										@endif
										<input type="file" class="form-control" id="image" name="image" />
									</div>
								</div>
                @auth('user')
                  <div class="form-group">
                    <label for="id" class="col-sm-3 control-label">User ID</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" id="id" value="{{ $user->id }}" readonly />
                    </div>
                  </div>
                @endauth
                <div class="form-group">
                  <label for="email" class="col-sm-3 control-label">Email</label>
                  <div class="col-sm-8">
                    <input type="email" class="form-control" name="email" id="email" value="{{ $user->email }}" placeholder="Insert your email" autocomplete="off" required />
                  </div>
                </div>
                <div class="form-group">
                  <label for="name" class="col-sm-3 control-label">Name</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" name="name" id="name" value="{{ $user->name }}" placeholder="Insert your name" autocomplete="off" required maxlength="20" />
                  </div>
                </div>
                <hr>
                <div class="form-group">
                  <label for="password" class="col-sm-3 control-label">Password</label>
                  <div class="col-sm-8">
                    <input type="password" class="form-control" name="password" id="password" placeholder="Insert if you want to change your password" />
                  </div>
                </div>
                <div class="form-group">
                  <label for="password_confirmation" class="col-sm-3 control-label">Password Confirmation</label>
                  <div class="col-sm-8">
                    <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Re-enter new password" />
                  </div>
                </div>
              </div>
              <div class="box-footer">
                <button type="reset" class="btn btn-default">Reset</button>
                <button type="submit" class="btn btn-primary">Save Changes</button>
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
  $('#box').hide().show('slide', { direction: 'left' }, 450);
</script>
@endsection

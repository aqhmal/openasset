@extends('layouts.app')

@section('title', 'Settings')

@section('content')
<div class="wrapper">
	@include('layouts.header')
  @include('layouts.sidebar')
  <div class="content-wrapper">
    <section class="content-header">
      <h1>@yield('title')</h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('/') }}"><i class="fa fa-cogs"></i> Home</a></li>
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
            <form role="form" class="form-horizontal" method="post" enctype="form/multipart-data" action="{{ route('settings.update') }}">
            	@csrf
            	<div class="box-body">
                <br>
            		<div class="form-group">
            			<label class="col-sm-3 control-label">Auto Backup Time Interval</label>
            			<div class="col-sm-8">
                    <select class="form-control" name="backup">
  										@if($backup->value === 'sunday')
  											<option value="sunday">Sunday</option>
  											<option value="daily">Daily</option>
  										@elseif($backup->value === 'daily')
  											<option value="daily">Daily</option>
  											<option value="sunday">Sunday</option>
  										@endif
  									</select>
            			</div>
            		</div>
								<div class="form-group">
            			<label class="col-sm-3 control-label">Color Theme</label>
            			<div class="col-sm-8">
                    <select class="form-control" name="theme">
											@foreach($theme_colors as $color)
												@if($color[0] === $theme->value)
													<option value="{{ $color[0] }}" selected>{{ $color[1] }}</option>
												@else
													<option value="{{ $color[0] }}">{{ $color[1] }}</option>
												@endif
											@endforeach
  									</select>
            			</div>
            		</div>
								<div class="form-group">
									<label class="col-sm-3 control-label">User</label>
									<div class="col-sm-8">
										<select class="form-control" name="user_enabled">
											@if($user_enabled->value === 'true')
												<option value="enabled">Enabled</option>
												<option value="disabled">Disabled</option>
											@else
												<option value="disabled">Disabled</option>
												<option value="enabled">Enabled</option>
											@endif
										</select>
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
  $('#sidebar_setting').addClass('active');
  $('#box').hide().show('slide', { direction: 'left' }, 450);
</script>
@endsection

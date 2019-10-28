@extends('layouts.app')

@section('title', 'Borrow Asset')

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
          <li><a href="{{ url('/') }}"><i class="ion ion-cube"></i> Home</a></li>
  				<li>Assets</li>
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
              <form role="form" class="form-horizontal" method="post" enctype="form/multipart-data" action="{{ route('asset.borrow') }}">
              	@csrf
              	<div class="box-body">
                  <br>
              		<div class="form-group">
              			<label for="asset_name" class="col-sm-3 control-label">Asset Name</label>
              			<div class="col-sm-8">
                      @if(count($assets) > 0)
                        <select name="asset_id" class="form-control">
                          @foreach($assets as $asset)
                            <option value="{{ $asset->id }}">{{ $asset->name }}</option>
                          @endforeach
                        </select>
                      @else
                        <select disabled>
                          <option>No Asset Available</option>
                        </select>
                      @endif
              			</div>
              		</div>
                  <div class="form-group">
                    <label for="quantity" class="col-sm-3 control-label">Quantity</label>
                    <div class="col-sm-8">
                      <input type="number" class="form-control" name="quantity" placeholder="Quantity that you want to borrow"/>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="" class="col-sm-3 control-label"></label>
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
$('#sidebar_asset, #asset_borrow  ').addClass('active');
$(document).ready(function() {
  $('#box').hide().show('slide', {
    direction: 'left'
  }, 450);
});
</script>
@endsection

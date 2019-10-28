@extends('layouts.app')

@section('title', 'View Asset')

@section('content')
<div class="wrapper">
	@include('layouts.header')
  @include('layouts.sidebar')
  <div class="content-wrapper">
    <section class="content-header">
      <h1>@yield('title')</h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('/') }}"><i class="ion ion-cube"></i> Home</a></li>
        <li>Assets</li>
        <li><a href="{{ route('asset.index') }}">Assets List</a></li>
        <li class="active">@yield('title')</li>
      </ol>
    </section>
    <section class="content">
      <div class="row">
        <div class="col-md-12" id="box">
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
          <div class="box box-primary">
            <div role="form" class="form-horizontal">
            	<div class="box-body">
                <br>
            		<!--<div class="form-group">
            			<label for="image" class="col-sm-3 control-label">Image</label>
            			<div class="col-sm-8">
            			</div>
            		</div>-->
            		<div class="form-group">
            			<label for="name" class="col-sm-3 control-label">Name</label>
            			<div class="col-sm-8">
                    <p class="form-control-static">{{ $asset->name }}</p>
            			</div>
            		</div>
            		<div class="form-group">
            			<label for="sku" class="col-sm-3 control-label">SKU</label>
            			<div class="col-sm-8">
                    @if($asset->sku != '')
                      <p class="form-control-static">{{ $asset->sku }}</p>
                    @else
                      <p class="form-control-static">-</p>
                    @endif
            			</div>
            		</div>
            		<div class="form-group">
            			<label for="price" class="col-sm-3 control-label">Price (RM)</label>
            			<div class="col-sm-8">
                    <p class="form-control-static">{{ $asset->price }}</p>
            			</div>
            		</div>
            		<div class="form-group">
            			<label for="quantity" class="col-sm-3 control-label">Quantity</label>
            			<div class="col-sm-8">
                    <p class="form-control-static">{{ $asset->quantity }}</p>
            			</div>
            		</div>
            		<div class="form-group">
            			<label for="description" class="col-sm-3 control-label">Description</label>
            			<div class="col-sm-8">
            				<textarea id="description" class="form-control" style="resize: none;" rows="6" readonly>{{ $asset->description }}</textarea>
            			</div>
            		</div>
            		<div class="form-group">
            			<label for="category" class="col-sm-3 control-label">Category</label>
            			<div class="col-sm-8">
                    <p class="form-control-static">{{ $asset->category->name }}</p>
            		</div>
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
<script type="text/javascript">
  $('#sidebar_asset, #asset_list').addClass('active');
  $('#box').hide().show('slide', { direction: 'left' }, 450);
</script>
@endsection

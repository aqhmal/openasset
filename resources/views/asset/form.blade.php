@extends('layouts.app')

@section('title', 'Edit Asset')

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
        <li><a href="{{ route('asset.index') }}">Manage Assets</a></li>
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
            <form role="form" class="form-horizontal" method="post" enctype="multipart/form-data" action="{{ route('asset.update', $asset->id) }}">
            	@csrf
            	<div class="box-body">
                <br>
            		<div class="form-group">
            			<label for="image" class="col-sm-3 control-label">Image</label>
            			<div class="col-sm-8">
										@if($asset->image)
											<img class="img-responsive" height="150" width="150" src="data:image/jpeg;base64,{{$asset->image}}"><br>
										@endif
            				<input type="file" name="image" class="form-control" id="image" />
            			</div>
            		</div>
            		<div class="form-group">
            			<label for="name" class="col-sm-3 control-label">Name</label>
            			<div class="col-sm-8">
            				<input type="text" name="name" class="form-control" id="name" placeholder="Enter Asset Name" required value="{{ $asset->name }}" />
            			</div>
            		</div>
            		<div class="form-group">
            			<label for="sku" class="col-sm-3 control-label">SKU</label>
            			<div class="col-sm-8">
            				<input type="text" name="sku" class="form-control" id="sku" placeholder="Enter Asset SKU" value="{{ $asset->sku }}" />
            			</div>
            		</div>
            		<div class="form-group">
            			<label for="price" class="col-sm-3 control-label">Price (RM)</label>
            			<div class="col-sm-8">
            				<input type="number" name="price" class="form-control" id="price" placeholder="Enter Asset Price (RM)" step="any" value="{{ $asset->price }}" />
            			</div>
            		</div>
            		<div class="form-group">
            			<label for="quantity" class="col-sm-3 control-label">Quantity</label>
            			<div class="col-sm-8">
            				<input type="number" name="quantity" class="form-control" id="quantity" placeholder="Enter Asset Quantity" required value="{{ $asset->quantity }}"/>
            			</div>
            		</div>
            		<div class="form-group">
            			<label for="description" class="col-sm-3 control-label">Description</label>
            			<div class="col-sm-8">
            				<textarea name="description" id="description" class="form-control" style="resize: none;" rows="6">{{ $asset->description }}</textarea>
            			</div>
            		</div>
            		<div class="form-group">
            			<label for="category" class="col-sm-3 control-label">Category</label>
            			<div class="col-sm-8">
            				@if(count($categories) > 0)
            					<select name="category" class="form-control">
            						@foreach($categories as $category)
            								<option value="{{ $category->id }}">{{ $category->name }}</option>
            						@endforeach
            					</select>
            				@else
            					<select class="form-control" disabled>
            						<option>No categories found</option>
            					</select>
            				@endif
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
  $('#sidebar_asset, #asset_manage').addClass('active');
  $('#box').hide().show('slide', { direction: 'left' }, 450);
</script>
@endsection

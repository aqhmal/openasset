@extends('layouts.app')

@section('title', 'Edit Category')

@section('content')
<div class="wrapper">
	@include('layouts.header')
  @include('layouts.sidebar')
  <div class="content-wrapper">
    <section class="content-header">
      <h1>@yield('title')</h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('/') }}"><i class="fa fa-tags"></i> Home</a></li>
        <li>Categories</li>
        <li><a href="{{ route('category.index') }}">Manage Categories</a></li>
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
            <form role="form" class="form-horizontal" method="post" enctype="form/multipart-data" action="{{ route('category.update', $category->id) }}">
            	@csrf
            	<div class="box-body">
                <br>
            		<div class="form-group">
            			<label for="name" class="col-sm-3 control-label">Name</label>
            			<div class="col-sm-8">
            				<input type="text" name="name" class="form-control" id="name" placeholder="Enter Category Name" required value="{{ $category->name }}" />
            			</div>
            		</div>
            	</div>
							<div class="form-group">
								<label for="assets" class="col-sm-3 control-label">Assets Associated</label>
								<div class="col-sm-8">
									<p id="assets" class="form-control-static">{{ $category->assets_count() }}</p>
								</div>
							</div>
							<div class="form-group">
								<label for="date_added" class="col-sm-3 control-label">Date Added</label>
								<div class="col-sm-8">
									<p id="date_added" class="form-control-static">{{ $category->created_at->format('d/m/Y h:i A') }}</p>
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
  $('#sidebar_category, #category_manage').addClass('active');
  $('#box').hide().show('slide', { direction: 'left' }, 450);
</script>
@endsection

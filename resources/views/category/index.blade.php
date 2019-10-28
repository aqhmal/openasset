@extends('layouts.app')

@section('title', 'Manage Categories')

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
          <li><a href="{{ url('/') }}"><i class="fa fa-tags"></i> Home</a></li>
  				<li>Categories</li>
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
                    <i class="fa fa-list-ul"></i> <span>Categories List</span>
                  </a>
                </li>
                <li>
                  <a href="#add" data-toggle="tab">
                    <i class="fa fa-tags"></i><b>+</b> <span>Add Category</span>
                  </a>
                </li>
              </ul>
              <div class="tab-content">
                <div class="tab-pane active" id="list">
                  <CategoriesList url="{{ route('category.json') }}" category_url="{{ route('category.index') }}" csrf='{{ csrf_token() }}' />
                </div>
                <div class="tab-pane" id="add">
                  <form role="form" class="form-horizontal" method="post" enctype="form/multipart-data" action="{{ route('category.add')}}">
                  	@csrf
                  	<div class="box-body">
                  		<div class="form-group">
                  			<label for="name" class="col-sm-3 control-label">Name</label>
                  			<div class="col-sm-8">
                  				<input type="text" name="name" class="form-control" id="name" placeholder="Enter Category Name" required />
                  			</div>
                  		</div>
                  	</div>
                  	<div class="box-footer">
                  		<button type="submit" class="btn btn-primary pull-right">Add Category</button>
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
<script src="{{ asset(mix('js/category_list.js')) }}"></script>
<script type="text/javascript">
$('#sidebar_category, #category_manage').addClass('active');
$(document).ready(function() {
  $('#tab').hide().show('slide', {
    direction: 'left'
  }, 450);
});
</script>
@endsection

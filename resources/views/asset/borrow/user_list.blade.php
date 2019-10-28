@extends('layouts.app')

@section('title', 'Borrowed Asset List')

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
            <div class="box box-primary" id="box">
              <div id="list">
                <br><br>
                <div class="box-body">
                  <BorrowList url="{{ route('asset.borrow.json') }}" borrow_url={{ route('asset.borrow') }} csrf="{{ csrf_token() }}" />
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
  <script type="text/javascript" src="{{ asset('js/borrow_user_list.js') }}"></script>
<script type="text/javascript">
$('#sidebar_asset, #borrow_list').addClass('active');
$(document).ready(function() {
  $('#box').hide().show('slide', {
    direction: 'left'
  }, 450);
});
</script>
@endsection

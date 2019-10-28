@php
$user_enabled = \App\Setting::where('option', 'user_enabled')->first()->value;
@endphp
<aside class="main-sidebar">
	<section class="sidebar">
		<div class="user-panel">
			<div class="pull-left image">
				<img src="data:image/jpeg;base64,{{Auth::user()->image}}" width="160" height="160" class="img-circle" alt="{{ Auth::user()->name }}">
			</div>
			<div class="pull-left info">
				<p>{{ Auth::user()->name }}</p>
				<a href="{{ route('profile.index') }}"><span>Edit Profile</span></a>
			</div>
		</div>

		<ul class="sidebar-menu" data-widget="tree">
			<li class="header">NAVIGATION</li>

			<li id="sidebar_dashboard">
				<a href="{{ route('dashboard') }}">
					<i class="fa fa-dashboard"></i> <span>Dashboard</span>
				</a>
			</li>

			<li class="treeview" id="sidebar_asset">
				<a href="#">
					<i class="ion ion-cube"></i> <span>Assets</span>
					<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
					</span>
				</a>
				<ul class="treeview-menu">
					@auth('admin')
						<li id="asset_manage">
							<a href="{{ route('asset.index') }}">
								<i class="fa fa-circle-o"></i> Manage Assets
							</a>
						</li>
						<li id="asset_borrowed">
							<a href="{{ route('asset.borrow.index') }}">
								<i class="fa fa-circle-o"></i> Borrowed Asset
							</a>
						</li>
					@endauth
					@auth('user')
						<li id="asset_list">
							<a href="{{ route('asset.index') }}">
								<i class="fa fa-circle-o"></i> Assets List
							</a>
						</li>
						<li id="borrow_list">
							<a href="{{ route('asset.borrow.list') }}">
								<i class="fa fa-circle-o"></i> Borrowed Asset List
							</a>
						</li>
						<li id="asset_borrow">
							<a href="{{ route('asset.borrow') }}">
								<i class="fa fa-circle-o"></i> Borrow Asset
							</a>
						</li>
					@endauth
				</ul>
			</li>

			<li class="treeview" id="sidebar_category">
				<a href="#">
					<i class="fa fa-tags"></i> <span>Categories</span>
					<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
					</span>
				</a>
				<ul class="treeview-menu">
					@auth('admin')
						<li id="category_manage">
							<a href="{{ route('category.index') }}">
								<i class="fa fa-circle-o"></i> Manage Categories
							</a>
						</li>
					@endauth
					@auth('user')
						<li id="category_list">
							<a href="{{ route('category.index') }}">
								<i class="fa fa-circle-o"></i> Categories List
							</a>
						</li>
					@endauth
				</ul>
			</li>

			@auth('admin')
				@if($user_enabled === 'true')
					<li class="treeview" id="sidebar_user">
						<a href="#">
							<i class="ion ion-person"></i> <span>Users</span>
							<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li id="user_manage">
								<a href="{{ route('user.index') }}">
									<i class="fa fa-circle-o"></i> Manage Users
								</a>
							</li>
						</ul>
					</li>
				@endif
			@endauth

			@auth('admin')
				<li id="sidebar_setting">
					<a href="{{ route('settings.index') }}">
						<i class="fa fa-cogs"></i> <span>Settings</span>
					</a>
				</li>
			@endauth

			<li>
				<a href="{{ route('auth.logout') }}">
					<i class="ion ion-log-out"></i> <span>Logout</span>
				</a>
			</li>

		</ul>
	</section>
</aside>

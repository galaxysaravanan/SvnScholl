<aside class="main-sidebar sidebar-dark-primary elevation-4">
	<a href="{{ route('dashboard') }}" class="brand-link">
		<img src="{{ asset('/AdminLTELogo.png') }}" class="brand-image img-circle elevation-3">
		<span class="brand-text font-weight-light">{{ config('app.name') }}</span>
	</a>
	<div class="sidebar">
		<nav class="mt-2">
			<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
				<li class="nav-item has-treeview {{ ((request()->segment(1) =='dashboard')) ? 'menu-open' : '' }}">
					<a href="{{ route('dashboard') }}" class="nav-link">
						<i class="nav-icon fas fa-home"></i>
						<p>Dashboard</p>
					</a>
				</li>
				 
		   <li class="nav-item has-treeview {{ ((request()->segment(1) =='courses')) ? 'menu-open' : '' }}">
				<a href="{{ url('admin/courses') }}" class="nav-link">
					<i class="nav-icon fas fa-users"></i>
					<p>Courses</p>
				</a>
			</li>

          <li class="nav-item has-treeview {{ ((request()->segment(1) =='Setting') || request()->is('users')) ? 'menu-open' : '' }}">
				<a href="" class="nav-link">
				  <i class="nav-icon fas fa-cog"></i>
				  <p>
				  Setting
					 <i class="fas fa-angle-left right"></i>
				  </p>
				</a>
				<ul class="nav nav-treeview">
				  <li class="nav-item">
					 <a href="{{ url('admin/permissions') }}" class="nav-link {{ (request()->is('profile')) ? 'active' : '' }}">
						<i class="far fa-circle nav-icon"></i>
						<p>User Permission</p>
					 </a>
				  </li>
				  <li class="nav-item">
					 <a href="{{ url('couress') }}" class="nav-link {{ (request()->is('users')) ? 'active' : '' }}">
						<i class="far fa-circle nav-icon"></i>
						<p>Courses</p>
					 </a>
				  </li>
				</ul>
			</li>

		   <li class="nav-item has-treeview {{ ((request()->segment(1) =='profile') || request()->is('changepassword')) ? 'menu-open' : '' }}">
				<a href="" class="nav-link">
				  <i class="nav-icon fas fa-user"></i>
				  <p>
				  {{ Auth::user()->name; }}
					 <i class="fas fa-angle-left right"></i>
				  </p>
				</a>
				<ul class="nav nav-treeview">
				  <li class="nav-item">
					 <a href="{{ url('admin/profile') }}" class="nav-link {{ (request()->is('profile')) ? 'active' : '' }}">
						<i class="far fas fa-hiking nav-icon"></i>
						<p>Update Profile</p>
					 </a>
				  </li>
				  <li class="nav-item">
					 <a href="{{ url('changepassword') }}" class="nav-link {{ (request()->is('changepassword')) ? 'active' : '' }}">
						<i class="far fas fa-chart-pie nav-icon"></i>
						<p>Change Password</p>
					 </a>
				  </li>
				  <li class="nav-item">
					 <a href="{{ url('logout') }}" class="nav-link ">
						<i class="far fas fa-hourglass-end nav-icon"></i>
						<p>Logout</p>
					 </a>
				  </li>
				</ul>
			</li>
			</ul>
		</nav>
	</div>
</aside>

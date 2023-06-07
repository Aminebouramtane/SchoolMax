<!-- main-sidebar -->
		<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
		<aside class="app-sidebar sidebar-scroll">
			<div class="main-sidebar-header active">
				<a class="mb-3 d-flex desktop-logo logo-light active" href="#"><img src="{{URL::asset('assets/img/graduation-cap.png')}}" class="sign-favicon ht-40" alt="logo"></a>
				{{-- <a class="desktop-logo logo-dark active" href="#"><img src="{{URL::asset('assets/img/graduation-cap.png')}}" class="main-logo dark-theme" alt="logo"></a> --}}
				{{-- <a class="logo-icon mobile-logo icon-light active" href="#">"><img src="{{URL::asset('assets/img/graduation-cap.png')}}" class="logo-icon" alt="logo"></a> --}}
				{{-- <a class="logo-icon mobile-logo icon-dark active" href="#">><img src="{{URL::asset('assets/img/graduation-cap.png')}}" class="logo-icon dark-theme" alt="logo"></a> --}}
			</div>
			<div class="main-sidemenu">
				<ul class="side-menu">
                    @if (auth('web')->check())
                        @include('layouts.main-sidebar.admin-main-sidebar')
                    @endif

                    @if (auth('student')->check())
                        @include('layouts.main-sidebar.student-main-sidebar')
                    @endif

                    @if (auth('teacher')->check())
                        @include('layouts.main-sidebar.teacher-main-sidebar')
                    @endif

                    @if (auth('add_parent')->check())
                        @include('layouts.main-sidebar.parent-main-sidebar')
                    @endif
				</ul>
			</div>
		</aside>
<!-- main-sidebar -->

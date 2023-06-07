<!-- main-header opened -->
			<div class="main-header sticky side-header nav nav-item">
				<div class="container-fluid">
					<div class="main-header-left ">
						<div class="responsive-logo">
							{{-- <a href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('assets/img/graduation-cap.png')}}" class="sign-favicon ht-40" alt="logo"></a> --}}
							<a href="#"><img src="{{URL::asset('assets/img/graduation-cap.png')}}" class="dark-logo-1" alt="logo"></a>
							<a href="#"><img src="{{URL::asset('assets/img/graduation-cap.png')}}" class="logo-2" alt="logo"></a>
							<a href="#"><img src="{{URL::asset('assets/img/graduation-cap.png')}}" class="dark-logo-2" alt="logo"></a>
						</div>
						<div class="app-sidebar__toggle" data-toggle="sidebar">
							<a class="open-toggle" href="#"><i class="header-icon fe fe-align-left" ></i></a>
							<a class="close-toggle" href="#"><i class="header-icons fe fe-x"></i></a>
						</div>
						<div class="main-header-center mr-3 d-sm-none d-md-none d-lg-block">
							<input class="form-control" readonly placeholder="Search for anything..." type="search"> <button class="btn"><i class="fas fa-search d-none d-md-block"></i></button>
						</div>
					</div>
					<div class="main-header-right">
						<ul class="nav">
							<div class="btn-group mb-1">
								<button type="button" class="btn btn-light btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								  @if (App::getLocale() == 'ar')
								  {{ LaravelLocalization::getCurrentLocaleName() }}
								 <img src="{{ URL::asset('assets/img/flags/SA.png') }}" alt="">
								  @else
								  {{ LaravelLocalization::getCurrentLocaleName() }}
								  <img src="{{ URL::asset('assets/img/flags/GB.png') }}" alt="">
								  @endif
								  </button>
								<div class="dropdown-menu">
									@foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
											<a class="dropdown-item" rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
												{{ $properties['native'] }}
											</a>
									@endforeach
								</div>
							</div>
						<div class="nav nav-item  navbar-nav-right ml-auto">
							<div class="nav-link" id="bs-example-navbar-collapse-1">
								<form class="navbar-form" role="search">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="Search">
										<span class="input-group-btn">
											<button type="reset" class="btn btn-default">
												<i class="fas fa-times"></i>
											</button>
											<button type="submit" class="btn btn-default nav-link resp-btn">
												<svg xmlns="http://www.w3.org/2000/svg" class="header-icon-svgs" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
											</button>
										</span>
									</div>
								</form>
							</div>

							<div class="nav-item full-screen fullscreen-button">
								<a class="new nav-link full-screen-link" href="#"><svg xmlns="http://www.w3.org/2000/svg" class="header-icon-svgs" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-maximize"><path d="M8 3H5a2 2 0 0 0-2 2v3m18 0V5a2 2 0 0 0-2-2h-3m0 18h3a2 2 0 0 0 2-2v-3M3 16v3a2 2 0 0 0 2 2h3"></path></svg></a>
							</div>
							<div class="dropdown main-profile-menu nav nav-item nav-link">
                                @if (auth('web')->check())
                                    <a class="profile-user d-flex" href=""><img alt="" src="{{URL::asset('assets/img/admin.png')}}"></a>
                                @endif

                                @if (auth('student')->check())
                                    <a class="profile-user d-flex" href=""><img alt="" src="{{URL::asset('assets/img/student.png')}}"></a>
                                @endif

                                @if (auth('teacher')->check())
                                    <a class="profile-user d-flex" href=""><img alt="" src="{{URL::asset('assets/img/teacher.png')}}"></a>
                                @endif

                                @if (auth('add_parent')->check())
                                    <a class="profile-user d-flex" href=""><img alt="" src="{{URL::asset('assets/img/parent.png')}}"></a>
                                @endif
								<div class="dropdown-menu">
									<div class="main-header-profile bg-primary p-3">
										<div class="d-flex wd-100p">
                                            @if (auth('web')->check())
                                                <a class="profile-user d-flex" href=""><img alt="" src="{{URL::asset('assets/img/admin.png')}}"></a>
                                            @endif

                                            @if (auth('student')->check())
                                                <a class="profile-user d-flex" href=""><img alt="" src="{{URL::asset('assets/img/student.png')}}"></a>
                                            @endif

                                            @if (auth('teacher')->check())
                                                <a class="profile-user d-flex" href=""><img alt="" src="{{URL::asset('assets/img/teacher.png')}}"></a>
                                            @endif

                                            @if (auth('add_parent')->check())
                                                <a class="profile-user d-flex" href=""><img alt="" src="{{URL::asset('assets/img/parent.png')}}"></a>
                                            @endif
											<div class="mr-3 my-auto">

                                                @if (auth('web')->check())
                                                    <h6>{{ Auth::user()->name }}</h6>
                                                @endif

                                                @if (auth('student')->check())
                                                    <h6>{{ App::getLocale()=='en'?Auth::guard('student')->user()->student_name_en:Auth::guard('student')->user()->student_name_ar }}</h6>
                                                @endif

                                                @if (auth('teacher')->check())
                                                    <h6>{{ App::getLocale()=='en'? Auth::guard('teacher')->user()->teacher_name_en:Auth::guard('teacher')->user()->teacher_name_ar }}</h6>
                                                @endif

                                                @if (auth('add_parent')->check())
                                                    <h6>{{ App::getLocale()=='en'? Auth::guard('add_parent')->user()->parent_name_en:Auth::guard('add_parent')->user()->parent_name_ar }}</h6>
                                                @endif
											</div>
										</div>
									</div>
                                    @if(auth('student')->check())
                                        <form method="GET" action="{{ route('logout','student') }}">
                                            @elseif(auth('teacher')->check())
                                                <form method="GET" action="{{ route('logout','teacher') }}">
                                             @elseif(auth('add_parent')->check())
                                                <form method="GET" action="{{ route('logout','add_parent') }}">
                                            @else
                                                <form method="GET" action="{{ route('logout','web') }}">
                                    @endif
                                            @csrf
                                            <a class="dropdown-item" onclick="event.preventDefault();this.closest('form').submit();" href="#"><i class="bx bx-log-out"></i>{{App::getLocale()=='en'?'Sign Out':'تسجيل الخروج'}}</a>
                                        </form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
<!-- /main-header -->

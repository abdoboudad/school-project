<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Limitless - Responsive Web Application Kit by Eugene Kopyov</title>

	<!-- Global stylesheets -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
	<link href={{ url('assets/css/icons/icomoon/styles.css') }} rel="stylesheet" type="text/css">
	<link href={{ url('assets/css/bootstrap.css') }} rel="stylesheet" type="text/css">
	<link href={{ url('assets/css/core.css') }} rel="stylesheet" type="text/css">
	<link href={{ url('assets/css/components.css') }} rel="stylesheet" type="text/css">
	<link href={{ url('assets/css/colors.css') }} rel="stylesheet" type="text/css">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.css" rel="stylesheet">

	<!-- /global stylesheets -->

	<!-- Core JS files -->
	<script type="text/javascript" src={{ url('assets/js/plugins/loaders/pace.min.js') }}></script>
	<script type="text/javascript" src={{ url('assets/js/core/libraries/jquery.min.js') }}></script>
	<script type="text/javascript" src={{ url('assets/js/core/libraries/bootstrap.min.js') }}></script>
	<script type="text/javascript" src={{ url('assets/js/plugins/loaders/blockui.min.js"') }}></script>
	<!-- /core JS files -->

	<!-- Theme JS files -->
	<script type="text/javascript" src={{ url('assets/js/plugins/visualization/d3/d3.min.js') }}></script>
	<script type="text/javascript" src={{ url('assets/js/plugins/visualization/d3/d3_tooltip.js') }}></script>
	<script type="text/javascript" src={{ url('assets/js/plugins/forms/styling/switchery.min.js') }}></script>
	<script type="text/javascript" src={{ url('assets/js/plugins/forms/styling/uniform.min.js') }}></script>
	<script type="text/javascript" src={{ url('assets/js/plugins/forms/selects/bootstrap_multiselect.js') }}></script>
	<script type="text/javascript" src={{ url('assets/js/plugins/ui/moment/moment.min.js') }}></script>
	<script type="text/javascript" src={{ url('assets/js/plugins/pickers/daterangepicker.js') }}></script>

	<script type="text/javascript" src={{ url('assets/js/core/app.js') }}></script>
	<script type="text/javascript" src={{ url('assets/js/pages/dashboard.js') }}></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.js"></script>

	<!-- /theme JS files -->

</head>

<body>

	<!-- Main navbar -->
	<div class="navbar navbar-inverse">
		<div class="navbar-header">
			<a class="navbar-brand" href="index.html"><img src="assets/images/logo_light.png" alt=></a>

			<ul class="nav navbar-nav visible-xs-block">
				<li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
				<li><a class="sidebar-mobile-main-toggle"><i class="icon-paragraph-justify3"></i></a></li>
			</ul>
		</div>

		<div class="navbar-collapse collapse" id="navbar-mobile">
			<ul class="nav navbar-nav">
				<li><a class="sidebar-control sidebar-main-toggle hidden-xs"><i class="icon-paragraph-justify3"></i></a></li>

				
			</ul>

			<ul class="nav navbar-nav navbar-right">		

				<li class="dropdown dropdown-user">
					<a class="dropdown-toggle" data-toggle="dropdown">
                        @if (Auth::check())
                            <span>{{ auth()->user()->name }}</span>
                        @else
                            <span>victoria</span>
                        @endif
						<i class="caret"></i>
					</a>

					<ul class="dropdown-menu dropdown-menu-right">
						<li><a href={{ route('profile',auth()->user()->name) }}><i class="icon-user-plus"></i> My profile</a></li>
						<li class="divider"></li>
						<li>
                            <form action="{{ route('logout') }}" method="post">
                                @csrf
                                <button style="background-color: transparent;border:0;padding:5px 15px;width:100%;text-align:start;" type="submit"><i class="icon-switch2"></i> Logout</button>                        
                            </form>    
                        </li>   
					</ul>
				</li>
			</ul>
		</div>
	</div>
	<!-- /main navbar -->


	<!-- Page container -->
	<div class="page-container">

		<!-- Page content -->
		<div class="page-content">

			<!-- Main sidebar -->
			<div class="sidebar sidebar-main">
				<div class="sidebar-content">

					<!-- User menu -->
					<div class="sidebar-user">
						<div class="category-content">
							<div class="media">
								
								<div class="media-body">
                                    @if (Auth::check())
                                        <span class="media-heading text-semibold">{{ auth()->user()->name }} </span>
                                        <div class="text-size-mini text-muted">
                                            <i class="icon-user text-size-small"></i><span style="margin-left: 5px;">{{ auth()->user()->role }}</span> 
                                        </div>
                                    @else
                                        <span class="media-heading text-semibold">Victoria Baker</span>
                                        <div class="text-size-mini text-muted">
                                            <i class="icon-user text-size-small"></i> &nbsp;Santa Ana, CA
                                        </div>
                                    @endif
									
								</div>

								<div class="media-right media-middle">
									<ul class="icons-list">
										<li>
											<a href={{ route('profile',Auth::user()->name) }}><i class="icon-cog3"></i></a>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
					<!-- /user menu -->


					<!-- Main navigation -->
					<div class="sidebar-category sidebar-category-visible">
						<div class="category-content no-padding">
							<ul class="navigation navigation-main navigation-accordion">
								@if (Auth::user()->role == 'admin')
										<!-- Main -->
									<li class="navigation-header"><span>Main</span> <i class="icon-menu" title="Main pages"></i></li>
									<li class="active"><a href={{ route('admin') }}><i class="icon-home4"></i> <span>Control Panel</span></a></li>
									<li>
										<a href="#"><i class="icon-bookmark"></i> <span>les matières</span></a>
										<ul>
											<li><a href="{{ route('subjects.create') }}" id="layout1">Crèe une matière</a></li>
										</ul>
									</li>
									
									<li>
										<a href='#'><i class="icon-stack3"></i> <span>les niveaux</span></a>
										<ul>
											<li><a href={{ route('levels.index') }}>Gestion des niveaux</a></li>
											<li><a href={{ route('levels.create') }}>Créer un niveau</a></li>
										</ul>
									</li>
									<li>
										<a href='#'><i class=" icon-stack"></i> <span>les classes</span></a>
										<ul>
											<li><a href={{ route('sections.create') }}>Créer une classe</a></li>
										</ul>
									</li>
									<li>
										<a href='#'><i class="icon-book"></i> <span>les Cours</span></a>
										<ul>
											<li><a href="{{ route('courses.create') }}" id="layout1">Crèe un cours</a></li>
										</ul>
									</li>
									<li>
										<a href='#'><i class="icon-file-empty2"></i> <span>les Examens</span></a>
										<ul>
											<li><a href="{{ route('courses.create') }}" id="layout1">Crèe un examen</a></li>
										</ul>
									</li>
									<!-- /main -->

									<!-- Forms -->
									<li class="navigation-header"><span>Forms</span> <i class="icon-menu" title="Forms"></i></li>
								
									<li>
										<a href="#"><i class="icon-users"></i> <span>les Utilisateurs</span></a>
										<ul>
											<li><a href={{ route('users.index') }}> Gestion des utilisateurs
											</a></li>

											<li><a href={{ route('users.create') }}>Créer un compte </a></li>
										</ul>
									</li>
								@endif
								@if (Auth::user()->role == 'teacher')
									<li>
										<a href='#'><i class="icon-book"></i> <span>les Cours</span></a>
										<ul>
											<li><a href="{{ route('courses.create') }}" id="layout1">Crèe un cours</a></li>
										</ul>
									</li>
									<li>
										<a href='#'><i class="icon-file-empty2"></i> <span>les Examens</span></a>
										<ul>
											<li><a href="{{ route('courses.create') }}" id="layout1">Crèe un examen</a></li>
										</ul>
									</li>
								@endif
								{{-- student --}}
								@if (Auth::user()->role === 'student')
									<li>
										<a href='#'><i class="icon-book"></i> <span>les Cours</span></a>
										<ul>
											<li><a href="{{ route('learn.subjects') }}" id="layout1">me cours</a></li>
										</ul>
									</li>
									<li>
										<a href='#'><i class="icon-file-empty2"></i> <span>les Examens</span></a>
										<ul>
											<li><a href="{{ route('learn.examsub') }}" id="layout1">me examen</a></li>
										</ul>
									</li>
									<li>
										<a href="{{ route('profile',auth()->user()->name) }}"><i class="icon-user"></i> <span>Mon Profile</span></a>
									</li>
								@endif
								

							</ul>
						</div>
					</div>
					<!-- /main navigation -->

				</div>
			</div>
			<!-- /main sidebar -->


			<!-- Main content -->
			<div class="content-wrapper">

				<!-- Page header -->
				<div class="page-header">
					<div class="page-header-content">
						<div class="page-title">
							<h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Home</span> - {{ str_replace(".", "  -  ", \Route::currentRouteName()); 
							}}</h4>
						</div>

						<div class="heading-elements">
							<div class="heading-btn-group">
								@if (\Route::currentRouteName() == 'sections.sectionsfind')
								<a href={{ route('sections.create') }} class="btn btn-link btn-float has-text"><i class="icon-plus3 text-primary"></i><span>Créé une classe</span></a>
								@else
								
								@endif
								@if (\Route::currentRouteName() == 'subjects.subjectsfind')
								<a href={{ route('subjects.create') }} class="btn btn-link btn-float has-text"><i class="icon-plus3 text-primary"></i><span>Créé une matiére</span></a>
								@else
								
								@endif
								
						</div>
						</div>
					</div>

					<div class="breadcrumb-line">
						<ul class="breadcrumb">
							<li><a href={{ route('admin') }}><i class="icon-home2 position-left"></i> Home</a></li>
							<li class="active">{{ str_replace(".", "  /  ", \Route::currentRouteName()); 
							}}</li>
						</ul>

						
					</div>
				</div>
				<!-- /page header -->


				<!-- Content area -->
				<div class="content">

					<!-- Main charts -->
					
					<!-- /main charts -->


					<!-- Dashboard content -->
						@yield('content')
					<!-- /dashboard content -->


					<!-- Footer -->
					
					<!-- /footer -->

				</div>
				<!-- /content area -->

			</div>
			<!-- /main content -->

		</div>
		<!-- /page content -->

	</div>
	<!-- /page container -->

</body>
</html>

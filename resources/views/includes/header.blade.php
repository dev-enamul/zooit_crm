<style>
    .unread_notice{
       background:  var(--bs-light) !important;
    }
</style>
<header id="page-topbar">
    @php
        $user = \App\Models\User::find(auth()->id());
    @endphp
    <div class="navbar-header">  
        <!-- Start Navbar-Brand -->
        <div class="navbar-logo-box">
            <a href="{{route('index')}}" class="logo logo-dark">
                <span class="logo-sm">
                    <img src="{{asset('assets/images/logo-sm.png')}}" alt="logo-sm-dark" height="40px">
                </span>
                <span class="logo-lg">
                    <img src="{{asset('assets/images/logo-dark.png')}}" alt="logo-dark" height="40px">
                </span>
            </a>

            <a href="{{route('index')}}" class="logo logo-light">
                <span class="logo-sm">
                    <img src="{{asset('assets/images/logo-sm.png')}}" alt="logo-sm-light" height="40px">
                </span>
                <span class="logo-lg">
                    <img src="{{asset('assets/images/logo-dark.png')}}" alt="logo-light" height="40px">
                </span>
            </a>

            <button type="button" class="btn btn-sm top-icon sidebar-btn" id="sidebar-btn">
                <i class="mdi mdi-menu-open align-middle fs-19"></i>
            </button>
        </div>
        <!-- End navbar brand -->

        <!-- Start menu -->
        <div class="d-flex justify-content-between menu-sm px-3 ms-auto">
            <div class="d-flex align-items-center gap-2">
                <div class="dropdown d-none d-lg-block">
                    <button type="button" class="btn btn-primary btn-sm fs-14 d-inline" id="light-dark-mode">
                        <i class="mdi mdi-brightness-7 align-middle"></i>
                    </button>  
                </div>

                <div class="dropdown d-none d-lg-block">
                    <button type="button" class="btn btn-primary btn-sm fs-14 d-inline" data-toggle="fullscreen">
                        <i class="mdi mdi-arrow-expand-all align-middle"></i>
                    </button>  
                </div> 
            </div>

            <div class="d-flex align-items-center gap-2"> 
                <!-- Start Notification --> 

                <form action="{{route('search')}}" class="app-search pb-0">
                    <div class="position-relative">
                        <input type="text" class="form-control" name="key" placeholder="Search ">
                        <span class="fab fa-sistrix fs-17 align-middle"></span>
                    </div>
                </form>

                @php
                    $notifications = \App\Models\NotificationUser::where('user_id',auth()->id()) 
                    ->latest()
                    ->take(6)
                    ->get();
                    $unread_notification = $notifications->where('read_at',null)->count();
                    if($unread_notification>9){
                        $unread_notification = '9+';
                    }

                @endphp
                <div class="dropdown d-inline-block">
                    <button type="button" class="btn btn-sm top-icon " id="page-header-notifications-dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-bell align-middle"></i>
                        <span class="btn-marker btn btn-primary btn-sm {{$unread_notification<=0?'d-none':''}}">{{$unread_notification}}<span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-md dropdown-menu-end p-0" aria-labelledby="page-header-notifications-dropdown">
                        <div class="p-3 bg-info">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h6 class="text-white m-0"><i class="far fa-bell me-2"></i> Notifications </h6>
                                </div>
                                <div class="col-auto">
                                    <a href="#!" class="badge bg-info-subtle text-info"> {{$unread_notification}}</a>
                                </div>
                            </div>
                        </div>
                        <div data-simplebar style="max-height: 230px;">
                            @foreach ($notifications as $notification)
                            <a href="{{route('notification.read',$notification->id)}}" class="text-reset notification-item bg-light">
                                <div class="d-flex {{$notification->read_at==null?'unread_notice':''}}">
                                    <div class="avatar avatar-xs avatar-label-primary me-3">
                                        <span class="rounded fs-16">
                                            <i class="mdi mdi-file-document-outline"></i>
                                        </span>
                                    </div>
                                    <div class="flex-1">
                                        <h6 class="mb-1">{{@$notification->notification->title}}</h6>
                                        <div class="fs-12 text-muted">
                                            <p class="mb-0"><i class="mdi mdi-clock-outline"></i> {{@$notification->created_at->diffForHumans();}}</p>
                                        </div>
                                    </div>
                                    <i class="mdi mdi-chevron-right align-middle ms-2"></i>
                                </div>
                            </a>
                            @endforeach
                            
                        </div>
                        <div class="p-2 border-top">
                            <div class="d-grid">
                                <a class="btn btn-sm btn-link font-size-14 text-center" href="{{route('notification.index')}}">
                                    <i class="mdi mdi-arrow-right-circle me-1"></i> View More..
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Start Profile -->
                <div class="dropdown d-inline-block">
                    <button type="button" class="btn btn-sm top-icon p-0" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img class="rounded avatar-2xs p-0" src="{{ $user->image()}}" alt="Header Avatar">
                    </button>
                    <div class="dropdown-menu dropdown-menu-wide dropdown-menu-end dropdown-menu-animated overflow-hidden py-0">
                        <div class="card border-0">
                            <div class="card-header bg-primary rounded-0">
                                <div class="rich-list-item w-100 p-0">
                                    <div class="rich-list-prepend">
                                        <div class="avatar avatar-label-light avatar-circle">
                                            <div class="avatar-display"><i class="fa fa-user-alt"></i></div>
                                        </div>
                                    </div>
                                    <div class="rich-list-content">
                                        <h3 class="rich-list-title text-white">{{auth()->user()->name}}</h3>
                                        <span class="rich-list-subtitle text-white">{{auth()->user()->phone}}</span>
                                    </div>
                                    {{-- <div class="rich-list-append"><span class="badge badge-label-light fs-6">6+</span></div> --}}
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div class="grid-nav grid-nav-flush grid-nav-action grid-nav-no-rounded">
                                    <div class="grid-nav-row">
                                        <a href="{{route('profile',encrypt(auth()->user()->id))}}" class="grid-nav-item">
                                            <div class="grid-nav-icon"><i class="far fa-address-card"></i></div>
                                            <span class="grid-nav-content">Profile</span>
                                        </a>

                                        <a href="{{route('profile.wallet',encrypt(auth()->user()->id))}}" class="grid-nav-item">
                                            <div class="grid-nav-icon"><i class="far fa-comments"></i></div>
                                            <span class="grid-nav-content">Wallet</span>
                                        </a>
                                        <a href="{{route('training.schedule')}}" class="grid-nav-item">
                                            <div class="grid-nav-icon"><i class="far fa-clone"></i></div>
                                            <span class="grid-nav-content">Event</span>
                                        </a>
                                    </div>
                                    <div class="grid-nav-row">
                                        <a href="{{route('my.task')}}" class="grid-nav-item">
                                            <div class="grid-nav-icon"><i class="far fa-calendar-check"></i></div>
                                            <span class="grid-nav-content">Tasks</span>
                                        </a>
                                        <a href="{{route('index')}}" class="grid-nav-item">
                                            <div class="grid-nav-icon"><i class="far fa-sticky-note"></i></div>
                                            <span class="grid-nav-content">Dashboard</span>
                                        </a>
                                        <a href="{{route('profile.target.achive',encrypt(auth()->user()->id))}}" class="grid-nav-item">
                                            <div class="grid-nav-icon"><i class="far fa-sticky-note"></i></div>
                                            <span class="grid-nav-content">Achivement</span>
                                        </a>
                                    </div>
                                </div>
                            </div> 
  
                            <div class="card-footer card-footer-bordered rounded-0">
                                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="btn btn-label-danger">Sign out</a></a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Profile -->
            </div>
        </div>
        <!-- End menu -->
    </div>
</header>
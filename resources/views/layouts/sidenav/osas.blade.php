<div id="sidebar" class="sidebar">
    <!-- begin sidebar scrollbar -->
    <div data-scrollbar="true" data-height="100%">
        <!-- begin sidebar user -->
        <ul class="nav">
            <li class="nav-profile">
                <a href="javascript:;" data-toggle="nav-profile">
                    <div class="cover with-shadow"></div>
                    <div class="image">
                        <img src="{{ Avatar::create(Auth::user()->name)->toBase64() }}" alt="" />
                    </div>
                    <div class="info">
                        <b class="caret pull-right"></b>
                        {{Auth::user()->name}}
                        <small>{{\App\r_role::where('role_id',Auth::user()->role_id)->first()->desc}}</small>
                    </div>
                </a>
            </li>
            <li>
                <ul class="nav nav-profile">
                    <li><a href="javascript:;"><i class="fa fa-cog"></i> Settings</a></li>
                    <li><a href="javascript:;"><i class="fa fa-pencil-alt"></i> Send Feedback</a></li>
                    <li><a href="javascript:;"><i class="fa fa-question-circle"></i> Helps</a></li>
                </ul>
            </li>
        </ul>
        <!-- end sidebar user -->
        <!-- begin sidebar nav -->
        <ul class="nav">
            <li class="nav-header">Navigation</li>

            <li class="{{Request::is('dashboard')?'active':''}}">
                <a href="{{url('dashboard')}}">
                    <i class="fa fa-th"></i>
                    <span>Dashboard </span>
                </a>
            </li>
            <li class="has-sub {{(Request::is('student')||Route::is('sanction')||Request::is('assistance'))?'active':''}}">
                <a href="javascript:;">
                    <b class="caret"></b>
                    <i class="fa fa-graduation-cap"></i>
                    <span>Students</span>
                </a>
                <ul class="sub-menu">
                    <li class="{{Request::is('student')?'active':''}}"><a href="{{url('student')}}">List of Students</a></li>
                    <li class="{{Route::is('sanction')?'active':''}}"><a href="{{url('sanction')}}">Sanctions</a></li>
                    <li class="{{Request::is('assistance')?'active':''}}"><a href="{{url('assistance')}}">Financial Assistance</a></li>

                </ul>
            </li>
            <li class="has-sub {{(Request::is('voucher')||Request::is('remittance'))?'active':''}}">
                <a href="javascript:;">
                    <b class="caret"></b>
                    <i class="fa fa-envelope"></i>
                    <span>Organization Financials</span>
                </a>
                <ul class="sub-menu">
                    <li class="{{Request::is('voucher')?'active':''}}"><a href="{{url('voucher')}}">Voucher</a></li>
                    <li class="{{Request::is('remittance')?'active':''}}"><a href="{{url('remittance')}}">Remittance</a></li>

                </ul>
            </li>

            <li class="has-sub {{(Route::is('event-pending')||Route::is('event-finished')||Route::is('assistance'))?'active':''}}">
                <a href="javascript:;">
                    <b class="caret"></b>
                    <i class="fa fa-folder"></i>
                    <span>Organization Events</span>
                </a>
                <ul class="sub-menu">
                    <li class="{{Route::is('event-pending')?'active':''}}"><a href="{{url('event-pending')}}">Pending Events</a></li>
                    <li class="{{Route::is('event-finished')?'active':''}}"><a href="{{url('event-finished')}}">Finished Events</a></li>

                </ul>
            </li>

            <li class="{{Request::is('announcement')?'active':''}}">
                <a href="{{url('announcement')}}">
                    <i class="fa fa-bell"></i>
                    <span>Announcements</span>
                </a>
            </li>





            <!-- begin sidebar minify button -->
            <li><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i class="fa fa-angle-double-left"></i></a></li>
            <!-- end sidebar minify button -->
        </ul>
        <!-- end sidebar nav -->
    </div>
    <!-- end sidebar scrollbar -->
</div>
<div class="sidebar-bg"></div>

 <!-- Main Wrapper -->
 <div class="main-wrapper">

   <!-- Header -->
   <div class="header">

     <!-- Logo -->
     <div class="header-left">
       <a href="index_admin" class="logo">
         <img src="/assets_admin/img/logo.png" alt="Logo">
       </a>
       <a href="index_admin" class="logo logo-small">
         <img src="/assets_admin/img/logo-small.png" alt="Logo" width="30" height="30">
       </a>
     </div>
     <!-- /Logo -->

     <a href="javascript:void(0);" id="toggle_btn">
       <i class="fe fe-text-align-left"></i>
     </a>

     <div class="top-nav-search">
       <form>
         <input type="text" class="form-control" placeholder="Search here">
         <button class="btn" type="submit"><i class="fa fa-search"></i></button>
       </form>
     </div>

     <!-- Mobile Menu Toggle -->
     <a class="mobile_btn" id="mobile_btn">
       <i class="fa fa-bars"></i>
     </a>
     <!-- /Mobile Menu Toggle -->

     <!-- Header Right Menu -->
     <ul class="nav user-menu">

       <!-- Notifications -->
       <li class="nav-item dropdown noti-dropdown">
         <a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
           <i class="fe fe-bell"></i> <span class="badge badge-pill">3</span>
         </a>
         <div class="dropdown-menu notifications">
           <div class="topnav-dropdown-header">
             <span class="notification-title">Notifications</span>
             <a href="javascript:void(0)" class="clear-noti"> Clear All </a>
           </div>
           <div class="noti-content">
             <ul class="notification-list">
               <li class="notification-message">
                 <a href="#">
                   <div class="media">
                     <span class="avatar avatar-sm">
                       <img class="avatar-img rounded-circle" alt="User Image" src="/assets_admin/img/user/user.jpg">
                     </span>
                     <div class="media-body">
                       <p class="noti-details"><span class="noti-title">Jonathan Doe</span> Schedule <span
                           class="noti-title">his appointment</span></p>
                       <p class="noti-time"><span class="notification-time">4 mins ago</span></p>
                     </div>
                   </div>
                 </a>
               </li>
               <li class="notification-message">
                 <a href="#">
                   <div class="media">
                     <span class="avatar avatar-sm">
                       <img class="avatar-img rounded-circle" alt="User Image" src="/assets_admin/img/user/user1.jpg">
                     </span>
                     <div class="media-body">
                       <p class="noti-details"><span class="noti-title">Julie Pennington</span> has booked her
                         appointment to <span class="noti-title">Ruby Perrin</span></p>
                       <p class="noti-time"><span class="notification-time">6 mins ago</span></p>
                     </div>
                   </div>
                 </a>
               </li>
               <li class="notification-message">
                 <a href="#">
                   <div class="media">
                     <span class="avatar avatar-sm">
                       <img class="avatar-img rounded-circle" alt="User Image" src="/assets_admin/img/user/user2.jpg">
                     </span>
                     <div class="media-body">
                       <p class="noti-details"><span class="noti-title">Tyrone Roberts</span> sent a amount of $210 for
                         his <span class="noti-title">appointment</span></p>
                       <p class="noti-time"><span class="notification-time">8 mins ago</span></p>
                     </div>
                   </div>
                 </a>
               </li>
               <li class="notification-message">
                 <a href="#">
                   <div class="media">
                     <span class="avatar avatar-sm">
                       <img class="avatar-img rounded-circle" alt="User Image" src="/assets_admin/img/user/user4.jpg">
                     </span>
                     <div class="media-body">
                       <p class="noti-details"><span class="noti-title">Patricia Manzi</span> send a message <span
                           class="noti-title"> to his Mentee</span></p>
                       <p class="noti-time"><span class="notification-time">12 mins ago</span></p>
                     </div>
                   </div>
                 </a>
               </li>
             </ul>
           </div>
           <div class="topnav-dropdown-footer">
             <a href="#">View all Notifications</a>
           </div>
         </div>
       </li>
       <!-- /Notifications -->

       <!-- User Menu -->
       <li class="nav-item dropdown has-arrow">
         @if (Auth::check())
           <!-- 检查用户是否登录 -->
           <a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
             <span class="user-img">
               <img src="{{ asset('storage/' . (Auth::user()->avatar_path ?? 'default-avatar.jpg')) }}" width="31"
                 alt="{{ Auth::user()->first_name }}">
             </span>
           </a>
           <div class="dropdown-menu">
             <div class="user-header">
               <div class="avatar avatar-sm">
                 <img src="{{ asset('storage/' . (Auth::user()->avatar_path ?? 'default-avatar.jpg')) }}"
                   width="50" alt="User Image" class="avatar-img">
               </div>
               <div class="user-text">
                 <h6>{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</h6> <!-- 添加了 last_name -->
                 <p class="text-muted mb-0">Administrator</p>
               </div>
             </div>
             <a class="dropdown-item" href="{{ route('profile', ['id' => Auth::id()]) }}">My Profile</a>
             <a class="dropdown-item" href="settings">Settings</a>
             <a class="dropdown-item" href="{{ route('admin-logout') }}">{{ __('logout') }}</a>
           </div>
         @else
           <!-- 可以添加未登录时的处理逻辑，如登录链接等 -->
         @endif
       </li>
       <!-- /User Menu -->


     </ul>
     <!-- /Header Right Menu -->

   </div>
   <!-- /Header -->

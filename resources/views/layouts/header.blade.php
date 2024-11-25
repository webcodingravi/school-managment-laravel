<nav class="main-header navbar navbar-expand navbar-light navbar-light sticky-top">
  <!-- Right navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>					
  </ul>
  <div class="navbar-nav pl-2">
    <!-- <ol class="breadcrumb p-0 m-0 bg-white">
      <li class="breadcrumb-item active">Dashboard</li>
    </ol> -->
  </div>
  
  <ul class="navbar-nav ml-auto">
    <li class="nav-item">
      <a class="nav-link" data-widget="fullscreen" href="#" role="button">
        <i class="fas fa-expand-arrows-alt"></i>
      </a>
    </li>


    <li class="nav-item dropdown">
      <a class="nav-link p-0 pr-3" data-toggle="dropdown" href="#">
        <img src="{{asset('uploads/profile_pic/thumb/'.Auth::user()->profile_pic)}}" class='img-circle elevation-2' width="40" height="40" alt="">

      </a>
      <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-3">
        <h4 class="h4 mb-0"><strong>{{Auth::user()->name}}</strong></h4>
        <div class="mb-3">{{Auth::user()->email}}</div>
        <div class="dropdown-divider"></div>

      
        <div class="dropdown-divider"></div>
      
        @if (Auth::user()->user_type == 1)
        <a href="{{route('MyProfileAdmin')}}" class="dropdown-item">
          <i class="fas fa-user mr-2"></i>My Profile							
        </a>
        
        <a href="{{route('MyAccount.admin')}}" class="dropdown-item">
          <i class="fas fa-cogs mr-2"></i>Account Settings								
        </a>
        <a href="{{route('admin.changePassword')}}" class="dropdown-item">
          <i class="fas fa-lock mr-2"></i> Change Password
        </a>
        @elseif (Auth::user()->user_type == 2)
        <a href="{{route('MyProfile')}}" class="dropdown-item">
          <i class="fas fa-user mr-2"></i>My Profile							
        </a>
        <a href="{{route('MyAccount.teacher')}}" class="dropdown-item">
          <i class="fas fa-cogs mr-2"></i>Account Settings								
        </a>

        <a href="{{route('teacher.changePassword')}}" class="dropdown-item">
          <i class="fas fa-lock mr-2"></i> Change Password
        </a>
        @elseif (Auth::user()->user_type == 3)
        <a href="{{route('MyProfile.Student')}}" class="dropdown-item">
          <i class="fas fa-user mr-2"></i>My Profile							
        </a>
        <a href="{{route('MyAccount')}}" class="dropdown-item">
          <i class="fas fa-cogs mr-2"></i>Account Settings								
        </a>

        <a href="{{route('student.changePassword')}}" class="dropdown-item">
          <i class="fas fa-lock mr-2"></i> Change Password
        </a>
        @elseif (Auth::user()->user_type == 4)
        <a href="{{route('MyProfile.Parent')}}" class="dropdown-item">
          <i class="fas fa-user mr-2"></i>My Profile							
        </a>

        <a href="{{route('MyAccount')}}" class="dropdown-item">
          <i class="fas fa-cogs mr-2"></i>Account Settings								
        </a>

        <a href="{{route('parent.changePassword')}}" class="dropdown-item">
          <i class="fas fa-lock mr-2"></i> Change Password
        </a>
        @endif
      
       
        <div class="dropdown-divider"></div>
        <a href="{{route('logout')}}" class="dropdown-item text-danger">
          <i class="fas fa-sign-out-alt mr-2"></i> Logout							
        </a>							
      </div>
    </li>
  </ul>
</nav>
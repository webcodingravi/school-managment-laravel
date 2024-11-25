			<!-- Brand Logo -->
      <div class="company_name d-flex align-items-center justify-content-center">
        <h2 class="fs-4 my-2"><span class="text-primary">School</span> Management</h2>
      </div>
   
      <a href="#" class="brand-link">
        <img src="{{asset('uploads/profile_pic/thumb/'.Auth::user()->profile_pic)}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-dark">{{Auth::user()->name}} {{Auth::user()->last_name}}</span>
      </a>
      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            @if (Auth::user()->user_type == 1)
            <li class="nav-item">
              <a href="{{route('admin.dashboard')}}" class="nav-link {{(Request::segment(2) == 'dashboard') ? 'active' : ''}}">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>Dashboard</p>
              </a>																
            </li>
            <li class="nav-item">
              <a href="{{route('admin.list')}}" class="nav-link {{(Request::segment(2) == 'admin') ? 'active' : ''}}">
                <i class="nav-icon fas fa-users"></i>
                <p>Admin</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="{{route('teacher.list')}}" class="nav-link {{(Request::segment(2) == 'teacher') ? 'active' : ''}}">
                <i class="nav-icon fas fa-user"></i>
                <p>Teacher</p>
              </a>
            </li>


            <li class="nav-item">
              <a href="{{route('student.list')}}" class="nav-link {{(Request::segment(2) == 'student') ? 'active' : ''}}">
                <i class="nav-icon fas fa-user"></i>
                <p>Student</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="{{route('parent.list')}}" class="nav-link {{(Request::segment(2) == 'parent') ? 'active' : ''}}">
                <i class="nav-icon fas fa-user"></i>
                <p>Parent</p>
              </a>
            </li>

              <li class="nav-item {{(Request::segment(2) == 'class' || Request::segment(2) == 'subject' || 
              Request::segment(2) == 'assign_subject' || Request::segment(2) == 'assign-class-teacher' || Request::segment(2) == 'class-timetable') ? 'menu-is-opening menu-open' : ''}}">

                <a href="#" class="nav-link {{(Request::segment(2) == 'class' || Request::segment(2) == 'subject' || 
              Request::segment(2) == 'assign_subject' || Request::segment(2) == 'assign-class-teacher') ? 'active' : '' || Request::segment(2) == 'class_timetable'}}">

                <i class="nav-icon fas fa-table"></i>
                <p>
                  Academics
                  <i class="fas fa-angle-left right"></i>
                </p>
               
              </a>
              <ul class="nav nav-treeview">
                 <li class="nav-item">
                  <a href="{{route('class.list')}}" class="nav-link {{(Request::segment(2) == 'class') ? 'active' : ''}}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Class</p>
                  </a>
                 </li>
                 <li class="nav-item">
                  <a href="{{route('subject.list')}}" class="nav-link {{(Request::segment(2) == 'subject') ? 'active' : ''}}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Subject</p>
                  </a>
                 </li>

                 <li class="nav-item">
                  <a href="{{route('assign_subject.list')}}" class="nav-link {{(Request::segment(2) == 'assign_subject') ? 'active' : ''}}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Assign Subject</p>
                  </a>
                 </li>


                 <li class="nav-item">
                  <a href="{{route('class-timetable.list')}}" class="nav-link {{(Request::segment(2) == 'class-timetable') ? 'active' : ''}}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Class Timetable</p>
                  </a>
                 </li>

                 
                 <li class="nav-item">
                  <a href="{{route('assign-class-teacher.list')}}" class="nav-link {{(Request::segment(2) == 'assign-class-teacher') ? 'active' : ''}}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Assign Class Teacher</p>
                  </a>
                 </li>
              </ul>
            </li>


            <li class="nav-item {{(Request::segment(2) == 'examination' || Request::segment(2) == 'examination') ? 'menu-is-opening menu-open' : ''}}">

                <a href="#" class="nav-link {{(Request::segment(2) == 'examination' || Request::segment(2) == 'examination') ? 'active' : '' || Request::segment(2) == 'class_timetable'}}">

                <i class="nav-icon fas fa-table"></i>
                <p>
                 Examination
                  <i class="fas fa-angle-left right"></i>
                </p>
               
              </a>
              <ul class="nav nav-treeview">
                 <li class="nav-item">
                  <a href="{{route('exam.list')}}" class="nav-link {{(Request::segment(2) == 'exam') ? 'active' : ''}}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Exam List</p>
                  </a>
                 </li>
    
              </ul>
            </li>



              @elseif (Auth::user()->user_type == 2)
              <li class="nav-item">
                <a href="{{route('teacher.dashboard')}}" class="nav-link {{(Request::segment(2) == 'dashboard') ? 'active' : ''}}">
                  <i class="nav-icon fas fa-tachometer-alt"></i>
                  <p>Dashboard</p>
                </a>																
              </li>
              
              <li class="nav-item">
                <a href="{{route('my_student')}}" class="nav-link {{(Request::segment(2) == 'my-student') ? 'active' : ''}}">
                  <i class="nav-icon fas fa-user"></i>
                  <p>My Student</p>
                </a>																
              </li>

              <li class="nav-item">
                <a href="{{route('my_class_subject')}}" class="nav-link {{(Request::segment(2) == 'my-class-subject') ? 'active' : ''}}">
                  <i class="nav-icon fas fa-user"></i>
                  <p>My Class & Subject</p>
                </a>																
              </li>
              
           
              @elseif (Auth::user()->user_type == 3)
              <li class="nav-item">
                <a href="{{route('student.dashboard')}}" class="nav-link {{(Request::segment(2) == 'dashboard') ? 'active' : ''}}">
                  <i class="nav-icon fas fa-tachometer-alt"></i>
                  <p>Dashboard</p>
                </a>																
              </li>

              <li class="nav-item">
                <a href="{{route('MySubject')}}" class="nav-link {{(Request::segment(2) == 'my-subject') ? 'active' : ''}}">
                  <i class="nav-icon fas fa-user"></i>
                  <p>My Subject</p>
                </a>																
              </li>

              <li class="nav-item">
                <a href="{{route('MyTimetable')}}" class="nav-link {{(Request::segment(2) == 'my-timetable') ? 'active' : ''}}">
                  <i class="nav-icon fas fa-user"></i>
                  <p>My Timetable</p>
                </a>																
              </li>
          
              @elseif (Auth::user()->user_type == 4)
              <li class="nav-item">
                <a href="{{route('parent.dashboard')}}" class="nav-link {{(Request::segment(2) == 'dashboard') ? 'active' : ''}}">
                  <i class="nav-icon fas fa-tachometer-alt"></i>
                  <p>Dashboard</p>
                </a>																
              </li>

              <li class="nav-item">
                <a href="{{route('MyStudentParent')}}" class="nav-link {{(Request::segment(2) == 'my-student') ? 'active' : ''}}">
                  <i class="nav-icon fas fa-user"></i>
                  <p>My Student</p>
                </a>																
              </li>
         
            @endif				
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
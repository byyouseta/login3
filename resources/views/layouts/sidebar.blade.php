<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{asset('adminlte/dist/img/avatar-default.png')}}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
            <p>Welcome</p>
          <p><b>{{Auth::user()->name}}</b></p>
          <!-- Status -->
          <!-- Kita tidak pakai
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            Kita tidak pakai status-->
        </div>
      </div>

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN MENU</li>
        <!-- Optionally, you can add icons to the links | Mengambil data session-->
        
        @if(session()->get('halaman')=='home')
          <li class="active">
        @else
          <li>
        @endif
          <a href="/home"><i class="fa fa-home"></i> <span>Home</span></a></li>
        @if(session()->get('halaman')=='agenda')
          <li class="active">
        @else
          <li>
        @endif    
          <a href="/agenda"><i class="fa fa-calendar-check-o"></i> <span>Agenda</span></a></li>
        
        @if(session()->get('halaman')=='master')
          <li class="treeview active">
        @else
          <li class="treeview">
        @endif
          <a href="#"><i class="fa fa-database"></i> <span>Master Data</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="/unit"><i class="fa fa-puzzle-piece"></i> <span>Unit</span></a></li>
            <li><a href="/pegawai"><i class="fa fa-users"></i> <span>Pegawai</span></a></li>
            <li><a href="/ruangan"><i class="fa fa-hotel"></i> <span>Ruangan</span></a></li>
          </ul>
        </li>
        
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>
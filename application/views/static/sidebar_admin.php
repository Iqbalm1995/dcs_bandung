      <div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="index.html">Daily Activity Sales</a>
          </div>
          <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">DCA</a>
          </div>
          
          <ul class="sidebar-menu">
            <li class="menu-header">Menu</li>
            <li <?php if ($menu=='dashboard') {echo "class=active";} else {echo "";}?>>
              <a class="nav-link" href="<?php echo base_url('admin/dashboard')?>"><i class="fas fa-fire"></i> <span>Dashboard</span></a>
            </li>
            <li <?php if ($menu=='customer') {echo "class=active";} else {echo "";}?>>
              <a class="nav-link" href="<?php echo base_url('admin/customer')?>"><i class="fas fa-users"></i> <span>Customer</span></a>
            </li>
            <li <?php if ($menu=='pic') {echo "class=active";} else {echo "";}?>>
              <a class="nav-link" href="<?php echo base_url('admin/pic')?>"><i class="fas fa-user-tie"></i> <span>PIC</span></a>
            </li>
            <li <?php if ($menu=='dca') {echo "class=active";} else {echo "";}?>>
              <a class="nav-link" href="<?php echo base_url('admin/dca')?>"><i class="fas fa-hands-helping"></i> <span>DCA</span></a>
            </li>
            <li <?php if ($menu=='kuisioner') {echo "class=active";} else {echo "";}?>>
              <a class="nav-link" href="<?php echo base_url('admin/kuisioner')?>"><i class="fas fa-inbox"></i> <span>Kuisioner</span></a>
            </li>

            <li class="menu-header">Master</li>
            <li <?php if ($menu=='agenda') {echo "class=active";} else {echo "";}?>>
              <a class="nav-link" href="<?php echo base_url('admin/agenda_type')?>"><i class="fas fa-calendar-alt"></i> <span>Tipe Agenda</span></a>
            </li>
            <li <?php if ($menu=='business') {echo "class=active";} else {echo "";}?>>
              <a class="nav-link" href="<?php echo base_url('admin/business_type')?>"><i class="fas fa-business-time"></i> <span>Tipe Business</span></a>
            </li>
            <li <?php if ($menu=='useradmin') {echo "class=active";} else {echo "";}?>>
              <a class="nav-link" href="<?php echo base_url('admin/user_admin')?>"><i class="fas fa-users-cog"></i> <span>User Admin</span></a>
            </li>
          </ul>

          <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
            <a href="<?php echo base_url(); ?>admin/login_admin/logout" class="btn btn-primary btn-lg btn-block btn-icon-split">
              <i class="fas fa-sign-out-alt"></i> Logout
            </a>
          </div>        </aside>
      </div>
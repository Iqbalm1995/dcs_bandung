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
              <a class="nav-link" href="<?php echo base_url('pic/dashboard')?>"><i class="fas fa-fire"></i> <span>Dashboard</span></a>
            </li>
            <li <?php if ($menu=='customer') {echo "class=active";} else {echo "";}?>>
              <a class="nav-link" href="<?php echo base_url('pic/customer')?>"><i class="fas fa-users"></i> <span>Customer</span></a>
            </li>
            <li <?php if ($menu=='dca') {echo "class=active";} else {echo "";}?>>
              <a class="nav-link" href="<?php echo base_url('pic/dca')?>"><i class="fas fa-hands-helping"></i> <span>DCA</span></a>
            </li>
            <li <?php if ($menu=='kuisioner') {echo "class=active";} else {echo "";}?>>
              <a class="nav-link" href="<?php echo base_url('pic/kuisioner')?>"><i class="fas fa-inbox"></i> <span>Kuisioner</span></a>
            </li>

            <li class="menu-header">Setting</li>
            <li <?php if ($menu=='profile') {echo "class=active";} else {echo "";}?>>
              <a class="nav-link" href="<?php echo base_url('pic/profile')?>"><i class="fas fa-user-alt"></i> <span>Profile</span></a>
            </li>
          </ul>

          <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
            <a href="<?php echo base_url(); ?>pic/login/logout" class="btn btn-primary btn-lg btn-block btn-icon-split">
              <i class="fas fa-sign-out-alt"></i> Logout
            </a>
          </div>        </aside>
      </div>
<aside class="navbar-aside" id="offcanvas_aside">
    <div class="aside-top">
        <a href="<?= base_url() ?>adminhome" class="brand-wrap">
            <div class="d-flex align-items-center">
            <img src="<?= base_url() ?>assets/admin/img/college-logo.jpeg"
             class="img-fluid me-2 sidebar-logo"
             style="height:40px;"
             alt="Mar Athanasius College of Engineering">
        <span class="brand-text fw-bold sidebar-title" style="font-size:14px;">
            Mar Athanasius College of Engineering
        </span>
            </div>
           
        </a>
        <div>
            <button class="btn btn-icon btn-aside-minimize"><i class="text-muted material-icons md-menu_open"></i></button>
        </div>
    </div>



    <div class="sidebar-user text-center">
        <h6 class="mt-3 text-primary"><?= ss('full_name') ?></h6>
        <p class="mb-0 font-roboto text-muted">Admin</p>
    </div>

    <hr>

   <!--  <div class="form-inline" style="margin: 1rem;">
        <div class="input-group" data-widget="sidebar-search">
            <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
                <button class="btn btn-sidebar">
                    <i class="fa fa-fw fa-search"></i>
                </button>
            </div>
        </div>

        <div class="sidebar-search-results" style="display: none;">
            <div class="list-group">
            </div>
        </div>
    </div>
 -->







    <nav id="active-menu-link" data-id="<?= $menu_id ?>">
        <ul class="menu-aside sidebar_menus" id="dashboard_menus">
            <li data-id="1" class="menu-item active">
                <a class="menu-link menu-navlinks" href="<?= base_url() ?>adminhome">
                    <i class="icon material-icons md-home"></i>
                    <span class="text">Dashboard</span>
                </a>
            </li>


            <li data-id="2" class="menu-item has-submenu">
                <a class="menu-link">
                    <i class="icon material-icons md-supervised_user_circle"></i>
                    <span class="text">Guest Employees</span>
                </a>
                <div class="submenu" style="display: none;">
                    <a class=" menu-navlinks" data-parent="Guest Employees" href="<?= base_url() ?>admin/guest_employees">Guest Employees</a>
                    <a class=" menu-navlinks" data-parent="Guest Employees" href="<?= base_url() ?>admin/guest_reports">Guest Employees report</a>
                    <a class=" menu-navlinks" data-parent="Guest Employees" href="<?= base_url() ?>admin/orders">Guest Employees report orders</a>
                </div>
            </li>


            <li data-id="3" class="menu-item has-submenu">
                <a class="menu-link">
                    <i class="icon material-icons md-supervised_user_circle"></i>
                    <span class="text">Permanent Employees</span>
                </a>
                <div class="submenu" style="display: none;">
                    <a class=" menu-navlinks" data-parent="Permanent Employees" href="<?= base_url() ?>admin/permanent_employees">Permanent Employees (PEN)</a>
                    <a class=" menu-navlinks" data-parent="Permanent Employees" href="<?= base_url() ?>admin/permanent_employees/data">Permanent Employees Data</a>
                    <a class=" menu-navlinks" data-parent="Permanent Employees" href="<?= base_url() ?>admin/permanent_employees_reports">Permanent Employees report</a>
                </div>
            </li>



            <li data-id="4" class="menu-item has-submenu">
                <a class="menu-link">
                    <i class="icon material-icons md-store"></i>
                    <span class="text">Reports </span>
                </a>
                <div class="submenu" style="display: none;">
                    <a class=" menu-navlinks" data-parent="Reports" href="<?= base_url() ?>admin/promotion_reports">Promotion Reports</a>
                    <a class=" menu-navlinks" data-parent="Reports" href="<?= base_url() ?>admin/grade_promotion_reports">Grade Promotion Reports</a>
                    <a class=" menu-navlinks" data-parent="Reports" href="<?= base_url() ?>admin/probation_reports">Probation Reports</a>
                    <a class=" menu-navlinks" data-parent="Reports" href="<?= base_url() ?>admin/appoinment_reports">Appoinment Reports</a>
                    <a class=" menu-navlinks" data-parent="Reports" href="<?= base_url() ?>admin/confirmation_reports">Confirmation Reports</a>
                </div>
            </li>




            <li data-id="5" class="menu-item has-submenu">
                <a class="menu-link">
                    <i class="icon material-icons md-store"></i>
                    <span class="text">Miscellaneous </span>
                </a>
                <div class="submenu" style="display: none;">
                    <a class=" menu-navlinks" data-parent="Miscellaneous" href="<?= base_url() ?>admin/departments">Departments</a>
                    <a class=" menu-navlinks" data-parent="Miscellaneous" href="<?= base_url() ?>admin/designations">Desginations</a>
                    <a class=" menu-navlinks" data-parent="Miscellaneous" href="<?= base_url() ?>admin/scale_of_pay">Scale of Pay</a>
                </div>
            </li>




            <li data-id="6" class="menu-item has-submenu">
                <a class="menu-link">
                    <i class="icon material-icons md-store"></i>
                    <span class="text">Letters </span>
                </a>
                <div class="submenu" style="display: none;">
                    <a class=" menu-navlinks" data-parent="Letters" href="<?= base_url() ?>admin/letters">Letters</a>
                    <a class=" menu-navlinks" data-parent="Letters" href="<?= base_url() ?>admin/letters/senders">Senders</a>
                    <a class=" menu-navlinks" data-parent="Letters" href="<?= base_url() ?>admin/letters/receivers">Receivers</a>
                    <a class=" menu-navlinks" data-parent="Letters" href="<?= base_url() ?>admin/letters/orders">Orders</a>
                </div>
            </li>









            <li data-id="6" class="menu-item">
                <a class="menu-link menu-navlinks" href="<?= base_url() ?>admin/logout">
                    <i class="icon material-icons md-settings"></i>
                    <span class="text">Logout</span>
                </a>
            </li>








        </ul>
        <hr />

        <br />
        <br />
    </nav>
</aside>



<script>
    setActivemenu();

    function setActivemenu() {
        $(".menu-item").removeClass('active');
        let menu_elems = $('.menu-item');
        const active_menu = $('#active-menu-link').attr('data-id');
        $.each(menu_elems, function(index, elems) {
            if (active_menu == elems.dataset.id) {
                elems.classList.add('active');
                elems.click();
            }
        });
    }
</script>
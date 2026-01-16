<aside class="navbar-aside" id="offcanvas_aside">
    <div class="aside-top">
        <a href="<?= base_url() ?>usershome" class="brand-wrap">
            <h1><span class="text-primary">MACE</span> Office</h1>
        </a>
        
        <div>
            <button class="btn btn-icon btn-aside-minimize"><i class="text-muted material-icons md-menu_open"></i></button>
        </div>

        
    </div>

    
    <div class="sidebar-user text-center">

        <h6 class="mt-3 text-primary"><?= ss('full_name') ?></h6>
        <p class="mb-0 font-roboto text-muted">Employee</p>
        
    </div>

    <hr>

    <div class="form-inline" style="margin: 1rem;">
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





    <hr>



    <nav id="active-menu-link" data-id="<?= $menu_id ?>">
        <ul class="menu-aside sidebar_menus" id="dashboard_menus">
            <li data-id="1" class="menu-item active">
                <a class="menu-link menu-navlinks" href="<?= base_url() ?>usershome">
                    <i class="icon material-icons md-home"></i>
                    <span class="text">Dashboard</span>
                </a>
            </li>





            <li data-id="2" class="menu-item">
                <a class="menu-link menu-navlinks" href="<?= base_url() ?>users/employees">
                    <i class="icon material-icons md-supervised_user_circle"></i>
                    <span class="text">Employee details</span>
                </a>
            </li>



            <li data-id="6" class="menu-item">
                <a class="menu-link menu-navlinks" href="<?= base_url() ?>users/logout">
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
            }
        });
    }
</script>
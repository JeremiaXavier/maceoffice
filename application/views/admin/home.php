<style>
  .col-search {
    position: relative;
  }

  .navbar-search-results {
    position: absolute;
    top: 100%;
    left: 0;
    right: 0;
    z-index: 1000;
  }

  /* Menu Cards Styling */
  .menu-card {
    border: none;
    border-radius: 10px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    transition: all 0.3s ease;
    color: inherit;
    height: 100%;
    text-decoration: none;
    display: block;
  }

  .menu-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 24px rgba(0,0,0,0.15);
    text-decoration: none;
  }

  .menu-card .card-body {
    padding: 24px;
    text-align: center;
  }

  .menu-card-icon {
    width: 64px;
    height: 64px;
    border-radius: 50%;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 16px;
    font-size: 32px;
  }

  .menu-card-title {
    color: #333;
    font-weight: 600;
    font-size: 16px;
    margin-bottom: 8px;
  }

  .menu-card-subtitle {
    color: #999;
    font-size: 13px;
    margin: 0;
  }

  .content-header {
    margin-bottom: 24px;
  }

  .content-header h2 {
    margin-bottom: 4px;
    font-weight: 700;
  }

  /* Color variations */
  .bg-gradient-1 { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
  .bg-gradient-2 { background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); }
  .bg-gradient-3 { background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); }
  .bg-gradient-4 { background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%); }
  .bg-gradient-5 { background: linear-gradient(135deg, #fa709a 0%, #fee140 100%); }
  .bg-gradient-6 { background: linear-gradient(135deg, #30cfd0 0%, #330867 100%); }
  .bg-gradient-7 { background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%); }
  .bg-gradient-8 { background: linear-gradient(135deg, #fbc2eb 0%, #a18cd1 100%); }
</style>

<er>

<section class="content-main">
    <div class="content-header">
        
        <p class="text-muted">Quick access to all menu items</p>
    </div>

    <!-- Dynamic Menu Cards Container -->
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-3" id="dashboard-menu-cards">
        <!-- Cards will be generated here dynamically -->
    </div>
</section>

<script src="<?= base_url() ?>assets/admin/js/vendors/chart.js"></script>
<script src="<?= base_url() ?>assets/admin/js/custom-chart.js" type="text/javascript"></script>

<script>
// Generate dashboard cards from sidebar menu
function generateDashboardCards() {
    var nav_items = document.getElementById('dashboard_menus').getElementsByClassName('menu-navlinks');
    var cards_html = '';
    
    var gradients = [
        'bg-gradient-1', 'bg-gradient-2', 'bg-gradient-3', 'bg-gradient-4',
        'bg-gradient-5', 'bg-gradient-6', 'bg-gradient-7', 'bg-gradient-8'
    ];
    
    for (var i = 0; i < nav_items.length; i++) {
        var gradient_class = gradients[i % gradients.length];
        var menu_text = nav_items[i].innerText.trim();
        var menu_href = nav_items[i].href;
        var menu_parent = nav_items[i].dataset.parent ? nav_items[i].dataset.parent : '';
        
        // Try to get icon from the menu item
        var icon_element = nav_items[i].querySelector('i');
        var icon_class = icon_element ? icon_element.className : 'material-icons md-dashboard';
        
        cards_html += `
            <div class="col">
                <a href="${menu_href}" class="menu-card">
                    <div class="card-body">
                        <div class="menu-card-icon ${gradient_class}">
                            <i class="${icon_class}" style="color: white;"></i>
                        </div>
                        <h5 class="menu-card-title">${menu_text}</h5>
                        ${menu_parent ? `<p class="menu-card-subtitle">${menu_parent}</p>` : ''}
                    </div>
                </a>
            </div>
        `;
    }
    
    document.getElementById('dashboard-menu-cards').innerHTML = cards_html;
}

// Generate cards when page loads
$(document).ready(function() {
    generateDashboardCards();
});

// Navbar search functionality
$(document).on('keyup', '.form-control-navbar', function (e) {
    e.preventDefault();
    
    let clear_btn = '<i class="fa fa-fw fa-times clear-in-searchbar"></i>';
    let search_btn = '<i class="fa fa-fw fa-search search-in-searchbar"></i>';
    
    let search_keyword = $('.form-control-navbar').val().toLowerCase();
    
    if (search_keyword.length > 1) {
        $('.btn-navbar').html(clear_btn);
        search_forkeyword_navbar(search_keyword);
    } else {
        $('.btn-navbar').html(search_btn);
        $('.navbar-search-results .list-group').html('');
        $('.navbar-search-results').hide();
    }
    
    navigate_throughNavbarResults(e.keyCode);
});

function navigate_throughNavbarResults(keyCode) {
    if (keyCode == 38) {
        $('.navbar-search-results .list-group').children().last().focus();
        return;
    }
    if (keyCode == 40) {
        $('.navbar-search-results .list-group').children().first().focus();
        return;
    }
}

function search_forkeyword_navbar(search_keyword) {
    if (search_keyword.length > 1) {
        $('.navbar-search-results').show();
    } else {
        $('.navbar-search-results').hide();
        return;
    }
    
    let counter = 0;
    var nav_items = document.getElementById('dashboard_menus').getElementsByClassName('menu-navlinks');
    var item_in_lower = '';
    var search_result_html = '';
    
    for (var i = 0; i < nav_items.length; i++) {
        item_in_lower = nav_items[i].innerText.toLowerCase();
        
        if (item_in_lower.includes(search_keyword)) {
            counter++;
            search_result_html += `
                <a href="${nav_items[i].href}" class="list-group-item">
                    <div class="search-title"><strong>${nav_items[i].innerText}</strong></div>
                    <div class="search-path">${(nav_items[i].dataset.parent) ? nav_items[i].dataset.parent : ''}</div>
                </a>
            `;
        }
    }
    
    if (counter == 0) {
        search_result_html = `
            <a class="list-group-item">
                <div class="search-title">No results found!</div>
                <div class="search-path"></div>
            </a>
        `;
    }
    
    $('.navbar-search-results .list-group').html(search_result_html);
}

function toggle_navbarSearchAndClear() {
    let clear_btn = '<i class="fa fa-fw fa-times clear-in-searchbar"></i>';
    let search_btn = '<i class="fa fa-fw fa-search search-in-searchbar"></i>';
    
    if ($('.btn-navbar .search-in-searchbar').is(":visible")) {
        $('.btn-navbar').html(clear_btn);
        $('.navbar-search-results').show();
        let search_keyword = $('.form-control-navbar').val().toLowerCase();
        search_forkeyword_navbar(search_keyword);
    } else {
        $('.btn-navbar').html(search_btn);
        $('.navbar-search-results').hide();
        $('.form-control-navbar').val('');
    }
}

$(document).on('click', '.btn-navbar', function (e) {
    e.preventDefault();
    toggle_navbarSearchAndClear();
});

$(document).on('click', function(e) {
    if (!$(e.target).closest('[data-widget="navbar-search"]').length && 
        !$(e.target).closest('.navbar-search-results').length) {
        $('.navbar-search-results').hide();
    }
});
</script>

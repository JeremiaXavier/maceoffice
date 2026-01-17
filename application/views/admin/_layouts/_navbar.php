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

</style>
<header class="main-header navbar">
  <div class="col-search">
    <div class="form-inline">
      <div class="input-group" data-widget="navbar-search">
        <input class="form-control form-control-navbar" type="search" placeholder="Search menu..." aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar">
            <i class="fa fa-fw fa-search"></i>
          </button>
        </div>
      </div>
      
      <div class="navbar-search-results" style="display: none;">
        <div class="list-group"></div>
      </div>
    </div>
  </div>

  <div class="col-nav">
    <button class="btn btn-icon btn-mobile me-auto" data-trigger="#offcanvas_aside"><i class="material-icons md-apps"></i></button>
    <ul class="nav">
      <li class="nav-item">
        <a class="nav-link btn-icon translate-modal"> <i class="material-icons md-translate"></i> </a>
      </li>
      <!-- <li class="nav-item">
        <a class="nav-link btn-icon" onclick="window.location.reload(true)"> <i class="material-icons md-refresh"></i> </a>
      </li>
      <li class="nav-item">
        <a class="nav-link btn-icon" id="checkinternetStatus"> <i class="material-icons md-public"></i> </a>
      </li>
      <li class="nav-item">
        <a class="nav-link btn-icon darkmode change-color-mode"> <i class="material-icons md-nights_stay animation-shake"></i> </a>
      </li>
      <li class="nav-item">
        <a class="requestfullscreen nav-link btn-icon"><i class="material-icons md-cast"></i></a>
      </li> -->
      
      <li class="dropdown nav-item">
        <a class="dropdown-toggle" data-bs-toggle="dropdown" id="dropdownAccount" aria-expanded="false">
          <div class="avatar ml-15" style="object-fit: cover;">
            <span style="display: block;" class="avatar-content user-avatar-text"></span>
          </div>
          <img class="img-xs rounded-circle user_image" src="" onerror="load_user_dp()" id="user_image" alt="<?= ss('full_name') ?>" style="display:none;" />
        </a>
        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownAccount">
          <a class="dropdown-item" href="<?= base_url() ?>admin/profile"><i class="material-icons md-perm_identity"></i>Edit Profile</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item text-danger" href="<?= base_url('admin/logout') ?>"><i class="material-icons md-exit_to_app"></i>Logout</a>
        </div>
      </li>
    </ul>
  </div>
</header>

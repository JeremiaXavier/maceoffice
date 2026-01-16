
<section class="content-main">
  <div class="row">
    <div class="col-xl-4">

      <div class="card">
        <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

          <!-- <img src="<?= base_url() . 'uploads/users/profile_images/' . ss('user_photo') ?>" alt="Profile" class="rounded-circle"> -->
          <h2><?= ss('full_name') ?></h2>
          <h3><?= ss('user_name') ?></h3>
          <h6><?= $this->input->ip_address() ?></h6>

        </div>
      </div>

    </div>

    <div class="col-xl-8">

      <div class="card">
        <div class="card-body pt-3">
          <!-- Bordered Tabs -->
          <ul class="nav nav-tabs nav-tabs-bordered">




            <li class="nav-item">
              <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button>
            </li>


            <li class="nav-item">
              <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-history">Login History</button>
            </li>


          </ul>
          <div class="tab-content pt-2">






            <div class="tab-pane fade pt-3  active show" id="profile-change-password">
              <!-- Change Password Form -->
              <?php echo form_open(base_url('users/change_password'), 'class="form-horizontal" id="add-form" enctype="multipart/form-data"') ?>

              <div class="row mb-3">
                <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                <div class="col-md-8 col-lg-9">
                  <input data-validation="required|min_length-5|max_length-10" name="old_password" type="password" class="form-control" id="currentPassword">
                </div>
              </div>

              <div class="row mb-3">
                <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                <div class="col-md-8 col-lg-9">
                  <input data-validation="required|min_length-5|max_length-10" name="new_password" type="password" class="form-control" id="newPassword">
                </div>
              </div>

              <div class="row mb-3">
                <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                <div class="col-md-8 col-lg-9">
                  <input data-validation="required|min_length-5|max_length-10" name="retyped_password" type="password" class="form-control" id="renewPassword">
                </div>
              </div>

              <div class="text-center">
                <button type="submit" class="btn btn-primary submit-button">Change Password</button>
              </div>

              <?php echo form_close(); ?>
              <!-- End Change Password Form -->
            </div>




            <div class="tab-pane fade pt-3" id="profile-history">

              <h3>Login History will be added soon !</h3>



            </div>




          </div><!-- End Bordered Tabs -->

        </div>
      </div>

    </div>
  </div>
</section>
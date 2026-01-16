  <!-- DataTables -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">



  <section class="content-main">
      <div class="content-header">
          <div>
              <h2 class="content-title card-title">Permanent Employees Uploaded Data List</h2>
              <p>List of permanent employee details uploaded by them in this portal.</p>
          </div>
      </div>

      <div class="card mb-4">
          <header class="card-header">
              <div class="row gx-3">

                  <form action="<?= base_url() ?>admin/permanent_employees/permanent_employees_data_json" class="datatable-list row">


                      <div class="col-12 col-md-3 mb-15">
                          <button onclick="window.history.go(-1); return false;" class="load-btn btn btn-light rounded font-sm mr-5 text-body hover-up">Go back</button>
                      </div>

                      <hr>

                      <div class="col-6 col-md-3 filter-value">
                          <select class="form-control float-end" name="status" id="status">
                              <?php foreach ($status as $statuses) : ?>
                                  <option <?= ($statuses->status_id == 1) ? 'selected' : '' ?> value="<?= en_func($statuses->status_id, 'e') ?>"><?= $statuses->status ?></option>
                              <?php endforeach; ?>
                          </select>
                      </div>



                      <div class="col-6 col-md-3 filter-value">
                          <select class="form-control float-end" name="personal" id="personal">
                              <option value="<?= en_func(0, 'e') ?>">Personal data - No Filter</option>
                              <option value="<?= en_func(2, 'e') ?>">Personal data - Yes</option>
                              <option value="<?= en_func(1, 'e') ?>">Personal data - No</option>
                          </select>
                      </div>

                      <div class="col-6 col-md-3 filter-value">
                          <select class="form-control float-end" name="present_service" id="present_service">
                              <option value="<?= en_func(0, 'e') ?>">Present Service data - No filter</option>
                              <option value="<?= en_func(2, 'e') ?>">Present Service data - Yes</option>
                              <option value="<?= en_func(1, 'e') ?>">Present Service data - No</option>
                          </select>
                      </div>


                      <div class="col-6 col-md-3 filter-value">
                          <select class="form-control float-end" name="address" id="address">
                              <option value="<?= en_func(0, 'e') ?>">Address data - No filter</option>
                              <option value="<?= en_func(2, 'e') ?>">Address data - Yes</option>
                              <option value="<?= en_func(1, 'e') ?>">Address data - No</option>
                          </select>
                      </div>


                      <div class="col-6 col-md-3 filter-value">
                          <select class="form-control float-end" name="appoinments" id="appoinments">
                              <option value="<?= en_func(0, 'e') ?>">Appoinments data - No filter</option>
                              <option value="<?= en_func(2, 'e') ?>">Appoinments data - Yes</option>
                              <option value="<?= en_func(1, 'e') ?>">Appoinments data - No</option>
                          </select>
                      </div>

                      <div class="col-6 col-md-3 filter-value">
                          <select class="form-control float-end" name="qualifications" id="qualifications">
                              <option value="<?= en_func(0, 'e') ?>">Qualifications data - No filter</option>
                              <option value="<?= en_func(2, 'e') ?>">Qualifications data - Yes</option>
                              <option value="<?= en_func(1, 'e') ?>">Qualifications data - No</option>
                          </select>
                      </div>


                      <div class="col-6 col-md-3 filter-value">
                          <select class="form-control float-end" name="probation" id="probation">
                              <option value="<?= en_func(0, 'e') ?>">Probation data - No filter</option>
                              <option value="<?= en_func(2, 'e') ?>">Probation data - Yes</option>
                              <option value="<?= en_func(1, 'e') ?>">Probation data - No</option>
                          </select>
                      </div>





                  </form>


              </div>
          </header>


          <div class="card-body">
              <div class="table-responsive">
                  <table class="table table-hover" id="na_datatable">
                      <thead>
                          <tr>
                              <th>#</th>
                              <th>PEN</th>
                              <th>Employee name</th>
                              <th>Uploaded Details</th>
                              <th>Print</th>

                          </tr>
                      </thead>

                  </table>
              </div>

          </div>

      </div>


  </section>





  <!-- DataTables  & Plugins -->
  <script src="<?= base_url() ?>assets/admin/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="<?= base_url() ?>assets/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="<?= base_url() ?>assets/admin/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="<?= base_url() ?>assets/admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="<?= base_url() ?>assets/admin/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="<?= base_url() ?>assets/admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>

  <script>
      $(document).on('click', '.click-collapse', function(e) {
          e.preventDefault();
          let collapseId = $(this).attr('data-collapse');
          $('#' + collapseId).toggle('collapse');
          $('#' + collapseId).css('display', 'flex');

          $(this).toggleClass('plus');
          $(this).toggleClass('minus');
      });
  </script>

  <style>
      .plus:before {
          content: '\25be';
      }

      .minus:before {
          content: '\25b4';
      }
  </style>
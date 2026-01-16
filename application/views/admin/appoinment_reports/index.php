  <!-- DataTables -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">



  <section class="content-main">
      <div class="content-header">
          <div>
              <h2 class="content-title card-title">Appoinment reports List</h2>
              <p>List of Appoinment reports uploaded in this portal.</p>
          </div>
      </div>

      <div class="card mb-4">
          <header class="card-header">
              <div class="row gx-3">

                  <form action="<?= base_url() ?>admin/appoinment_reports/appoinment_reports_json" class="datatable-list row">


                      <div class="col-12 col-md-3 mb-15">
                          <button onclick="window.history.go(-1); return false;" class="load-btn btn btn-light rounded font-sm mr-5 text-body hover-up">Go back</button>
                      </div>


                      <div class="col-12 col-md-3 mb-15">
                          <a href="<?= base_url() ?>admin/appoinment_reports/orders" class="load-btn btn btn-light rounded font-sm mr-5 text-body hover-up">Add Appoinment orders</a>
                      </div>


                      <div class="col-6 col-md-3 filter-value">
                          <select class="form-control float-end" name="status" id="status">
                              <?php foreach ($status as $statuses) : ?>
                                  <option <?= ($statuses->status_id == 1) ? 'selected' : '' ?> value="<?= en_func($statuses->status_id, 'e') ?>"><?= $statuses->status ?></option>
                              <?php endforeach; ?>
                          </select>
                      </div>




                      <div class="col-6 col-md-3">
                          <a class="btn btn-primary float-end" href="<?= base_url() ?>admin/appoinment_reports/add_appoinment_reports">Add report</a>
                      </div>

                  </form>


              </div>
          </header>


          <?php echo form_open(base_url('admin/appoinment_reports/generate_appoinment_report'), 'class="form-horizontal" id="generate-report" enctype="multipart/form-data"') ?>
          <?php echo form_close(); ?>

          <div class="card-body">
              <div class="table-responsive">
                  <table class="table table-hover" id="na_datatable">
                      <thead>
                          <tr>
                              <th>#</th>
                              <th>Report title</th>
                              <th>Created</th>
                              <th>Last updated</th>
                              <th></th>
                              <th></th>

                          </tr>
                      </thead>

                  </table>
              </div>

          </div>

      </div>


  </section>


<script src="<?= base_url() ?>assets/admin/scripts/reports.js"></script>


  <!-- DataTables  & Plugins -->
  <script src="<?= base_url() ?>assets/admin/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="<?= base_url() ?>assets/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="<?= base_url() ?>assets/admin/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="<?= base_url() ?>assets/admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="<?= base_url() ?>assets/admin/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="<?= base_url() ?>assets/admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
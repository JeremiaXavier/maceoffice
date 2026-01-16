  <!-- DataTables -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">



  <section class="content-main">
      <div class="content-header">
          <div>
              <h2 class="content-title card-title">Generated Reports List</h2>
              <p>List of reports generated in this portal.</p>
          </div>
      </div>

      <div class="card mb-4">
          <header class="card-header">
              <div class="row gx-3">


                  <div class="col-12 col-md-3 mb-15">
                      <button onclick="window.history.go(-1); return false;" class="load-btn btn btn-light rounded font-sm mr-5 text-body hover-up">Go back</button>
                  </div>



                  <div class="col-6 col-md-3">
                      <select class="form-select float-end reports-gen-status" name="status" id="status">
                          <?php foreach ($status as $statuses) : ?>
                              <option <?= ($statuses->status_id == 1) ? 'selected' : '' ?> value="<?= en_func($statuses->status_id, 'e') ?>"><?= $statuses->status ?></option>
                          <?php endforeach; ?>
                      </select>
                  </div>






              </div>
          </header>

          <?php echo form_open(base_url('admin/reports/generate_report'), 'class="form-horizontal" id="generate-report" enctype="multipart/form-data"') ?>
          <?php echo form_close(); ?>

          <div class="card-body">
              <div class="table-responsive">
                  <table class="table table-hover" id="na_datatable">
                      <thead>
                      <tr>
                              <th>#</th>
                              <th>Report name</th>
                              <th>Report date</th>
                              <th>Created</th>
                              <th></th>

                          </tr>
                      </thead>

                  </table>
              </div>

          </div>

      </div>


  </section>




  <!-- report Modal -->
  <div class="modal fade" id="show-Modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
          <div class="modal-content" style="background: #222736;">
              <div class="modal-header">
                  <h5 class="modal-title text-white" id="exampleModalLabel">Report preview</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

              </div>


              <div class="md-progress progress mb-3 progress-lg" style="display: none;">
                  <div class="loading-progress progress-bar bg-success" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100">
                  </div>
              </div>

              <div class="mt-15 modal-alert-message-div" style="display: none; padding: 0% 3%;">
              </div>

              <div class="modal-body text-white" id="report-content">

              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-sm btn-danger" data-bs-dismiss="modal">Close</button>
              </div>
          </div>
      </div>
  </div>
  <!-- report Modal -->



  <!-- DataTables  & Plugins -->
  <script src="<?= base_url() ?>assets/admin/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="<?= base_url() ?>assets/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="<?= base_url() ?>assets/admin/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="<?= base_url() ?>assets/admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="<?= base_url() ?>assets/admin/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="<?= base_url() ?>assets/admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>

  <script src="<?= base_url() ?>assets/admin/scripts/departments.js"></script>

  <script>
      load_generated_reports_json();
  </script>

  <script>
      let generate_reports_url = base_url + 'admin/reports/generate_report/';
      let show_reports_url = base_url + 'admin/reports/view_reports';
      let edit_reports_url = base_url + 'admin/reports/edit_reports';
      let add_reports_url = base_url + 'admin/reports/add_reports';

      $(document).on('click', '.generate-report', function(e) {
          e.preventDefault();
          
          if (confirm('Are you sure to generate the report ?')) {
              let report_id = $($(this)).attr('data-id');
              generate_report(report_id);
          }

      });


      $(document).on('click', '.show-report', function(e) {
          e.preventDefault();
          $('#show-Modal').modal('show');
          let report_id = $($(this)).attr('data-id');
          report_modal(report_id, show_reports_url);
      });

      $(document).on('click', '.edit-report', function(e) {
          e.preventDefault();
          $('#show-Modal').modal('show');
          let report_id = $($(this)).attr('data-id');
          report_modal(report_id, edit_reports_url);
      });


      $(document).on('click', '.add-report', function(e) {
          e.preventDefault();
          $('#show-Modal').modal('show');
          let report_id = $($(this)).attr('data-id');
          report_modal(report_id, add_reports_url);
      });


      function report_modal(report_id, modal_url) {
          $(".loading-progress").width('0%');
          $(".md-progress").show();
          var width = 0;
          var prg = setInterval(function() {
              if (width >= 100) {
                  clearInterval(prg);
              } else {
                  width++;
                  $(".loading-progress").width(width + '%');
              }
          }, 13);


          var show_report_xhr = $.ajax({
              url: modal_url,
              type: 'GET',
              data: {
                  report_id: report_id
              }
          });


          show_report_xhr.done(function(data) {
              $('#report-content').html(data);

              $(".loading-progress").width('0%');
              $(".md-progress").hide();

          });

          show_report_xhr.fail(function() {
              toastSuccess('error', 'Something went wrong, try later !', false);
              loading_btn();

          });
      }
  </script>
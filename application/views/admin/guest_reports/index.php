  <!-- DataTables -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">



  <section class="content-main">
      <div class="content-header">
          <div>
              <h2 class="content-title card-title">Reports List</h2>
              <p>List of reports in this portal.</p>
          </div>
      </div>

      <div class="card mb-4">
          <header class="card-header">
              <div class="row gx-3">

              <form action="<?= base_url() ?>admin/guest_reports/guest_reports_json" class="datatable-list row">


                  <div class="col-12 col-md-3 mb-15">
                      <button onclick="window.history.go(-1); return false;" class="load-btn btn btn-light rounded font-sm mr-5 text-body hover-up">Go back</button>
                  </div>


                  <div class="col-12 col-md-3 mb-15">
                      <a href="<?= base_url() ?>admin/orders" class="load-btn btn btn-light rounded font-sm mr-5 text-body hover-up">Add orders</a>
                  </div>



                  <div class="col-6 col-md-3 filter-value">
                      <select class="form-select float-end" name="status" id="status">
                          <?php foreach ($status as $statuses) : ?>
                              <option <?= ($statuses->status_id == 1) ? 'selected' : '' ?> value="<?= en_func($statuses->status_id, 'e') ?>"><?= $statuses->status ?></option>
                          <?php endforeach; ?>
                      </select>
                  </div>




                  <div class="col-6 col-md-3">
                      <a class="btn btn-primary float-end add-reports" href="<?= base_url() ?>admin/guest_reports/add_guest_reports">Add Guest report</a>
                  </div>


              </form>


              </div>
          </header>

          <?php echo form_open(base_url('admin/guest_reports/generate_guest_report'), 'class="form-horizontal" id="generate-report" enctype="multipart/form-data"') ?>
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



  <script>
      let generate_reports_url = base_url + 'admin/guest_reports/generate_guest_report/';
      let delete_reports_url = base_url + 'admin/guest_reports/delete_guest_report/';
      let show_reports_url = base_url + 'admin/guest_reports/view_guest_reports';
      let edit_reports_url = base_url + 'admin/guest_reports/edit_guest_reports';
      let add_reports_url = base_url + 'admin/guest_reports/add_guest_reports';

      $(document).on('click', '.generate-report', function(e) {
          e.preventDefault();
          
          if (confirm('Are you sure to generate the report ?')) {
              let report_id = $($(this)).attr('data-id');
              generate_report(report_id);
          }

      });


      $(document).on('click', '.delete-report', function(e) {
          e.preventDefault();
          
          if (confirm('Are you sure to delete the report ?')) {
              let report_id = $($(this)).attr('data-id');
              delete_report(report_id);
          }

      });


      function generate_report(report_id) {

          var formData = new FormData($("#generate-report")[0]);

          var generate_xhr = $.ajax({
              url: generate_reports_url + report_id,
              type: 'POST',
              data: formData,
              processData: false,
              contentType: false,
              xhr: function() {
                  var xhr = new window.XMLHttpRequest();
                  xhr.upload.addEventListener("progress", function(evt) {
                      if (evt.lengthComputable) {
                          var percentComplete = parseInt((evt.loaded / evt.total) * 100);
                          $(".progress-bar").width(percentComplete + '%');
                          $(".progress-bar").html(percentComplete + '%');
                      }
                  }, false);
                  return xhr;
              },
              beforeSend: function() {
                  $(".progress-bar").width('0%');
                  $(".progress").show();
              }
          })

          generate_xhr.done(function(data) {
              $(".progress-bar").width('0%');
              $(".progress").hide();

              var out = data;
        out = out.data;
              AlertandToast(out.status, out.msg);
              if (out.status == 'success') {
                load_datatable_list();
              }
          });

          generate_xhr.fail(function() {
              $(".progress-bar").width('0%');
              $(".progress").hide();

              AlertandToast('error', 'Page has expired, try later !');
              loading_btn();

          });
      }

      function delete_report(report_id) {

          var formData = new FormData($("#generate-report")[0]);

          var delete_xhr = $.ajax({
              url: delete_reports_url + report_id,
              type: 'POST',
              data: formData,
              processData: false,
              contentType: false,
              xhr: function() {
                  var xhr = new window.XMLHttpRequest();
                  xhr.upload.addEventListener("progress", function(evt) {
                      if (evt.lengthComputable) {
                          var percentComplete = parseInt((evt.loaded / evt.total) * 100);
                          $(".progress-bar").width(percentComplete + '%');
                          $(".progress-bar").html(percentComplete + '%');
                      }
                  }, false);
                  return xhr;
              },
              beforeSend: function() {
                  $(".progress-bar").width('0%');
                  $(".progress").show();
              }
          })

          delete_xhr.done(function(data) {
              $(".progress-bar").width('0%');
              $(".progress").hide();

              var out = data;
        out = out.data;
              AlertandToast(out.status, out.msg);
              if (out.status == 'success') {
                load_datatable_list();
              }
          });

          delete_xhr.fail(function() {
              $(".progress-bar").width('0%');
              $(".progress").hide();

              AlertandToast('error', 'Page has expired, try later !');
              loading_btn();

          });
      }

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
          $(".progress").show();
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
              $(".progress").hide();

          });

          show_report_xhr.fail(function() {
              toastSuccess('error', 'Something went wrong, try later !', false);
              loading_btn();

          });
      }
  </script>
<section class="content-main">



    <div class="row">

        <?php if ($operation == 'add') : ?>
            <?php echo form_open(base_url('admin/guest_reports/save_guest_reports'), 'class="form-horizontal" id="reports-form" enctype="multipart/form-data"') ?>
        <?php endif;
        if ($operation == 'edit') :  ?>
            <?php echo form_open(base_url('admin/guest_reports/update_guest_reports'), 'class="form-horizontal" id="reports-form" enctype="multipart/form-data"') ?>
            <input type="hidden" name="report_id" value="<?= $report_id ?>">
        <?php endif; ?>

        <?php if ($operation != 'view') :  ?>




        <?php endif; ?>



        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Report Orders</h3>
                </div>



                <div class="card-body">

                    <div class="points_div">
                        <?php
                        $i = 1;
                        foreach ($ordersList as $orders) :
                        ?>
                            <div class="input-group mb-10">
                                <span class="input-group-text"><?= $i++ ?></span>
                                <input <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= $orders->order_content ?>" id="points" name="points[]" class="form-control">
                                <span class="input-group-text btn-warning remove_points"> <i class="fa fa-trash"></i></span>

                            </div>
                        <?php endforeach; ?>
                    </div>

                    <a class="btn btn-sm btn-primary m-3" id="add_new_points">Add new points <i class="fa fa-plus-circle"></i></a>

                </div>
            </div>
        </div>


        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Report Details</h3>


                </div>


                <div class="card-body">

                    <div class="form-group">
                        <label for="inputName">Report no</label>
                        <input <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= (!empty($reportsDetails)) ? $reportsDetails->report_no : ''; ?>" id="report_no" name="report_no" class="form-control">
                    </div>



                        <!-- <div class="form-group col-md-6">
                            <label for="inputName">Report year</label>
                            <select name="report_year" id="report_year" class="form-control">

                                <option value="2021">2021</option>
                                <option value="2022" selected>2022</option>
                                <option value="2023">2023</option>

                            </select>
                        </div>  -->
                        
                        <div class="form-group">
                            <label for="inputName">Report time *(For taking the month and year to display in report & getting the teachers working in the selected date)</label>
                            <input type="date" value="<?= date('Y-m-d') ?>" name="report_time" id="report_time" class="form-control"/>


                            </select>
                        </div>

                      

                    <div class="form-group">
                        <label for="inputName">Report title</label>
                        <input <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= (!empty($reportsDetails)) ? $reportsDetails->report_title : ''; ?>" id="report_title" name="report_title" class="form-control">
                    </div>


                    <div class="form-group">
                        <label for="inputName">Report date *(Date the report was generated)</label>
                        <input <?= ($operation == 'view') ? 'disabled' : '' ?> type="date" value="<?= (!empty($reportsDetails)) ? $reportsDetails->report_date : date('Y-m-d'); ?>" id="report_date" name="report_date" class="form-control">
                    </div>


                    <div class="form-group">
                        <label for="inputName">Head of Account</label>
                        <input <?= ($operation == 'view') ? 'disabled' : '' ?> type="text" value="<?= (!empty($reportsDetails)) ? $reportsDetails->head_of_account : ''; ?>" id="head_of_account" name="head_of_account" class="form-control">
                    </div>



                    <div class="form-group">
                        <label for="inputName">Status</label>
                        <select <?= ($operation == 'view') ? 'disabled' : '' ?> name="status" id="status" class="form-control">
                            <?php foreach ($status as $statuses) : ?>
                                <option <?= ((!empty($reportsDetails)) && $reportsDetails->status == $statuses->status_id) ? 'selected' : ''; ?> value="<?= en_func($statuses->status_id, 'e') ?>"><?= $statuses->status ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>




                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>



        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Select teachers</h3>


                </div>


                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">


                            <div class="md-progress progress mb-3 progress-lg" style="display: none;">
                                <div class="loading-progress progress-bar bg-primary" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100">
                                </div>
                            </div>

                            <div class="row" id="teachers-div">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>




        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Teachers details</h3>


                </div>


                <div class="card-body">
                    <div class="row teachers-div">

                    </div>
                </div>
            </div>
        </div>


        <div class="col-12">
            <div class="content-header">
                <div>
                    <button onclick="window.history.go(-1); return false;" class="load-btn btn btn-light rounded font-sm mr-5 text-body hover-up">Go back</button>
                    <button type="submit" id="teachers-report" class="btn btn-md teachers-report rounded font-sm hover-up btn-block float-right">Add report&nbsp; <i class="fas fa-sign-in-alt"></i></button>
                </div>
            </div>
        </div>
        <?php echo form_close(); ?>


    </div>


</section>


<script>
    let teachers_json_url = base_url + 'admin/guest_reports/guest_employees_list';

    load_teachers();


    $(document).on('change', '#report_time', function() {
        load_teachers();
    });



    function load_teachers() {
        $("#teachers-div").html("");
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

        

        let report_time = $("#report_time").val();
        var parameters = {
            report_time: report_time
        };
        $.get(teachers_json_url, parameters, function(data, status) {
            $("#teachers-div").html(data);
            $(".loading-progress").width('0%');
            $(".md-progress").hide();
            show_teachers();
        });
    }

    $(document).on('click', '.remove_points', function() {
        $(this).parent().remove()
    });


    $('#add_new_points').click(function(event) {
        let point_html = `<div class="input-group mb-10">
                            <input  type="text" value="" id="points" name="points[]" class="form-control">
                            <span class="input-group-text btn-warning remove_points"> <i class="fa fa-trash"></i></span>
                        </div>`;

        $('.points_div').append(point_html);
    });

    $(document).on('change','.form-check-input', function() {
        var teacher_name = $(this).attr('data-module');
        var status = (this.checked) ? 1 : 0;

        var toast_status = status ? 'success' : 'error';

        AlertandToast(toast_status, teacher_name, false,true);
        show_teachers();

    });


    function show_teachers() {
        $('.teachers-div').html('');

        let teacher_id;
        let teacher_name;

        let teacher_html;
        $.each($("input[name='teachers_list']:checked"), function() {
            teacher_id = $($(this)).attr('data-id');
            teacher_name = $($(this)).attr('data-module');
            teacher_html = `<input type="hidden" value="${teacher_id}" id="teachers" name="teachers[]" class="form-control">`;

            teacher_html += `<div class="form-group col-md-4">
                        <label>Name</label>
                        <input type="text" value="${teacher_name}" id="teacher_name" name="teacher_name[]" class="form-control">
                    </div>`;

            teacher_html += `<div class="form-group col-md-4">
                        <label>Days</label>
                        <input type="text" id="days" name="days[]" class="form-control" >
                    </div>`;


            teacher_html += `<div class="form-group col-md-4">
                        <label>Income tax</label>
                        <input type="text" id="income_tax" value="0" name="income_tax[]" class="form-control" >
                    </div>`;


            $('.teachers-div').append(teacher_html);
        });
    }





    $(document).on('submit', '#reports-form', function(e) {
        e.preventDefault();
        var this_btn_elem = $($(('.teachers-report')));
        loading_btn(this_btn_elem);
        var formData = new FormData($("#reports-form")[0]);
        var form_url = $('#reports-form').attr('action');
        var result_xhr = $.ajax({
            url: form_url,
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

        result_xhr.done(function(data) {
            $(".progress-bar").width('0%');
            $(".progress").hide();

            loading_btn();
            var out = data;
        out = out.data;
            toastModal(out.status, out.msg, false, false, true);
            $('.teachers-report').show();
            if (out.status == 'success') {
                window.location.href = base_url + 'admin/guest_reports';
                // $('#show-Modal').modal('hide');
                // $('#modal-alert-message-div').html('');
                // load_departments_json();
            }
        });

        result_xhr.fail(function() {
            toastModal('error', 'Page has expired, try later !');
            loading_btn();

        });
    });
</script>

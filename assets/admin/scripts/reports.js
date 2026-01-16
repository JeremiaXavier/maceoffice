"use strict";

$(document).on('click', '.generate-report', function(e) {
    e.preventDefault();

    if (confirm('Are you sure to generate the report ?')) {
        let report_id = $($(this)).attr('data-id');
        generate_report(report_id);
    }

});


function generate_report(report_id) {

    var form_url = $("#generate-report").attr('action');
    var formData = new FormData($("#generate-report")[0]);

    var generate_xhr = $.ajax({
        url: form_url + '/' + report_id,
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
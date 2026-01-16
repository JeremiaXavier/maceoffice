"use strict"

const base_url = document.getElementsByTagName("constants")[0].dataset.base;

let dashboard_menus = base_url + 'admin/home/dashboard_menus';
let shortcut_url = base_url + 'keyboard_shortcuts';
let alert_message = '';




let intId = document.getElementById("internetStatus");
let sucText = "Yaay!  You are now online.";
let failText = "Oops! No internet connection.";
let sucCol = "#00b894";
let failCol = "#ea4c62";




document.addEventListener("DOMContentLoaded", () => {
    $('body').removeClass('loading');
    // load_dashboard_menus();
    load_user_dp();
    setSiteSettings();

    hide_preloader();

    load_datatable_list() // loads datatable data 



    $('.select2').select2({
        closeOnSelect: true
    });
});



function load_user_dp() {
    $('.user_image').hide();
    let username = $('#user_image').attr('alt');

    var matches = username.match(/\b(\w)/g);
    var acronym = matches.join('');

    $('.user-avatar-text').show();
    $('.user-avatar-text').html(acronym);
}




function setSiteSettings() {
    let layout_color = localStorage.getItem("layout-color");
    $('body').removeClass();
    $('body').addClass(layout_color);
}


function saveSiteSettings() {
    let body_elem = document.body;
    let layout_color = body_elem.getAttribute('class');
    localStorage.setItem("layout-color", layout_color);
    AlertandToast('info', 'Site settings saved !', false, true);
}



function hide_preloader() {
    $('.preloader').hide();
}



$(document).on('click', '.change-color-mode', function (e) {
    e.preventDefault();
    saveSiteSettings();
});






/*** Login page for admin */


document.addEventListener('keydown', (e) => {
    let { keyCode } = e;

    var ctrl = e.ctrlKey ? e.ctrlKey : ((key === 17)
        ? true : false);

    if (!ctrl)
        return;

    var key = e.which || e.keyCode;

    if (key == 81 && ctrl) {
        e.preventDefault();
        window.location.href = base_url + 'admin/login';
    }

    if (key == 77 && ctrl) {
        e.preventDefault();
        let selectedText = document.getSelection().toString();
        $('.translate-modal').attr('data-text', selectedText);
        $('.translate-modal').trigger('click');
    }

});
/*** Login page for admin */

/******** Sidebar search ********/

$(document).on('keyup', '.form-control-sidebar', function (e) {
    e.preventDefault();


    let clear_btn = '<i class="fa fa-fw fa-times clear-in-searchbar"></i>';
    let search_btn = '<i class="fa fa-fw fa-search search-in-searchbar"></i>';

    let search_keyword = $('.form-control-sidebar').val().toLowerCase();


    if (search_keyword.length > 1) {

        $('.btn-sidebar').html(clear_btn);
        search_forkeyword(search_keyword);
    } else {
        $('.btn-sidebar').html(search_btn);
        $('.list-group').html('');

    }

    navigate_throughResults(e.keyCode);



});

function navigate_throughResults(keyCode) {
    if (keyCode == 38) {
        $('.list-group').children().last().focus();
        return;
    }
    if (keyCode == 40) {
        $('.list-group').children().first().focus();
        return;
    }
}


function search_forkeyword(search_keyword) {

    if (search_keyword.length > 1) {
        $('.sidebar-search-results').show();
    } else {
        $('.sidebar-search-results').hide();
        return;
    }


    let counter = 0;
    var nav_items = document.getElementById('dashboard_menus').getElementsByClassName('menu-navlinks');

    var item_in_lower = '';
    var search_result_html = ``;


    for (var i = 0; i < nav_items.length; i++) {
        item_in_lower = nav_items[i].innerText.toLowerCase();

        ;

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
                  <div class="search-title">No results found !</div>
                  <div class="search-path"></div>
              </a>
      `;
    }


    $('.list-group').html(search_result_html);

}

function toggle_searchAndclear() {
    let clear_btn = '<i class="fa fa-fw fa-times clear-in-searchbar"></i>';
    let search_btn = '<i class="fa fa-fw fa-search search-in-searchbar"></i>';


    if ($('.search-in-searchbar').is(":visible")) {
        $('.btn-sidebar').html(clear_btn);
        $('.sidebar-search-results').show();
        let search_keyword = $('.form-control-sidebar').val().toLowerCase();

        search_forkeyword(search_keyword);

    } else {
        $('.btn-sidebar').html(search_btn);
        $('.sidebar-search-results').hide();
    }


}

$(document).on('click', '.btn-sidebar', function (e) {
    e.preventDefault();
    toggle_searchAndclear();
});

/******** Sidebar search ********/





function getParameters_toDOM() {
    $('.filters-applied').html('');
    $('.fa-hr').remove();

    let parameters = getParameters();
    let filters = '<hr class="fa-hr mt-15"><div class="filters-applied">';
    let key_splitted = [];
    let selectedOption = '';
    parameters.forEach((value, key) => {
        selectedOption = $("#" + key)[0].options[$("#" + key)[0].selectedIndex].text;
        key = key.replaceAll('_', ' ');
        key_splitted = key.split(" ");

        for (var i = 0; i < key_splitted.length; i++)
            key_splitted[i] = key_splitted[i].charAt(0).toUpperCase() + key_splitted[i].slice(1);


        key = key_splitted.join(" ");

        if (key != 'Page')
            filters += `
                        <span role="button" class="filter-preview badge alert-info" data-key="${key}">${key} :  ${selectedOption}<i class="fa fa-times-circle ml-10 remove-filter-preview"></i></span>
                    `;
    });

    filters += '</div>';
    if (!key_splitted.length)
        filters = '';
    $('.datatable-list').after(filters);

}


$(document).on('click', '.remove-filter-preview', function (e) {
    e.preventDefault();
    let key_splitted;
    let key = $(this).parent().attr('data-key').trim();
    key = key.replaceAll(' ', '_');

    key_splitted = key.split("_");

    for (var i = 0; i < key_splitted.length; i++)
        key_splitted[i] = key_splitted[i].charAt(0).toLowerCase() + key_splitted[i].slice(1);


    key = key_splitted.join("_");


    remove_this_getParameters(key);

    if ($("#" + key)[0].tagName == 'SELECT')
        $("#" + key).prop("selectedIndex", 0);
    if ($("#" + key)[0].tagName == 'INPUT')
        $("#" + key).val("");


    load_datatable_list();

    AlertandToast('info', 'Filter removed', false, true);
});



// if (performance.navigation.type == performance.navigation.TYPE_RELOAD) {
//     remove_getParameters();
// }




/******** Loads Datatable Json data ********/

function load_datatable_list() {
    if ($('.datatable-list').length > 0)
        $(".datatable-list").submit();
}

$(document).on('change', '.datatable-list .filter .form-control', function (e) {
    e.preventDefault();
    if ($('.datatable-list').length > 0)
        $(".datatable-list").submit();
});




/*
 * 
 *  Datatables autoloading function which is inside a form with class datatable-list
 *  GET parameters are loaded from the url and all the details are rendered to table with id na_datatable
 * 
 */
$(document).on('submit', '.datatable-list', function (e) {
    e.preventDefault();

    getParameters_toDOM();


    var parameters = [];

    /*
    $(this).children()
        .each(function (index, element) {
            if (element.classList.contains('filter')) {
                var ids = element.children[0].id;
                parameters[ids] = element.children[0].value;
            }
        });
    */


    var parameters = {};
    let current_parameters = getParameters();

    for (const [key, value] of current_parameters.entries()) {
        parameters[key] = value;
    }


    load_datatable(parameters, $(this).attr('action'));
});


function load_datatable(parameters, form_url, datatable_id = '#na_datatable') {
    $(datatable_id).dataTable().fnDestroy();

    $(datatable_id).DataTable({
        "processing": true,
        "serverSide": false,
        "ajax": {
            "data": parameters,
            "url": form_url
        },
        "responsive": true,
        "lengthChange": true,
        "autoWidth": false,
    });
}


/******** Loads Datatable Json data ********/





$(document).on('change', '.datatable-list .filter-value', function (e) {
    e.preventDefault();

    let ids = $(this)[0].children[0].id;
    let value = $(this)[0].children[0].value;

    // console.log($(this)[0].children[0].value);

    add_getParameters(ids, value);



    if ($('.datatable-list').length > 0)
        $(".datatable-list").submit();
});




/******** Loads GET Parameters data ********/


function remove_this_getParameters(ids) {
    let current_parameters = getParameters();

    if (current_parameters.has(ids))
        current_parameters.delete(ids);

    window.history.replaceState(null, null, "?" + current_parameters);

}


function remove_getParameters() {

    window.history.replaceState(null, null, "?");

}

function add_getParameters(ids, value) {
    let current_parameters = getParameters();

    if (current_parameters.has(ids))
        current_parameters.set(ids, value);
    else
        current_parameters.append(ids, value);

    window.history.replaceState(null, null, "?" + current_parameters);

}

function fetch_getParameters(ids) {
    let current_parameters = getParameters();

    if (current_parameters.has(ids))
        return current_parameters.get(ids);
    return null

}


function getParameters() {
    let address = window.location.search;
    let parameterList = new URLSearchParams(address);
    return parameterList;
}


if (performance.navigation.type == performance.navigation.TYPE_RELOAD) {
    remove_getParameters();
}


/******** Loads GET Parameters data ********/




$(document).on('keyup', '.form-control', function (e) {
    try {
        validate_form(false, false, true, true);
    } catch (err) {
        console.warn('Validation is not present');
    }
});

$(document).on('change', '.form-change', function (e) {
    try {
        validate_form(false, false, true, true);
    } catch (err) {
        console.warn('Validation is not present');
    }
});



/******** Submits form and shows alert ********/

$(document).on('submit', '#add-form', function (e) {
    e.preventDefault();


    if (validate_form(true, false, true))
        return false;



    var this_btn_elem = $($(('.submit-form')));
    loading_btn(this_btn_elem);

    var formData = new FormData($("#add-form")[0]);
    var form_url = $('#add-form').attr('action');
    var result_xhr = $.ajax({
        url: form_url,
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        xhr: function () {
            var xhr = new window.XMLHttpRequest();
            xhr.upload.addEventListener("progress", function (evt) {
                if (evt.lengthComputable) {
                    var percentComplete = parseInt((evt.loaded / evt.total) * 100);
                    $(".progress-bar").width(percentComplete + '%');
                    $(".progress-bar").html(percentComplete + '%');

                }
            }, false);
            return xhr;
        },
        beforeSend: function () {
            $(".progress-bar").width('0%');
            $(".progress").show();

        }
    })

    result_xhr.done(function (data) {
        $(".progress-bar").width('0%');
        $(".progress").hide();

        var out = data.data;
        if (out.status == 'success') {
            closeOffCanvas();
            AlertandToast(out.status, out.msg, false, true);
            // go_to_backpage();
            // closeOffCanvas();

            load_datatable_list();

            if (out.redirect_url) {
                setTimeout(function () {
                    location = out.redirect_url;
                }, 3000/* time in milliseconds */);
            }

        }
        // else
        //     AlertandToast(out.status, out.msg, true, true);


        AlertandToast(out.status, out.msg, true, true);
        loading_btn();
    });

    result_xhr.fail(function () {
        loading_btn();
        $(".progress-bar").width('0%');
        $(".progress").hide();
        AlertandToast('error', 'Something wrong with the server, try refreshing the page or try later !', true, true);
        $('body,html').animate({
            scrollTop: 0
        }, 500);
    });
});




/******** Submits form and shows alert ********/




$(document).on('change', '.document-upload', function (e) {
    var allowedTypes = ['application/pdf'];
    var file = this.files[0];
    var fileName = file.name;
    var fileType = file.type;
    var fileSize = (file.size / 1024) / 1024;
    fileSize = Math.ceil(fileSize);

    if (!allowedTypes.includes(fileType)) {
        AlertandToast('warning', fileName + ' is of ' + fileType + ' and the allowed types are ' + allowedTypes.toString());
        return false;
    }

    if (fileSize > 4) {
        AlertandToast('warning', fileName + ' is of ' + fileSize + 'MB and the limit for uploading size is 4 MB');
        return false;
    }

    fileSize = fileSize + ' MB';

    $('#previous_document').hide();
    $('#document-preview').fadeIn();
    document.getElementById('document-preview').src = window.URL.createObjectURL(this.files[0]);
    return true;

});







function circular_loader_post(action = 'hide', progress = 0) {
    $("#loader-overlay").show();
    var width = 0;
    if (action == 'hide') {
        $("#circular-progress-value").html('0%');
        $("#loader-overlay").hide();
    }


    var prg = setInterval(function () {
        if (progress >= 100) {
            $("#circular-progress-value").html('0%');
            clearInterval(prg);
            $("#loader-overlay").hide();

        } else {
            $("#circular-progress-value").html(progress + '%');
            $("#circular-progressbar").removeClass();
            // width++;
            $("#circular-progressbar").addClass('progress-circle');
            if (progress >= 50)
                $("#circular-progressbar").addClass('over50');

            $("#circular-progressbar").addClass('p' + progress);

        }
    }, 1);



}

function AlertandToast(status, message, alert = true, toast = true) {
    if (toast) {
        BottomToast(message);
        // var Toast = Swal.mixin({
        //     toast: true,
        //     position: 'top-end',
        //     showConfirmButton: false,
        //     timer: 3000
        // });

        // Toast.fire({
        //     icon: status,
        //     title: message
        // });
    }

    if (alert)
        alertMessage(status, message);
}


function alertMessage(status, message) {
    $('.alert-message-div').html('');

    $('body,html').animate({
        scrollTop: 0
    }, 500);

    let alert_status = (status == 'error') ? 'alert-danger' : 'alert-' + status;
    let bg_status = (status == 'error') ? 'bg-danger' : 'bg-' + status;

    alert_message = `
    <div class="alert ${alert_status} alert-dismissible fade show" role="alert">
        ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>`;

    $('.alert-message-div').html(alert_message);
    $('.alert-message-div').show(1200);





}




function BottomToast(message = 'Welcome !') {
    $("#snackbar").remove();
    let snackbar_html = `<div id="snackbar" class="show">${message}</div>`;
    $('body').append(snackbar_html);
    setTimeout(function () {
        $("#snackbar").removeClass("show"); $("#snackbar").remove();
    }, 3000);
}


$(document).on('click', '.close-offcanvas', function (e) {
    e.preventDefault();
    closeOffCanvas();
});


$(document).on('click', '.open-offcanvas', function (e) {
    $('.offcanvas-heading').html('');
    $('.offcanvas-content').html('');
    showOffCanvas();


    let form_url = $(this).attr("data-url");


    $.get(form_url, function (data, status) {
        var out = data;
        out = out.data;

        $('.offcanvas-heading').html(out.heading);
        $('.offcanvas-content').html(out.content);

    }).fail(function () {
        AlertandToast('error', 'Could not load the page, Try again later !', false, true);
        $('.offcanvas-content').html('');

    });


});


function showOffCanvas() {
    let offCanvas_loader = `<center><i style="font-size:35px;color: #3bb77e;" class="fa fa-spinner fa-spin"></i></center>`;
    $('.my-offcanvas').addClass('show');
    // $(canvas).show();


    $('.offcanvas-content').html(offCanvas_loader);
}


function closeOffCanvas() {
    $('.my-offcanvas').removeClass('show');
    $('.offcanvas-content').html('');

}


function toastSuccess(status, message, alert = true, toast = true) {
    if (toast) {
        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });

        Toast.fire({
            icon: status,
            title: message
        });
    }

    if (alert)
        alertMessage(status, message);
}


function alertMessage(status, message) {

    $('body,html').animate({
        scrollTop: 0
    }, 500);

    let alert_status = (status == 'error') ? 'alert-danger' : 'alert-' + status;
    let bg_status = (status == 'error') ? 'bg-danger' : 'bg-' + status;

    alert_message = `
    <div class="alert ${alert_status} alert-dismissible fade show" role="alert">
        ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>`;

    $('#alert-message-div').html(alert_message);
    $('#alert-message-div').show(1200);





}



function toastModal(status, message, alert_modal = true, toast = true, alert = false) {
    if (toast) {
        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });

        Toast.fire({
            icon: status,
            title: message
        });
    }

    if (alert_modal)
        alertModal(status, message);
    if (alert)
        alertMessage(status, message);
}


function alertModal(status, message) {

    $('body,html').animate({
        scrollTop: 0
    }, 500);

    let alert_status = (status == 'error') ? 'alert-danger' : 'alert-' + status;
    let bg_status = (status == 'error') ? 'bg-danger' : 'bg-' + status;

    alert_message = `
    <div class="alert ${alert_status} alert-dismissible fade show" role="alert">
        ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>`;

    $('#modal-alert-message-div').html(alert_message);
    $('#modal-alert-message-div').show(1200);





}
function alertMessage(status, message) {

    $('body,html').animate({
        scrollTop: 0
    }, 500);

    let alert_status = (status == 'error') ? 'alert-danger' : 'alert-' + status;
    let bg_status = (status == 'error') ? 'bg-danger' : 'bg-' + status;

    alert_message = `
    <div class="alert ${alert_status} alert-dismissible fade show" role="alert">
        ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>`;

    $('#alert-message-div').html(alert_message);
    $('#alert-message-div').show(1200);





}


function alertMessage_old(status, message) {
    return;
    $('body,html').animate({
        scrollTop: 0
    }, 500);

    let alert_status = (status == 'error') ? 'alert-danger' : 'alert-' + status;
    let bg_status = (status == 'error') ? 'bg-danger' : 'bg-' + status;

    $('.alert-msg').addClass(alert_status);
    $('.alert-msg').addClass(bg_status);
    $('.message_content').html(message);
    $('.alert-msg').show(1200);

    setTimeout(function () {
        $('.alert-msg').fadeOut();
        $('.alert-msg').removeClass(alert_status);
        $('.alert-msg').removeClass(bg_status);
    }, 10000);


}

function loadCroppie() {
    $uploadCrop = $('#upload-demo').croppie({
        enableExif: true,
        boundary: {
            width: 1280,
            height: 430
        },
        viewport: {
            width: 1271,
            height: 419,
            type: 'square'
        }
    });
}



$(document).on('click', '.load-btn', function () {
    this.innerHTML = (this.localName == 'input') ? 'Loading ...' : 'Loading...' + '<i class="fas fa-fan fa-spin"></i>';
    this.style.opacity = "0.7";
    return true;
});




var elem;
function loading_btn(this_elem = '') {
    return;
    var xhr_loader = document.querySelectorAll('.loader-xhr');
    if (xhr_loader.length > 0) {
        xhr_loader[0].remove();
        elem.css('opacity', '1.0');
        elem.removeAttr('disabled');
    } else {
        this_elem.attr('disabled', true);
        this_elem.css('opacity', '0.7');
        this_elem.append('<i class="fas fa-spinner fa-spin loader-xhr"></i>');
        elem = this_elem;
    }
    return;
}


function refresh_page(to_page = '') {


    setTimeout(function () {
        $(".progress-bar").width('0%'); $(".progress").show();
        $(".progress-bar").html('0%');
        location.reload(true);
    }, 1000);
}



$(document).on('click', '#checkinternetStatus', function (e) {
    e.preventDefault();
    check_internet();
});


function check_internet() {
    if (window.navigator.onLine) {
        intId.innerHTML = sucText;
        intId.style.display = "block";
        intId.style.backgroundColor = sucCol;
    } else {
        intId.innerHTML = failText;
        intId.style.display = "block";
        intId.style.backgroundColor = failCol;
    }

    setTimeout(function () {
        var fade2Out = setInterval(function () {
            if (!intId.style.opacity) {
                intId.style.opacity = 1;
            }
            if (intId.style.opacity > 0) {
                intId.style.opacity -= 0.1;
            } else {
                clearInterval(fade2Out);
                intId.style.display = "none";
            }
        }, 5);
    }, 4000);
}


if (intId) {
    if (window.navigator.onLine) {
        intId.innerHTML = sucText;
        intId.style.display = "none";
        intId.style.backgroundColor = sucCol;
    } else {
        intId.innerHTML = failText;
        intId.style.display = "block";
        intId.style.backgroundColor = failCol;
    }

    window.addEventListener("online", function () {
        intId.innerHTML = sucText;
        intId.style.display = "block";
        intId.style.backgroundColor = sucCol;
        setTimeout(function () {
            var fade2Out = setInterval(function () {
                if (!intId.style.opacity) {
                    intId.style.opacity = 1;
                }
                if (intId.style.opacity > 0) {
                    intId.style.opacity -= 0.1;
                } else {
                    clearInterval(fade2Out);
                    intId.style.display = "none";
                }
            }, 5);
        }, 7000);
    });

    window.addEventListener("offline", function () {
        intId.innerHTML = failText;
        intId.style.display = "block";
        intId.style.backgroundColor = failCol;
    });
}




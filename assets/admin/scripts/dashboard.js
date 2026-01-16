




let contact_us_json = base_url + 'admin/home/dashboard_contact_messages';
let dashboard_counts_json = base_url + 'admin/home/dashboard_counts';
let recent_activity_json = base_url + 'admin/home/recent_activity';
let visitors_traffic_json = base_url + 'admin/home/visitors_traffic';


document.addEventListener("DOMContentLoaded", () => {
    load_contact_us_json();
    load_dashboard_count();
    load_recent_activity();
    load_website_traffic();
});




function load_contact_us_json() {

    var table = $('#na_datatable').DataTable({
        "processing": true,
        "serverSide": false,
        "ajax": {
            "type": "GET",
            "url": contact_us_json
        },
        "responsive": true,
        "lengthChange": true,
        "autoWidth": false,
        "bFilter": false,
        "bInfo": false,
        "bPaginate": false,
    });
}


function load_dashboard_count() {
    var count_xhr = $.get(dashboard_counts_json);

    count_xhr.done(function (data) {
        var out = jQuery.parseJSON(data);
        out = out.data;

        $("#enquiries_count").html(out.enquiries);
        $("#news_count").html(out.news);
        $("#blogs_count").html(out.blogs);
        $("#traffic_count").html(out.traffic);
    });

}


function load_recent_activity() {
    var activity_xhr = $.get(recent_activity_json);

    activity_xhr.done(function (data) {
        var out = jQuery.parseJSON(data);
        out = out.data;

        var activities = '';


        out = out.activity;
        out.map(function (element) {

            var randNum = parseInt(Math.random() * 10);
            var class_activity = '';

            if (randNum % 3 == 0)
                class_activity = 'primary';
            else if (randNum % 2 == 0)
                class_activity = 'success';
            else
                class_activity = 'danger';


            activities += `<div class="activity-item d-flex">
              <div class="activite-label activity_time"><span class="badge bg-secondary"> <i class="bi bi-calendar4-event"></i> ${element.created_date}</span></div> 
              <i class='bi bi-circle-fill activity-badge text-${class_activity} align-self-start'></i>
              <div class="activity-content">
              <span class="badge bg-${class_activity}"><i class="bi bi-clock-fill"></i> ${element.created_time}  </span>
                <p class="fw-bold text-dark activity_content pb-1 mb-1">${element.activity}</p>
              </div>
            </div>`;

        });


        $('.activity_block').html(activities);
    });

}

function load_website_traffic() {
    var traffic_xhr = $.get(visitors_traffic_json);

    traffic_xhr.done(function (data) {
        var out = jQuery.parseJSON(data);
        out = out.data.traffic;

        setTrafficChart(out);
    });

}


function setTrafficChart(out) {

    var data_array = [];
    $.each(out, function (index, value) {
        data_array[index] = {
            value: value.visit_count,
            name: value.visited_date
        }
    });





    echarts.init(document.querySelector("#trafficChart")).setOption({
        tooltip: {
            trigger: 'item'
        },
        legend: {
            top: '5%',
            left: 'center'
        },
        series: [{
            name: 'Visitors count',
            type: 'pie',
            radius: ['40%', '70%'],
            avoidLabelOverlap: false,
            label: {
                show: false,
                position: 'center'
            },
            emphasis: {
                label: {
                    show: true,
                    fontSize: '18',
                    fontWeight: 'bold'
                }
            },
            labelLine: {
                show: true
            },

            data: data_array
        }]
    });

}
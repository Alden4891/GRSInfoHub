<!-- <script type='text/javascript' src="https://raw.github.com/xuanluo/flot-axislabels/master/jquery.flot.axislabels.js"></script> -->
          <!-- top tiles -->
          <div class="row" style="display: inline-block;" >
          <div class="tile_count">

                    <?php



                             $cnt=0;
                             $res_grivwidget = mysqli_query($con, "

                          SELECT 0 AS id, 'total_griev' AS grs_type,COUNT(id) AS `value` FROM grievances
                          UNION ALL
                          SELECT
                              `lib_grssubtype`.`id`
                              , `lib_grssubtype`.`subtype` AS `grs_type`
                              , COUNT(`grievances`.`id`) AS `value`
                          FROM
                              `db_grs`.`grievances`
                              INNER JOIN `db_grs`.`lib_grssubtype`
                                  ON (`grievances`.`GRS_TYPE` = `lib_grssubtype`.`id`)
                          GROUP BY `lib_grssubtype`.`id`, `grs_type`;

                             ") or die(mysqli_error());
                            while ($r=mysqli_fetch_array($res_grivwidget,MYSQLI_ASSOC)) {

                                $grs_type=$r['grs_type'];
                                $grs_value=$r['value'];




                                $grs_type = ($grs_type=='total_griev'?'Total Grievances':$grs_type);

                                if ($grs_type=='total_griev'){
                                    $grs_type = 'Total Grievances';

                                    echo "
                                          <div class=\"col-md-2 col-sm-4 green tile_stats_count\">
                                            <span class=\"count_top \"><i class=\"fa fa-user\"></i> $grs_type</span>
                                            <div class=\"count green\" id=\"dbw_total_griev\">$grs_value&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                          </div>
                                    ";

                                }else{
                                    echo "
                                          <div class=\"col-md-2 col-sm-4  tile_stats_count\">
                                            <span class=\"count_top\"><i class=\"fa fa-user\"></i> $grs_type</span>
                                            <div class=\"count \" id=\"dbw_total_griev\">$grs_value&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                          </div>

                                    ";

                                }
                            }
                            mysqli_free_result($res_grivwidget);

                        ?>
          </div>
        </div>
          <!-- /top tiles -->

          <div class="row">
            <div class="col-md-12 col-sm-12 ">
              <div class="dashboard_graph">

                <div class="row x_title">
                  <div class="col-md-6">
                    <h3>GRS Trends <small></small></h3>
                  </div>
                  <div class="col-md-6">
                    <div id="reportrange" class="pull-right" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc">
                      <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                      <span>December 30, 2014 - January 28, 2015</span> <b class="caret"></b>
                    </div>
                  </div>
                </div>

                <div class="col-md-9 col-sm-9 ">
                  <div id="chart_plot_01" class="demo-placeholder"></div>
                </div>
                <div class="col-md-3 col-sm-3  bg-white">
                  <div class="x_title">
                    <h2>Grievances</h2>
                    <div class="clearfix"></div>
                  </div>

                  <div class="col-md-12 col-sm-12 ">

                    <div>
                      <p>Pending</p>
                      <div class="">
                        <div class="progress progress_sm" style="width: 76%;">
                          <div class="progress-bar bg-green" role="progressbar" data-valuemin="0" id="dbp_griev_open"></div>
                        </div>
                      </div>
                    </div>

                    <div>
                      <p>On Going</p>
                      <div class="">
                        <div class="progress progress_sm" style="width: 76%;">
                          <div class="progress-bar bg-green" role="progressbar" aria-valuemin="0" id="dbp_griev_ongoing" ></div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12 col-sm-12 ">
                    <div>
                      <p>Resolved</p>
                      <div class="">
                        <div class="progress progress_sm" style="width: 76%;">
                          <div class="progress-bar bg-green" role="progressbar" data-valuemin="0" id="dbp_griev_close"></div>
                        </div>
                      </div>
                    </div>

                  </div>

                </div>

                <div class="clearfix"></div>
              </div>
            </div>

          </div>
          <br />

          <div class="row">

            <div class="col-md-12 col-sm-4 ">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Recent Grievances <small>Sessions</small></h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                          <a class="dropdown-item" href="#">Settings 1</a>
                          <a class="dropdown-item" href="#">Settings 2</a>
                        </div>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <div class="dashboard-widget-content">
                    <ul class="list-unstyled timeline widget" id="recent_activities_container">

                    </ul>
                  </div>
                </div>
              </div>
            </div>

          </div>


          <div class="row">




          </div>


<script type="text/javascript">

  jQuery(document).ready(function() {
    init_flot_chart();
    init_db_widgets();
    init_db_componentprogress();
    init_recentInterventions();

  });


  function init_recentInterventions() {
    // getDBRecentIntrvData.php
    $.ajax({
        type: 'get',
        url: 'proc/getDBRecentGrievData.php',
        dataType: 'JSON',
        data: {
            startdate: '2020-01-01',
            enddate: '2020-12-31',
        },
        success: function(response) {
            var arr_data1 = [];
            var jsondata = JSON.parse(JSON.stringify(response));

            var str = "";

            for (var i=0;i<jsondata.length; i++) {

              var subject = '';
              var id = jsondata[i][0];
              var description   = jsondata[i][1];
              var encoder   = jsondata[i][2];
              var date_reported  = jsondata[i][3];
              var guid  = jsondata[i][4];
              var date_reported2 = new Date(date_reported);

              var today = new Date();
              var diffMs = (today-date_reported2); // milliseconds between now & Christmas
              var diffDays = Math.floor(diffMs / 86400000); // days
              var diffMonths = Math.floor(diffMs / 8.64e+8); // days
              var diffHrs = Math.floor((diffMs % 86400000) / 3600000); // hours
              var diffMins = Math.round(((diffMs % 86400000) % 3600000) / 60000); // minutes

              //console.log(date_reported2);
              //console.log(diffMonths);
              //console.log(today);

              var duration = "";
              if (diffMonths>0) {
                  duration = diffMonths + " Months ago";
              }else if (diffDays>0){
                  duration = diffDays + " days ago";
              }else if (diffHrs>0){
                  duration = diffHrs + " hours ago";
              }else if (diffMins>0){
                  duration = diffHrs + " minutes ago";
              }

              str += "<li>";
              str += "  <div class=\"block\">";
              str += "    <div class=\"block_content\">";
              str += "       <h2 class=\"title\">";
              str += "          <a>"+subject+"</a>";
              str += "       </h2>";
              str += "       <div class=\"byline\">";
              str += "          <span>"+duration+"</span> by <a>"+encoder+"</a>";
              str += "       </div>";
              str += "      <p class=\"excerpt\">"+description.substring(0, 300);+"";
              str += "    ...<a href=\"#\" data-toggle=\"modal\" data-target=\"#previewGrievModal\" id=\"viewGriev\" guid=\""+guid+"\" ctrlno=\""+id+"\">read&nbsp;more</a></p></div>";
              str += "  </div>";
              str += "</li>";

            }

              $('#recent_activities_container').html(str);

        }
    });
  }


  function init_db_componentprogress() {
    $.ajax({
        type: 'get',
        url: 'proc/getDBStatusDataProgressBar.php',
        dataType: 'JSON',
        data: {
            startdate: '2020-01-01',
            enddate: '2020-12-31',
        },
        success: function(response) {
            var arr_data1 = [];
            var jsondata = JSON.parse(JSON.stringify(response));
            var total_griev = jsondata[0][2];
             for (var i = 1; i < jsondata.length; i++){
                var id = jsondata[i][0];
                var comp_desc = jsondata[i][1];
                var value = jsondata[i][2]/total_griev*100;
                if (id == 1) $('#dbp_griev_open').css('width',value+'%').attr('data-transitiongoal',value).attr('aria-valuenow',value);
                if (id == 2) $('#dbp_griev_ongoing').css('width',value+'%').attr('data-transitiongoal',value).attr('aria-valuenow',value);
                if (id == 3) $('#dbp_griev_close').css('width',value+'%').attr('data-transitiongoal',value).attr('aria-valuenow',value);

             }
             // if ($("#chart_plot_01").length){
             //      $.plot( $("#chart_plot_01"), [ arr_data1 ],  chart_plot_01_settings );
             // }
        }
    });
  }

  function init_db_widgets(){
    //getDBWidgetData.php


    $.ajax({
        type: 'get',
        url: 'proc/getDBWidgetData.php',
        dataType: 'JSON',
        data: {
            startdate: '2020-01-01',
            enddate: '2020-12-31',
        },
        success: function(response) {
            //console.log(response);
            var arr_data1 = [];
            var jsondata = JSON.parse(JSON.stringify(response));

             for (var i = 0; i < jsondata.length; i++){
                var id = jsondata[i][0];;
                var subcomp = jsondata[i][1];
                var value = jsondata[i][2];

                if (id == 0) $('#dbw_total_griev').html(value+'&nbsp;&nbsp;');
                if (id == 1) $('#dbw_social_amelioration').html(value+'&nbsp;&nbsp;');
                if (id == 2) $('#dbw_employment_facilitation').html(value+'&nbsp;&nbsp;');
                if (id == 3) $('#dbw_social_security').html(value+'&nbsp;&nbsp;');
                if (id == 4) $('#dbw_health').html(value+'&nbsp;&nbsp;');
                if (id == 5) $('#dbw_housing').html(value+'&nbsp;&nbsp;');
                if (id == 6) $('#dbw_pamana').html(value+'&nbsp;&nbsp;');
                if (id == 7) $('#dbw_ciu').html(value+'&nbsp;&nbsp;');
                if (id == 8) $('#dbw_dti').html(value+'&nbsp;&nbsp;');
                if (id == 9) $('#dbw_da').html(value+'&nbsp;&nbsp;');
                if (id ==10) $('#dbw_lgu').html(value+'&nbsp;&nbsp;');

             }
             // if ($("#chart_plot_01").length){
             //      $.plot( $("#chart_plot_01"), [ arr_data1 ],  chart_plot_01_settings );
             // }

        }
    });
  }
  function init_flot_chart(){

    if( typeof ($.plot) === 'undefined'){ return; }

  // $('#reportrange').daterangepicker({
  //     "showDropdowns": true,
  //     "startDate": "04/03/2020",
  //     "endDate": "04/09/2020",
  //     "minDate": "01/01/2019",
  //     "maxDate": "01/01/2030"
  // }, function(start, end, label) {
  //   console.log('New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')');
  // });


    var chart_plot_01_settings = {
          series: {
            curvedLines: {
              apply: true,
              active: true,
              monotonicFit: true
            },
            splines: {
              show: true,
              tension: 0.4,
              lineWidth: 1,
              fill: 0.1
            },
            points: {
              radius: 1,
              show: true
            },
            shadowSize: 2
          },
          grid: {
            verticalLines: true,
            hoverable: true,
            clickable: true,
            tickColor: "#d5d5d5",
            borderWidth: 1,
            color: '#fff'
          },
          colors: ["rgba(38, 185, 154, 0.38)", "rgba(3, 88, 106, 0.38)"],
          xaxis: {
            tickColor: "rgba(51, 51, 51, 0.06)",
            mode: "time",
            tickSize: [30, "day"],
            //tickLength: 10,
            axisLabel: "Date",
            axisLabelUseCanvas: true,
            axisLabelFontSizePixels: 12,
            axisLabelFontFamily: 'Verdana, Arial',
            axisLabelPadding: 10
          },
          yaxis: {
            ticks: 8,
            tickColor: "rgba(51, 51, 51, 0.06)",
          },
          tooltip: true
        }

    var markers;
    $.ajax({
        type: 'get',
        url: 'proc/getDBGrievActivitiesData.php',
        dataType: 'JSON',
        data: {
            startdate: '',
            enddate: '',
        },
        success: function(response) {
          console.log('res1:'+response);
            var arr_data1 = [];
            var arr_data2 = [];
            var jsondata = JSON.parse(JSON.stringify(response));

             for (var i = 0; i < jsondata.length; i++){
                var dd_year = jsondata[i][0];;
                var dd_month = jsondata[i][1];
                var dd_value = jsondata[i][2];
                arr_data1[i] = [gd(dd_year, dd_month, 28), dd_value];
             }


             if ($("#chart_plot_01").length){
                  $.plot( $("#chart_plot_01"), [ arr_data1,arr_data2 ],  chart_plot_01_settings );
             }

        }
    });


      $('#reportrange').on('apply.daterangepicker', function(ev, picker) {
            var fromDate = picker.startDate.format('YYYY-MM-DD');
            var toDate = picker.endDate.format('YYYY-MM-DD');


            console.log("Apply event fired, start/end dates are " + fromDate + " to " + toDate);

            //line graph
            $.ajax({
                type: 'get',
                url: 'proc/getDBGrievActivitiesData.php',
                dataType: 'JSON',
                data: {
                    startdate: fromDate,
                    enddate: toDate,
                },
                success: function(response) {
                  //console.log("res2:"+response);
                    var arr_data1 = [];
                    var arr_data2 = [];

                    var jsondata = JSON.parse(JSON.stringify(response));

                     for (var i = 0; i < jsondata.length; i++){
                        var dd_year = jsondata[i][0];;
                        var dd_month = jsondata[i][1];
                        var dd_value = jsondata[i][2];
                        arr_data1[i] = [gd(dd_year, dd_month, 28), dd_value];
                     }

                     if ($("#chart_plot_01").length){
                  $.plot( $("#chart_plot_01"), [ arr_data1,arr_data2 ],  chart_plot_01_settings );
                     }

                }
            });

            //

      });


  }

  //randomize 1 to 100
  function rv(){
    return Math.floor((Math.random() * 100) + 1);
  }
</script>

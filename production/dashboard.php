<!-- <script type='text/javascript' src="https://raw.github.com/xuanluo/flot-axislabels/master/jquery.flot.axislabels.js"></script> -->
          <!-- top tiles -->
          <div class="row" style="display: inline-block;" >
          <div class="tile_count">
            <div class="col-md-2 col-sm-4  tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Total number of Intervention</span>
              <div class="count green" id="dbw_total_interv">0&nbsp;&nbsp;</div>
              <!-- <span class="count_bottom"><i class="green">4% </i> Employment Facilitation</span> -->
            </div>
            <div class="col-md-2 col-sm-4  tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Employable Skills</span>
              <div class="count" id="dbw_employable_skills">0&nbsp;&nbsp;</div>
              <!-- <span class="count_bottom"><i class="green">4% </i> Employment Facilitation</span> -->
            </div>
            <div class="col-md-2 col-sm-4  tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Employment Facilitation</span>
              <div class="count" id="dbw_employment_facilitation">0&nbsp;&nbsp;</div>
              <!-- <span class="count_bottom"><i class="green">4% </i> Employment Facilitation</span> -->
            </div>            
            <div class="col-md-2 col-sm-4  tile_stats_count">
              <span class="count_top"><i class="fa fa-clock-o"></i> Social Security</span>
              <div class="count" id="dbw_social_security">0&nbsp;&nbsp;</div>
              <!-- <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>3% </i> From last Week</span> -->
            </div>
            <div class="col-md-2 col-sm-4  tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Health</span>
              <div class="count " id="dbw_health">0&nbsp;&nbsp;</div>
              <!-- <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span> -->
            </div>
            <div class="col-md-2 col-sm-4  tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Housing</span>
              <div class="count" id="dbw_housing">0&nbsp;&nbsp;</div>
              <!-- <span class="count_bottom"><i class="red"><i class="fa fa-sort-desc"></i>12% </i> From last Week</span> -->
            </div>
            <div class="col-md-2 col-sm-4  tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Pamana</span>
              <div class="count" id="dbw_pamana">0&nbsp;&nbsp;</div>
              <!-- <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span> -->
            </div>
            <div class="col-md-2 col-sm-4  tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> CIU</span>
              <div class="count" id="dbw_ciu">0&nbsp;&nbsp;</div>
              <!-- <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span> -->
            </div>
            <div class="col-md-2 col-sm-4  tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> DTI/Government Financial Institutions</span>
              <div class="count" id="dbw_dti">0&nbsp;&nbsp;</div>
              <!-- <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span> -->
            </div>
            <div class="col-md-2 col-sm-4  tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Department of Agriculture</span>
              <div class="count" id="dbw_da">0&nbsp;&nbsp;</div>
              <!-- <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span> -->
            </div>
            <div class="col-md-2 col-sm-4  tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> LGU, NGOs/CSOs</span>
              <div class="count" id="dbw_lgu">0&nbsp;&nbsp;</div>
              <!-- <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span> -->
            </div>

          </div>
 



        </div>
          <!-- /top tiles -->

          <div class="row">
            <div class="col-md-12 col-sm-12 ">
              <div class="dashboard_graph">

                <div class="row x_title">
                  <div class="col-md-6">
                    <h3>Intervention Activities <small></small></h3>
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
                    <h2>Interventions</h2>
                    <div class="clearfix"></div>
                  </div>

                  <div class="col-md-12 col-sm-12 ">
                    <div>
                      <p>Economic Soficiency</p>
                      <div class="">
                        <div class="progress progress_sm" style="width: 76%;">
                          <div class="progress-bar bg-green" role="progressbar" aria-valuemin="0" id="dbp_economic_sufficiency" ></div>
                        </div>
                      </div>
                    </div>
                    <div>
                      <p>Social Adequacy</p>
                      <div class="">
                        <div class="progress progress_sm" style="width: 76%;">
                          <div class="progress-bar bg-green" role="progressbar" data-valuemin="0" id="dbp_social_adequacy"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12 col-sm-12 ">
                    <div>
                      <p>Internal Interventions</p>
                      <div class="">
                        <div class="progress progress_sm" style="width: 76%;">
                          <div class="progress-bar bg-green" role="progressbar" data-valuemin="0" id="dbp_internal_internation"></div>
                        </div>
                      </div>
                    </div>
                    <div>
                      <p>External Interventions</p>
                      <div class="">
                        <div class="progress progress_sm" style="width: 76%;">
                          <div class="progress-bar bg-green" role="progressbar" data-valuemin="0" id="dbp_external_intervntion"></div>
                        </div>
                      </div>
                    </div>
                    <div>
                      <p>Other Interventions</p>
                      <div class="">
                        <div class="progress progress_sm" style="width: 76%;">
                          <div class="progress-bar bg-green" role="progressbar" data-valuemin="0" id="dbp_other_intervntion"></div>
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
                  <h2>Recent Activities <small>Sessions</small></h2>
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
        url: 'proc/getDBRecentIntrvData.php',
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
               
              var interv_id = jsondata[i][0];
              var subject   = jsondata[i][1];
              var details   = jsondata[i][2];
              var fullname  = jsondata[i][3];
              var date_conducted = jsondata[i][4];
              var date_encoded2 = new Date(date_conducted);


              var today = new Date();
              var diffMs = (today-date_encoded2); // milliseconds between now & Christmas
              var diffDays = Math.floor(diffMs / 86400000); // days
              var diffMonths = Math.floor(diffMs / 8.64e+8); // days
              var diffHrs = Math.floor((diffMs % 86400000) / 3600000); // hours
              var diffMins = Math.round(((diffMs % 86400000) % 3600000) / 60000); // minutes

              console.log(date_encoded2);
              console.log(diffMonths);
              console.log(today);

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
              str += "          <span>"+duration+"</span> by <a>"+fullname+"</a>";
              str += "       </div>";
              str += "      <p class=\"excerpt\">"+details.substring(0, 500);+"";
              str += "    ...<a href=#>Read&nbsp;More</a></p></div>";
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
        url: 'proc/getDBComponentDataProgressBar.php',
        dataType: 'JSON',
        data: {
            startdate: '2020-01-01',
            enddate: '2020-12-31',
        },
        success: function(response) {
            var arr_data1 = [];
            var jsondata = JSON.parse(JSON.stringify(response));
            var total_interv = jsondata[0][2];
             for (var i = 1; i < jsondata.length; i++){
                var comp_id = jsondata[i][0];
                var comp_desc = jsondata[i][1];
                var value = jsondata[i][2]/total_interv*100;
                if (comp_id == 1) $('#dbp_economic_sufficiency').css('width',value+'%').attr('data-transitiongoal',value).attr('aria-valuenow',value);
                if (comp_id == 2) $('#dbp_social_adequacy').css('width',value+'%').attr('data-transitiongoal',value).attr('aria-valuenow',value);
                if (comp_id == 3) $('#dbp_internal_internation').css('width',value+'%').attr('data-transitiongoal',value).attr('aria-valuenow',value);
                if (comp_id == 4) $('#dbp_external_intervntion').css('width',value+'%').attr('data-transitiongoal',value).attr('aria-valuenow',value);
                if (comp_id == 5) $('#dbp_other_intervntion').css('width',value+'%').attr('data-transitiongoal',value).attr('aria-valuenow',value);

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
            var arr_data1 = [];
            var jsondata = JSON.parse(JSON.stringify(response));

             for (var i = 0; i < jsondata.length; i++){
                var subcomp_id = jsondata[i][0];;
                var subcomp = jsondata[i][1];
                var value = jsondata[i][2];




                if (subcomp_id == 0) $('#dbw_total_interv').html(value+'&nbsp;&nbsp;');
                if (subcomp_id == 1) $('#dbw_employable_skills').html(value+'&nbsp;&nbsp;');
                if (subcomp_id == 2) $('#dbw_employment_facilitation').html(value+'&nbsp;&nbsp;');
                if (subcomp_id == 3) $('#dbw_social_security').html(value+'&nbsp;&nbsp;');
                if (subcomp_id == 4) $('#dbw_health').html(value+'&nbsp;&nbsp;');
                if (subcomp_id == 5) $('#dbw_housing').html(value+'&nbsp;&nbsp;');
                if (subcomp_id == 6) $('#dbw_pamana').html(value+'&nbsp;&nbsp;');
                if (subcomp_id == 7) $('#dbw_ciu').html(value+'&nbsp;&nbsp;');
                if (subcomp_id == 8) $('#dbw_dti').html(value+'&nbsp;&nbsp;');
                if (subcomp_id == 9) $('#dbw_da').html(value+'&nbsp;&nbsp;');
                if (subcomp_id ==10) $('#dbw_lgu').html(value+'&nbsp;&nbsp;');
                
             }
             // if ($("#chart_plot_01").length){
             //      $.plot( $("#chart_plot_01"), [ arr_data1 ],  chart_plot_01_settings );
             // } 
            
        }
    });
  }
  function init_flot_chart(){
    
    if( typeof ($.plot) === 'undefined'){ return; }
    
    console.log('init_flot_chart');
    var chart_plot_01_settings = {
          series: {
            lines: {
              show: false,
              fill: true
            },
            splines: {
              show: true,
              tension: 0.4,
              lineWidth: 5,
              fill: 0.1
            },
            points: {
              radius: 4,
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
            tickSize: [28, "day"],
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
          tooltip: false
        }


    var markers;
    $.ajax({
        type: 'get',
        url: 'proc/getDBIntervActivitiesData.php',
        dataType: 'JSON',
        data: {
            startdate: '2020-01-01',
            enddate: '2020-12-31',
        },
        success: function(response) {
            var arr_data1 = [];
            var jsondata = JSON.parse(JSON.stringify(response));

             for (var i = 0; i < jsondata.length; i++){
                var dd_year = jsondata[i][0];;
                var dd_month = jsondata[i][1];
                var dd_value = jsondata[i][2];

               
                arr_data1[i] = [gd(dd_year, dd_month, 28), dd_value];
             }
             if ($("#chart_plot_01").length){
                  $.plot( $("#chart_plot_01"), [ arr_data1 ],  chart_plot_01_settings );
             } 
            
        }
    });


  } 

  //randomize 1 to 100
  function rv(){
    return Math.floor((Math.random() * 100) + 1);
  }
</script>



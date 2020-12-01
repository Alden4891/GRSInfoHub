.
<div class="row">


              <div class="col-md-12 ">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>REPORTS <small></small></h2>
                    <!--ul class="nav navbar-right panel_toolbox">
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
                    </ul-->
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br>
                    <form class="form-horizontal form-label-left" target="_blank" method="post" action="./tbs/index.php">
                      <div class="form-group row">
                        <label class="control-label col-md-3 col-sm-3 ">REGION</label>
                        <div class="col-md-9 col-sm-9 ">
                          <select class="select2_single form-control" tabindex="-1" id=optionRegion name="optionRegion" >
                            <option value='-1'>Select</option>
                            <option value='12'>Region XII</option>
                          </select>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="control-label col-md-3 col-sm-3 ">PROVINCE</label>
                        <div class="col-md-9 col-sm-9 ">
                          <select class="select2_single form-control" tabindex="-1" id=optionProvince name="optionProvince">
                            <option value='-1'>Select</option>
                          </select>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="control-label col-md-3 col-sm-3 ">MUNICIPALITY</label>
                        <div class="col-md-9 col-sm-9 ">
                          <select class="select2_single form-control" tabindex="-1" id=optionMunicipality name="optionMunicipality">
                            <option value='-1'>Select</option>
                          </select>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="control-label col-md-3 col-sm-3 ">BARANGAY</label>
                        <div class="col-md-9 col-sm-9 ">
                          <select class="select2_single form-control" tabindex="-1" id=optionBarangay name=optionBarangay>
                            <option value='-1'>Select</option>
                          </select>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="control-label col-md-3 col-sm-3 ">TYPE OF REPORTS</label>
                        <div class="col-md-9 col-sm-9 ">
                          <select class="select2_group form-control" id=optionReportType name="optionReportType">
                            <optgroup label="Masterlists">
                              <option value="grs_r1">Grievance redress system monitoring report</option>
                            </optgroup>
                            <optgroup label="Summary">
                              <option value="grs_r2">Summary of Greivances by Status</option>
                              <option value="grs_r3">Summary of Greivances by Classification</option>
                            </optgroup>
                          </select>
                        </div>
                      </div>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-9 col-sm-9  offset-md-3">
                          <button type="submit" class="btn btn-success" disabled id="btnDownloadReport">Download</button>
                        </div>
                      </div>

                    </form>
                  </div>
                </div>
              </div>
            </div>

<script>
$(document).ready(function(e) {
    //load region filter
    //SELECT DISTINCT  region AS 'valuemember',region AS 'displaymember' FROM roster

      $.ajax({
      type: 'GET',
      url: './proc/getComboData.php',
      data: {
          tableName: "lib_psgc",
          valueMember: "DISTINCT  region",
          displayMember: "region",
          condition: "1 = 1 ",
          selected: -1,
      },
      success: function(response) {
          $('#optionRegion').html(response);
      }
    });
});

    //on #optionRegion changed
    $(document).on('change', "#optionRegion", function(e) {
        e.preventDefault();
        var value = $(this).children("option:selected").val()
        if (value !== -1) {
            $('#btnDownloadReport').removeAttr('disabled');
        }
        //get interv component values
        $.ajax({
            type: 'GET',
            url: './proc/getComboData.php',
            data: {
                tableName: "lib_psgc",
                valueMember: "DISTINCT province",
                displayMember: "province",
                condition: "region = '" + value + "'",
            },
            success: function(response) {

                $('#optionProvince').html(response);
            }
        });
    });

    //on #optionProvince changed
    $(document).on('change', "#optionProvince", function(e) {
        e.preventDefault();
        var value = $(this).children("option:selected").val()

        //get interv component values
        $.ajax({
            type: 'GET',
            url: './proc/getComboData.php',
            data: {
                tableName: "lib_psgc",
                valueMember: "DISTINCT MUNICIPALITY",
                displayMember: "MUNICIPALITY",
                condition: "PROVINCE = '" + value + "'",
            },
            success: function(response) {

                $('#optionMunicipality').html(response);
            }
        });
    });

    //on #optionMunicipality changed
    $(document).on('change', "#optionMunicipality", function(e) {
        e.preventDefault();
        var value = $(this).children("option:selected").val()

        //get interv component values
        $.ajax({
            type: 'GET',
            url: './proc/getComboData.php',
            data: {
                tableName: "lib_psgc",
                valueMember: "DISTINCT `BARANGAY`",
                displayMember: "`BARANGAY`",
                condition: "MUNICIPALITY = '" + value + "'",
            },
            success: function(response) {
                console.log(response);
                $('#optionBarangay').html(response);
            }
        });
    });
</script>

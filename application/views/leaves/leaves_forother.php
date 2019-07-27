<script src="<?php echo base_url();?>public/vendors/jquery/dist/jquery.min.js"></script>

<div class="">
            
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                      <h2><i class="fa fa-paper-plane-o" aria-hidden="true"></i> <span style="margin-left:10px;color:#73879C;">Request leaves Information form </span><small></small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <!--<ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>-->
                          
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                  <div class="row">
                    <fieldset class="scheduler-border">
                      <legend></legend>
                      <?php if(isset($errors)){?>
                        <div class="alert alert-danger" style="text-align:left;"><a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                            <p>ការសុំច្បាប់របស់អ្នក មិនបានជោតជ័យទេ !</p>
                            <p>លោកអ្នកបានសុំច្បាប់រួចរាល់ហើយ</p>
                            <p>សូមធ្វើការត្រួតពិនិត្យឡើងវិញម្ដងទៀត</p>
                        </div>
                        
                      <?php }?>
                      <div class="col-md-8">
                        <form  action="<?php echo site_url('requestforother');?>" method="post" enctype="multipart/form-data">
                                
                                <div class="row">
                                  <div class="col-sm-4 col-md-6 col-xs-12">
                                    <div class="form-group">
                                      <label for="exampleInputEmail1">Staff Name<sup style="color:red">*</sup></label>
                                      <select id='basic' class='form-control staffname' name="staffname"  required='required'>
                                          <option value="">Select Staff</option>
                                          <?php foreach($staff as $row){?>
                                          <option value="<?php echo $row->system_id;?>"><?php echo $row->staff_nameeng;?></option>
                                          <?php }?>
                                      </select>
                                      <input type="hidden" id='requestdate' name="requestdate" value="<?php echo date('Y-m-d');?>" required='required'>
                                    </div>
                                  </div>

                                  <div class="col-sm-4 col-md-6 col-xs-12">
                                    <div class="form-group">
                                      <label for="exampleInputEmail1">Leave Types<sup style="color:red">*</sup></label>
                                      <select class="form-control" name="leavetype" id="leavetype" required='required'>
                                          <option value="">Select leaves</option>
                                          <?php foreach($leavetypes as $row){ ?>
                                          <option value="<?php echo $row->id;?>"><?php echo $row->name;?></option>
                                          <?php }?>
                                      </select>
                                    </div>
                                  </div>

                                </div>

                                <div class="row">
                                  <div class="col-sm-4 col-md-6 col-xs-12">
                                    <div class="form-group">
                                      <label for="exampleInputEmail1">Date Start<sup style="color:red">*</sup></label>
                                      <input type="text" class="form-control" id="startdate" name="datestart" data-provide="datepicker" data-date-format="yyyy-mm-dd" data-date-start-date="+2d" placeholder="Date Start" required='required' autocomplete="off">
                                    </div>
                                  </div>

                                  <div class="col-sm-4 col-md-6 col-xs-12">
                                    <div class="form-group">
                                      <label for="exampleInputEmail1"><sup style="color:red">*</sup></label>
                                      <select class="form-control" name="morning" required='required'>
                                          <option value="Morning">Morning</option>
                                          <option value="Afternoon">Afternoon</option>
                                        </select>
                                    </div>
                                  </div>
                                </div>

                                <div class="row">
                                  <div class="col-sm-4 col-md-6 col-xs-12">
                                    <div class="form-group">
                                      <label for="exampleInputEmail1">Date End<sup style="color:red">*</sup></label>
                                      <input type="text" class="form-control" id="enddate" name="dateend" data-provide="datepicker" data-date-format="yyyy-mm-dd" data-date-start-date="+2d" placeholder="Date End" required='required' autocomplete="off">
                                    </div>
                                  </div>

                                  <div class="col-sm-4 col-md-6 col-xs-12">
                                    <div class="form-group">
                                      <label for="exampleInputEmail1"><sup style="color:red">*</sup></label>
                                      <select class="form-control" name="afternoon" required='required'>
                                          <option value="Afternoon">Afternoon</option>
                                          <option value="Morning">Morning</option>
                                      </select>
                                    </div>
                                  </div>
                                </div>


                                <div class="row">
                                  <div class="col-sm-4 col-md-12 col-xs-12">
                                    <div class="form-group">
                                      <label for="exampleInputEmail1">Note<sup style="color:red">*</sup></label>
                                      <textarea class="form-control" name="note" required='required' rows="3"></textarea>
                                    </div>
                                  </div>
                                </div>

                                <div class="row">
                                  <div class="col-sm-4 col-md-6 col-xs-12">
                                    <div class="form-group">
                                      <label for="exampleInputEmail1">Attach File</label>
                                      <input type="file" id="exampleInputFile" name="userfile">
                                        <p class="help-block">Select Files or Images(jpg|pdf|png|gif|JPG)</p>
                                    </div>
                                  </div>
                                </div>

                                <div class="row">
                                  <div class="col-sm-4 col-md-12 col-xs-12">
                                    <button type="button" class="btn btn-primary pull-right" style="display:none;" id="request" disabled="disabled">Request</button>
                                    <button type="submit" class="btn btn-primary pull-right"  id="requestshow"><span class="glyphicon glyphicon-ok"></span><span style="margin-left:10px;">Request</span></button>
                                    <button type="reset" class="btn btn-danger pull-right"  id="requestshow"><i class="fa fa-remove"></i><span style="margin-left:10px;">Cancel</span></button>
                                  </div>
                                </div>

                                <!-- <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-4 col-md-4 col-xs-12 control-label">Request</label>
                                    <div class="col-sm-4">
                                    <select class="form-control">
                                          <option value="1">Request</option> 
                                          <option value="2" disabled>Pending</option> 
                                    </select>
                                    </div>
                                  </div> -->                    
                                                      
                              </form>
                            </div>  
                            <div class="col-md-4">
                                <ul>
                                  <li><label>UNL:</label> Unpaid Leave</li>
                                  <li><label>MTL:</label> Maternity Leave</li>
                                  <li><label>SPL:</label> Special Leave</li>
                                  <li><label>SIL:</label> Sick Leave</li>
                                  <li><label>ANL:</label> Annual Leave</li>
                                </ul> 

                            </div>                         
                          <div>
                         </fieldset>  
                         </div>
                      </div>                     
                      
                    </div>   
                    </div>
                  </div>
                </div>
            </div>
        </div>

  <style>
  fieldset.scheduler-border {
    border: 2pt groove #ffff !important;
    padding: 0 1em 1em 1em !important;
    margin: 0 0 1.5em 0 !important;
    color:#73879C !important;
    -webkit-box-shadow:  0px 0px 0px 0px #000 !important;
            box-shadow:  0px 0px 0px 0px #000 !important;
    }

    legend.scheduler-border {
    font-size: 1.2em !important;
    font-weight: bold !important;
    text-align: left !important;
    color:#73879C !important;
    }
    legend{
        font-size: 1em !important;
        color: #777;
    }
    fieldset
    {
        width:100% !important;
        
    }
 </style>  
 
 <link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel = "stylesheet">
<script src = "https://code.jquery.com/jquery-1.10.2.js"></script>
<script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>

<script>
    var jqOld = jQuery.noConflict();
    jqOld(function() {
        jqOld("#startdate" ).datepicker({ dateFormat: 'yy-mm-dd' });
    });
    jqOld(function() {
        jqOld("#enddate" ).datepicker({ dateFormat: 'yy-mm-dd' });
    })
</script>


<script>
$(document).ready(function()
    {
    $('#basic').on('change',function(){
        var id=$(this).val();        
        $('#bystaff').load("<?php echo site_url("leave/checkbalance");?>/"+id);
        $('#leavetype').load("<?php echo site_url("leave/checkleavetype");?>/"+id);  
        
    });
    })
</script>
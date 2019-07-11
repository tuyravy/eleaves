<script src="<?php echo base_url();?>public/vendors/jquery/dist/jquery.min.js"></script>

<div class="">
            
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                      <h2><i class="fa fa-paper-plane-o" aria-hidden="true"></i> <span style="margin-left:10px;">Request leaves Information form </span><small></small></h2>
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
                    <?php if(isset($errors)){?>
                      <div class="alert alert-danger" style="text-align:left;"><a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                          <p>ការសុំច្បាប់របស់អ្នក មិនបានជោតជ័យទេ !</p>
                          <p>លោកអ្នកបានសុំច្បាប់រួចរាល់ហើយ</p>
                          <p>សូមធ្វើការត្រួតពិនិត្យឡើងវិញម្ដងទៀត</p>
                      </div>
                      
                     <?php }?>
                      <form class="form-horizontal form-label-left" action="<?php echo site_url('requestforother');?>" method="post" enctype="multipart/form-data">
                              <div class="box-body">
                                <div class="form-group">
                                  <label for="inputEmail3" for="staffname" class="col-sm-4 col-md-4 col-xs-12 control-label">Staff Name<span class="required">*</span></label>
                                  <div class="col-sm-4 col-md-4 col-xs-12">
                                
                                    <select id='basic' class='form-control staffname' name="staffname"  required='required'>
                                        <option value="">Select Staff</option>
                                        <?php foreach($staff as $row){?>
                                        <option value="<?php echo $row->system_id;?>"><?php echo $row->staff_nameeng;?></option>
                                        <?php }?>
                                    </select>
                                  </div>
                                  <div class="col-sm-4 col-md-4 col-xs-12">
                                      <label style="margin-left:50px;">ចំណុចសម្គាល់មុនពេលស្នើរសុំ</label>
                                    
                                  </div>
                                </div>
                                  
                                <input type="hidden" id='requestdate' name="requestdate" value="<?php echo date('Y-m-d');?>" required='required'>
                                <div class="form-group">
                                  <label for="inputEmail3" class="col-sm-4 col-md-4 col-xs-12 control-label">Leave Types<span class="required">*</span></label>
                                  <div class="col-sm-4 col-md-4 col-xs-12">

                                    <select class="form-control" name="leavetype" id="leavetype" required='required'>
                                        <option value="">Select leaves</option>
                                        <?php foreach($leavetypes as $row){ ?>
                                        <option value="<?php echo $row->id;?>"><?php echo $row->name;?></option>
                                        <?php }?>
                                    </select>
                                  </div>
                                  <div class="col-sm-4 col-md-4 col-xs-12">
                                      <label><span>សូមធ្វើការត្រួតពិនិត្យចំនួន Leaves Balance របស់បុគ្គលិកអោយបានត្រឹមត្រូវមុននិងធ្វើការស្នើរសុំ !</span></label>
                                    
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label for="inputPassword3" class="col-sm-4 col-md-4 col-xs-12 control-label">Date Start<span class="required">*</span></label>
                                  <div class="col-sm-4 col-md-4 col-xs-12">
                                    <input type="text" class="form-control" id="startdate" name="datestart" data-provide="datepicker" data-date-format="yyyy-mm-dd" data-date-start-date="+2d" placeholder="Date Start" required='required'>
                                  </div>
                                  <div class="col-sm-4 col-md-4 col-xs-12">
                                      <select class="form-control" name="morning" required='required'>
                                        <option value="Morning">Morning</option>
                                        <option value="Afternoon">Afternoon</option>
                                      </select>
                                  </div>
                                </div>

                                 <div class="form-group">
                                  <label for="inputPassword3" class="col-sm-4 col-md-4 col-xs-12 control-label">Date End<span class="required">*</span></label>
                                  <div class="col-sm-4 col-md-4 col-xs-12">
                                    <input type="text" class="form-control" id="enddate" name="dateend" data-provide="datepicker" data-date-format="yyyy-mm-dd" data-date-start-date="+2d" placeholder="Date End" required='required'>
                                  </div>

                                  <div class="col-sm-4 col-md-4 col-xs-12">
                                      <select class="form-control" name="afternoon" required='required'>
                                        <option value="Afternoon">Afternoon</option>
                                        <option value="Morning">Morning</option>
                                      </select>

                                  </div>     

                                </div>

                                 <div class="form-group">
                                  <label for="inputPassword3" class="col-sm-4 col-md-4 col-xs-12 control-label">Note<span class="required">*</span></label>
                                  <div class="col-sm-4 col-md-8 col-xs-12">
                                   <textarea class="form-control" name="note" required='required'></textarea>
                                  </div>
                                </div>

                                 <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-4 col-md-4 col-xs-12 control-label">Attach File</label>

                                    <div class="col-sm-8 col-md-4 col-xs-12">
                                       <input type="file" id="exampleInputFile" name="userfile">
                                       <p class="help-block">Select Files or Images(jpg|pdf|png|gif|JPG)</p>
                                    </div> 
                                </div>  
                                <div class="form-group">
                                  <label for="inputPassword3" class="col-sm-4 col-md-4 col-xs-12 control-label">Request</label>
                                  <div class="col-sm-4">
                                   <select class="form-control">
                                        <option value="1">Request</option> 
                                        <option value="2" disabled>Pending</option> 
                                   </select>
                                  </div>
                                </div>


                              </div><!-- /.box-body -->
                              <div class="box-footer">

                                <button type="button" class="btn btn-primary pull-right" style="display:none;" id="request" disabled="disabled">Request leaves</button>
                                <button type="submit" class="btn btn-primary pull-right"  id="requestshow"><span class="glyphicon glyphicon-ok"></span><span style="margin-left:10px;">Request leaves</span></button>
                              </div><!-- /.box-footer -->
                            </form>
                           <br><br>
                         <div>
                         <!--<table id="datatable-buttons" class="table table-striped table-bordered">
                          <thead>
                              <tr>
                                  <th rowspan="2" style="vertical-align: middle;">Staff Name</th>
                                  <th rowspan="2" style="vertical-align: middle;">Position</th>
                                  <th rowspan="2" style="vertical-align: middle;">Gender</th>
                                  <th colspan="5" id="in">Beginning Balance</th>
                                  <th colspan="5" id="in">Using Balance</th>
                                  <th colspan="5" id='in'>Ending Balance</th>
                              </tr>
                              <tr>
                                  <td id="smail">UNL</td>
                                  <td id="smail">MTL</td>
                                  <td id="smail">SPL</td>
                                  <td id="smail">SIL</td>
                                  <td id="smail">ANL</td>
                                  <td id="smail">UNL</td>
                                  <td id="smail">MTL</td>
                                  <td id="smail">SPL</td>
                                  <td id="smail">SIL</td>
                                  <td id="smail">ANL</td>
                                  <td id="smail">UNL</td>
                                  <td id="smail">MTL</td>
                                  <td id="smail">SPL</td>
                                  <td id="smail">SIL</td>
                                  <td id="smail">ANL</td>
                              </tr>
                          </thead>
                          <tbody id="bystaff">
                              <?php
                              
                              foreach ($balance as $row) {
                                  ?>
                                  <tr id="tbody">
                                      <td id="smail"><?php echo $row->staff_nameeng; ?></td>
                                      <td><?php echo $row->position_nameeng; ?></td>
                                      <td><?php echo $row->sex; ?></td>
                                      <td><?php echo $row->Unpaid; ?></td>
                                      <td><?php echo $row->Maternity; ?></td>
                                      <td><?php echo $row->Special; ?></td>
                                      <td><?php echo $row->Sick; ?></td>
                                      <td><?php echo $row->Annual; ?></td>
                                      <td><?php echo $row->useingUnpaid; ?></td>
                                      <td><?php echo $row->useingMaternity; ?></td>
                                      <td><?php echo $row->useingspecial; ?></td>
                                      <td><?php echo $row->useingSick; ?></td>
                                      <td><?php echo $row->useingAnnual; ?></td>
                                      <td><?php echo ($row->Unpaid) - ($row->useingUnpaid); ?></td>
                                      <td><?php echo ($row->Maternity) - ($row->useingMaternity); ?></td>
                                      <td><?php echo ($row->Special) - ($row->useingspecial); ?></td>
                                      <td><?php echo ($row->Sick) - ($row->useingSick); ?></td>
                                      <td><?php echo ($row->Annual) - ($row->useingAnnual); ?></td>
                                  </tr>
                              <?php } ?>
                          </tbody>
                      </table>-->
                      </div>
                      <br><br>
                      <ul>
                          <li><label>UNL:</label> Unpaid Leave</li>
                          <li><label>MTL:</label> Maternity Leave</li>
                          <li><label>SPL:</label> Special Leave</li>
                          <li><label>SIL:</label> Sick Leave</li>
                          <li><label>ANL:</label> Annual Leave</li>
                      </ul>  
                    </div>   
                    </div>
                  </div>
                </div>
            </div>
        </div>

 
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
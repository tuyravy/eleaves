<script src="<?php echo base_url();?>public/vendors/jquery/dist/jquery.min.js"></script>
<div class="">            
          <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2><i class="fa fa-paper-plane-o" aria-hidden="true"></i> <span style="margin-left:10px;">Request Leaves Form</span> <small></small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>  
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
                    <div class="col-md-10">
                      <form class="form-horizontal form-label-left" action="<?php echo site_url('requestleaves');?>" method="post" enctype="multipart/form-data">
                              <div class="box-body">
                                <input type="hidden" id='requestdate' name="requestdate" value="<?php echo date('Y-m-d');?>">
                                <div class="form-group">
                                  <label for="inputEmail3" class="col-sm-4 col-md-4 col-xs-12 control-label">Leave Types</label>
                                  <div class="col-sm-4 col-md-4 col-xs-12">
                                    <input type="hidden" name="staffname" value="<?php echo $this->session->userdata('system_id');?>">
                                    <select class="form-control typeleaves" name="leavetype" id="leavetype" required="required" autofocus>
                                        <option value="">Select leaves</option>
                                        <?php foreach($leavetypes as $row){?>
                                            <option value="<?php echo $row->id;?>"><?php echo $row->name;?></option>
                                        <?php }?>
                                    </select>
                                  </div>
                                  <div class="col-sm-4 col-md-4 col-xs-12">                                   
                                   <input type="text" class="form-control" disabled value="<?php if(isset($managername)){echo $managername->m_name;}?>">
                                  </div>
                                    
                                </div>
                                <div class="form-group">
                                  <label for="inputPassword3" class="col-sm-4 col-md-4 col-xs-12 control-label">Date Start</label>
                                  <div class="col-sm-4 col-md-4 col-xs-12">
                                    <input type="text" class="form-control" id="startdate" name="datestart" data-provide="datepicker" data-date-format="yyyy-mm-dd" data-date-start-date="+2d" placeholder="Date Start" required="required">
                                  </div>
                                  <div class="col-sm-4 col-md-4 col-xs-12">
                                      <select class="form-control" name="morning">
                                        <option value="Morning">Morning</option>
                                        <option value="Afternoon">Afternoon</option>
                                      </select>
                                  </div>
                                </div>

                                 <div class="form-group">
                                  <label for="inputPassword3" class="col-sm-4 col-md-4 col-xs-12 control-label">Date End</label>
                                  <div class="col-sm-4 col-md-4 col-xs-12">
                                    <input type="text" class="form-control" id="enddate" name="dateend" data-provide="datepicker" data-date-format="yyyy-mm-dd" data-date-start-date="+2d" placeholder="Date End" required="required">
                                  </div>

                                  <div class="col-sm-4 col-md-4 col-xs-12">
                                      <select class="form-control" name="afternoon">
                                        <option value="Afternoon">Afternoon</option>
                                        <option value="Morning">Morning</option>
                                      </select>

                                  </div>     

                                </div>

                                 <div class="form-group">
                                  <label for="inputPassword3" class="col-sm-4 col-md-4 col-xs-12 control-label">Note</label>
                                  <div class="col-sm-8 col-md-8 col-xs-12">
                                   <textarea class="form-control" name="note" required="required"></textarea>
                                  </div>
                                </div>

                                 <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-4 col-md-4 col-xs-12 control-label">Attach File</label>

                                    <div class="col-sm-8 col-md-4 col-xs-12">
                                       <input type="file" name="userfile">
                                       <p class="help-block">Select Files or Images(jpg|pdf|png|gif|JPG)</p>
                                    </div> 
                                </div>  
                                <div class="form-group">
                                  <label for="inputPassword3" class="col-sm-4 col-md-4 col-xs-12 control-label">Request</label>
                                  <div class="col-sm-4 col-md-4 col-xs-12">
                                   <select class="form-control">
                                        <option value="1">Request</option> 
                                        <option value="2" disabled>Pending</option> 
                                   </select>
                                  </div>
                                </div>


                              </div><!-- /.box-body -->
                              <div class="box-footer">

                                <button type="button" class="btn btn-primary pull-right" style="display:none;" id="request" disabled="disabled">Request leaves</button>
                                <button type="submit" class="btn btn-primary pull-right"  id="requestshow" class="btn"><span class="glyphicon glyphicon-ok"></span><span style="margin-left:10px;">Request leaves</span></button>
                              </div><!-- /.box-footer -->
                            </form>
                            <p></p>
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
    $('#departmet').on('change',function(){
        var id=$(this).val();
        
        $('.staffname').load("<?php echo site_url("Request_leaves_Controller/leavesstaff");?>/"+id);  
    });
    });
  
</script>

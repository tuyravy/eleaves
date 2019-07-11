<script src="<?php echo base_url();?>public/vendors/jquery/dist/jquery.min.js"></script>
<div class="">
            
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2><i class="fa fa-users" aria-hidden="true"></i><span style="margin-left:10px;">Create Users</span><small></small></h2>
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
                        
                      <form class="form-horizontal" action="<?php echo site_url('setcreate');?>" method="post" id="contact-form">
                  <div class="box-body">
                    
                    <div class="form-group">
                      <label for="inputEmail3" class="col-sm-4 control-label">Users Types</label>
                      <div class="col-sm-8">
                        <label class="radio-inline">
                          <input type="radio" name="useroption" id="user1" value="1" required> General 
                        </label>
                        <label class="radio-inline">
                          <input type="radio" name="useroption" id="user1" value="2" required> Accountent 
                        </label>
                        <label class="radio-inline">
                          <input type="radio" name="useroption" id="user2" value="3" required> BM<small>(Unite Manager)</small>
                        </label>
                        <label class="radio-inline">
                          <input type="radio" name="useroption" id="user2" value="4" required>RM<small>(Unite Manager)</small>
                        </label>
                        <label class="radio-inline">
                          <input type="radio" name="useroption" id="user3" value="5" required> Head Department 
                        </label>
                      </div>
                    </div>  
                      
                    <div class="form-group">
                      <label for="inputEmail3" class="col-sm-4 control-label">SID</label>
                      <div class="col-sm-4">
                        <input type="text" class="form-control" name="sid" id="sid"  data-toggle="tooltip" data-placement="left" title="SID Required" placeholder="លេខកាត់សម្គាល់ខ្លួន" required> 
                      </div>
                      <div class="col-sm-4">
                          <input type="text" class="form-control" id="employesdate" name="empdate" data-provide="datepicker" data-date-format="yyyy-mm-dd" placeholder="Employes Date" required>
                      </div>
                    </div>
                     
                    
                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-4 control-label">Staff Name(Eng)</label>
                        
                      <div class="col-sm-4">
                        <input type="text" class="form-control" id="fname" name="fname" data-toggle="tooltip" data-placement="left" title="First name Required"  placeholder="First Name" required>
                      </div>
                      <div class="col-sm-4">
                        <input type="text" class="form-control" id="fname" name="lname" data-toggle="tooltip" data-placement="left" title="Last name Required"  placeholder="Last Name" required>
                      </div>
                    </div>
                      
                     <div class="form-group">
                      <label for="inputPassword3" class="col-sm-4 control-label">Staff Name(KH)</label>
                      <div class="col-sm-4">
                        <input type="text" class="form-control" id="fname" name="fnamekhr" data-toggle="tooltip" data-placement="left" title="First name Required"  placeholder="First Name" required>
                      </div>
                        <div class="col-sm-4">
                        <input type="text" class="form-control" id="fname" name="lnamekhr" data-toggle="tooltip" data-placement="left" title="Last name Required"  placeholder="Last Name" required>
                      </div>
                     
                      
                      
                    </div>
                      
                     <div class="form-group">
                      <label for="inputPassword3" class="col-sm-4 control-label">Email Address</label>
                      <div class="col-sm-4">
                        <input type="email" class="form-control" id="email" name="email" data-toggle="tooltip" data-placement="left" title="Email Required" placeholder="Email Address" required>
                      </div>
                    
                       <div class="col-sm-4">
                        <input type="text" class="form-control" id="pnumber" name="pnumber" data-toggle="tooltip" data-placement="left" title="Phone number Required" placeholder="Phone number" required>
                      </div>    
                         
                    </div>
                      
            
                      <div class="form-group">
                      <label for="inputPassword3" class="col-sm-4 control-label">Branch Name:</label>
                      <div class="col-sm-4">
                       <select class="form-control" name="brname">
                        <option>Select Branch</option>   
                        <?php foreach($br as $row){?>
                            <option value="<?php echo $row->brCode;?>"><?php echo $row->brName;?></option>   
                         <?php }?>
                      </select>
                      
                      </div>
                    <div class="col-sm-4">
                       <select class="form-control" name="subbrname">
                        <option value="0">Select Sub Branch</option>  
                        <option value="0">No SubBranch</option>
                        <?php foreach($br as $row){?>
                            <option value="<?php echo $row->brCode;?>"><?php echo $row->brName;?></option>   
                         <?php }?>
                        
                      </select>
                      
                      </div>
                          
                         
                    </div>  
                      
                  </div><!-- /.box-body -->
                  <div class="box-footer">
                    <div align='right'>
                        
                        <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span><span style="margin-left:10px;"></span>Add</button>
                        <button type="reset" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span><span style="margin-left:10px;"></span>Cancel   </button>
                    </div> 
                   
                  </div><!-- /.box-footer -->
                </form>
                  
                      
                   
                  </div>
                </div>
              </div>
            </div>
          </div>
        
            



              <style>
                  .table-hover tr td:hover
                  {
                      
                      cursor: pointer;
                  }
              </style>
              <script>
                  $(document).ready(function()
                    {
                      
                     $('#sid').focusout(function()
                     {
                         var sid=$(this).val();
                         if(sid=="")
                         {
                           $("#style").html("<style>#sid{border:1px solid red;}</style>");
                           $("#style").show();  
                           $("#submit").hide();
                         }
                         else
                         {
                             $("#style").hide();
                             
                         }
                     })  
                     $("#postion").focus(function()
                        {
                            $("#postionmodal").modal();
                        })
                    })
                    $("#selected #hover").on("click","td",function()
                     {
                        var id=$(this).data('id');
                        var name=$(this).data('name');
                        var description=$(this).data('description');
                        document.getElementById("postion").value=name;
                        document.getElementById("idpostion").value=id;
                        
                        $("#postionmodal").modal("hide");
                     })
                    $("#manager").focus(function()
                    {
                        $("#managementmodel").modal();
                        
                    })
                    $("#selected #hovermana").on("click","td",function()
                    {
                        var id=$(this).data('id');
                        var name=$(this).data('name');
                        var brcode=$(this).data('code');
                        document.getElementById("manager").value=name;
                        document.getElementById("idmanager").value=id;
                        document.getElementById("brcode").value=brcode;
                        $("#managementmodel").modal("hide");
                    })
              </script>
                <script type="text/javascript">
                $(function() {
                    $('input[name="empdate"]').daterangepicker({
                        singleDatePicker: true,
                        showDropdowns: true
                    },

                    function(start, end, label) {
                        var years = moment().diff(start, 'years');

                    });
                });
                $(function() {

                    $('input[name="dateend"]').daterangepicker({
                        singleDatePicker: true,
                        showDropdowns: true
                    },
                    function(start, end, label) {
                        var years = moment().diff(start, 'years');

                    });
                });
                </script>
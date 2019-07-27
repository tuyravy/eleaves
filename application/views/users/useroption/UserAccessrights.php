<script src="<?php echo base_url();?>public/vendors/jquery/dist/jquery.min.js"></script>

          <div class="">
            <div class="clearfix"></div>
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2><i class="fa fa-users" aria-hidden="true"></i><span style="margin-left:10px;color:#73879C;">User Access rights</span></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
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

                            <form class="form-inline" action="<?= site_url('reports/ereportbydate');?>" method="post">

                                <div class="form-group">
                                    <label for="exampleInputName2">Brname</label>                                    
                                        <select class="form-control select2" name="customer" id="customer">
                                        <?php foreach($branch as $row){?>
                                         <option value="<?php $row->brCode?>"><?php echo $row->brName;?></option>
                                        <?php }?>
                                        </select>
                               
                                </div>    

                                <div class="form-group">
                                    <label for="exampleInputName2">System Id</label>                                    
                                    <input type="text" class="form-control" name="datestart" id="datestart" placeholder="System Id" autocomplete="off">                                   
                                </div>           
                                <button type="submit" class="btn btn-success" style="margin-top:5px;"><i class="fa fa-search"></i><span style="margin-left:5px;">Search</span></button>
                            
                            </form>

                    </fieldset>  
                  </div>

                  <div class="row">   
                  <fieldset class="scheduler-border">
                    <legend></legend> 

                    
                  <div class="table-responsive">
                    <table id="datatable-buttons" class="table table-striped table-bordered" >
                      <thead style="border-bottom:2pt solid #22d4ae;">
                        <tr>
                          <th style="text-align:center">ID</th>
                          <th>BrName</th>
                          <th style="text-align:center">BrCode</th>
                          <th>StaffName</th>
                          <th>UserName</th>
                          <th>Position</th>                          
                          <th style="text-align:center">Action</th>
                        </tr>
                      </thead>                   
                      <tbody>
                       
                      </tbody>
                    </table>
                       
                   </div> 
                   </fieldset>
                     </div>   
                   </div>
                </div>
              </div>
            </div>
             
          
           
        <!-- /page content -->

<style>
 .nopadding {
    padding: 0 !important;
    margin: 0 !important;
}
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
<script>   
    $(document).ready(function()
    {
        $('.select2').select2();
    });
</script>
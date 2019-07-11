            <script src="<?php echo base_url();?>public/vendors/jquery/dist/jquery.min.js"></script>       
            <div class="clearfix"></div>
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2><i class="fa fa-floppy-o" aria-hidden="true"></i><span style="margin-left:10px;">Staff Control</span></h2>
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
                <div class="pull-right">
                    <button class="btn btn-primary" onclick="javascript:printDiv('reports')" id="btnPrint"><span class="glyphicon glyphicon-print"></span></button>
                    <p></p>
                </div>
                <div>
                    <form class="form-inline" action="<?= site_url('user/staffFitter');?>" method="GET">
                    <div class="form-group">
                        <label for="exampleInputName2">Branch</label>
                        <select class="form-control" name="Brcode">
                            <option value='0'>All</option>
                            <?php foreach($Branch as $row){?>
                            <option value="<?= $row->brCode;?>"><?= $row->shortcode;?></option>
                            <?php }?>
                        </select>
                        
                      </div>
                      <!--<div class="form-group">
                       
                        <select class="form-control" name="Brcode">
                            <option value='0'>Position</option>
                            <?php foreach($position as $row){?>
                            <option value="<?= $row->pid;?>"><?= $row->position_kh;?></option>
                            <?php }?>
                        </select>
                        
                      </div>-->
                      <div class="form-group">
                        <label for="exampleInputName2">Statu</label>
                        <select class="form-control" name="statu">                            
                            <option value='1'>Active</option>
                            <option value='0'>InActive</option>
                        </select>
                        
                      </div>
                      <div class="form-group">
                        <label for="exampleInputName2">Start</label>
                        <input type="text" class="form-control" name="datestart" id="datestart" placeholder="Start" value="<?php if(isset($start)){ echo $start;}?>">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail2">End</label>
                        <input type="text" class="form-control" name="dateend" id="dateend" placeholder="End" value="<?php if(isset($end)){ echo $end;}?>">
                      </div>
                      <button type="submit" class="btn btn-success" style="margin-top:5px;"><i class="fa fa-share-square"></i><span style="margin-left:5px;">Submit</span></button>
                      <a href="<?= site_url('user/staffcontroler'); ?>" style="margin-top:5px;" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Refresh Page"><span class="glyphicon glyphicon-refresh"></span></a>
                    </form>
                </div>
                <div class="row">
                    <div class="form-group col-md-4">   
                       <label for="exampleInputName2">Fitter by</label>             
                        <select class="form-control" name="position" id="fitterby">
                            <option value='0'>Position</option>
                            <?php foreach($position as $row){?>
                            <option value="<?= $row->pid;?>"><?= $row->position_kh;?></option>
                            <?php }?>
                        </select>
                    
                      </div>
                </div>
                <div id="reports">
                      <div class="row" id="logoreports" style="display:none">
                            <div class="col-md-6">
                                  <img src="<?php echo base_url();?>public/img/logo_simple.png" class="img-responsive" alt="Cinque Terre">
                            </div>
                              <div class="col-md-6" id="textcenter">
                                  <h2 id="in" style="font-size:25px;text-align:center">សហគ្រិនភាព ម៉ាយក្រួហ្វាយនែន ភិអិលស៊ី</h2>
                                  <h2 id="in1" style="text-align:center;">SAHAKRINPHEAP S.T MICROFINANCE PLC</h2>
                                  <h2 id="in2" style="text-align:center;">Eleaves Reports</h2>
                                  <p id="in3" style="text-align:center">Reports Date:
                                  <?php if(isset($start)){echo $start;}else{echo $start;}?>
                                    <span style="margin-left:10px;">
                                        To:<span style="margin-left:10px;">
                                          <?php if(isset($end)){echo $end;}else{echo $end;}?>
                                          </span>
                                    </span>
                                  </p>
                              </div>   
                      </div> 
                      <table class="table table-bordered">
                        <thead style="boder">
                          <th>BrCode</th>
                          <th>BrName</th>
                          <th>StaffName-KH</th>
                          <th>StaffName-Eng</th>
                          <th>Date_employee</th>                          
                          <th>Position_KH</th>
                          <th>Statu Request</th>                          
                        </thead>
                        <tbody  id="reportsleaves">
                        <?php foreach($staffControl as $row){?>
                        <tr>
                          <td><?php echo $row->brCode;?></td>
                          <td><?php echo $row->shortcode;?></td>
                          <td><?php echo $row->staff_nameeng;?></td>
                          <td><?php echo $row->staff_namekh;?></td>
                          <td><?php echo $row->dateemployee;?></td>                             
                          <td><?php echo $row->position_namekh;?></td>                          
                          <td style="text-align:center">
                          <?php if($row->tellerset=1){ ?>
                            <a href="#" id="reject" data-id='<?php echo $row->lid;?>'>
                                <button type="button" class="btn btn-danger btn-xs">Not Yet</button>
                            </a>                           
                              
                            <?php  }else{ ?>
                            <a href="#" id="reject" data-id='<?php echo $row->lid;?>'>
                                <button type="button" class="btn btn-danger btn-xs">Not Yet</button>
                            </a>
                            <?php }?>
                          
                          </td>
                        </tr>
                        <?php }?>
                        </tbody>
                      </table>
                      <div class="col-sm-12" id="foldershow" style="display:none;">
                                <p>ថ្ងៃទី.......ខែ.....ឆ្នាំ..<?php echo date('Y');?></p>
                                <p style="margin-left:40px;">ហត្ថលេខា</p>
                                <p>................................</p>
                                <p><span style="margin-left:30px;"><?php echo $this->session->userdata('fullname');?></span></p>
                              <br/>

                      </div>
                  </div>

                  <div class="pull-right">
                    <div style="margin-top: 25px;margin-bottom: -12px;">
                        <label>Total <span class="label label-default"><?= $total_rows; ?></span>records</label>
                    </div>  
                    <br/>
                    <?php echo $this->pagination->create_links(); ?>
                  </div>

                  </div>
              </div>
            </div>
        <!-- /page content -->

<link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel = "stylesheet">
<script src = "https://code.jquery.com/jquery-1.10.2.js"></script>
<script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<style>
/* style sheet for "A4" printing */
  @media print and (width: 21cm) and (height: 29.7cm) {
      @page {
          margin: 3cm;
          
      }
      
  }

  /* style sheet for "letter" printing */
  @media print and (width: 8.5in) and (height: 11in) {
      @page {
          margin: 1in;
      }
     
  }
  
  /* A4 Landscape*/
  @page {
      size: A4 landscape;
      margin: 10%;
  }
</style>
<script>
    var jqOld = jQuery.noConflict();
    jqOld(function() {
        jqOld("#datestart" ).datepicker({ dateFormat: 'yy-mm-dd' });
    });
    jqOld(function() {
        jqOld("#dateend" ).datepicker({ dateFormat: 'yy-mm-dd' });
    })
</script>
     
     <script language="javascript" type="text/javascript">
        function printDiv(divID) {
            
            //Get the HTML of div
            var divElements = document.getElementById(divID).innerHTML;
            //Get the HTML of whole page
            var oldPage = document.body.innerHTML;
            //Reset the page's HTML with div's HTML onl
            document.body.innerHTML = 
              "<html><head><title></title></head><body>" + 
              divElements + "</body>";
              document.getElementById("foldershow").style.display= "inline-block";   
              document.getElementById("logoreports").style.display= "inline-block";  
              document.getElementById("textcenter").style.margin = "0px 100px 10px 210px";
              var table=document.getElementById("reportsleaves");
              var r=0;
              while(row=table.rows[r++])
              {
                var c=9;
                while(cell=row.cells[c++])
                {
                  //cell.innerHTML='[Row='+r+',Col='+c+']'; // do sth with cell
                  cell.innerHTML=""; // do sth with cell

                }
              }
              
            //Print Page
            window.print();
            //Restore orignal HTML
            document.body.innerHTML = oldPage;
            
          
        }
    </script>
 
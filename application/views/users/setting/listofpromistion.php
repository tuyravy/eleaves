
<div class="">   
    <div class="clearfix"></div>
       
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2><i class="fa fa-address-book" aria-hidden="true"></i><span>Add User Function</span><small></small></h2>
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
                        
                        <form class="form-horizontal" action="<?php echo site_url('user/Searchstaff'); ?>" method="post">
                          <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Staff ID</label>
                            <div class="col-sm-4">
                              <input type="text" class="form-control" id="inputEmail3" value="<?php if(isset($staffname->system_id)){echo $staffname->system_id;};?>" name="staffid" placeholder="Staff ID" >
                            </div>
                            <label for="inputEmail3" class="col-sm-2 control-label">Staff Name</label>
                            <div class="col-sm-4">
                              <input type="text" class="form-control" id="inputEmail3" value="<?php if(isset($staffname->full_name)){echo $staffname->full_name;};?>" placeholder="Staff Name" readonly>
                            </div>
                          </div>
                          
                          <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">Main Function Code</label>
                            <div class="col-sm-4">
                              <input type="text" value="<?php if(isset($staffname->menu_option)){echo $staffname->menu_option;};?>" class="form-control" id="inputPassword3" placeholder="Main Function" readonly>
                            </div>
                            <label for="inputEmail3" class="col-sm-2 control-label">Sub Function Code</label>
                            <div class="col-sm-4">
                              <input type="text" value="<?php if(isset($staffname->submenu_option)){echo $staffname->submenu_option;};?>" class="form-control" id="inputEmail3" placeholder="Sub Function" readonly>
                            </div>
                          </div>
                         
                          <div class="form-group">
                            <div class="pull-right" style="margin-right:7px;">
                              <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search"></span>
                               <span style="margin-left:5px;">Find Now</span></button>
                            </div>
                          </div>
                        </form> 
                    <form>

                        <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span>
                            <span style="margin-left:5px;">Add Function</span>
                        </button>

                        <table class="table table-bordered">
                        <tbody>
                        <tr class="success">
                            <td align="center">ID</td>
                            <td>Menu Name</td>
                            <td>Function Name</td>
                            
                        </tr>
                        </tbody>
                       <?php 
                            $i=1;
                            foreach ($listmenu as $list) {                            
                            
                       ?>  
                        <tr class="warning">
                            <td align="center"><?php echo $i++;?></td>
                            <td colspan="2">
                                <input type="checkbox" class="check">
                                <span style="margin-left:5px;cursor:pointer;">
                                    <?php echo $list->function_name; ?>
                                </span>
                            </td>
                        <?php 
                        $getsubmenu=$this->users_model->getsubmenu($list->mid);
                        
                        
                        foreach($getsubmenu as $row){
                            
                            echo $check=$this->users_model->checksubmenu($row->mid,$staffname->user_id); 
                             
                        ?>
                            
                            <tr>
                                <td></td>
                                <td>
                                  <div  style="margin-left:30px;">
                                  
                                    <input type="checkbox" class="check"><span style="margin-left:5px;cursor:pointer;"><?php echo $row->function_name;?></span>
                                  
                                  </div>
                                </td>
                                <td><?php echo $row->controller;?></td>
                            </tr>     

                            <?php
                             }
                            ?>
                        </tr>
                    

                       <?php
                                 
                        }
                         ?>
                        </table>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.check:hover
{
    cursor:pointer;
}
</style>

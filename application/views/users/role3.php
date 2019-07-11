
<style>
    .font13{
        font-size: 14px;
    }
</style>
<script src="<?php echo base_url();?>public/vendors/jquery/dist/jquery.min.js"></script>



<script>
        $(window).load(function(){
                $('#onload').modal('show');
            });
</script>

 <div class="col-md-12 col-sm-12 col-xs-12 nopadding">
                
                <div class="row" role="main" style="background-color: white;padding:10px;">
                    <div class="clearfix"></div>
                   
                    <div class="row">
                        <!--current balance SKP-->
                        <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
                            <div class="tile-stats">
                                <div class="icon"><i class="fa fa-users"></i></div>
                                <div class="count" style="font-size: 20px"></div>
                                <h3  class="font13" style="margin-top: 10px;">ចំនួនបុគ្គលិកសរុប</h3>
                                
                                <p><a href="javascript:void(0)">&nbsp;</a></p>
                                <p class="pull-right" style="margin-top:40px;margin-right:10px;">
                                    <a href="http://www.app.sahakrinpheap.com/eleaves/liststaff"><span style="color:red;">Click here</span></a></p>
                                <h1><span style="padding:10px;"></span><?php echo $dashboard;?></h1>
                                
                            </div>
                        </div>
                        <!--current balance MMI-->
                        <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
                            <div class="tile-stats">
                                <div class="icon"><i class="fa fa-users"></i></div>
                                <div class="count" style="font-size: 20px"></div>
                                <h3  class="font13" style="margin-top: 10px;">ចំនួនបុគ្គលិកសុំច្បាប់ក្នុងខែ</h3>
                                <p><a href="javascript:void(0)">&nbsp;</a></p>
                                <p class="pull-right" style="margin-top:40px;margin-right:10px;">
                                    <a href="http://www.app.sahakrinpheap.com/eleaves/reports_leaves"><span style="color:red;">Click here</span></a></p>
                                <h1><span style="padding:10px;"></span><?php echo $eleaves;?></h1>
                            </div>
                        </div>
                        <!--current balance FSS-->
                        <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
                            <div class="tile-stats">
                                <div class="icon"><i class="fa fa-users"></i></div>
                                <div class="count" style="font-size: 20px"></div>
                                <h3  class="font13" style="margin-top: 10px;">បុគ្គលិកមិនអនុញ្ញាតច្បាប់ក្នុងខែ</h3>
                                <p><a href="javascript:void(0)">&nbsp;</a></p>
                               
                                <h1><span style="padding:10px;"></span><span><?php echo $reject;?></span></h1>
                            </div>
                        </div>
                        <!--pending cash request-->
                        <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
                            <div class="tile-stats">
                                <div class="icon"><i class="fa fa-recycle" aria-hidden="true"></i></div>
                                <div class="count" style="font-size: 20px"></div>
                                <h3  class="font13" style="margin-top: 10px;">ស្នើរសុំបញ្ចូលឈ្មោះបុគ្លលិកថ្មីក្នុងប្រព័ន្ធ</h3>
                                <p><a href="javascript:void(0)">&nbsp;</a></p>
                                <p class="pull-right" style="margin-top:40px;margin-right:10px;">
                                    <a href="#" data-toggle="modal" data-target="#myModal">
                                    <span style="color:red;">Request Now</span></a></p>
                                    
                                <h1><span style="padding:10px;"></span><span><?php echo $request;?></span></h1>
                            </div>
                        </div>
                        <!--
                        <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
                            <div class="tile-stats">
                                <div class="icon" style="margin-top:5px;"><i class="fa fa-users"></i></div>
                                <div class="count" style="font-size: 20px"></div>
                                <h3 class="font13" style="margin-top: 10px;">ចំនួនបុគ្គលិកសុំច្បាប់ច្រើនក្នុងខែ</h3>
                                <p><a href="javascript:void(0)">&nbsp;</a></p>
                                <h1><span style="padding:10px;"></span></h1>
                            </div>
                        </div>
                        <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
                            <div class="tile-stats">
                                <div class="icon" style='margin-top:5px;'><i class="fa fa-users"></i></div>
                                <div class="count" style="font-size: 20px"></div>
                                <h3 class="font13" style="margin-top: 10px;">សំណើរសុំបញ្ចូលឈ្មោះបុគ្គលិកថ្មី</h3>
                                <p><a href="javascript:void(0)">&nbsp;</a></p>
                                <h1><span style="padding:10px;"></span></h1>
                            </div>
                        </div>
                       -->  
                    </div>
                   
            </div>
            </div>
           
          <!-- Modal -->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel"><i class="fa fa-recycle" aria-hidden="true"></i><span style="margin-left:5px;">Request New Staff</span></h4>
                </div>
                <div class="modal-body">
                <form class="form-horizontal" action="<?php echo site_url('home/reqeustnewstaff');?>" method="post">
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-4 control-label">Staff ID</label>
                        <div class="col-sm-8">
                        <input type="text" class="form-control" id="inputEmail3" name="staffid" placeholder="Staff ID" required="requeired">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-4 control-label">Staff Name KH</label>
                        <div class="col-sm-8">
                        <input type="text" class="form-control" id="inputPassword3" name="staffname" placeholder="Staff Name KH" required="requeired">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-4 control-label">Staff Name Eng</label>
                        <div class="col-sm-8">
                        <input type="text" class="form-control" id="inputPassword3" name="staffnameeng" placeholder="Staff Name Eng" required="requeired">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-4 control-label">Note</label>
                        <div class="col-sm-8">
                            <textarea class="form-control" rows="3" name="note"></textarea>
                        </div>
                    </div>
                    <div class="pull-right">
                        <button type="button" data-dismiss="modal" class="btn btn-danger"><i class="fa fa-times" aria-hidden="true"></i>
                        <span style="margin-left:3px;">Close</span></button>
                        <button type="submit" class="btn btn-primary" name="submit"><i class="fa fa-recycle" aria-hidden="true"></i>
                        <span style="margin-left:5px;">Request Now<span></button>
                    </div>
                   
                    
                    </form>
                </div>
                <div class="modal-footer">
                   
                </div>
                </div>
            </div>
            </div>
            

<script>
    function load()
    {
       
        $(".bs-example-modal-lg").modal("show");
    }
    window.onload = load;

</script>
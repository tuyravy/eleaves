

<div class="[ container text-center ]">

    <div class="[ row ]">

        <div class="[ col-xs-12 ]" style="padding-bottom: 30px;">

            <h2>កំណត់លក្ខខណ្ឌក្នុងការគ្រប់គ្រង</h2>

        </div>

    </div>

</div>

<div class="[ container text-center ]">

	<div class="[ row ]">

		<div class="[ col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 ]" role="tabpanel">

            <div class="[ col-xs-4 col-sm-12 ]">

                <!-- Nav tabs -->

                <ul class="[ nav nav-justified ]" id="nav-tabs" role="tablist">

                    <li role="presentation" class="active">

                        <a href="#dustin" aria-controls="dustin" role="tab" data-toggle="tab">

                             <img class="img-circle" src="<?php echo base_url();?>/assets/img/logo/Icojam-Blue-Bits-Document-delete.ico" />

                            

                            <span class="quote"><i class="fa fa-quote-left"></i></span>

                        </a>

                    </li>

                    <li role="presentation" class="">

                        <a href="#daksh" aria-controls="daksh" role="tab" data-toggle="tab">

                           <img class="img-circle" src="<?php echo base_url();?>/assets/img/logo/check_Datencheck.png" />

                            <span class="quote"><i class="fa fa-quote-left"></i></span>

                        </a>

                    </li>

                    <li role="presentation" class="">

                        <a href="#anna" aria-controls="anna" role="tab" data-toggle="tab">

                           <img class="img-circle" src="<?php echo base_url();?>/assets/img/logo/setting.png" />

                            <span class="quote"><i class="fa fa-quote-left"></i></span>

                        </a>

                    </li>

                   

                </ul>

            </div>

            <div class="[ col-xs-8 col-sm-12 ]">

                <!-- Tab panes -->

                <div class="tab-content" id="tabs-collapse">            

                    <div role="tabpanel" class="tab-pane fade in active" id="dustin">

                        <div class="tab-inner">                    

                           

                             <div class="container">

                                <div class="row">

                                    <h3>លោកអ្នកគ្រូវចុចប៊ូតុងខាងក្រោមដើម្បីកំណត់ពីការគ្រប់គ្រងផ្សេងក្នុងប្រព័ន្ធ<br /><small></small></h3>

                                    <p><strong>Setting Code</strong></p>

                                    <form action="<?php echo site_url('setcode');?>" method="post">

                                        <button type="submit" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#processing-modal">

                                            <i class="glyphicon glyphicon-play"></i> Start Processing

                                        </button>  

                                     </form>

                                    <!-- Static Modal -->

                                    <div class="modal modal-static fade" id="processing-modal" role="dialog" aria-hidden="true">

                                        

                                        <div class="modal-dialog">

                                            <div class="modal-content">

                                                <div class="modal-body">

                                                    <div class="text-center">

                                                        <img src="<?php echo base_url();?>/assets/img/logo/loader.gif" class="icon" style="margin-left:-20px;margin-top:-20px;"/>

                                                        

                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                       

                                    </div>

                                </div>

                            </div>

                            <p><strong class="text-uppercase">Please Wait affter Finished</strong></p>

                            <p><em class="text-capitalize"> </em>  <a href="#"></a></p>                 

                        </div>

                    </div>

                    

                    <div role="tabpanel" class="tab-pane fade" id="daksh">

                        <div class="tab-inner">

                            <p class="lead">Suspendisse dictum gravida est, nec consequat tortor venenatis a. Suspendisse vitae venenatis sapien.</p>

                            <hr>

                            

                           





                            

                            

                            <p><strong class="text-uppercase">Daksh Bhagya</strong></p>

                            <p><em class="text-capitalize"> UX designer</em> at <a href="#">Google</a></p>

                        </div>

                    </div>

                    

                    <div role="tabpanel" class="tab-pane fade" id="anna">

                        <div class="tab-inner">

                            <p class="lead">Nullam suscipit ante ac arcu placerat, nec sagittis quam volutpat. Vestibulum aliquam facilisis velit ut ultrices.</p>

                            <hr>

                            <p><strong class="text-uppercase">Anna Pickard</strong></p>

                            <p><em class="text-capitalize"> Master web developer</em> at <a href="#">Intel</a></p>

                        </div> 

                    </div>

                    

                    <div role="tabpanel" class="tab-pane fade" id="wafer">

                        <div class="tab-inner">

                            <p class="lead"> Fusce erat libero, fermentum quis sollicitudin id, venenatis nec felis. Morbi sollicitudin gravida finibus.</p>

                            <hr>

                            <p><strong class="text-uppercase">Wafer Baby</strong></p>

                            <p><em class="text-capitalize"> Web designer</em> at <a href="#">Microsoft</a></p>

                        </div>

                    </div>

                </div>

            </div>        

        </div>

	</div>

</div>

<style>



    @import url(//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css);



.nav.nav-justified > li > a { position: relative; }

.nav.nav-justified > li > a:hover,

.nav.nav-justified > li > a:focus { background-color: transparent; }

.nav.nav-justified > li > a > .quote {

    position: absolute;

    left: 0px;

    top: 0;

    opacity: 0;

    width: 30px;

    height: 30px;

    padding: 5px;

    background-color: #13c0ba;

    border-radius: 15px;

    color: #fff;  

}

.nav.nav-justified > li.active > a > .quote { opacity: 1; }

.nav.nav-justified > li > a > img { box-shadow: 0 0 0 5px #13c0ba; }

.nav.nav-justified > li > a > img { 

    max-width: 100%; 

    opacity: .3; 

    -webkit-transform: scale(.8,.8);

            transform: scale(.8,.8);

    -webkit-transition: all 0.3s 0s cubic-bezier(0.175, 0.885, 0.32, 1.275);

            transition: all 0.3s 0s cubic-bezier(0.175, 0.885, 0.32, 1.275);

}

.nav.nav-justified > li.active > a > img,

.nav.nav-justified > li:hover > a > img,

.nav.nav-justified > li:focus > a > img { 

    opacity: 1; 

    -webkit-transform: none;

            transform: none;

    -webkit-transition: all 0.3s 0s cubic-bezier(0.175, 0.885, 0.32, 1.275);

            transition: all 0.3s 0s cubic-bezier(0.175, 0.885, 0.32, 1.275);

}

.tab-pane .tab-inner { padding: 30px 0 20px; }



@media (min-width: 768px) {

    .nav.nav-justified > li > a > .quote {

        left: auto;

        top: auto;

        right: 20px;

        bottom: 0px;

    }  

}

.modal-static { 

    position: fixed;

    top: 50% !important; 

    left: 50% !important; 

    margin-top: -100px;  

    margin-left: -100px; 

    overflow: visible !important;

}

.modal-static,

.modal-static .modal-dialog,

.modal-static .modal-content {

    width: 200px; 

    height: 200px; 

}

.modal-static .modal-dialog,

.modal-static .modal-content {

    padding: 0 !important; 

    margin: 0 !important;

}

.modal-static .modal-content .icon {

}

</style>
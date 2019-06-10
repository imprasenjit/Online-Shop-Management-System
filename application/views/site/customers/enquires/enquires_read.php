	<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="page-header">Dashboard / Enquiry</h3>
                </div>
                <!-- /.col-lg-12 -->
            </div>
           
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-sitemap fa-fw"></i> Enquiry Details
                            <div class="pull-right">
                                <!--<div class="btn-group">
                                    <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                                        Actions
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu pull-right" role="menu">
                                        <li><a href="#">Action</a>
                                        </li>
                                        <li><a href="#">Another action</a>
                                        </li>
                                        <li><a href="#">Something else here</a>
                                        </li>
                                        <li class="divider"></li>
                                        <li><a href="#">Separated link</a>
                                        </li>
                                    </ul>
                                </div>-->
                            </div>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table class="table">
								<tr><td>Enquiry Date</td><td><?php echo $order_date; ?></td></tr>
								<tr><td>Enquiry Id</td><td><?php echo $orderid; ?></td></tr>
								<tr><td>Product Id</td><td><?php echo $productid; ?></td></tr>
								<tr><td>Quantity</td><td><?php echo $quantity; ?></td></tr>
								
							   
								<tr><td></td><td><a href="<?php echo site_url('orders') ?>" class="btn btn-default">Cancel</button></td></tr>
							</table>
						</div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                 </div>
                <!-- /.col-lg-8 -->
                
                </div>
                <!-- /.col-lg-4 -->
            
        </div>
        <!-- /#page-wrapper -->
    
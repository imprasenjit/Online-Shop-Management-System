	<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="page-header">Dashboard / Customer Registration</h3>
                </div>
                <!-- /.col-lg-12 -->
            </div>
           
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-user-plus fa-fw"></i> Customer List
                            <div class="pull-right">
                                
                            </div>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            
							<div class="row" style="margin-bottom: 10px">
								<div class="col-md-4">
									<?php echo anchor(site_url('customer_registration_new/create'),'Add Customer', 'class="btn btn-primary"'); ?>
								</div>
								<div class="col-md-4 text-center">
									<div style="margin-top: 8px" id="message">
										<?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
									</div>
								</div>
								<div class="col-md-4 text-right">
									<form action="<?php echo site_url('customer_registration_new/search/'); ?>" class="form-inline" method="post">
									<input name="keyword" class="form-control" value="<?php echo $keyword; ?>" />
										<?php 
										if ($keyword <> '')
										{
											?>
											<a href="<?php echo site_url('customer_registration_new'); ?>" class="btn btn-default">Reset</a>
											<?php
										}
										?>
										<input type="submit" value="Search" class="btn btn-primary" />
									</form>
								</div>
							</div>
							<table class="table table-hover" style="margin-bottom: 10px">
								<tr>
									<th>Sl No.</th>
									<th>Customer Name</th>
									<!--<th>Address</th>-->
									<th>Contact</th>
									<th>Email</th>
									<th width="30%" style="text-align:center">Action</th>
								</tr><?php
								foreach ($customer_registration_data as $customer_registration)
								{
									?>
									<tr>
								<td><?php echo ++$start ?></td>
								<td><?php echo $customer_registration->name ?></td>
								<!--<td><?php echo $customer_registration->address ?></td>-->
								<td><?php echo $customer_registration->contact ?></td>
								<td><?php echo $customer_registration->email ?></td>
								
								<td style="text-align:center">
									<?php 
									echo anchor(site_url('customer_registration_new/report/'.$customer_registration->id),'<span class="glyphicon glyphicon-file" aria-hidden="true"></span>&nbsp;',array('class' => 'btn btn-success'))."&nbsp;";
									
									echo anchor(site_url('customer_registration_new/read/'.$customer_registration->id),'<span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>&nbsp;',array('class' => 'btn btn-primary'))."&nbsp;";
									
									echo anchor(site_url('customer_registration_new/update/'.$customer_registration->id),'<span class="glyphicon glyphicon-edit" aria-hidden="true"></span>&nbsp;',array('class' => 'btn btn-warning'))."&nbsp;"; 
									
									echo anchor(site_url('customer_registration_new/delete/'.$customer_registration->id),'<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>&nbsp;',array('class' => 'btn btn-danger','onclick'=>'return confirm(\'Are You Sure you want to delete?\')'))."&nbsp;";
									?>
								</td>
							</tr>
									<?php
								}
								?>
							</table>
							<div class="row">
								<div class="col-md-6">
									<a href="#" class="btn btn-primary">Total Record : <?php echo $total_rows ?></a>
									<?php echo anchor(site_url('customer_registration_new/excel'), 'Excel', 'class="btn btn-primary"'); ?>
								</div>
								<div class="col-md-6 text-right">
									<?php echo $pagination ?>
								</div>
							</div>

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
    
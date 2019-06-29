<div class="profile-sidebar">
	<div class="profile-userpic">
		<img src="<?= base_url(); ?>assets/images/111.png" alt="" style="border-radius: 50% !important;border:1px solid #d8d5d5;padding:7px" class="img-responsive">
	</div>
	<div class="profile-usertitle" align="center">
		<div class="profile-usertitle-name">
			<?php echo $this->session->userdata("name"); ?> <br> <?php echo $this->session->userdata("contact"); ?>
		</div>
		<div class="profile-usertitle-job">
			<?php echo $this->session->userdata("email"); ?>
		</div>
	</div>
	<div class="profile-usermenu">
		<ul class="nav">
		<li>
				<a href="<?= base_url("customers/dashboard/"); ?>">
				<i class="fa fa-bars" aria-hidden="true"></i>
					Dashboard </a>
			</li>
			<li>
				<a href="<?= base_url("customers/enquires/"); ?>">
				<i class="fa fa-calendar-minus-o" aria-hidden="true"></i>
					Enquires </a>
			</li>
			<li>
				<a href="<?= base_url("customers/quotations/"); ?>">
				<i class="fa fa-fax" aria-hidden="true"></i>
					Quotations </a>
			</li>
			<li>
				<a href="<?= base_url("customers/purchase_order/"); ?>">
				<i class="fa fa-shopping-bag" aria-hidden="true"></i>
					Purchase Orders </a>
			</li>
			<li>
				<a href="<?= base_url("customers/proforma_invoice/"); ?>">
				<i class="fa fa-file-powerpoint-o" aria-hidden="true"></i>
					Proforma Invoice </a>
			</li>

			<li>
				<a href="<?= base_url("customers/customer/manage_address"); ?>">
					<i class="glyphicon glyphicon-folder-open"></i>

					Manage Address</a>
			</li>
			<li>
				<a href="<?= base_url("customers/customer/edit_profile/"); ?>">
					<i class="glyphicon glyphicon-user"></i>
					Account Settings </a>
			</li>

		</ul>
	</div>
	<!-- END MENU -->
</div>

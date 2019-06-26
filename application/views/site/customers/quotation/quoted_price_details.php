	<div class="row profile">
		<div class="col-md-2">
			<?php $this->load->view("site/customers/dashboard/profile"); ?>
		</div>
		<div class="col-md-10">
			<div class="profile-content" style="margin-top:10px;" >
				<h3 align="center">Quotation Details</h3>
				<div class="table-responsive" width="100%" id="print_html">
					<?php
					$quotation_id = base64_decode(urldecode($this->uri->segment(4)));
					$row = $this->quotation_model->get_by_id($quotation_id);
					if ($row) {
						$id = !!empty($row->enquiry_id)?$row->enquiry_id:"";
						$email = !empty($row->email)?$row->email:"";
						$enquiry_id = !empty($row->enquiry_id)?$row->enquiry_id:"";
						$enquery_customer_details = $this->enquires_model->get_enquery_detail_by_enquery_id($enquiry_id);
						$customer_details = $this->customers_model->get_by_id($row->customer_id);//var_dump($customer_details);die;
						$editordata = $row->editordata;
						$enq_enq_ref = !empty($enquery_customer_details)?$enquery_customer_details->enq_ref:"";
						$i = 1;
						?>
						<br/>
						<br/>
						<span class="pull-right">Quotation No. : <?= $row->quotation_id?></span><br/>
						<span class="pull-right">Quotation Date : <?= date("d-m-Y", strtotime($row->quotation_date)); ?></span>
						To, <br />
						<?php
						echo !empty($customer_details)?$customer_details->name:"";
						echo "<br/>";
						echo !empty($customer_details)?$customer_details->contact:"";
						echo "<br/>";
						echo !empty($customer_details)?$customer_details->email:"";
						echo "<br/>";
						echo "<br/>";
						echo $editordata;
						echo "<br/>";
						$product_details = array(
							"productid" => $row->productid,
							"others" => $row->others,
							"quantity" => $row->quantity,
							"product_unit" => $row->product_unit,
							"tax_rate" => $row->tax_rate,
							"attributes" => $row->attributes,
							"product_price" => $row->product_price,
							"cgst" => $row->cgst,
							"sgst" => $row->sgst,
							"igst" => $row->igst,
							"exyard" => $row->exyard,
							"frieght" => $row->frieght,
							"total" => $row->total,
						);
						$this->load->view("admin/products/product_table_format", array("product" => (object)$product_details)); ?>
						<?= $row->editordata2; ?>

					<?php
				} else { ?>
						<h4>No records found! Try again.</h4>
					<?php } ?>
				</div>
				<hr/>
				<?php $results_purchase_order = $this->purchase_order_model->check_purchase_order($quotation_id);
				if (!$results_purchase_order) { ?>
					<a href="<?= base_url("customers/dashboard/send_purchase_order/".urlencode(base64_encode($quotation_id))); ?>" class="btn btn-primary">Send Purchase Order<a>
						<?php } else {
						echo "<button type='button' disabled class='btn btn-outline-primary btn-sm'>Purchase Order Sent</button>";
					} ?>
					<a href="#!" id="print_content" class="btn btn-sm btn-warning">Print</a>
			</div>
		</div>
	</div>
	<script src="<?= base_url("assets/admin/js/jquery.print.js"); ?>"></script>
	<script type="text/javascript">
	$(document).ready(function(){
			$(document).on("click","#print_content",function(){
											//Print ele4 with custom options
											$("#print_html").print({
													//Use Global styles
													globalStyles : true,
													//Add link with attrbute media=print
													mediaPrint : true,
													//Custom stylesheet
													stylesheet : "<?=base_url("assets/admin/css/print.css");?>",
													//Print in a hidden iframe
													iframe : false,
													//Don't print this
													noPrintSelector : ".btn",
													//Add this at top
													prepend : "Purchase Order To Supplier",
													//Add this on bottom
													append : "<span><br/></span>",
													//Log to console when printing is done via a deffered callback
													deferred: $.Deferred().done(function() { console.log('Printing done', arguments); })

											});
									});
									});

	</script>

<!doctype html>
<html>
    <head>
        <title>harviacode.com - codeigniter crud generator</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <style>
            .word-table {
                border:1px solid black !important; 
                border-collapse: collapse !important;
                width: 100%;
            }
            .word-table tr th, .word-table tr td{
                border:1px solid black !important; 
                padding: 5px 10px;
            }
        </style>
    </head>
    <body>
        <h2>Obat</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
				<th>send_to</th>
				<th>product_price</th>
				<th>send_from</th>
		
            </tr><?php
            foreach ($quotation_data as $quotation)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $quotation->send_to ?></td>
		      <td><?php echo $quotation->product_price ?></td>
		      <td><?php echo $quotation->send_from ?></td>t	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>
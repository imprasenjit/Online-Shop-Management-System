<div class="container-fluid">
    <div class="mb-4">
        <?= $this->breadcrumbs->show(); ?>
    </div>
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Testimonials Details</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="product-status-wrap">
                                <table class="table table-striped table-bordered">
                                    <td>Name</td>
                                    <td><?php echo $name; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Contact</td>
                                        <td><?php echo $contact; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <td><?php echo $email; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Address</td>
                                        <td><?php echo nl2br($address); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Message</td>
                                        <td><?php echo nl2br($message); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Feedback Date</td>
                                        <td><?php echo date("d-m-Y h:i A", strtotime($created_at)); ?></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="<?php echo site_url('admin/testimonials/update/' . $id) ?>" class="btn btn-sm btn-warning">Edit</a>
                    <a href="<?php echo site_url('admin/testimonials') ?>" class="btn btn-sm btn-info">Close</a>
                </div>
            </div>
        </div>
    </div>
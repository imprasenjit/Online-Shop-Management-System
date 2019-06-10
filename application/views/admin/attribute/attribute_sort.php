<div class="container-fluid">
    <div class="mb-4">
        <?= $this->breadcrumbs->show(); ?>
    </div>
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Attribute Sorting</h6>
                    <div class="dropdown no-arrow">
                        <a class="btn btn-sm btn-outline-primary" href="<?= base_url() ?>admin/attribute/create" role="button">
                            <i class="fas fa-plus fa-sm fa-fw"></i>add attribute
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <script src="<?= base_url('assets/admin/js/jquery-ui.min.js') ?>"></script>
                    <script type="text/javascript">
                        $(document).ready(function() {
                            $(document).on("change", "#product_id", function() {
                                $("#loading_sortable").empty().append('Loading...<div class="loading"></div>')
                                var id = $(this).val();
                                $.ajax({
                                    url: "<?= base_url("admin/attribute/get_attributes") ?>",
                                    method: "POST",
                                    data: {
                                        id: id
                                    },
                                    dataType: "html",
                                    success: function(htm) {
                                        $('#sortable').empty().append(htm);
                                        $("#loading_sortable").empty();
                                    }
                                });
                            });
                            $("#sortable").sortable({
                                placeholder: "ui-state-highlight",
                                update: function(event, ui) {
                                    $("#loading_sortable").empty().append('Loading...<div class="loading"></div>')
                                    var sorted = $("#sortable").sortable("toArray", {
                                        attribute: "data-article-id"
                                    });
                                    $.post("<?= base_url("admin/attribute/save_attribute_order/"); ?>", {
                                        'choices[]': sorted,
                                        'product': $('#product_id').val()
                                    }).done(function() {
                                        $("#loading_sortable").empty();
                                        $.notify({
                                            message: 'Attributes Sorted Successfully'
                                        }, {
                                            // settings
                                            type: 'success',
                                            animate: {
                                                enter: 'animated fadeInDown',
                                                exit: 'animated fadeOutUp'
                                            },
                                            offset: {
                                                x: 20,
                                                y: 100
                                            }
                                        });
                                    });
                                }
                            });
                        });
                    </script>
                    <div class="row">
                        <div class="col-md-4">
                            <label class="form-label">Select Product : <label>
                                    <select id="product_id" class="form-control form-control-sm">
                                        <option value="">Select a product</option>
                                        <?php foreach ($this->products_model->get_all() as $prows) { ?>
                                            <option value="<?= $prows->id ?>"><?= $prows->product_name ?></option>
                                        <?php } ?>
                                    </select>
                        </div>
                    </div>
                    <hr />
                    <div class="row">
                        <div class="col-md-4">
                            <ul class="list-group" id="sortable">
                            </ul>
                        </div>
                        <div class="col-md-8" id="loading_sortable">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
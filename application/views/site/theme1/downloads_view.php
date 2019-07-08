<script>
    $(document).ready(function () {
        $('#downloads').addClass('active');
    });
</script>
<div class="page-background">
    <div class="text-center container">
        <h2 class="header-title-inner-page">Downloads</h2>
    </div>
</div>
<div class="v-page-wrap">
    <div class="container pull-bottom-big pull-top">
      <link href="<?= base_url('public/datatables/css/loading.css') ?>" rel="stylesheet" />
      <link href="<?= base_url('assets/admin/vendor/datatables/dataTables.bootstrap4.min.css') ?>" rel="stylesheet" />
      <script src="<?= base_url('public/datatables/js/jquery.dataTables.min.js') ?>"></script>
      <script src="<?= base_url('public/datatables/js/dataTables.bootstrap4.min.js') ?>"></script>
      <script type="text/javascript">
          $(document).ready(function () {
              $.extend($.fn.DataTable.ext.classes, {
                  sWrapper: "dataTables_wrapper dt-bootstrap4",
              });
              $("#dtbl").DataTable({
                  "columnDefs": [{
                      className: 'text-right',
                      orderable: false,
                      targets: 3
                  }],
                  "columns": [
                      {"data": "download_id"},
                      {"data": "download_title", width:200},
                      {"data": "download_description"},
                      {"data": "download_file"}
                  ],
                  "processing": true,
                  "serverSide": true,
                  "ajax": {
                      "url": "<?= base_url("downloads/get_dtrecords") ?>",
                      "dataType": "json",
                      "type": "POST",
                  },
                  language: {
                      processing: "<div class='loading'></div>",
                  },
                  "order": [[0, 'asc']],
                  "lengthMenu": [[20, 30, 50, 100, 200], [20, 30, 50, 100, 200]]
              });
          });
      </script>
      <table class="table table-bordered" id="dtbl">
          <thead>
              <tr>
                  <th>(#)</th>
                  <th>Title</th>
                  <th>Description</th>
                  <th>Action</th>
              </tr>
          </thead>
      </table>

    </div>
</div>

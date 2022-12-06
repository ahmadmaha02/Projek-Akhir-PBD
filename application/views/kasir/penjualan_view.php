<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" type="image/x-icon" href="<?= base_url() ?>assets/images/favicon.ico">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <link href="<?= base_url() ?>assets/css/sb-admin-2.min.css" rel="stylesheet">
  <link href="<?= base_url() ?>assets/DataTables-1.10.18/css/dataTables.bootstrap4.min.css" rel="stylesheet">
  <link href="<?= base_url() ?>assets/Responsive-2.2.2/css/responsive.bootstrap4.min.css" rel="stylesheet">
  <link href="<?= base_url() ?>assets/jquery-ui-1.12.1.custom/jquery-ui.min.css" rel="stylesheet">
  <title>kasir</title>
</head>

<body id="page-top">

  <div id="wrapper">

  <?php $this->load->view('component/sidebar')?>

    <div id="content-wrapper" class="d-flex flex-column">

      <div id="content">

        <?php $this->load->view('component/header')?>

        <div class="container-fluid">
          <table id="tabelPenjualan" class="table table-striped table-bordered nowrap" style="width:100%">
            <thead>
              <tr>
                <th>no</th>
                <th>Id</th>
                <th>Nama</th>
                <th>Qty</th>
                <th>Kasir</th>
                <th>Harga satuan</th>
                <th>Jumlah Bayar</th>
                <th>Tanggal</th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
        </div>

      </div>
      <?php $this->load->view('component/footer')?>

    </div>

  </div>
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <script src="<?= base_url() ?>assets/jquery/jquery-3.2.1.min.js"></script>
  <script src="<?= base_url() ?>assets/bootstrap-4.1.3/js/bootstrap.min.js"></script>
  <script src="<?= base_url() ?>assets/js/sb-admin-2.js"></script>
  <script src="<?= base_url() ?>assets/DataTables-1.10.18/js/jquery.dataTables.min.js"></script>
  <script src="<?= base_url() ?>assets/DataTables-1.10.18/js/dataTables.bootstrap4.min.js"></script>
  <script src="<?= base_url() ?>assets/Responsive-2.2.2/js/dataTables.responsive.min.js"></script>
  <script src="<?= base_url() ?>assets/Responsive-2.2.2/js/responsive.bootstrap4.min.js"></script>
  <script src="<?= base_url() ?>assets/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
  <script src="<?= base_url() ?>assets/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
  <script>
    let table;
    $(document).ready(function(){
      $("body").toggleClass("sidebar-toggled");
      $(".sidebar").toggleClass("toggled");
      find_transaction();
    });

    function find_transaction() {
      table = $('#tabelPenjualan').DataTable({
        "columnDefs": [
          {
            "targets": [0, 1, 2, 3, 4, 5, 6, 7],
            "orderable": false,
          },
        ],
        "order": [],
        "serverSide": true, 
        "ajax": {
          "url": "<?= site_url('option/get_penjualan') ?>",
          "type": "POST"
          },
        "lengthChange": false,
        "responsive": true,
      });
    }
    
    function reload_table(){
      table.ajax.reload(null,false);
    }
  </script>
</body>

</html>

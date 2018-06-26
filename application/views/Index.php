<?php
    if(empty($_SESSION['guru']) && $_SESSION['guru']==''){
        redirect('Home/login');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="admin page absensi online sd prajamukti">
    <title>Penilaian SMA Muhammdyah 1 Taman</title>

    <!-- ========== Css Files ========== -->
    <link href="<?php echo base_url('assets/css/bootstrap.min.css');?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/vendor/font-awesome/css/font-awesome.min.css');?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/style_absen.css');?>" rel="stylesheet">

    <script type="text/javascript" src="<?php echo base_url('assets/js/jquery.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/bootstrap/bootstrap.min.js'); ?>"></script>
</head>
<body>
	<div class="container">
        <div class="page-header main-header">

                <div class="row">
                    <div class="col-xs-2">
                        <img src="<?php echo base_url('assets/img/logo.png');?>" class="main-logo">
                    </div>
                    <div class="col-xs-8">
                        <h1>Penilaian Siswa SMA Muhammdyah 1 Taman</h1>
                    </div>
                    <div class="col-xs-2 text-right">
                        <a href="<?= base_url('home/logout'); ?>" class="btn btn-danger" data-toggle="tooltip" data-placement="bottom" title="Logout"><i class="fa fa-power-off"></i></a>
                    </div>
                </div>
        </div>   
        <div class="container-fluid main-content">
            <?php $this->load->view($page);?>
        </div>
        <div class="footer">
            <div class="container">
                <p>Copyright &copy; 2016 SMA Muhammdyah 1 Taman</p>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
            $(".alert").delay(3000).slideUp(200, function() {
                $(this).alert('close');
            });
        });
    </script>
</body>
</html>

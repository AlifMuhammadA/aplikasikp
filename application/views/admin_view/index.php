<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="admin page absensi online sd prajamukti">
    <title><?php echo isset($title)?$title:''; ?> | Penilaian SD Praja Mukti</title>

    <!-- ========== Css Files ========== -->
    <link href="<?php echo base_url('assets/css/root.css');?>" rel="stylesheet">

    <link href="<?= base_url('assets/vendor/morrisjs/morris.css'); ?>" rel="stylesheet" />

    <!-- ================================================
    jQuery Library
    ================================================ -->
    <script type="text/javascript" src="<?php echo base_url('assets/js/jquery.min.js'); ?>"></script>

</head>
<body>
    <!-- Start Page Loading -->
    <div class="loading"><img src="<?php echo base_url('assets/img/loading.gif'); ?>" alt="loading-img"></div>
    <!-- End Page Loading -->
    <!-- //////////////////////////////////////////////////////////////////////////// --> 
    <!-- START TOP -->
    <div id="top" class="clearfix">

        <!-- Start App Logo -->
        <div class="applogo">
          <a href="<?php echo base_url('admin');?>" class="logo">Penilaian</a>
        </div>
        <!-- End App Logo -->

        <!-- Start Sidebar Show Hide Button -->
        <a href="#" class="sidebar-open-button"><i class="fa fa-bars"></i></a>
        <a href="#" class="sidebar-open-button-mobile"><i class="fa fa-bars"></i></a>
        <!-- End Sidebar Show Hide Button -->

        <!-- Start Top Right -->
        <ul class="top-right">

        <li class="dropdown link">
            <a href="#" data-toggle="dropdown" class="dropdown-toggle profilebox"><img src="<?php echo base_url('assets/img/user.png');?>" alt="img"><b><?php echo $this->Admin_model->get_nama($_SESSION['admin']); ?></b><span class="caret"></span></a>
            <ul class="dropdown-menu dropdown-menu-list dropdown-menu-right">
                <li role="presentation" class="dropdown-header">Profile</li>
                <li><a href="#"><i class="fa falist fa-wrench"></i>Settings</a></li>
                <li class="divider"></li>
                <li><a href="<?php echo base_url('admin/dashboard/logout');?>"><i class="fa falist fa-power-off"></i> Logout</a></li>
            </ul>
        </li>

        </ul>
        <!-- End Top Right -->

    </div>
    <!-- END TOP -->
<!-- //////////////////////////////////////////////////////////////////////////// --> 


<!-- //////////////////////////////////////////////////////////////////////////// --> 
    <!-- START SIDEBAR -->
    <div class="sidebar clearfix">
        <ul class="sidebar-panel nav">
            <li class="sidetitle"></li>
            <li><a class="<?php echo isset($home)?$home:''; ?>" href="<?php echo base_url('admin');?>"><span class="icon color5"><i class="fa fa-dashboard"></i></span>Dashboard</a></li>
            <li><a class="<?php echo isset($thnajr)?$thnajr:''; ?>" href="<?php echo base_url('admin/Tahun_Ajar');?>"><span class="icon color5"><i class="fa fa-check-circle-o"></i></span>Tahun Ajar</a></li>
            <li><a class="<?php echo isset($kelas)?$kelas:''; ?>" href="<?php echo base_url('admin/Kelas');?>"><span class="icon color5"><i class="fa fa-users"></i></span>Kelas</a></li>
            <li><a class="<?php echo isset($guru)?$guru:''; ?>" href="<?php echo base_url('admin/Guru');?>"><span class="icon color5"><i class="fa fa-graduation-cap"></i></span>Guru</a></li>
            <li><a class="<?php echo isset($siswa)?$siswa:''; ?>" href="<?php echo base_url('admin/Siswa');?>"><span class="icon color5"><i class="fa fa-user"></i></span>Siswa</a></li>
            <li><a class="<?php echo isset($matpel)?$matpel:''; ?>" href="<?php echo base_url('admin/matpel');?>"><span class="icon color5"><i class="fa fa-book"></i></span>Mata Pelajaran</a></li>
        </ul>
        <ul class="sidebar-panel nav">
            <li><a class="<?php echo isset($wakel)?$wakel:''; ?>" href="<?php echo base_url('admin/Wali_kelas');?>"><span class="icon color5"><i class="fa fa-sign-in"></i></span>Wali Kelas</a></li>
            <li><a class="<?php echo isset($naikel)?$naikel:''; ?>" href="<?php echo base_url('admin/Mutasi_siswa');?>"><span class="icon color5"><i class="fa fa-edit"></i></span>Naik Kelas</a></li>
            <li><a class="<?php echo isset($kurikulum)?$kurikulum:''; ?>" href="<?php echo base_url('admin/kurikulum');?>"><span class="icon color5"><i class="fa fa-cubes"></i></span>Kurikulim</a></li>
            <li><a class="<?php echo isset($nilai)?$nilai:''; ?>" href="<?php echo base_url('admin/nilai');?>"><span class="icon color5"><i class="fa fa-star"></i></span>Nilai</a></li>
        </ul>
        <ul class="sidebar-panel nav">
            <li class="sidetitle">LAPORAN</li>
            <li><a class="<?php echo isset($lapnil)?$lapnil:''; ?>" href="<?php echo base_url('admin/Laporan_nilai');?>"><span class="icon color5"><i class="fa fa-file-o"></i></span>Laporan Nilai</a></li>
        </ul>
    </div>
    <!-- END SIDEBAR -->
<!-- //////////////////////////////////////////////////////////////////////////// --> 

 <!-- //////////////////////////////////////////////////////////////////////////// --> 
<!-- START CONTENT -->
<div class="content">
    <?php if(isset($page))$this->load->view('admin_view/'.$page); ?>
    <!-- Start Footer -->
    <div class="row footer">
        <div class="col-md-6 text-left">
            Copyright &copy; 2016 SMA Muhammadyah 1 Taman, Sidorajo All rights reserved.
        </div>
        <div class="col-md-6 text-right">
            Design and Developed by Thomy Handono
        </div> 
    </div>
    <!-- End Footer -->
</div>
<!-- End Content -->
 <!-- //////////////////////////////////////////////////////////////////////////// --> 


    <!-- ================================================
    Bootstrap Core JavaScript File
    ================================================ -->
    <script src="<?php echo base_url('assets/js/bootstrap/bootstrap.min.js'); ?>"></script>

    <!-- ================================================
    Plugin.js - Some Specific JS codes for Plugin Settings
    ================================================ -->
    <script type="text/javascript" src="<?php echo base_url('assets/js/plugins.js'); ?>"></script>

    <!-- ================================================
    Bootstrap Select
    ================================================ -->
    <script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap-select/bootstrap-select.js'); ?>"></script>

    <!-- ================================================
    Bootstrap Toggle
    ================================================ -->
    <script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap-toggle/bootstrap-toggle.min.js'); ?>"></script>

    <!-- ================================================
    jQuery UI
    ================================================ -->
    <script type="text/javascript" src="<?php echo base_url('assets/js/jquery-ui/jquery-ui.min.js'); ?>"></script>

    <!-- ================================================
    Moment.js
    ================================================ -->
    <script type="text/javascript" src="<?php echo base_url('assets/js/moment/moment.min.js'); ?>"></script>

    <!-- ================================================
    Full Calendar
    ================================================ -->
    <script type="text/javascript" src="<?php echo base_url('assets/js/full-calendar/fullcalendar.js'); ?>"></script>

    <!-- ================================================
    Bootstrap Date Range Picker
    ================================================ -->
    <script type="text/javascript" src="<?php echo base_url('assets/js/date-picker/bootstrap-datepicker.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/date-picker/bootstrap-datepicker.id.js'); ?>"></script>

    <!-- ================================================
    Easy Pie Chart
    ================================================ -->
    <!-- main file -->
    <script type="text/javascript" src="<?php echo base_url('assets/js/easypiechart/easypiechart.js'); ?>"></script>
    <!-- demo codes -->
    <script type="text/javascript" src="<?php echo base_url('assets/js/easypiechart/easypiechart-plugin.js'); ?>"></script>

    

    <script src="<?= base_url('assets/vendor/raphael/raphael.min.js'); ?>" type="text/javascript"></script>
    <script src="<?= base_url('assets/vendor/morrisjs/morris.min.js'); ?>" type="text/javascript"></script>

    <!-- ================================================
    Data Tables
    ================================================ -->
    <script src="<?php echo base_url('assets/js/datatables/datatables.min.js');?>"></script>

    <script type="text/javascript">
        $(function () {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
    <script>
    $(document).ready(function() {


        $('[data-toggle="tooltip"]').tooltip(); 
        
        $('#tbl1').DataTable();

        $('#tgl').datepicker({
                format: "yyyy-mm-dd",
                language: "id",
                autoclose: true
        });

        $("#nip").click(function(){
            $('#myModal').modal('show');
        });

        $('.plhguru').click(function(){
            var id = $(this).attr('id');
            var nm = $(this).attr('namaguru');
            $('#nip').val(id);
            $('#namaguru').val(nm);
            $('#myModal').modal('hide');

            return false;
        });

        $('.pindal_kanan_satu').click(function(){
            $(".cbmsiswa option:selected").each(function(){
                var a = $(this).val();
                var b = $('[value='+a+']').html();
                $('[value='+a+']').remove();
                var c = "<option value='"+a+"' selected>"+b+"</option>";
                $("#cbsiswa_fix").append(c);
            });
        });

        $('.pindal_kanan_all').click(function(){
            $(".cbmsiswa option").each(function(){
                var a = $(this).val();
                var b = $('[value='+a+']').html();
                $('[value='+a+']').remove();
                var c = "<option value='"+a+"' selected>"+b+"</option>";
                $("#cbsiswa_fix").append(c);
            });
        });

        $('.pindal_kiri_satu').click(function(){
            $("#cbsiswa_fix option:selected").each(function(){
                var a = $(this).val();
                var b = $('[value='+a+']').html();
                $('[value='+a+']').remove();
                var c = "<option value='"+a+"'>"+b+"</option>";
                $("#cbsiswa_kanan").append(c);
            });
        });

        $('.pindal_kiri_all').click(function(){
            $("#cbsiswa_fix option").each(function(){
                var a = $(this).val();
                var b = $('[value='+a+']').html();
                $('[value='+a+']').remove();
                var c = "<option value='"+a+"'>"+b+"</option>";
                $("#cbsiswa_kanan").append(c);
            });
        });

        $('#frmmutasi').submit(function(){
            var cb1 = $("#cbkls1").val();
            var cb2 = $("#cbkls2").val();
            if(cb1 == cb2){
                alert('Kelas tidak boleh sama');
                return false;
            }
        });

        /*===================================================================================*/
        /*===================================================================================*/
        /*===================================================================================*/

        $('.pindal_kanan_satu_matpel').click(function(){
            $("#cbmatpel_kanan option:selected").each(function(){
                var a = $(this).val();
                var b = $('#cbmatpel_kanan [value='+a+']').html();
                $('#cbmatpel_kanan [value='+a+']').remove();
                var c = "<option value='"+a+"' selected>"+b+"</option>";
                $("#cbmatpel_fix").append(c);
                console.log(a+" "+b);
            });
        });

        $('.pindal_kanan_all_matpel').click(function(){
            $("#cbmatpel_kanan option").each(function(){
                var a = $(this).val();
                var b = $('#cbmatpel_kanan [value='+a+']').html();
                $('#cbmatpel_kanan [value='+a+']').remove();
                var c = "<option value='"+a+"' selected>"+b+"</option>";
                $("#cbmatpel_fix").append(c);
                console.log(c);
            });
        });

        $('.pindal_kiri_satu_matpel').click(function(){
            $("#cbmatpel_fix option:selected").each(function(){
                var a = $(this).val();
                var b = $('#cbmatpel_fix [value='+a+']').html();
                console.log(b);
                $('#cbmatpel_fix [value='+a+']').remove();
                var c = "<option value='"+a+"'>"+b+"</option>";
                console.log(c);
                $("#cbmatpel_kanan").append(c);
            });
        });

        $('.pindal_kiri_all_matpel').click(function(){
            $("#cbmatpel_fix option").each(function(){
                var a = $(this).val();
                var b = $('#cbmatpel_fix [value='+a+']').html();
                $('#cbmatpel_fix [value='+a+']').remove();
                var c = "<option value='"+a+"'>"+b+"</option>";
                $("#cbmatpel_kanan").append(c);
            });
        });
    });

        /*===================================================================================*/
        /*===================================================================================*/
        /*===================================================================================*/

    var table = $('#tbl1').DataTable({responsive: true});
    function filter_kelas(ini){
        table.search(ini).draw();
    }

    function pilih_kelas (ini) {
        var link = "<?php echo base_url('admin/Mutasi_siswa/combo_siswa/"+ini+"');?>";
        $("#load_siswa_left").load(link);
    }
    
    function pilih_kelas_nilai (ini) {

        var link = "<?php echo base_url('admin/nilai/gen_table_siswa/"+ini+"');?>";
        console.log(link);
        $("#load_siswa").load(link);
    }

    function ubah_kelas(ini){
        var b = $(ini).val();
        var a = $("#cbkls2").val();
        var link = "<?= base_url('admin/kurikulum/combo_matpel_fix/"+a+"/"+b+"');?>";
        $("#matpel_fix").load(link, function(){
            $('#cbmatpel_fix [value=""]').remove();
            cek_combo();
        });
    }

    function cek_combo() {
        var link = "<?= base_url('admin/kurikulum/combo_matpel_load/');?>";
        $("#cbmatpel_kanan").load(link, function(){
            console.log("OKOKOK");
            $("#cbmatpel_fix option").each(function(){
                var a = $(this).val();
                $("#cbmatpel_kanan option").each(function(){
                    var b = $(this).val();
                    if(a==b){
                        $(this).remove();
                    }
                });
            });
        });
    }

    </script>

</body>
</html>
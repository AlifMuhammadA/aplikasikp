<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="admin page absensi online sd prajamukti">
    <title>Kartu Hasil Studi | SMA Muhammadyah 1 Taman</title>

    <!-- ========== Css Files ========== -->
    <link href="<?php echo base_url('assets/css/bootstrap.min.css');?>" rel="stylesheet">

    <script type="text/javascript" src="<?php echo base_url('assets/js/jquery.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/bootstrap/bootstrap.min.js'); ?>"></script>

    <style>
    	*{
    	}
    	th{
    		text-align: left;
    	}
    	
    	.dab{
    		text-align: center;
    	}
        .img-logo{
            position: absolute;
            left: 50px;
            top: 25px;
        }
    </style>
</head>
<body>
	<div class="container-fluid">
        <div class="page-header text-center">
        	<div class="row">
	        	<div class="col-xs-2">
	            	<img src="<?php echo $imglogo; ?>" class="img-responsive" width="50%">
	        	</div>
	        	<div class="col-xs-8">
		            <h1>Kartu Hasil Studi Siswa</h1>
		            <h3>SMA Muhammadyah 1 Taman</h3>
	        	</div>
        	</div>
        </div>  
        <div class="container-fluid">
        	<h4>Tahun Ajar : <?php echo $this->TA_model->get_aktif(); ?></h4>
        	<br>
        	<?php foreach ($nkelas as $key => $kelas): ?>
        	<h4>Kelas <?= isset($kelas)?$kelas:''; ?></h4>
        	<hr>
        	<?php
        		$res = $siswa[$key]->result();
        	?>
        	<?php foreach ($res as $row): ?>
        	<table class="table">
        		<tbody>
        			<tr>
        				<th width="20%">NIS</th>
        				<td> : <?= $row->nis; ?></td>
        			</tr>
        			<tr>
        				<th>NISN</th>
        				<td> : <?= $row->NISN; ?></td>
        			</tr>
        			<tr>
        				<th>Nama</th>
        				<td> : <?= $row->NamaSiswa; ?></td>
        			</tr>
        			<tr>
        				<th>Jenis Kelamin</th>
        				<td> : <?= $row->JenisKelamin=='L'?'Laki-laki':'Perempuan'; ?></td>
        			</tr>
        			<tr>
        				<th>Agama</th>
        				<td> : <?= $row->Agama; ?></td>
        			</tr>
        			<tr>
        				<th>TTL</th>
        				<td> : <?= $row->TempatLahir; ?>, <?= date("d-m-Y", strtotime($row->TglLahir)); ?></td>
        			</tr>
        			<tr>
        				<th>Alamat</th>
        				<td> : <?= $row->Alamat; ?></td>
        			</tr>
        		</tbody>
        	</table>
        	<?php echo $table[$row->idMutasi]; ?>
        	<br><hr><br>
        	<?php endforeach; ?>
        	<?php endforeach; ?>
        </div>
   	</div>
	<div class="footer">
		<div class="wraper">
			
		</div>
	</div>
	<script>
	window.print();
	</script>
</body>
</html>
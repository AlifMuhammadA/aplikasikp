
    <!-- Start Page Header -->
    <div class="page-header">
        <h1 class="title">Master Pelajaran</h1>
        <ol class="breadcrumb">
            <li class="active">Nilai Siswa SMA Muhammadyah 1 Taman, Sidorajo Tahun Ajar <?php echo $this->TA_model->get_aktif(); ?></li>
        </ol>
    </div>
    <!-- End Page Header -->
    <?php 
        $msg = $this->session->flashdata('msg');
        $msg_status = $this->session->flashdata('msg_status');
        if(isset($msg)): 
    ?> 
	<div class="kode-alert kode-alert-icon <?php echo $msg_status;?>">
        <a href="#" class="closed">×</a>
        <?php echo $msg; ?>
    </div>

    <?php endif; ?> 
<div class="container-padding">
	<div class="row">
<!-- Start Panel -->
	    <div class="col-md-12">
	      	<div class="panel panel-default">
		        <?php echo isset($link_add)?'<div class="panel-title">Data Guru<br/>'.$link_add.'</div>':''; ?>
		        <?php echo isset($table)?'<div class="panel-body table-responsive">'.$table.'</div>':''; ?>
		        <?php if(isset($form)):?>
		        <div class="panel-title">Form Guru</div>
		        <div class="panel-body">
		        	<?php
			            $attr = array('class' => 'form-horizontal');
			            $hidden = array('idMatapelajaran' => isset($idMatapelajaran)?$idMatapelajaran:'', );
			            echo form_open($form, $attr, $hidden);
		        	?>

		            <div class="form-group">
		                <label for="mata_pelajaran" class="col-sm-2 control-label">Nama Pelajaran</label>
		                <div class="col-sm-10">
		                    <input type="text" class="form-control" id="mata_pelajaran" name="mata_pelajaran" placeholder="Nama Pelajaran" value="<?php echo isset($txtmata_pelajaran)?$txtmata_pelajaran:''; ?>" required>
		                </div>
		            </div>
		            <div class="form-group">
		                <label for="keterangan" class="col-sm-2 control-label">Keteragan</label>
		                <div class="col-sm-10">
		                    <input type="text" class="form-control" id="keterangan" name="keterangan" placeholder="Keteragan	" value="<?php echo isset($txtketerangan)?$txtketerangan:''; ?>" required>
		                </div>
		            </div>
		            <div class="form-group">
		                <div class="col-sm-offset-2 col-sm-10">
		                    <button type="submit" class="btn btn-primary">Simpan</button>
		                </div>
		            </div>
		        </div>
		        <?php endif; ?>
	      	</div>
	    </div>	
    <!-- End Panel -->	
	</div>
</div>
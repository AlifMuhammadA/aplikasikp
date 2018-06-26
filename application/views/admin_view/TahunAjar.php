
    <!-- Start Page Header -->
    <div class="page-header">
        <h1 class="title">Master Tahun Ajar</h1>
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
		        <?php echo isset($link_add)?'<div class="panel-title">Data Tahun Ajar<br/>'.$link_add.'</div>':''; ?>
		        <?php echo isset($table)?'<div class="panel-body table-responsive">'.$table.'</div>':''; ?>
		        <?php if(isset($form)):?>
		        <div class="panel-title">Form Tahun Ajar</div>
		        <div class="panel-body">
		        	<?php
			            $attr = array('class' => 'form-horizontal');
			            echo form_open($form, $attr);
		        	?>
		        	<input type="hidden" name="idTahunAjar" value="<?php echo isset($txtidta)?$txtidta:''; ?>" >
		            <div class="form-group">
		                <label for="tahunajar" class="col-sm-2 control-label">Tahun Ajar</label>
		                <div class="col-sm-10">
		                    <input type="text" class="form-control" id="tahunajar" name="tahunajar" placeholder="Contoh : 2015/2016 Ganjil" value="<?php echo isset($txtta)?$txtta:''; ?>" required>
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
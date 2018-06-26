
    <!-- Start Page Header -->
    <div class="page-header">
        <h1 class="title">Master Guru</h1>
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
			            echo form_open($form, $attr);
		        	?>
		            <div class="form-group">
		                <label for="nip" class="col-sm-2 control-label">NIP</label>
		                <div class="col-sm-10">
		                    <input type="text" class="form-control" id="nip" name="nip" placeholder="NIP" <?php echo isset($nip)?'value="'.$nip.'" disabled':''; ?> required>
		                    <input type="hidden" class="form-control" id="nip" name="idnip" value="<?php echo isset($nip)?$nip:''; ?>" >
		                </div>
		            </div>
		            <div class="form-group">
		                <label for="namaguru" class="col-sm-2 control-label">Nama Guru</label>
		                <div class="col-sm-10">
		                    <input type="text" class="form-control" id="namaguru" name="namaguru" placeholder="Nama Guru" value="<?php echo isset($txtnama)?$txtnama:''; ?>" required>
		                </div>
		            </div>
		            <div class="form-group">
		                <label for="username" class="col-sm-2 control-label">Username</label>
		                <div class="col-sm-10">
		                    <input type="text" class="form-control" id="username" name="username" placeholder="username" value="<?php echo isset($txtusername)?$txtusername:''; ?>" required>
		                </div>
		            </div>
		            <div class="form-group">
		                <label for="password" class="col-sm-2 control-label">Password</label>
		                <div class="col-sm-10">
		                    <input type="password" class="form-control" id="password" name="password" placeholder="password" value="<?php echo isset($txtpassword)?$txtpassword:''; ?>" required>
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
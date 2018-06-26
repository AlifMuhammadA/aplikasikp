
    <!-- Start Page Header -->
    <div class="page-header">
        <h1 class="title">Wali Kelas</h1>
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
		        <?php echo isset($link_add)?'<div class="panel-title">Data Wali Kelas<br/>'.$link_add.'</div>':''; ?>
		        <?php echo isset($table)?'<div class="panel-body table-responsive">'.$table.'</div>':''; ?>
		        <?php if(isset($form)):?>
		        <div class="panel-title">Form Wali Kelas</div>
		        <div class="panel-body">
		        	<?php
			            $attr = array('class' => 'form-horizontal');
			            echo form_open($form, $attr);
		        	?>
		        	<input type="hidden" name="idwali" value="<?php echo isset($idwali)?$idwali:''; ?>">
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
		            <?php echo ! empty($combo_kelas) ? $combo_kelas : '';?>
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
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  	<div class="modal-dialog">
	    <div class="modal-content">
	      	<div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title" id="myModalLabel">Data Guru</h4>
	      	</div>
		    <div class="modal-body">
		        <?php echo $tbl_guru?>
		    </div>
	      	<div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	      	</div>
	    </div>
  	</div>
</div>
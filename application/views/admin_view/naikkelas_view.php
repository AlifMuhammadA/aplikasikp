
    <!-- Start Page Header -->
    <div class="page-header">
        <h1 class="title">Naik Kelas</h1>
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
		        <div class="panel-body">
		        	<div class="panel-title">Form Naik Kelas
		        	</div>
		        	<?php
			            $attr = array('class' => 'form-horizontal', 'id' => 'frmmutasi');
			            echo form_open($form, $attr);
		        	?>
		        	<div class="row">
		        		<div class="col-md-5">
		        			<?php echo ! empty($combo_kelas) ? $combo_kelas : '';?>
		        			<div id="load_siswa_left">
		        				<div class="form-group">
		        					<div class="col-sm-12">
		        						<select name="idkelas" class="form-control cbmsiswa" multiple="multiple">
											<option value="" selected="selected"></option>
										</select>
									</div>
								</div>
		        			</div>
		        		</div>
		        		<div class="col-md-1">
		        			<button type="button" class="btn btn-default pindal_kanan_all"><span class="fa fa-angle-double-right"></span></button><br/><br/>
		        			<button type="button" class="btn btn-default pindal_kanan_satu"><span class="fa fa-angle-right"></span>&nbsp;</button><br/><br/>
		        			<button type="button" class="btn btn-default pindal_kiri_satu"><span class="fa fa-angle-left"></span>&nbsp;</button><br/>	<br/>
		        			<button type="button" class="btn btn-default pindal_kiri_all"><span class="fa fa-angle-double-left"></span></button>
		        		</div>
		        		<div class="col-md-5">
		        			<?php echo ! empty($combo_taj) ? $combo_taj : '';?>
		        			<?php echo ! empty($combo_kelas2) ? $combo_kelas2 : '';?>
		            			<div class="form-group">
		        					<div class="col-sm-12">
		        						<select name="cb_siswa[]" id="cbsiswa_fix" class="form-control cbmsiswa" multiple="multiple" required>
										</select>
									</div>
								</div>
		        		</div>
		        	</div>
		            
		            <div class="form-group">
		                <div class="col-sm-offset-2 col-sm-10">
		                    <button type="submit" class="btn btn-primary">Simpan</button>
		                </div>
		            </div>
		        </div>
	      	</div>
	    </div>	
    <!-- End Panel -->	
	</div>
</div>
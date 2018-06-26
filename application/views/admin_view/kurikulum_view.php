
    <!-- Start Page Header -->
    <div class="page-header">
        <h1 class="title">Kurikulum</h1>
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
		        	<div class="panel-title">Form Kurikulum
		        	</div>
		        	<?php
			            $attr = array('class' => 'form-horizontal');
			            echo form_open($form, $attr);
		        	?>
		        	<div class="row">
		        		<div class="col-md-5">
		        			<div id="load_siswa_left">
		        				<div class="form-group">
		        					<div class="col-sm-12" id="matpel_awal">
		        						<?php echo ! empty($combo_matpel) ? $combo_matpel : '';?>
									</div>
								</div>
		        			</div>
		        		</div>
		        		<div class="col-md-1">
		        			<button type="button" class="btn btn-default pindal_kanan_all_matpel"><span class="fa fa-angle-double-right"></span></button><br/><br/>
		        			<button type="button" class="btn btn-default pindal_kanan_satu_matpel"><span class="fa fa-angle-right"></span>&nbsp;</button><br/><br/>
		        			<button type="button" class="btn btn-default pindal_kiri_satu_matpel"><span class="fa fa-angle-left"></span>&nbsp;</button><br/>	<br/>
		        			<button type="button" class="btn btn-default pindal_kiri_all_matpel"><span class="fa fa-angle-double-left"></span></button>
		        		</div>
		        		<div class="col-md-5">
		        			<?php echo ! empty($combo_kelas) ? $combo_kelas : '';?>
		        			<?php echo ! empty($combo_taj) ? $combo_taj : '';?>
		            			<div class="form-group">
		        					<div class="col-sm-12" id="matpel_fix">
		        						<select name="cb_matpel[]" id="cbmatpel_fix" class="form-control cbmsiswa" multiple="multiple" required style="min-height:350px">
										</select>
									</div>
								</div>
		        		</div>
		        	</div>
		            
		            <div class="form-group">
		                <div class="col-sm-offset-9 col-sm-2">
		                    <button type="submit" class="btn btn-primary">Simpan</button>
		                </div>
		            </div>
		        </div>
	      	</div>
	    </div>	
    <!-- End Panel -->	
	</div>
</div>

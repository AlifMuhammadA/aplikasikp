
    <!-- Start Page Header -->
    <div class="page-header">
        <h1 class="title">Nilai</h1>
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
		        <?php 
		        	if($this->uri->segment(3)=='tambah'): 
		        ?>
	    		<table class="table">
		    		<tr>
		    			<th width="20%">NIS</th>
		    			<td>: <?= $nis; ?></td>
		    		</tr>
		    		<tr>
		    			<th>Nama</th>
		    			<td>: <?= $NamaSiswa; ?></td>
		    		</tr>
		    		<tr>
		    			<th>Kelas</th>
		    			<td>: <?= $Kelas; ?></td>
		    		</tr>
		    	</table>
		    	<hr/>
		    	<div class="panel-title">Mata Pelajaran</div>
		    	<?php
			            $attr = array('class' => 'form-horizontal');
			            $hidd = array('idMutasi' => $idMutasi);
			            echo form_open($form, $attr, $hidd);
		        	?>
		    	<?php echo isset($table)?'<div class="panel-body table-responsive">'.$table.'</div>':''; ?>
				
		            <div class="form-group">
		                <div class="col-sm-offset-10 col-sm-2">
		                    <button type="submit" class="btn btn-primary">Simpan</button>
		                </div>
		            </div>
		    	</form>
		    	<?php else: ?>
		        <?= ! empty($cbkelas) ? $cbkelas : '';?>
		        <div class="panel-body table-responsive" id="load_siswa">
		        </div>
		    	<?php endif; ?>
	      	</div>
	    </div>	
    <!-- End Panel -->	
	</div>
</div>
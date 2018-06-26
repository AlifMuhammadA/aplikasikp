
    <!-- Start Page Header -->
    <div class="page-header">
        <h1 class="title">Laporan Nilai</h1>
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
	      		<div class="panel-title">Rekap Nilai</div>
	      			<?php
			            $attr = array('class' => 'form-horizontal', 'target' => 'blank');
			            echo form_open($form, $attr);
		        	?>
	      			<?php echo isset($cbtype)?$cbtype:''; ?>
	      			<div class="load_kelas"></div>
	      			<div class="load_siswa"></div>
				  	<div class="form-group">
				    	<div class="col-sm-offset-2 col-sm-8">
				      		<button type="submit" class="btn btn-default">Cetak</button>
				    	</div>
				  	</div>
				</form>
	      	</div>
	    </div>	
    <!-- End Panel -->	
	</div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
		
    });
    var type = 0;
    var link = '<?= base_url("admin/laporan_nilai"); ?>';
    function pilih_type(ini) {
    	type = ini;
    	if(ini>1){
    		var t = link+'/combo_kelas';
    		$(".load_kelas").load(t);
    	}

    }

    function pilih_cbkelas(ini) {
    	if(type==3){
    		var t = link+'/combo_siswa/'+ini;
    		console.log(t);
    		$(".load_siswa").load(t);
    	}
    }
</script>
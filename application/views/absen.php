<?php 
$msg = $this->session->flashdata('msg');
$msg_status = $this->session->flashdata('msg_status');
	if(isset($msg)): 
?> 
	<div class="alert <?php echo $msg_status; ?> alert-dismissible fade in" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
		<?php echo $msg; ?>
	</div>
<?php endif; ?> 
<div class="page-header">
	<h2>Absensi kelas </h2>
	<h3><?php echo ! empty($hari) ? $hari : '';?></h3>
</div>
<div class="main-absen">
	<?php
		$attr = array('class' => 'form-horizontal');
		echo form_open($form, $attr);
	?>
	<table class="table table-hover table-bordered table-condensed">
		<thead>
			<tr>
				<th class="col-md-1 bg-primary">NIS</th>
				<th class="col-md-1 bg-primary">NISN</th>
				<th class="col-md-6 bg-primary">Nama</th>
				<th class="col-md-1 bg-success">Hadir</th>
				<th class="col-md-1 bg-info">Izin</th>
				<th class="col-md-1 bg-warning">Sakit</th>
				<th class="col-md-1 bg-danger">Alpha</th>
				<th class="col-md-1 bg-primary">Terlambat</th>
			</tr>
		</thead>
		<tbody>
			<?php echo isset($table)?$table:''; ?>
		</tbody>
	</table>
  	<div class="form-group">
	    <div class="col-sm-offset-10 col-sm-2">
	      	<button type="submit" class="btn btn-primary">Simpan</button>
	      	<a href="<?php echo base_url('Absen/logout');?>" class="btn btn-danger" onclick="return confirm('Apakah data sudah disimpan?')">Keluar</a>
	    </div>
  	</div>
	</form>
	<div class="clearfix"></div>
</div>
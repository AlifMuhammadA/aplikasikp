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
	<h2>Penilaian kelas <?php  echo $_SESSION['nama_kelas']; ?> </h2>
	<h3><?php echo ! empty($matpel) ? $matpel : '';?></h3>
</div>
<div class="main-absen">
	<?php
		$attr = array('class' => 'form-horizontal');
		echo form_open($form, $attr);
	?>
	<table class="table table-hover table-bordered table-condensed">
		<thead>
			<tr>
				<th width="5%" class="bg-primary">NIS</th>
				<th width="5%" class="bg-primary">NISN</th>
				<th width="50%" class="bg-primary">Nama</th>
				<th width="5%" class="bg-success">Tugas</th>
				<th width="5%" class="bg-info">UTS</th>
				<th width="5%" class="bg-warning">UAS</th>
			</tr>
		</thead>
		<tbody>
			<?php echo isset($table)?$table:''; ?>
		</tbody>
	</table>
  	<div class="form-group">
	    <div class="col-sm-offset-10 col-sm-2">
	      	<button type="submit" class="btn btn-primary">Simpan</button>
	      	<a href="<?php echo base_url('home');?>" class="btn btn-warning" onclick="return confirm('Apakah data sudah disimpan?')">Kembali</a>
	    </div>
  	</div>
	</form>
	<div class="clearfix"></div>
</div>
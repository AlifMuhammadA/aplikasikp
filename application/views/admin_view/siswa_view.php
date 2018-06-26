
    <!-- Start Page Header -->
    <div class="page-header">
        <h1 class="title">Master Siswa</h1>
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
		        <?php echo isset($link_add)?'<div class="panel-title">Data Siswa<br/>'.$link_add.'</div>':''; ?>
		        <?php echo ! empty($cbkelas) ? $cbkelas : '';?>
		        <?php echo isset($table)?'<div class="panel-body table-responsive">'.$table.'</div>':''; ?>
		        <?php if(isset($form)):?>
		        <div class="panel-title">Form Siswa</div>
		        <div class="panel-body">
		        	<?php
			            $attr = array('class' => 'form-horizontal');
			            echo form_open($form, $attr);
		        	?>
		            <?php echo ! empty($combo_kelas) ? $combo_kelas : '';?>
		            <div class="form-group">
		                <label for="NIS" class="col-sm-2 control-label">NIS</label>
		                <div class="col-sm-10">
		                    <input type="text" class="form-control" id="NIS" name="NIS" placeholder="NIP" <?php echo isset($NIS)?'value="'.$NIS.'" disabled':''; ?> required>
		                    <input type="hidden" class="form-control" id="NIS" name="IDNIS" value="<?php echo isset($NIS)?$NIS:''; ?>" >
		                </div>
		            </div>
		            <div class="form-group">
		                <label for="NISN" class="col-sm-2 control-label">NISN</label>
		                <div class="col-sm-10">
		                    <input type="text" class="form-control" id="NISN" name="NISN" placeholder="NISN" value="<?php echo isset($txtNISN)?$txtNISN:''; ?>" required>
		                </div>
		            </div>
		            <div class="form-group">
		                <label for="namasiswa" class="col-sm-2 control-label">Nama Siswa</label>
		                <div class="col-sm-10">
		                    <input type="text" class="form-control" id="namasiswa" name="namasiswa" placeholder="Nama Siswa" value="<?php echo isset($txtnama)?$txtnama:''; ?>" required>
		                </div>
		            </div>
		            <?php echo ! empty($radio_jk) ? $radio_jk : '';?>
		            <?php echo ! empty($combo_agama) ? $combo_agama : '';?>

		            <div class="form-group">
		                <label for="TempatLahir" class="col-sm-2 control-label">Tempat Lahir</label>
		                <div class="col-sm-10">
		                    <input type="text" class="form-control" id="TempatLahir" name="TempatLahir" placeholder="Tempat Lahir" value="<?php echo isset($txtTempatLahir)?$txtTempatLahir:''; ?>" required>
		                </div>
		            </div>
		            <div class="form-group">
		                <label for="TglLahir" class="col-sm-2 control-label">Tanggal Lahir</label>
		                <div class="col-sm-10">
		                    <input type="text" class="form-control" id="tgl" name="TglLahir" placeholder="Tanggal Lahir" value="<?php echo isset($txtTglLahir)?$txtTglLahir:''; ?>" required>
		                </div>
		            </div>
		            <div class="form-group">
		                <label for="Alamat" class="col-sm-2 control-label">Alamat</label>
		                <div class="col-sm-10">
		                    <textarea class="form-control" id="Alamat" name="Alamat" placeholder="Alamat" rows="5"><?php echo isset($txtAlamat)?$txtAlamat:''; ?></textarea>
		                </div>
		            </div>
		            <div class="form-group">
		                <label for="NamaAyah" class="col-sm-2 control-label">Nama Ayah</label>
		                <div class="col-sm-10">
		                    <input type="text" class="form-control" id="NamaAyah" name="NamaAyah" placeholder="Nama Ayah" value="<?php echo isset($txtNamaAyah)?$txtNamaAyah:''; ?>" required>
		                </div>
		            </div>
		            <?php echo ! empty($combo_pendidikan_ayah) ? $combo_pendidikan_ayah : '';?>
		            <div class="form-group">
		                <label for="PenghasilanAyah" class="col-sm-2 control-label">Penghasilan Ayah</label>
		                <div class="col-sm-10">
		                	<div class="input-group">
    							<span class="input-group-addon">Rp.</span>
		                    	<input type="number" class="form-control" id="PenghasilanAyah" name="PenghasilanAyah" placeholder="Penghasilan Ayah" value="<?php echo isset($txtPenghasilanAyah)?$txtPenghasilanAyah:''; ?>" required>
		                	</div>
		                </div>
		            </div>
		            <div class="form-group">
		                <label for="AlamatRumahAyah" class="col-sm-2 control-label">Alamat Ayah</label>
		                <div class="col-sm-10">
		                    <textarea class="form-control" id="AlamatRumahAyah" name="AlamatRumahAyah" placeholder="Alamat Rumah Ayah" rows="5"><?php echo isset($txtAlamatRumahAyah)?$txtAlamatRumahAyah:''; ?></textarea>
		                </div>
		            </div>
		            <div class="form-group">
		                <label for="NomorHpAyah" class="col-sm-2 control-label">Nomor Ayah</label>
		                <div class="col-sm-10">
		                    <input type="text" class="form-control" id="NomorHpAyah" name="NomorHpAyah" placeholder="Nomor Ayah" value="<?php echo isset($txtNomorHpAyah)?$txtNomorHpAyah:''; ?>" required>
		                </div>
		            </div>
		            <div class="form-group">
		                <label for="NamaIbu" class="col-sm-2 control-label">Nama Ibu</label>
		                <div class="col-sm-10">
		                    <input type="text" class="form-control" id="NamaIbu" name="NamaIbu" placeholder="Nama Ibu" value="<?php echo isset($txtNamaIbu)?$txtNamaIbu:''; ?>" required>
		                </div>
		            </div>
		            <?php echo ! empty($combo_pendidikan_ibu) ? $combo_pendidikan_ibu : 'a';?>
		            <div class="form-group">
		                <label for="PenghasilanIbu" class="col-sm-2 control-label">Penghasilan Ibu</label>
		                <div class="col-sm-10">
		                	<div class="input-group">
    							<span class="input-group-addon">Rp.</span>
		                    	<input type="number" class="form-control" id="PenghasilanIbu" name="PenghasilanIbu" placeholder="Penghasilan Ibu" value="<?php echo isset($txtPenghasilanIbu)?$txtPenghasilanIbu:''; ?>" required>
		                	</div>
		                </div>
		            </div>
		            <div class="form-group">
		                <label for="AlamatRumahIbu" class="col-sm-2 control-label">Alamat Ibu</label>
		                <div class="col-sm-10">
		                    <textarea class="form-control" id="AlamatRumahIbu" name="AlamatRumahIbu" placeholder="Alamat Rumah Ibu" rows="5"><?php echo isset($txtAlamatRumahIbu)?$txtAlamatRumahIbu:''; ?></textarea>
		                </div>
		            </div>
		            <div class="form-group">
		                <label for="NomorHpIbu" class="col-sm-2 control-label">Nomor Ibu</label>
		                <div class="col-sm-10">
		                    <input type="text" class="form-control" id="NomorHpIbu" name="NomorHpIbu" placeholder="Nomor Ibu" value="<?php echo isset($txtNomorHpIbu)?$txtNomorHpIbu:''; ?>" required>
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
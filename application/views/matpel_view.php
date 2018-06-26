<div class="frm_kelas">
    <h3>Kelas <?php  echo $_SESSION['nama_kelas']; ?></h3>
    <h3>Pilih Mata Pelajaran</h3>
    <?php
        $attr = array('class' => 'form-horizontal');
        echo form_open($form, $attr);
    ?>
        <?php echo ! empty($combo_kelas) ? $combo_kelas : '';?>
        <button type="submit" class="btn btn-primary">Pilih</button>
    </form>
</div>
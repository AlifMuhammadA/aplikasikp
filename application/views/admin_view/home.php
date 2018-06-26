
    <!-- Start Page Header -->
    <div class="page-header">
        <h1 class="title">Dashboard</h1>
        <ol class="breadcrumb">
            <li class="active">Nilai Siswa SMA Muhammadyah 1 Taman, Sidorajo Tahun Ajar <?php echo $this->TA_model->get_aktif(); ?></li>
        </ol>
    </div>
    <!-- End Page Header -->


 <!-- //////////////////////////////////////////////////////////////////////////// --> 
    <!-- START CONTAINER -->
    <div class="container-widget">
    


        <div class="row">
            <div class="col-md-12 col-lg-12 text-center">
                <div class="panel panel-widget" style="min-height:205px;">
                    <div class="panel-title">
                        Siswa Ranking Tiap Kelas
                    </div>
                    <div class="panel-body">
                       <div id="chart_rangking"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-6">
                <div class="panel panel-widget">
                    <div class="panel-title">
                        Nilai Tiap Mata Pelajaran Tertinggi
                    </div>
                    <div class="panel-body">
                        <table class="table table-hover table-condensed">
                            <?php 
                                $matpel = $this->Nilai_model->get_matpel_max(); 
                                $hmatpel = $matpel->result();
                                foreach ($hmatpel as $irow):
                            ?>
                            <tr>
                                <td width="15%"><?= $irow->mata_pelajaran; ?></td>
                                <td><?= $irow->NamaSiswa; ?></td>
                                <td><?= $irow->Kelas; ?></td>
                                <td><?= number_format($irow->Nilai) ?></td>
                            </tr>
                            <?php
                                endforeach;
                            ?>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-6">
                <div class="panel panel-widget">
                    <div class="panel-title">
                        Nilai Tiap Mata Pelajaran Terendah
                    </div>
                    <div class="panel-body">
                        <table class="table table-hover table-condensed">
                            <?php 
                                $matpel = $this->Nilai_model->get_matpel_min(); 
                                $hmatpel = $matpel->result();
                                foreach ($hmatpel as $irow):
                            ?>
                            <tr>
                                <td width="15%"><?= $irow->mata_pelajaran; ?></td>
                                <td><?= $irow->NamaSiswa; ?></td>
                                <td><?= $irow->Kelas; ?></td>
                                <td><?= number_format($irow->Nilai) ?></td>
                            </tr>
                            <?php
                                endforeach;
                            ?>
                        </table>
                    </div>
                </div>
            </div>

            

        </div>
    </div>
    <!-- END CONTAINER -->
 <!-- //////////////////////////////////////////////////////////////////////////// --> 


<script type="text/javascript">
    $(document).ready(function(){
        var dd = [];
        <?php
            $keys = "";
            $label = "";

            $query = "SELECT 
                        d.idKelas, 
                        d.Kelas, 
                        c.NamaSiswa, 
                        ((a.tugas * 0.4) + (a.uts * 0.3) + (a.uas * 0.3)) as Nilai 
                    FROM tblnilai a
                    JOIN tblmutasi b ON a.idMutasi = b.idMutasi
                    JOIN tblsiswa c ON b.nis = c.nis
                    JOIN tblkelas   d ON b.idKelas = d.idKelas
                    WHERE ((a.tugas * 0.4) + (a.uts * 0.3) + (a.uas * 0.3)) = 
                    (
                        SELECT 
                            MAX((z.tugas * 0.4) + (z.uts * 0.3) + (z.uas * 0.3)) as Nilai
                        FROM tblnilai z
                        JOIN tblmutasi w ON z.idMutasi = w.idMutasi
                        WHERE w.idKelas = d.idKelas
                        GROUP BY w.idKelas
                    )
                    GROUP BY d.idKelas";
            $q = $this->db->query($query);
            $res = $q->result();
            $i=0;
            foreach ($res as $row) {
                if($i==0){
                    $keys .= "$row->idKelas";
                    $label .= "'$row->Kelas - $row->NamaSiswa'";
                }else{
                    $keys .= ", $row->idKelas";
                    $label .= ", '$row->Kelas - $row->NamaSiswa'";
                }
                echo 'dd.push({x : "'.$row->Kelas.' - '.$row->NamaSiswa.'", y : '.$row->Nilai.' });';
                $i++;
            }

        ?>
        console.log(dd);

        Morris.Bar({
            element: 'chart_rangking',
            data: dd,
            xkey: 'x',
            ykeys: 'y',
            labels: ['Nilai'],
            hideHover: 'auto',
            resize: true,
        }).on('click', function(i, row){
            //detail_box(row.y, row.y);
        });
    });
</script>
<style> 
    .line-title{ 
        border: 0; 
        border-style: inset; 
        border-top: 1px solid #000; 
    } 
</style> 
<head> 
    <title><?php echo $title; ?></title> 
</head> 
<div class="container-fluid"> 
    <img src="<?php echo base_url(); ?>assets/img/horizon.jpg" style="width: 100px; height: auto;"> 
    <span style="float: right; font-size: 12px;">Halo, <?php echo $this->session->userdata('name'); ?></span>
    <hr class="line-title"> 
    <!-- Page Heading --> 
    <h1 class="h3 mb-2 text-gray-800">Tabel Mahasiswa</h1> 
    <p class="mb-4">Pada tabel ini ditampilkan data mahasiswa yang aktif menjalani perkuliahan</p> 
    <!-- DataTables --> 
    <div class="card mb-3"> 
        <div class="card-body"> 
            <div class="table-responsive"> 
                <table border="1" class="table table-hover" id="dataTable" width="100%" cellspacing="0"> 
                    <thead> 
                        <tr> 
                            <th>No</th>  
                            <th>Foto</th> 
                            <th>NPM</th> 
                            <th>Nama</th> 
                        </tr> 
                    </thead> 
                    <tbody> 
                    <?php  
                        $no = 1; 
                        foreach ($tbl_mahasiswa as $key) { ?> 
                        <tr align="center"> 
                            <td><?php echo $no++; ?></td>  
                            <td><img src="<?php echo base_url('assets/foto/' . $key->foto); ?>" style="width: 50px; height: auto;"></td>
                            <td><?php echo $key->npm; ?></td> 
                            <td><?php echo $key->nama; ?></td> 
                        </tr> 
                        <?php } ?> 
                    </tbody> 
                </table> 
            </div> 
        </div> 
    </div> 
</div> 

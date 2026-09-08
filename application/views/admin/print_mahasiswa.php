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
<?php foreach ($tbl_mahasiswa as $row) { ?> 
    <img src="<?php echo base_url(); ?>assets/img/horizon.jpg" style="width: 100px; height: auto;">    
    <span style="float: right; font-size: 12px;">Halo, <?php echo $this->session->userdata('name'); ?></span>
    <hr class="line-title"> 
    <!-- Page Heading --> 
    <h1 class="h3 mb-2 text-gray-800">Detail Mahasiswa</h1> 
    <h2><p class="mb-10">Data Mahasiswa</p></h2> 
    <div class="card mb-3"> 
        <div class="card-body"> 
            <table>  
                <tr> 
                    <td>NPM</td> 
                    <td>:</td> 
                    <td><?php echo $row->npm; ?></td>  
                </tr> 
                 <tr> 
                    <td>Nama</td> 
                    <td>:</td> 
                    <td><?php echo $row->nama; ?></td>  
                </tr> 
                <tr> 
                    <td>Foto</td> 
                    <td>:</td> 
                    <td><img style="width:100px; height:auto;" src="<?php echo base_url('assets/foto/' . $row->foto); ?>" ></td>  
                </tr> 
            </table> 
        </div> 
    </div> 
<?php } ?> 
</div> 

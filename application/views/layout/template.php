<?php 
$this->load->view('layout/header'); 
$this->load->view('layout/sidebar'); 
?>

<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
        <?php $this->load->view('layout/navbar'); ?>
        
        <div class="container-fluid">
            <?php $this->load->view($isi_konten); ?>
        </div>
        
    </div>
    </div>
<?php $this->load->view('layout/footer'); ?>

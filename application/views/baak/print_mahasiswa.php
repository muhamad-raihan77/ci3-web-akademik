<head>
  <title><?php echo $title; ?></title>
  <style type="text/css">
    td,h3 {font-family: DejaVu Sans;}
  </style>
</head>
<body>
<!-- Header Laporan -->
 <div style="border: 1px solid #ECA7A7; padding: 5px;">
   <table width="100%" style="border-bottom: 2px solid black; padding-bottom: 10px;">
    <tr>
      <td width="15%" align="center">
<?php
$path = FCPATH . 'assets/img/horizon.jpg';
$type = pathinfo($path, PATHINFO_EXTENSION);
$data = file_get_contents($path);
?>
 <img src="data:image/<?= $type ?>;base64,<?= base64_encode($data); ?>" width="100">
        </td>
        <td width="85%" align="left">
            <span style="font-size:25px; font-weight:bold;">
                UNIVERSITAS HORIZON INDONESIA
            </span><br>
            <span style="font-size:12px;">
                Jl. Raya Pangkal Perjuangan Km.1 ByPass Karawang, Jawa Barat<br>
                Telp: (0267) 3331999 | Email: info@horizon.ac.id
            </span>
        </td>
    </tr>
 </table>
<!-- Isi Data -->
<?php 
if (is_object($mahasiswa)) 
    {
$mahasiswa = [$mahasiswa];
    }
foreach ($mahasiswa as $mhs) { ?>
    <h3>Student Profile</h3>
    <table>
      <tr>
        <td style="border: 1px solid gray; padding: 5px;">
        <?php
        $path2 = FCPATH . 'assets/foto/'.$mhs->foto;
        $type2 = pathinfo($path2, PATHINFO_EXTENSION);
        if (file_exists($path2)) {
            $data2 = file_get_contents($path2);
            $base64_foto = base64_encode($data2);
        } else {
            $base64_foto = '';
        }
        ?>
        <img src="data:image/<?= $type2 ?>;base64,<?= $base64_foto ?>" width="100">
        </td>
        <td style="vertical-align: top; padding-left: 20px;">
          <table>
            <tr>
              <td>NIM</td>
              <td>:</td>
              <td><?php echo $mhs->npm; ?></td>
            </tr>
            <tr>
              <td>Nama</td>
              <td>:</td>
              <td><?php echo $mhs->nama; ?></td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
<?php } ?>
 </div>
</body>

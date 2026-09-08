<!DOCTYPE html>
<html>
<head>
    <title>Qrcode</title>
    <style type="text/css">
        @page {size: 1.4"; margin: 2cm;}
        @media print {
            table {width: 9.5cm; height: 3cm;}
            img {height: 3cm; width: auto;}
        }
        table {
            width: 9.5cm; height: 3cm;
            border: 1px solid; border-collapse: collapse;
        }
        table td, th { border: 1px solid; border-collapse: collapse; }
        img {height: 2.5cm; width: auto; }
        #qrcodeTable {
            width: 3cm;
            text-align: center;
        }
    </style>
</head>
<body>
  <script src="<?php echo base_url(); ?>assets/js/jquery-4.0.0.min.js"></script>
 <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.qrcode.min.js">
   </script>
    <table border="1" align="left">
        <tr>
            <td rowspan="3">
                <div id="qrcodeTable"></div>
            </td>
            <td align="center">
                <img src="<?php echo base_url('assets/img/horizon.jpg'); ?>" />
            </td>
        </tr>
        <tr>
            <td align="center">
                <b>Horizon University</b>
            </td>
        </tr>
        <tr>
            <td align="center">
                <b>
                    <?php echo $mahasiswa->npm; ?> 
                    <?php echo $mahasiswa->nama; ?>
                </b>
            </td>
        </tr>
    </table>
    <script type="text/javascript">
        jQuery('#qrcodeTable').qrcode({
            width: 100,
            height: 100,
            text: "<?= site_url('Home/index/'.$mahasiswa->npm); ?>"
        });
    </script>
</body>
</html>

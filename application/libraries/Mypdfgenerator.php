<?php defined('BASEPATH') or exit('No direct script access allowed');
require_once 'dompdf/autoload.inc.php';
use Dompdf\Dompdf;
use Dompdf\Options;

class Mypdfgenerator
{
    protected $ci;
    public function __construct()
    {
        $this->ci =& get_instance();
    }

    public function generate($view, $data = array(), $filename = 'laporan', $paper = 'A4', $orientation = 'portrait')
    {
        $options = new Options();
        $options->set('isRemoteEnabled', TRUE);
        $options->set('isHtml5ParserEnabled', TRUE);
        $options->set('chroot', FCPATH); 
        
        $dompdf = new Dompdf($options);
        $html = $this->ci->load->view($view, $data, TRUE);
        $dompdf->setBasePath(FCPATH);
        $dompdf->loadHtml($html);
        $dompdf->setPaper($paper, $orientation);
        $dompdf->render();
        
        if (ob_get_length()) ob_end_clean();
        $dompdf->stream($filename . ".pdf", array("Attachment" => FALSE));
    }
}

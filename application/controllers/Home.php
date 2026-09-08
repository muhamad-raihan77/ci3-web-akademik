<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_mahasiswa');
    }

    public function index($npm)
    {
        $data['mahasiswa'] = $this->M_mahasiswa->ambil_data($npm);
        $data['title'] = 'Biodata Mahasiswa';
        $this->load->view('baak/qrcode_mahasiswa.php', $data);
    }
}

<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Api_buku extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        // Set header JSON dan CORS
        header('Content-Type: application/json');
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
        header('Access-Control-Allow-Headers: Content-Type, Authorization, X-API-KEY');

        // Handle preflight OPTIONS request
        if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
            $this->output->set_status_header(200);
            exit;
        }

        // Load model
        $this->load->model('M_buku');
    }

    /**
     * GET /api_buku/get_data
     * Mengambil semua data buku
     */
    public function get_data()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
            $this->output->set_status_header(405);
            echo json_encode(['status' => false, 'message' => 'Method Not Allowed']);
            return;
        }

        $data = $this->M_buku->ambil_semua_data();

        echo json_encode([
            'status'  => true,
            'message' => 'Data buku berhasil diambil',
            'data'    => $data
        ]);
    }

    /**
     * GET /api_buku/get_detail/{kode_buku}
     * Mengambil detail satu data buku berdasarkan kode_buku
     */
    public function get_detail($kode_buku = null)
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
            $this->output->set_status_header(405);
            echo json_encode(['status' => false, 'message' => 'Method Not Allowed']);
            return;
        }

        if ($kode_buku === null) {
            $this->output->set_status_header(400);
            echo json_encode(['status' => false, 'message' => 'Parameter kode_buku tidak diberikan']);
            return;
        }

        $data = $this->M_buku->ambil_data($kode_buku);

        if ($data) {
            echo json_encode([
                'status'  => true,
                'message' => 'Data buku ditemukan',
                'data'    => $data
            ]);
        } else {
            $this->output->set_status_header(404);
            echo json_encode([
                'status'  => false,
                'message' => 'Data buku tidak ditemukan',
                'data'    => null
            ]);
        }
    }

    /**
     * POST /api_buku/tambah_data
     * Menambahkan data buku baru
     */
    public function tambah_data()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->output->set_status_header(405);
            echo json_encode(['status' => false, 'message' => 'Method Not Allowed']);
            return;
        }

        $input = json_decode(file_get_contents('php://input'), true);

        // Jika form-data
        if (empty($input)) {
            $input = $this->input->post();
        }

        if (!empty($input['kode_buku'])) {
            $simpan = $this->M_buku->tambah_data($input);

            if ($simpan) {
                $this->output->set_status_header(201);
                echo json_encode([
                    'status'  => true,
                    'message' => 'Data buku berhasil ditambahkan'
                ]);
            } else {
                $this->output->set_status_header(500);
                echo json_encode([
                    'status'  => false,
                    'message' => 'Gagal menyimpan data ke database'
                ]);
            }
        } else {
            $this->output->set_status_header(400);
            echo json_encode([
                'status'  => false,
                'message' => 'Data input tidak lengkap (minimal kode_buku wajib diisi)'
            ]);
        }
    }

    /**
     * PUT/POST /api_buku/update_data/{kode_buku}
     * Mengupdate data buku berdasarkan kode_buku
     */
    public function update_data($kode_buku = null)
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'PUT' && $_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->output->set_status_header(405);
            echo json_encode(['status' => false, 'message' => 'Method Not Allowed']);
            return;
        }

        if ($kode_buku === null) {
            $this->output->set_status_header(400);
            echo json_encode(['status' => false, 'message' => 'Parameter kode_buku tidak diberikan']);
            return;
        }

        $input = json_decode(file_get_contents('php://input'), true);

        // Jika menggunakan x-www-form-urlencoded
        if (empty($input) && $_SERVER['REQUEST_METHOD'] === 'POST') {
            $input = $this->input->post();
        }

        if (!empty($input)) {
            $update = $this->M_buku->update_data($kode_buku, $input);

            if ($update) {
                echo json_encode([
                    'status'  => true,
                    'message' => 'Data buku berhasil diupdate'
                ]);
            } else {
                $this->output->set_status_header(500);
                echo json_encode([
                    'status'  => false,
                    'message' => 'Gagal mengupdate data di database'
                ]);
            }
        } else {
            $this->output->set_status_header(400);
            echo json_encode([
                'status'  => false,
                'message' => 'Tidak ada data yang dikirim untuk diupdate'
            ]);
        }
    }

    /**
     * DELETE/POST /api_buku/hapus_data/{kode_buku}
     * Menghapus data buku berdasarkan kode_buku
     */
    public function hapus_data($kode_buku = null)
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'DELETE' && $_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->output->set_status_header(405);
            echo json_encode(['status' => false, 'message' => 'Method Not Allowed']);
            return;
        }

        if ($kode_buku === null) {
            $this->output->set_status_header(400);
            echo json_encode(['status' => false, 'message' => 'Parameter kode_buku tidak diberikan']);
            return;
        }

        // Cek ketersediaan buku
        $buku = $this->M_buku->ambil_data($kode_buku);
        if (!$buku) {
            $this->output->set_status_header(404);
            echo json_encode(['status' => false, 'message' => 'Data buku tidak ditemukan']);
            return;
        }

        $hapus = $this->M_buku->hapus_data($kode_buku);

        if ($hapus) {
            echo json_encode([
                'status'  => true,
                'message' => 'Data buku berhasil dihapus'
            ]);
        } else {
            $this->output->set_status_header(500);
            echo json_encode([
                'status'  => false,
                'message' => 'Gagal menghapus data dari database'
            ]);
        }
    }
}

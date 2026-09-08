<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Api extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        // Set header JSON dan CORS
        header('Content-Type: application/json');
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, POST');
        header('Access-Control-Allow-Headers: Content-Type, Authorization, X-API-KEY');

        // Handle preflight OPTIONS request
        if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
            $this->output->set_status_header(200);
            exit;
        }

        // Load model
        $this->load->model('M_mahasiswa');

        // Validasi API Key
        $api_key = "Mahasiswa123";
        $headers = $this->input->request_headers();


        $client_key = isset($headers['X-Api-Key']) ? $headers['X-Api-Key']
            : (isset($headers['X-Api-Key']) ? $headers['X-Api-Key'] : null);

        if ($client_key !== $api_key) {
            $this->output->set_status_header(401);
            echo json_encode([
                'status'  => false,
                'message' => 'Unauthorized: API Key salah atau tidak ditemukan'
            ]);
            exit;
        }
    }

    /**
     * GET /api/get_data
     * Mengambil semua data mahasiswa
     */
    public function get_data()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
            $this->output->set_status_header(405);
            echo json_encode(['status' => false, 'message' => 'Method Not Allowed']);
            return;
        }

        $data = $this->M_mahasiswa->ambil_semua_data();

        echo json_encode([
            'status'  => true,
            'message' => 'Data berhasil diambil',
            'data'    => $data
        ]);
    }

    /**
     * POST /api/kirim_data
     * Menyimpan data mahasiswa baru dari pihak luar
     */
    public function kirim_data()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->output->set_status_header(405);
            echo json_encode(['status' => false, 'message' => 'Method Not Allowed']);
            return;
        }

        $input = json_decode(file_get_contents('php://input'), true);

        if (!empty($input['npm']) && !empty($input['nama'])) {
            $payload = [
                'npm'  => $input['npm'],
                'nama' => $input['nama'],
                'foto' => 'default.jpg'
            ];

            $simpan = $this->M_mahasiswa->tambah_data($payload);

            if ($simpan) {
                echo json_encode([
                    'status'  => true,
                    'message' => 'Data dari pihak luar berhasil disimpan'
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
                'message' => 'Data input tidak lengkap (npm dan nama wajib diisi)'
            ]);
        }
    }
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chatbot extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        // Cek login
        if (!$this->session->userdata('role_id')) {
            redirect('auth');
        }
    }

    public function index()
    {
        $data['title'] = 'Chatbot';
        $data['isi_konten'] = 'chatbot/index';
        $this->load->view('layout/template', $data);
    }

    public function send()
    {
        header('Content-Type: application/json');
        
        $message = trim($this->input->post('message'));
        $apiKeyInput = trim($this->input->post('api_key'));
        $modelInput = trim($this->input->post('model'));

        if (empty($message)) {
            echo json_encode([
                'status' => false,
                'message' => 'Pesan kosong'
            ]);
            return;
        }

        // Gunakan API Key dari frontend jika ada, jika tidak pakai hardcoded placeholder
        $apiKey = !empty($apiKeyInput) ? $apiKeyInput : 'MASUKAN API KEY ANDA MASING-MASING';
        
        // JIKA TIDAK ADA KEY / MASIH PLACEHOLDER -> MASUK KE MODE SIMULASI LOKAL (BIAR LANGSUNG JALAN DAN TIDAK PUSING)
        if (empty($apiKey) || $apiKey === 'MASUKAN API KEY ANDA MASING-MASING') {
            $userName = 'Broo';
            $reply = "Halo " . $userName . "! (Mode Simulasi) Saya menerima pesan Anda: \"" . $message . "\". Hubungkan dengan OpenRouter API Key di atas jika ingin menggunakan AI asli.";
            
            $lowerMessage = strtolower($message);
            if (strpos($lowerMessage, 'nama') !== false) {
                if (strpos($lowerMessage, 'kamu') !== false || strpos($lowerMessage, 'bot') !== false) {
                    $reply = "Nama saya adalah BotKampus, chatbot pintar buatan mahasiswa Web Programming 2.";
                } else {
                    $reply = "Nama Anda adalah " . $userName . ". Anda login menggunakan akun ini di sistem akademik.";
                }
            } elseif (strpos($lowerMessage, 'kabar') !== false || strpos($lowerMessage, 'gimana') !== false) {
                $reply = "Kabar saya luar biasa baik! Bagaimana dengan Anda, " . $userName . "? Semoga harimu menyenangkan!";
            } elseif (strpos($lowerMessage, 'hi') === 0 || strpos($lowerMessage, 'hii') === 0 || strpos($lowerMessage, 'halo') !== false || strpos($lowerMessage, 'hello') !== false || strpos($lowerMessage, 'hei') !== false) {
                $reply = "Halo juga " . $userName . "! Ada yang bisa saya bantu hari ini?";
            } elseif (strpos($lowerMessage, 'matakuliah') !== false || strpos($lowerMessage, 'kuliah') !== false) {
                $reply = "Untuk melihat atau mengelola mata kuliah, silakan akses menu 'Data Matakuliah' di panel sidebar kiri.";
            }

            echo json_encode([
                'status' => true,
                'debug' => [
                    'http_code' => 200,
                    'curl_error' => '',
                    'model' => 'local/mock-chatbot-simulator',
                    'request' => [
                        'message' => $message,
                        'user' => $userName
                    ],
                    'raw_response' => 'Simulation active',
                    'decoded_response' => [
                        'choices' => [
                            [
                                'message' => [
                                    'content' => $reply
                                ]
                            ]
                        ]
                    ]
                ]
            ], JSON_PRETTY_PRINT);
            return;
        }
        
        // Gunakan model dari frontend jika ada, jika tidak pakai gpt-4o-mini
        $model = !empty($modelInput) ? $modelInput : 'openai/gpt-4o-mini';

        $data = [
            "model" => $model,
            "messages" => [
                [
                    "role" => "user",
                    "content" => $message
                ]
            ]
        ];

        $jsonData = json_encode($data);
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "https://openrouter.ai/api/v1/chat/completions");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        
        // DEBUG Area
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Content-Type: application/json",
            "Authorization: Bearer " . $apiKey,
            "HTTP-Referer: http://localhost/ci-32/",
            "X-Title: Chatbot Kampus"
        ]);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);

        $result = curl_exec($ch);
        $curlError = curl_error($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        $decoded = json_decode($result, true);

        echo json_encode([
            'status' => true,
            'debug' => [
                'http_code' => $httpCode,
                'curl_error' => $curlError,
                'model' => $model,
                'request' => $data,
                'raw_response' => $result,
                'decoded_response' => $decoded
            ]
        ], JSON_PRETTY_PRINT);
    }
}

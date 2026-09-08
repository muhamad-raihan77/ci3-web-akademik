<?php
 defined ('BASEPATH') or exit('Tidak bisa akses langsung');
 
 class Dashboard extends CI_Controller
 {
	 public function __construct()
     {
        parent::__construct();
        $this->load->library(['session', 'form_validation']);
        $this->load->model('M_mahasiswa');
		$this->load->model('M_matakuliah');
		$this->load->model('M_dosen');
		$this->load->model('M_buku');
        // Proteksi Dasar: Harus Login
        if (!$this->session->userdata('logged_in')) {
            redirect('auth');
        }
     }
    
    
	 public function index()
	 {
		 $role_id = $this->session->userdata('role_id');
		 if($role_id == 1)
			{
				$this->halaman_admin();
			}
			elseif 	($role_id == 2)
			{
				$this->halaman_baak();
			}
			else if ($role_id == 3)
			{
				$this->halaman_mahasiswa();
			}else
			{
				redirect('auth');
			}
		 
	 }
	 
	 private function halaman_admin()
	 {
		 $data['isi_konten'] = 'admin/view_dashboard';
		 $data['title'] = 'Halaman Admin';
		 $this->load->view('layout/template',$data);
	 }
	 
	 private function halaman_baak()
	 {
		 $data['isi_konten'] = 'baak/view_dashboard';
		 $data['title'] = 'Halaman Admin';
		 $this->load->view('layout/template',$data);
	 }
	 
	 private function halaman_mahasiswa()
	 {
		 $data['isi_konten'] = 'baak/view_dashboard';
		 $data['title'] = 'Halaman Admin';
		 $this->load->view('layout/template',$data);
	 }
	
	public function data_mahasiswa()
	{		
		$data['mahasiswa'] = $this->M_mahasiswa->ambil_semua_data();
		$data['title'] = 'Kelola Data Mahasiswa';
		$data['isi_konten'] = 'baak/mahasiswa_index';
		$this->load->view('layout/template', $data);
	}
	
	public function data_mataku()
	{		
		$data['matakuliah'] = $this->M_matakuliah->ambil_semua_data();
		$data['title'] = 'Kelola Data Matakuliah';
		$data['isi_konten'] = 'baak/matakuliah_index';
		$this->load->view('layout/template', $data);
	}
	
	public function data_nilai()
	{
		$data['title'] = 'Kelola data Nilai'; 
		$data['isi_konten'] = 'baak/nilai'; 
		$this->load->view('layout/template', $data);
	}
	
	public function tambah_mhs()
	{
		$data['title'] = 'Tambah Mahasiswa';
		$data['isi_konten'] = 'baak/tambah_mahasiswa';
		$this->load->view('layout/template', $data);
	}

	public function tambah_matakuliah()
	{
		$data['title'] = 'Tambah Matakuliah';
		$data['isi_konten'] = 'baak/tambah_matakuliah';
		$this->load->view('layout/template', $data);
	}

	public function edit_matakuliah($kode_mk)
	{
		if ($this->session->userdata('role_id') != 2) redirect('dashboard');

		$data['mk'] = $this->M_matakuliah->ambil_data($kode_mk);
		if (!$data['mk']) {
			$this->session->set_flashdata('error', 'Data matakuliah tidak ditemukan.');
			redirect('dashboard/data_mataku');
		}

		$data['title'] = 'Edit Matakuliah';
		$data['isi_konten'] = 'baak/edit_matakuliah';
		$this->load->view('layout/template', $data);
	}

	public function proses_edit_mk()
	{
		if ($this->session->userdata('role_id') != 2) redirect('dashboard');

		$kode_mk = $this->input->post('kode_mk');
		$update_data = [
			'nama_mk' => $this->input->post('nama_mk'),
			'sks'     => $this->input->post('sks'),
			'sem'     => $this->input->post('sem')
		];

		$this->M_matakuliah->update_data($kode_mk, $update_data);
		$this->session->set_flashdata('success', 'Data matakuliah berhasil diupdate!');
		redirect('dashboard/data_mataku');
	}

	public function hapus_mk($kode_mk)
	{
		if ($this->session->userdata('role_id') != 2) redirect('dashboard');

		$this->M_matakuliah->hapus_data($kode_mk);
		$this->session->set_flashdata('success', 'Data matakuliah berhasil dihapus!');
		redirect('dashboard/data_mataku');
	}
	
	public function proses_tambah_mhs()
	{
    if ($this->session->userdata('role_id') != 2) redirect('dashboard');

    $npm  = $this->input->post('npm');
    $nama = $this->input->post('nama');

    // Konfigurasi Upload Gambar
    $config['upload_path']   = './assets/foto/';
    $config['allowed_types'] = 'jpg|png|jpeg';
    $config['max_size']      = 2048; // 2MB
    $config['file_name']     = 'mhs_' . $npm;

    $this->load->library('upload', $config);

    if (!$this->upload->do_upload('foto')) {
        // Jika upload gagal
        $this->session->set_flashdata('error', $this->upload->display_errors());
        redirect('dashboard/tambah_mahasiswa');
    } else {
        // Jika upload berhasil
        $foto_data = $this->upload->data();
        $data = [
            'npm'  => $npm,
            'nama' => $nama,
            'foto' => $foto_data['file_name']
        ];

        $this->M_mahasiswa->tambah_data($data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Congratulation! Data has been created <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        redirect('dashboard/data_mahasiswa');
    }
	}
	
	public function edit_mhs($npm)
	{
		if ($this->session->userdata('role_id') != 2) redirect('dashboard');

		$data['mhs'] = $this->M_mahasiswa->ambil_data($npm);
		if (!$data['mhs']) {
			$this->session->set_flashdata('error', 'Data mahasiswa tidak ditemukan.');
			redirect('dashboard/data_mahasiswa');
		}
    
		$data['title'] = 'Edit Mahasiswa';
		$data['isi_konten'] = 'baak/edit_mahasiswa';
		$this->load->view('layout/template', $data);
	}

	public function proses_edit_mhs()
	{
		if ($this->session->userdata('role_id') != 2) redirect('dashboard');

		$npm = $this->input->post('npm');
		$foto_lama = $this->input->post('foto_lama');
		$update_data = ['nama'=>$this->input->post('nama')];

		if (!empty($_FILES['foto']['name'])) {
			$config['upload_path']   = './assets/foto/';
			$config['allowed_types'] = 'jpg|png|jpeg';
			$config['max_size']      = 2048;
			$config['file_name']     = 'mhs_' . $npm . '_' . time();

			$this->load->library('upload', $config);

			if ($this->upload->do_upload('foto')) {
				$foto_baru = $this->upload->data('file_name');
				if ($foto_lama != 'default.jpg') {
					unlink(FCPATH . 'assets/foto/' . $foto_lama);
				}
				$this->db->set('foto', $foto_baru);
			}
		}
		$this->M_mahasiswa->update_data($npm, $update_data);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Congratulation! Data has been Updated.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		redirect('dashboard/data_mahasiswa');
	}

	public function hapus_mhs($npm)
	{
		if ($this->session->userdata('role_id') != 2) redirect('dashboard');

		$mhs = $this->M_mahasiswa->ambil_data($npm);
		if ($mhs->foto != 'default.jpg') {
			unlink(FCPATH . 'assets/foto/' . $mhs->foto);
		}
	
		$this->M_mahasiswa->hapus_data($npm);
		$this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">Data has been deleted.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		redirect('dashboard/data_mahasiswa');
	}

	public function proses_tambah_mk()
	{
		if ($this->session->userdata('role_id') != 2) redirect('dashboard');

		$this->form_validation->set_rules(
			'kode_mk',
			'Kode Matakuliah',
			'required|trim|is_unique[matakuliah.kode_mk]',
			['is_unique' => 'Kode Matakuliah sudah terdaftar!']
		);

		$this->form_validation->set_rules('nama_mk', 'Nama Matakuliah', 'required|trim');
		$this->form_validation->set_rules('sks', 'SKS', 'required|numeric');
		$this->form_validation->set_rules('sem', 'Semester', 'required|numeric');

		if ($this->form_validation->run() == FALSE) {
			$this->tambah_matakuliah();
		} else {
			$data = [
				'kode_mk' => $this->input->post('kode_mk'),
				'nama_mk' => $this->input->post('nama_mk'),
				'sks'     => $this->input->post('sks'),
				'sem'     => $this->input->post('sem')
			];

			$insert = $this->M_matakuliah->tambah_data($data);

			if (!$insert) {
				$this->session->set_flashdata('error', 'Gagal menambahkan data matakuliah. Silakan coba lagi.');
				redirect('dashboard/tambah_matakuliah');
			}

			$this->session->set_flashdata('success', 'Data matakuliah berhasil ditambahkan!');
			redirect('dashboard/data_mataku');
		}
	}

	public function data_dosen()
	{		
		$data['dosen'] = $this->M_dosen->ambil_semua_data();
		$data['title'] = 'Kelola Data Dosen';
		$data['isi_konten'] = 'baak/dosen_index';
		$this->load->view('layout/template', $data);
	}

	public function tambah_dosen()
	{
		$data['title'] = 'Tambah Dosen';
		$data['isi_konten'] = 'baak/tambah_dosen';
		$this->load->view('layout/template', $data);
	}

	public function proses_tambah_dosen()
	{
		if ($this->session->userdata('role_id') != 2) redirect('dashboard');

		$this->form_validation->set_rules(
			'NIDN',
			'NIDN',
			'required|trim|callback_cek_nidn_unik',
			['cek_nidn_unik' => 'NIDN sudah terdaftar!']
		);
		$this->form_validation->set_rules('Nama', 'Nama Dosen', 'required|trim');

		if ($this->form_validation->run() == FALSE) {
			$this->tambah_dosen();
		} else {
			$data = [
				'NIDN' => $this->input->post('NIDN'),
				'Nama' => $this->input->post('Nama')
			];

			$this->M_dosen->tambah_data($data);
			$this->session->set_flashdata('success', 'Data dosen berhasil ditambahkan!');
			redirect('dashboard/data_dosen');
		}
	}

	// Callback untuk cek NIDN unik (karena nama tabel mengandung spasi)
	public function cek_nidn_unik($nidn)
	{
		$existing = $this->M_dosen->ambil_data($nidn);
		if ($existing) {
			$this->form_validation->set_message('cek_nidn_unik', 'NIDN sudah terdaftar!');
			return FALSE;
		}
		return TRUE;
	}

	public function edit_dosen($nidn)
	{
		if ($this->session->userdata('role_id') != 2) redirect('dashboard');

		$data['dosen'] = $this->M_dosen->ambil_data($nidn);
		if (!$data['dosen']) {
			$this->session->set_flashdata('error', 'Data dosen tidak ditemukan.');
			redirect('dashboard/data_dosen');
		}

		$data['title'] = 'Edit Dosen';
		$data['isi_konten'] = 'baak/edit_dosen';
		$this->load->view('layout/template', $data);
	}

	public function proses_edit_dosen()
	{
		if ($this->session->userdata('role_id') != 2) redirect('dashboard');

		$nidn = $this->input->post('NIDN');
		$update_data = [
			'Nama' => $this->input->post('Nama')
		];

		$this->M_dosen->update_data($nidn, $update_data);
		$this->session->set_flashdata('success', 'Data dosen berhasil diupdate!');
		redirect('dashboard/data_dosen');
	}

	public function hapus_dosen($nidn)
	{
		if ($this->session->userdata('role_id') != 2) redirect('dashboard');

		$this->M_dosen->hapus_data($nidn);
		$this->session->set_flashdata('success', 'Data dosen berhasil dihapus!');
		redirect('dashboard/data_dosen');
	}

	public function export_excel()
	{
		$data['title'] = 'Laporan Data Mahasiswa';
		$data['mahasiswa'] = $this->M_mahasiswa->ambil_semua_data();
		$data['isi_konten'] = 'baak/mahasiswa_index';
		$this->load->view('baak/excel', $data);
	}

	public function export_excel_single($parameter)
	{
		$data['title'] = 'Laporan Data Mahasiswa';
		$data['mahasiswa'] = $this->M_mahasiswa->ambil_data($parameter);
		$data['isi_konten'] = 'baak/mahasiswa_index';
		$this->load->view('baak/excel', $data);
	}

	// Added for Modul #10 (Updated to Module #1 Student Activity Sheet)
	public function export_pdf()
	{
		$this->load->library('mypdfgenerator');
		$data['title'] = "Data Mahasiswa";
		$data['mahasiswa'] = $this->M_mahasiswa->ambil_semua_data();
		$this->mypdfgenerator->generate('baak/laporan_pdf', $data);
	}

	public function print_mahasiswa($param)
	{
		$this->load->library('mypdfgenerator');
		$data['title'] = "Detail Mahasiswa";
		$data['mahasiswa'] = $this->M_mahasiswa->ambil_data($param);
		$this->mypdfgenerator->generate('baak/print_mahasiswa', $data);
	}

	public function qrcode($npm)
	{
		$data['mahasiswa'] = $this->M_mahasiswa->ambil_data($npm);
		$this->load->view('baak/qrcode',$data);
	}

	// =====================================================
	// MODUL BUKU - CRUD + Export Excel & PDF
	// =====================================================

	/**
	 * Menampilkan daftar semua data buku
	 */
	public function data_buku()
	{
		$data['buku'] = $this->M_buku->ambil_semua_data();
		$data['title'] = 'Kelola Data Buku';
		$data['isi_konten'] = 'baak/buku_index';
		$this->load->view('layout/template', $data);
	}

	/**
	 * Menampilkan form tambah buku
	 */
	public function tambah_buku()
	{
		$data['title'] = 'Tambah Buku';
		$data['isi_konten'] = 'baak/tambah_buku';
		$this->load->view('layout/template', $data);
	}

	/**
	 * Proses simpan data buku baru
	 */
	public function proses_tambah_buku()
	{
		if ($this->session->userdata('role_id') != 2) redirect('dashboard');

		$this->form_validation->set_rules(
			'kode_buku',
			'Kode Buku',
			'required|trim|max_length[6]|is_unique[buku.kode_buku]',
			['is_unique' => 'Kode Buku sudah terdaftar!']
		);
		$this->form_validation->set_rules('judul', 'Judul', 'required|trim');
		$this->form_validation->set_rules('penulis', 'Penulis', 'required|trim|max_length[25]');
		$this->form_validation->set_rules('penerbit', 'Penerbit', 'required|trim|max_length[50]');

		if ($this->form_validation->run() == FALSE) {
			$this->tambah_buku();
		} else {
			$data = [
				'kode_buku' => $this->input->post('kode_buku'),
				'judul'     => $this->input->post('judul'),
				'penulis'   => $this->input->post('penulis'),
				'penerbit'  => $this->input->post('penerbit')
			];

			$insert = $this->M_buku->tambah_data($data);

			if (!$insert) {
				$this->session->set_flashdata('error', 'Gagal menambahkan data buku. Silakan coba lagi.');
				redirect('dashboard/tambah_buku');
			}

			$this->session->set_flashdata('success', 'Data buku berhasil ditambahkan!');
			redirect('dashboard/data_buku');
		}
	}

	/**
	 * Menampilkan form edit buku
	 */
	public function edit_buku($kode_buku)
	{
		if ($this->session->userdata('role_id') != 2) redirect('dashboard');

		$data['buku'] = $this->M_buku->ambil_data($kode_buku);
		if (!$data['buku']) {
			$this->session->set_flashdata('error', 'Data buku tidak ditemukan.');
			redirect('dashboard/data_buku');
		}

		$data['title'] = 'Edit Buku';
		$data['isi_konten'] = 'baak/edit_buku';
		$this->load->view('layout/template', $data);
	}

	/**
	 * Proses update data buku
	 */
	public function proses_edit_buku()
	{
		if ($this->session->userdata('role_id') != 2) redirect('dashboard');

		$kode_buku = $this->input->post('kode_buku');
		$update_data = [
			'judul'    => $this->input->post('judul'),
			'penulis'  => $this->input->post('penulis'),
			'penerbit' => $this->input->post('penerbit')
		];

		$this->M_buku->update_data($kode_buku, $update_data);
		$this->session->set_flashdata('success', 'Data buku berhasil diupdate!');
		redirect('dashboard/data_buku');
	}

	/**
	 * Hapus data buku
	 */
	public function hapus_buku($kode_buku)
	{
		if ($this->session->userdata('role_id') != 2) redirect('dashboard');

		$this->M_buku->hapus_data($kode_buku);
		$this->session->set_flashdata('success', 'Data buku berhasil dihapus!');
		redirect('dashboard/data_buku');
	}

	/**
	 * Export data buku ke Excel/Spreadsheet
	 */
	public function export_excel_buku()
	{
		$data['title'] = 'Laporan Data Buku';
		$data['buku'] = $this->M_buku->ambil_semua_data();
		$this->load->view('baak/excel_buku', $data);
	}

	/**
	 * Export data buku ke PDF
	 */
	public function export_pdf_buku()
	{
		$this->load->library('mypdfgenerator');
		$data['title'] = "Laporan Data Buku";
		$data['buku'] = $this->M_buku->ambil_semua_data();
		$this->mypdfgenerator->generate('baak/laporan_buku_pdf', $data, 'Laporan_Buku');
	}

}
 

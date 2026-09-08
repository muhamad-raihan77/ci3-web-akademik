<?php
 defined ('BASEPATH') or exit('Tidak bisa akses langsung');
 
 class Auth extends CI_Controller
 {
	 public function __construct()
	 {
		 parent::__construct();
		 $this->load->model('M_auth');
		 $this->load->library('session');
		 $this->load->library('form_validation');
	 }
	 
	 
	 public function index()
	 {
		 $this->load->view('auth/login');
	 }
	 
	 public function proses_login()
	 {
		$user = $this->input->post('email');
		$pwd = $this->input->post('password');
		$data_user = $this->db->get_where('user',['email'=> $user])->row();
		if($data_user)
		{
			if(password_verify($pwd, $data_user->password))
			{
				$session_data = array(
					'id' => $data_user->id,
					'name' => $data_user->name,
					'email' => $data_user->email,
					'role_id' => $data_user->role_id,
					'logged_in' => TRUE
				);
				$this->session->set_userdata($session_data);
				redirect('dashboard');
			}
			else
			{
				$this->session->set_flashdata('error','Kata sandi salah');
				redirect(base_url('index.php/auth'));
			}
		}
		else
		{
			$this->session->set_flashdata('error','Usernama tidak terdaftar');
			redirect('auth');
		}
	 }
	 
	 
	 public function register()
	 {
		 $this->load->view('auth/register');
	 }
	 
	 public function proses_register()
	{
		$this->form_validation->set_rules('nama', 'Nama', 'required|trim');
		$this->form_validation->set_rules('email', 'Username/Email', 'required|is_unique[user.email]');
		$this->form_validation->set_rules('pwd1', 'Password', 'required|min_length[5]');
		$this->form_validation->set_rules('pwd2', 'Konfirmasi Password', 'required|matches[pwd1]', [
			'matches' => 'Konfirmasi password tidak cocok!'
		]);

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('auth/register');
			
		} else {
			$data = [
				'name' => $this->input->post('nama'), 
				'email' => $this->input->post('email'), 
				'password' => password_hash($this->input->post('pwd1'), PASSWORD_DEFAULT),
				'role_id'     => 2 
			];

			$simpan = $this->db->insert('user', $data);

			if ($simpan) {
				$this->session->set_flashdata('success', 'Registrasi Berhasil!');
				redirect('auth');
			} else {
				$this->session->set_flashdata('error', 'Gagal menyimpan data.');
				redirect('auth/register');
			}
		}
	}
	
	public function logout()
	{
		$this->session->sess_destroy();
		$this->session->set_flashdata('Anda berhasil logout');
		redirect('auth');
	}
 }


<?php
	class M_mahasiswa extends CI_Model
	{
		public function ambil_semua_data()
		{
			return $this->db->get('mahasiswa')->result();
		}
		
		public function ambil_data($npm)
		{
			return $this->db->get_where('mahasiswa',['npm' => $npm])->row();
		}
		
		public function tambah_data($data)
		{
			return $this->db->insert('mahasiswa',$data);
		}
		
		public function update_data($npm,$data)
		{
			$this->db->where('npm',$npm);
			return $this->db->update('mahasiswa',$data);
		}
		
		public function hapus_data($npm)
		{
			return $this->db->delete('mahasiswa', ['npm' => $npm]);
		}

		// Added for Modul #10
		public function show_data()
		{
			return $this->db->get('mahasiswa');
		}

		public function edit_data($table, $where)
		{
			return $this->db->get_where($table, $where);
		}
	}

?>

<?php
	defined('BASEPATH') or exit ('Tidak ada akses');
	
	class M_auth extends CI_Model
	{
		public function tampil_user()
		{
			$q = $this->db->get('user');
			return $q->result(); 
		}	
	}
?>

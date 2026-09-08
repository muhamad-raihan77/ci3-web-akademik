<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_dosen extends CI_Model
{
    private $table = 'tabel dosen';

    public function ambil_semua_data()
    {
        return $this->db->query("SELECT * FROM `tabel dosen`")->result();
    }

    public function ambil_data($nidn)
    {
        return $this->db->query("SELECT * FROM `tabel dosen` WHERE NIDN = ?", [$nidn])->row();
    }

    public function tambah_data($data)
    {
        return $this->db->query("INSERT INTO `tabel dosen` (NIDN, Nama) VALUES (?, ?)", [$data['NIDN'], $data['Nama']]);
    }

    public function update_data($nidn, $data)
    {
        return $this->db->query("UPDATE `tabel dosen` SET Nama = ? WHERE NIDN = ?", [$data['Nama'], $nidn]);
    }

    public function hapus_data($nidn)
    {
        return $this->db->query("DELETE FROM `tabel dosen` WHERE NIDN = ?", [$nidn]);
    }
}

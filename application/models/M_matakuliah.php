<?php
class M_matakuliah extends CI_Model
{
    public function ambil_semua_data()
    {
        return $this->db->get('matakuliah')->result();
    }

    public function ambil_data($kode_mk)
    {
        return $this->db->get_where('matakuliah', ['kode_mk' => $kode_mk])->row();
    }

    public function tambah_data($data)
    {
        return $this->db->insert('matakuliah', $data);
    }

    public function update_data($kode_mk, $data)
    {
        $this->db->where('kode_mk', $kode_mk);
        return $this->db->update('matakuliah', $data);
    }

    public function hapus_data($kode_mk)
    {
        return $this->db->delete('matakuliah', ['kode_mk' => $kode_mk]);
    }
}
?>
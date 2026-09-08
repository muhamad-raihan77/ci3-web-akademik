<?php
class M_buku extends CI_Model
{
    public function ambil_semua_data()
    {
        return $this->db->get('buku')->result();
    }

    public function ambil_data($kode_buku)
    {
        return $this->db->get_where('buku', ['kode_buku' => $kode_buku])->row();
    }

    public function tambah_data($data)
    {
        return $this->db->insert('buku', $data);
    }

    public function update_data($kode_buku, $data)
    {
        $this->db->where('kode_buku', $kode_buku);
        return $this->db->update('buku', $data);
    }

    public function hapus_data($kode_buku)
    {
        return $this->db->delete('buku', ['kode_buku' => $kode_buku]);
    }
}
?>

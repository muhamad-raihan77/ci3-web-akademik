<?php
class Matakuliah_model extends CI_Model {

    public function getAll() {
        return $this->db->get('matakuliah')->result();
    }

    public function insert($data) {
        return $this->db->insert('matakuliah', $data);
    }

    public function delete($id) {
        return $this->db->delete('matakuliah', ['id' => $id]);
    }
}
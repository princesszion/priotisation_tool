<?php
class Diseases_mdl extends CI_Model {

    public function get_all() {
        $this->db->select('d.id, d.name, d.description, d.thematic_area_id, ta.name AS thematic_area');
        $this->db->from('diseases_and_conditions d');
        $this->db->join('disease_thematic_areas ta', 'ta.id = d.thematic_area_id', 'left');
        return $this->db->get()->result();
    }
    

    public function insert($data) {
        return $this->db->insert('diseases_and_conditions', $data);
    }

    public function update($id, $data) {
        return $this->db->where('id', $id)->update('diseases_and_conditions', $data);
    }

    public function delete($id) {
        return $this->db->delete('diseases_and_conditions', ['id' => $id]);
    }

    public function get($id) {
        return $this->db->get_where('diseases_and_conditions', ['id' => $id])->row();
    }
}

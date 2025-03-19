<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Records_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	public function assign_disease_to_country($member_state_id, $disease_id) {
        // Check if already assigned
        $exists = $this->db->get_where('member_state_diseases', [
            'member_state_id' => $member_state_id,
            'disease_id' => $disease_id
        ])->num_rows();

        if ($exists == 0) {
            $this->db->insert('member_state_diseases', [
                'member_state_id' => $member_state_id,
                'disease_id' => $disease_id
            ]);
        }
    }
	public function get_assigned_diseases($member_state_id) {
		$this->db->select('diseases_and_conditions.name');
		$this->db->join('diseases_and_conditions', 'member_state_diseases.disease_id = diseases_and_conditions.id');
		$query = $this->db->get_where('member_state_diseases', ['member_state_id' => $member_state_id]);
		return $query->result_array();
	}
	public function unassign_disease_from_country($member_state_id, $disease_id) {
		$this->db->delete('member_state_diseases', [
			'member_state_id' => $member_state_id,
			'disease_id' => $disease_id
		]);
	}
	public function get_all_parameters(){
		return $this->db->get('parameters')->result_array();
	}
	
	public function load_ranking_form() {
    $country_id = $this->input->post('member_state_id');
    $period = $this->input->post('period');
    $thematic_area_id = $this->input->post('thematic_area_id'); // Add thematic area filter

    // Fetch diseases based on country and thematic area
    $data['diseases'] = $this->records_model->get_assigned_diseases_with_area($country_id, $thematic_area_id);
    $data['parameters'] = $this->records_model->get_all_parameters();

    // Load the view with filtered data
    $this->load->view('ranking_table', $data);
}

public function get_assigned_diseases_with_area($member_state_id, $thematic_area_id = null) {
    $this->db->select('d.id, d.name, ta.name as thematic_area')
             ->from('member_state_diseases msd')
             ->join('diseases_and_conditions d', 'd.id = msd.disease_id')
             ->join('disease_thematic_areas ta', 'ta.id = d.thematic_area_id')
             ->where('msd.member_state_id', $member_state_id);

    // Add thematic area filter only if a specific thematic area is selected
    if (!empty($thematic_area_id)) {
        $this->db->where('d.thematic_area_id', $thematic_area_id);
    }

    return $this->db->get()->result_array();
}
	
  // Get existing data for a specific member_state_id, period, and disease_id
  public function get_member_state_disease_data($member_state_id, $period, $disease_id) {
	return $this->db->get_where('member_state_diseases_data', [
		'member_state_id' => $member_state_id,
		'period' => $period,
		'disease_id' => $disease_id
	])->row_array();
}

// Insert new data into the member_state_diseases_data table
public function insert_member_state_disease_data($data) {
	return $this->db->insert('member_state_diseases_data', $data);
}

// Update existing data in the member_state_diseases_data table
public function update_member_state_disease_data($id, $data) {
	$this->db->where('id', $id);
	return $this->db->update('member_state_diseases_data', $data);
}
	
	
	

	
}
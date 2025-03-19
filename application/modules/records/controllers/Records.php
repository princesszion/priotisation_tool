<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Records extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('records_model');
		$this->load->library('pagination');
	}

	public function profile()
	{
		// Pagination configuration
		$data['module'] = 'records';
		$data['title'] = 'Home';
		$data['uptitle'] = "Home";
        $data['countries'] =$this->lists_mdl->get_memberstates();
		$data['thematic_areas']=$this->lists_mdl->get_thematic_areas();
		$data['diseases'] =$this->lists_mdl->get_diseases();
		//dd($data);
		render_site('index', $data);
	}
	public function index()
	{
		// Pagination configuration
		$data['module'] = 'records';
		$data['title'] = 'Country Disease Profile';
		$data['uptitle'] = "Country";
		$data['countries'] =$this->lists_mdl->get_memberstates();
		$data['thematic_areas']=$this->lists_mdl->get_thematic_areas();
		$data['diseases'] =$this->lists_mdl->get_diseases();
		
		render_site('dashboard', $data);
	}
	public function assign_diseases() {
        $country_id = $this->input->post('member_state_id');
        $diseases = $this->input->post('diseases');

        if (!$country_id || empty($diseases)) {
            echo json_encode(['status' => false, 'message' => 'Please select diseases and a country.']);
            return;
        }

        foreach ($diseases as $disease_id) {
            $this->records_model->assign_disease_to_country($country_id, $disease_id);
        }

        echo json_encode(['status' => true, 'message' => 'Diseases successfully assigned.']);
    }
	public function get_assigned_diseases() {
		$member_state_id = $this->input->post('member_state_id');
		$diseases = $this->records_model->get_assigned_diseases($member_state_id);
		echo json_encode($diseases);
	}
	public function unassign_diseases() {
		$country_id = $this->input->post('member_state_id');
		$diseases = $this->input->post('diseases');
	
		if (!$country_id || empty($diseases)) {
			echo json_encode(['status' => false, 'message' => 'Select at least one disease and a country.']);
			return;
		}
	
		foreach ($diseases as $disease_id) {
			$this->records_model->unassign_disease_from_country($country_id, $disease_id);
		}
	
		echo json_encode(['status' => true, 'message' => $this->db->last_query()]);
	}

	// Load form dynamically
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
	
	public function save_ranking_data() {
		// Get the POST data
		$member_state_id = $this->input->post('member_state_id');
		$period = $this->input->post('period');
		$disease_id = $this->input->post('disease_id');
		$param = $this->input->post('param'); // Parameter key (e.g., 'prev', 'detect', etc.)
		$creteria = $this->input->post('creteria'); // Selected value
	
		// Validate the input data
		if (empty($member_state_id) || empty($period) || empty($disease_id) || empty($param) || empty($creteria)) {
			echo json_encode(['status' => 'error', 'message' => 'Invalid input data']);
			return;
		}
	
		// Map the parameter to the correct column in the table
		$param_columns = [
			'prev' => ['prev1', 'prev2', 'prev3'],
			'detect' => ['detect1', 'detect2', 'detect3'],
			'morbid' => ['morbid1', 'morbid2', 'morbid3'],
			'case' => ['case1', 'case2', 'case3'],
			'mort' => ['mort1', 'mort2', 'mort3'],
		];
	
		// Check if the parameter exists in the mapping
		if (array_key_exists($param, $param_columns)) {
			// Fetch existing data for the member_state_id, period, and disease_id
			$existing_data = $this->records_model->get_member_state_disease_data($member_state_id, $period, $disease_id);
	
			if ($existing_data) {
				// Prepare data for update
				$data = [
					'period' => $period,
					'member_state_id' => $member_state_id,
					'disease_id' => $disease_id,
				];
	
				// Reset all columns in the parameter group to NULL
				foreach ($param_columns[$param] as $column) {
					$data[$column] = null;
				}
	
				// Update the specific column with the new value
				$data[$param_columns[$param][0]] = $creteria; // Always use the first column (e.g., detect1)
	
				// Update the record in the database
				$this->records_model->update_member_state_disease_data($existing_data['id'], $data);
			} else {
				// Insert a new record
				$data = [
					'period' => $period,
					'member_state_id' => $member_state_id,
					'disease_id' => $disease_id,
					$param_columns[$param][0] => $creteria, // Use the first column for the parameter
				];
	
				$this->records_model->insert_member_state_disease_data($data);
			}
	
			echo json_encode(['status' => 'success', 'message' => 'Data saved successfully']);
		} else {
			echo json_encode(['status' => 'error', 'message' => 'Invalid parameter']);
		}
	}
	

	
	


}
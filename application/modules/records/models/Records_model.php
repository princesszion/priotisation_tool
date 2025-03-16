<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Records_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function count_all_outbreak_events()
	{
		return $this->db->count_all('outbreak_events');
	}

	public function get_outbreak_events($limit, $start)
	{
		$this->db->order_by('priority', 'ASC');
		$this->db->limit($limit, $start);
		$query = $this->db->get('outbreak_events');
		return $query->result();
	}

	public function search_outbreak_events($term)
	{
		// Add wildcard search with '%' before and after the search term
		$this->db->like('outbreak_name', $term, 'both');
		$this->db->or_like('start_date', $term, 'both');
		$this->db->or_like('end_date', $term, 'both');

		// Order results by start date in descending order
		$this->db->order_by('start_date', 'DESC');

		// Fetch the results from the 'outbreak_events' table
		$query = $this->db->get('outbreak_events');

		return $query->result(); // Return the result set
	}


	public function get_outbreak_event($id)
	{
		$query = $this->db->get_where('outbreak_events', ['id' => $id]);
		return $query->row();
	}

	public function create_outbreak_event($data)
	{
		$this->db->insert('outbreak_events', $data);
		return $this->db->insert_id();
	}

	public function update_outbreak_event($id, $data)
	{
		$this->db->where('id', $id);
		return $this->db->update('outbreak_events', $data);
	}

	public function delete_outbreak_event($id)
	{
		$this->db->where('id', $id);
		return $this->db->delete('outbreak_events');
	}
}
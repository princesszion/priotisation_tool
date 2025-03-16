<?php
defined('BASEPATH') or exit('No direct script access allowed');

#[AllowDynamicProperties]
class Data_mdl extends CI_Model
{


	public function __Construct()
	{

		parent::__Construct();

		$this->table = "outbreak_events";
	}

			public function get()
		{
			// Get table structure (schema)
			$schema_query = $this->db->query("SHOW COLUMNS FROM " . $this->table);
			$schema = $schema_query->result();
			// Get table data
			$data_query = $this->db->get($this->table);
			return $data_query->result(); 
			
		}


	public function get_by_id($id)
	{
		$query = $this->db->get_where($this->table, ['id' => $id]);
		return $query->row();
	}

	public function insert($data)
	{
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}

	public function update($id, $data)
	{
		$this->db->update($this->table, $data, ['id' => $id]);
		return $this->db->affected_rows();
	}

	public function delete($id)
	{
		$this->db->delete($this->table, ['id' => $id]);	
		return $this->db->affected_rows();
	}
	// Method to insert a menu link for an outbreak
	public function insert_menu_link($data)
	{
		// Insert the menu link into the table
		return $this->db->insert('outbreak_menu_links', $data);
	}

	// Optional: Method to fetch outbreaks for the dropdown in the form
	public function get_all_outbreaks()
	{
		return $this->db->get('outbreak_menu_links')->result();
	}

	// Optional: Method to get outbreak by ID
	public function get_outbreak_by_id($id)
	{
		return $this->db->where('id', $id)->get('outbreak_menu_links')->row();
	}

	// Optional: Method to delete a menu link by ID (if needed)
	public function delete_menu_link($id)
	{
		return $this->db->where('id', $id)->delete('outbreak_menu_links');
	}
	public function delete_menu_links_by_outbreak($outbreak_id)
	{
		return $this->db->where('outbreak_id', $outbreak_id)->delete('outbreak_menu_links');
	}

	// Optional: Method to update a menu link by ID (if needed)
	public function update_menu_link($id, $data)
	{
		return $this->db->where('id', $id)->update('outbreak_menu_links', $data);
	}

	// Optional: Method to get menu links by outbreak ID
	public function get_menu_links_by_outbreak($outbreak_id)
	{
		return $this->db->where('outbreak_id', $outbreak_id)->get('outbreak_menu_links')->result();
	}

	
}

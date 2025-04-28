<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Outbreaks extends MX_Controller
{


	public  function __construct()
	{
		parent::__construct();

		$this->module = "outbreaks";
		$this->title  = "Outbreaks";
		$this->load->model("outbreaks_mdl", 'outbreaksmodel');
	}

	public function index()
	{
		$data['module'] = $this->module;
		$data['title']  = $this->title;
		$data['uptitle']   = "Outbreaks";
		$data['outbreaks'] = $this->outbreaksmodel->get();

		render('list', $data);
	}
	public function create()
	{
		$data['module'] = $this->module;
		$data['title'] = $this->title;
		$data['uptitle'] = "Add Outbreaks";
		$data['outbreaks'] = $this->outbreaksmodel->get();

		render('add', $data);
	}

	public function create_links()
	{
		$data['module'] = $this->module;
		$data['title'] = $this->title;
		$data['uptitle'] = "Add Outbreaks";
		$data['outbreaks'] = $this->outbreaksmodel->get();

		render('links', $data);
	}
	public function edit_links()
	{
		$data['module'] = $this->module;
		$data['title'] = $this->title;
		$data['uptitle'] = "Add Outbreaks";
		$data['outbreaks'] = $this->outbreaksmodel->get();

		render('edit_links', $data);
	}


	public function add()
	{
	

		// Get form data
		$data = [
			'outbreak_name' => $this->input->post('outbreak_name'),
			'outbreak_type' => $this->input->post('outbreak_type'),
			'start_date' => $this->input->post('start_date'),
			'end_date' => $this->input->post('end_date'),
			'severity_level' => $this->input->post('severity_level'),
			'status' => $this->input->post('status'),
			'affected_regions' => $this->input->post('affected_regions'),
			'coordinator_name' => $this->input->post('coordinator_name'),
			'contact_email' => $this->input->post('contact_email'),
			'contact_phone' => $this->input->post('contact_phone'),
			'description' => $this->input->post('description')
		];

		// Insert outbreak data into the database
		$result = $this->outbreaksmodel->insert($data);

		if ($result) {
			$response = [
				'success' => true,
				'message' => 'Outbreak added successfully'
			];
		} else {
			$response = [
				'success' => false,
				'message' => 'Failed to add outbreak'
			];
		}

		// Return JSON response
		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($response));
	}

	public function edit($id, $status=FALSE)
	{
		// Load outbreak by ID for GET request or failed POST validation
		$outbreak = $this->outbreaksmodel->get_by_id($id);

		if (!$outbreak) {
			show_404(); // If no outbreak is found, show a 404 page
			return;
		}

		// Handle POST request (update)
		if ($this->input->post()) {
			// Collect the input data
			if(!$this->input->post('status')){
			$data['status'] = $status;
			}
			$data =$this->input->post();

			

			// Update the outbreak
			$result = $this->outbreaksmodel->update($id, $data);

			if ($result) {
				$response = [
					'success' => true,
					'message' => 'Outbreak updated successfully',
					'data' => $this->outbreaksmodel->get_by_id($id)
				];
			} else {
				$response = [
					'success' => false,
					'message' => 'Failed to update outbreak'
				];
			}

			// Return JSON response for AJAX call
			$this->output
				->set_content_type('application/json')
				->set_output(json_encode($response));
		} else {
			// Handle GET request (display the edit form)
			$data['outbreak'] = $outbreak;
			$this->load->view('outbreaks/edit', $data);
		}
	}
	public function delete($id)
	{
		

		// Attempt to delete the outbreak
		$result = $this->outbreaksmodel->delete($id);

		if ($result) {
			$response = [
				'success' => true,
				'message' => 'Outbreak deleted successfully'
			];
		} else {
			$response = [
				'success' => false,
				'message' => 'Failed to delete outbreak'
			];
		}

		// Return JSON response
		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($response));
	}
	public function assign_menu_links()
	{
		

		$outbreak_id = $this->input->post('outbreak_id');
		$menu_items = $this->input->post('menu');

		// Ensure menu items do not exceed 5 and outbreak ID is valid
		if (count($menu_items) > 5 || !$outbreak_id) {
			$response = [
				'success' => false,
				'message' => 'Invalid outbreak ID or too many menu items'
			];
			$this->output
				->set_content_type('application/json')
				->set_output(json_encode($response));
			return;
		}

		foreach ($menu_items as $item) {
			$data = [
				'outbreak_id' => $outbreak_id,
				'name' => $item['name'],
				'title' => $item['name'],
				'tab' => $item['tab'],
				'url' => $item['url'],
			];

			$this->outbreaksmodel->insert_menu_link($data);
		}

		$response = [
			'success' => true,
			'message' => 'Menu links assigned successfully'
		];

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($response));
	}
	public function get_menu_links($outbreak_id)
	{
		$menu_items = $this->outbreaksmodel->get_menu_links_by_outbreak($outbreak_id);
		$response = [
			'success' => true,
			'menu_items' => $menu_items
		];

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($response));
	}
	public function update_menu_links()
	{
	

		// Get the outbreak ID
		$outbreak_id = $this->input->post('outbreak_id');
		if (!$outbreak_id) {
			$response = [
				'success' => false,
				'message' => 'Invalid outbreak ID'
			];
			$this->output
				->set_content_type('application/json')
				->set_output(json_encode($response));
			return;
		}

		// Get the menu items from the form data
		$menu_items = $this->input->post('menu');
		if (empty($menu_items) || !is_array($menu_items)) {
			$response = [
				'success' => false,
				'message' => 'No menu items provided'
			];
			$this->output
				->set_content_type('application/json')
				->set_output(json_encode($response));
			return;
		}

		// Delete existing menu links for the outbreak before inserting the updated ones
		$this->outbreaksmodel->delete_menu_links_by_outbreak($outbreak_id);

		// Insert the new menu items
		foreach ($menu_items as $item) {
			$data = [
				'outbreak_id' => $outbreak_id,
				'name' => $item['name'],
				'title' => $item['title'],
				'tab' => $item['tab'],
				'url' => $item['url'],
				'icon' => isset($item['icon']) ? $item['icon'] : null,
				'is_active' => 1 // Default to active; this can be adjusted based on your requirements
			];

			// Insert each menu link
			$this->outbreaksmodel->insert_menu_link($data);
		}

		// Send a success response
		$response = [
			'success' => true,
			'message' => 'Menu items updated successfully'
		];

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($response));
	}

	public function copy_menu_links()
	{
		

		// Retrieve source and target outbreak IDs
		$source_outbreak_id = $this->input->post('source_outbreak_id');
		$target_outbreak_id = $this->input->post('target_outbreak_id');

		// Check if both IDs are valid
		if (!$source_outbreak_id || !$target_outbreak_id) {
			$response = [
				'success' => false,
				'message' => 'Invalid outbreak IDs'
			];
			$this->output
				->set_content_type('application/json')
				->set_output(json_encode($response));
			return;
		}

		// Fetch menu links for the source outbreak
		$menu_links = $this->outbreaksmodel->get_menu_links_by_outbreak($source_outbreak_id);

		// Check if there are menu links to copy
		if (empty($menu_links)) {
			$response = [
				'success' => false,
				'message' => 'No menu items to copy from the selected outbreak'
			];
			$this->output
				->set_content_type('application/json')
				->set_output(json_encode($response));
			return;
		}

		// Copy each menu link to the target outbreak as new entries
		foreach ($menu_links as $menu_link) {
			$data = [
				'outbreak_id' => $target_outbreak_id,
				'name' => $menu_link->name,
				'title' => $menu_link->title,
				'tab' => $menu_link->tab,
				'url' => $menu_link->url,
				'icon' => $menu_link->icon,
				'order' => $menu_link->order,
				'is_active' => $menu_link->is_active
			];

			// Insert each copied menu link into the target outbreak
			$this->outbreaksmodel->insert_menu_link($data);
		}

		// Send a success response
		$response = [
			'success' => true,
			'message' => 'Menu items copied successfully'
		];

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($response));
	}






}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Parameters_mdl extends CI_Model {
    
    public function get_pivot_data() {
        $query = $this->db->select("header, creteria, beta")
                          ->from("parameters")
                          ->get();
        $data = $query->result_array();

        $pivot = [];
        $headers = [];
        $levels = [];

        foreach ($data as $row) {
            $headers[$row['header']] = $row['header']; // Collect headers dynamically
            $pivot['beta'][$row['header']] = $row['beta'];
            $levels[$row['header']] = $row['creteria']; // Store the criteria levels
        }

        return ['headers' =>  ($headers), 'pivot' => $pivot, 'levels' => $levels];
    }
}
?>

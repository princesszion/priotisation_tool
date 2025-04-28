<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FormFlashHook {
    public function setFlashData() {
        $CI = &get_instance();
        $CI->load->library('session');

        // Check if it's a POST request
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Store all form data into flash session
            $CI->session->set_flashdata('form_data', $CI->input->post());
        }
    }
}

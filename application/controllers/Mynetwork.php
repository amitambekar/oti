<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mynetwork extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$session_data = $this->session->userdata;
		$username = $this->input->get('username');
		if($username == '')
		{
			$username = $session_data['oti_logged_in']['username'];
		}
		$data = array();
		$data['session_data'] = $session_data;
		$data['username'] = $username;
		$this->load->view('frontend/mynetwork',$data);
	}
}
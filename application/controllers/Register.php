<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {

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
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index($sponserUsername='')
	{
		$session_data = $this->session->userdata;
		$data = array();
		$data['session_data'] = $session_data;

		$placement = $this->input->get('placement');
		$data['sponserUsername']=$sponserUsername;
		$data['placement']=$placement;
		$this->load->view('frontend/register',$data);
	}
	
	public function signUp()
	{
		if($this->input->post())
		{
			$status = '';
			$message = '';
			$this->load->library('form_validation');
			$username = $this->input->post('username');
			$email = $this->input->post('email');
			$password = $this->input->post('password');
			$sponserUsername = $this->input->post('sponserUsername');
			$placement1 = $this->input->post('placement');
			$placement_id = $this->input->post('placement_id');

			$this->form_validation->set_rules('username', 'Username', 'required');
			$this->form_validation->set_rules('email', 'Email ID', 'required|valid_email');
			$this->form_validation->set_rules('password', 'Password', 'required');
			$this->form_validation->run();
			$error_array = $this->form_validation->error_array();
			
			$checkUsernameExists = checkUsernameExists($username);	
			if($checkUsernameExists == true)
			{
				$error_array['username'] = 'Username already exists';
			}
			$checkEmailIDExists = checkEmailIDExists($email);	
			if($checkEmailIDExists == true)
			{
				$error_array['email'] = 'Email ID already exists';
			}
			if(count($error_array) == 0 )
			{
				$this->load->model('Register_model');
				$email_verification_token = md5($username.$email);
				$userid = $this->Register_model->register($username,$email,$password,$email_verification_token);
				
				$alignment_data = array();
				if($sponserUsername != '')
				{
					$alignment_data = checkAlignmentSetOfUser($sponserUsername);	
				}

				//$sponserid = 0;
				//$placement = 'left';
				//dump($_REQUEST);
				//dump($alignment_data);
				if(count($alignment_data) > 0)
				{
					//echo "success1";
					$sponserid = $alignment_data['userid'];
					$placement = $alignment_data['user_alignment'];
				}else
				{
					//echo "success2";
					$alignment_data = checkAlignmentSetOfUser('amitjain');
					$sponserid = $alignment_data['userid'];
					$placement = $alignment_data['user_alignment'];
				}

				if($placement1 != '')
				{
					//echo "success3";
					$placement = $placement1;
				}

				if($placement_id > 0)
				{
					$placementid=$placement_id;
				}else
				{
					$placementid=$sponserid;
				}
				binary_tree_update($userid,$sponserid,$placement,$placementid);
				
				$email_data = array();
				$template_data = array();
				$template_data['email'] = $email;
				$template_data['username'] = $username;
				$template_data['email_verification_token'] = $email_verification_token;

				$email_data['subject'] = 'New Registration Email Verfication';
				$email_data['html'] = $this->load->view('frontend/email_templates/new_registration_email_verification',$template_data,true);;
				$email_data['to'] = $email;
				send_email($email_data);
				$status = 'success';
			    $message = 'user registered successfully';
			    $status_code = 200;
			}else
			{
				$status = 'error';
			    $message = $error_array;
			    $status_code = 501;
			}
			$response = array('status'=>$status,'message'=>$message);
			echo responseObject($response,$status_code);
			
		}
	}

	public function placementOfUser()
	{
		if($this->input->post())
		{
			$userid = $this->input->post('userid');
			$sponserid = $this->input->post('sponserid');
			$placement = $this->input->post('placement');			
		}
	}

	public function email_verification()
	{
		$email_verification_token = $this->input->get('email_verification_token');
		$this->load->model('Register_model');
		
		$user_data = $this->Register_model->email_token_verification($email_verification_token);
		
		if(count($user_data)>0)
		{
			$this->load->model('Login_model');
			$res = $this->Login_model->check_login($user_data['username'],$user_data['password'],true);		
			$message = 'Email Verification Completed';
		    redirect('dashboard?message='.$message);    
		}else
		{
			$message = 'Verfication Token Not Matching';
			redirect('home?message='.$message);
		}
	}
}
<?php

class User extends Secure_Controller {

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
	 * 
	 */
	
	function __construct()
	{
		parent::__construct();
		$this->load->model( array( 'mindex_user','mglobal') );
		$this->load->library('form_validation');
		$this->load->helper('url','form');
	}
	public function index($user_row=0)
	{
		$this->session->set_userdata('cur_row',$user_row);
		$per_page = $this->mindex_user->active_user_num_rows();
		$per_page = $per_page->NumRows;
		$user_per_page =$per_page;
		$total_row= $this->mindex_user->count_user();
		$this->load->library('pagination');
		$config['base_url'] = base_url('user/index/');
		$config['total_rows'] = $total_row->user_count;
		$user_total =  $total_row->user_count;
		$config['cur_page'] = $user_row;
		$config['per_page'] = $per_page;
		$this->pagination->initialize($config);
		$data['links']= $this->pagination->create_links();
		$data['menu_name'] = "";
		$data['get_treeview'] = $this->mindex_user->get_treeview('treeview_user');
		$data['post_month'] = "";
		$data['post_year'] = "";
		$data['post_name']= "";
		$data['user_lname']= $this->session->userdata('user_lname');
		$data['user_fname'] = $this->session->userdata('user_fname');
		$data['user_position']= $this->session->userdata('user_position');
		$data['user_count']=$user_total;
		$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
		$data['user'] = $this->mindex_user->user_view($user_per_page,$user_row,$user_total);
		$data['user_num_rows'] = $this->mindex_user->user_num_rows();
		$this->load->view('header/header_admin',$data);
		$this->load->view('admin/view_user',$data);
		$this->load->view('footer/footer_admin',$data);
	}
	public function view_user_scan()
	{
		$user_row= $this->session->userdata('cur_row');
			
		$per_page = $this->input->post('user_per_page');
		if ($per_page == "")
		{
			$per_page = $this->mindex_user->active_user_num_rows();
			$per_page = $per_page->NumRows;
		}
		$user_per_page =$per_page;
		$this->mindex_user->update_user_num_rows($user_per_page);
		$total_row= $this->mindex_user->count_user();
		$this->load->library('pagination');
		$config['base_url'] = base_url('user/view_user_search/');
		$config['total_rows'] = $total_row->user_count;
		$user_total =  $total_row->user_count;
		$config['cur_page'] = $user_row;
		$config['per_page'] = $per_page;
		$this->pagination->initialize($config);
		$data['links']= $this->pagination->create_links();
		$data['menu_name'] = "";
		$data['get_treeview'] = $this->mindex_user->get_treeview('treeview_user');
		$data['post_month'] = "";
		$data['post_year'] = "";
		$data['post_name']= "";
		$data['user_lname']= $this->session->userdata('user_lname');
		$data['user_fname'] = $this->session->userdata('user_fname');
		$data['user_position']= $this->session->userdata('user_position');
		$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
		$data['user_count']=$user_total;
		$data['user'] = $this->mindex_user->user_view($user_per_page,$user_row,$user_total);
		$data['user_num_rows'] = $this->mindex_user->user_num_rows();
		$this->load->view('header/header_admin',$data);
		$this->load->view('admin/view_user',$data);
		$this->load->view('footer/footer_admin',$data);
	}
	public function view_user_search($user_row=0)
	{
		$user_search=$this->session->userdata('user_search');
		$this->session->set_userdata('cur_row',$user_row);
		$per_page = $this->mindex_user->active_user_num_rows();
		$per_page = $per_page->NumRows;
		$user_per_page =$per_page;
		$this->mindex_user->update_user_num_rows($user_per_page);
		$total_row= $this->mindex_user->count_user_search($user_search);
		$this->load->library('pagination');
		$config['base_url'] = base_url('user/view_user_search/');
		$config['total_rows'] = $total_row->user_count;
		$user_total =  $total_row->user_count;
		$config['cur_page'] = $user_row;
		$config['per_page'] = $per_page;
		$this->pagination->initialize($config);
		$data['links']= $this->pagination->create_links();
		$data['menu_name'] = "";
		$data['get_treeview'] = $this->mindex_user->get_treeview('treeview_user');
		$data['post_month'] = "";
		$data['post_year'] = "";
		$data['post_name']= "";
		$data['user_lname']= $this->session->userdata('user_lname');
		$data['user_fname'] = $this->session->userdata('user_fname');
		$data['user_position']= $this->session->userdata('user_position');
		$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
		$data['user_count']=$user_total;
		$data['user'] = $this->mindex_user->user_view_search($user_per_page,$user_search,$user_row,$user_total);
		$data['user_num_rows'] = $this->mindex_user->user_num_rows();
		$this->load->view('header/header_admin',$data);
		$this->load->view('admin/view_user_search',$data);
		$this->load->view('footer/footer_admin',$data);
	}
	public function view_user_searched()
	{
		$user_row= $this->session->userdata('cur_row');
		$user_search=$this->input->post('hid_user_search');
		if($user_search)
		{
			$this->session->set_userdata('user_search',$user_search);
		}
		else 
		{
			$user_search= $this->session->userdata('user_search');
		}
		
		$per_page = $this->input->post('user_per_page_search');
		if ($per_page == "")
		{
			$per_page = $this->mindex_user->active_user_num_rows();
			$per_page = $per_page->NumRows;
			$user_row= 0;
		}
		
		$user_per_page =$per_page;
		$this->mindex_user->update_user_num_rows($user_per_page);
		$total_row= $this->mindex_user->count_user_search($user_search);
		$this->load->library('pagination');
		$config['base_url'] = base_url('user/view_user_search/');
		$config['total_rows'] = $total_row->user_count;
		$user_total =  $total_row->user_count;
		$config['cur_page'] = $user_row;
		$config['per_page'] = $per_page;
		$this->pagination->initialize($config);
		$data['links']= $this->pagination->create_links();
		$data['menu_name'] = "";
		$data['get_treeview'] = $this->mindex_user->get_treeview('treeview_user');
		$data['post_month'] = "";
		$data['post_year'] = "";
		$data['post_name']= "";
		$data['user_lname']= $this->session->userdata('user_lname');
		$data['user_fname'] = $this->session->userdata('user_fname');
		$data['user_position']= $this->session->userdata('user_position');
		$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
		$data['user_count']=$user_total;
		$data['user'] = $this->mindex_user->user_view_search($user_per_page,$user_search,$user_row,$user_total);
		$data['user_num_rows'] = $this->mindex_user->user_num_rows();
		$this->load->view('header/header_admin',$data);
		$this->load->view('admin/view_user_search',$data);
		$this->load->view('footer/footer_admin',$data);
	}
	public function add_user()
	{
		$user_user_id="";
		$user_pic = $this->input->post('userfile');
		$add =  $this->input->post('btn-add');
		$user_no = $this->input->post('user_no');
		$user_last_name = $this->input->post('user_last_name');
		$user_first_name = $this->input->post('user_first_name');
		$user_mid_name = $this->input->post('user_mid_name');
		$user_suffix_name = $this->input->post('user_suffix_name');
		$user_position = $this->input->post('user_position');
		$user_contact = $this->input->post('user_contact');
		$user_email = $this->input->post('user_email');
		$user_username = $this->input->post('user_username');
		$user_password = $this->input->post('user_password');
		$get_user_no = $this->mindex_user->get_user_no();
		$user_password = $this->input->post('user_password');
		$user_confirm_password = $this->input->post('user_confirm_password');
		
		$data['menu_name'] = "";
		$data['get_treeview'] = $this->mindex_user->get_treeview('treeview_user');
		$data['post_month'] = "";
		$data['post_year'] = "";
		$data['post_name']= "";
		if($add)
		{
			$data['record'] = array('user_no' => 'cxzcxz');
			$this->load->helper(array('form', 'url'));
			$this->load->library('form_validation');
	    	$this->form_validation->set_rules('user_no',				'User Number' ,	'required|numeric');
	        $this->form_validation->set_rules('user_first_name',  		'First Name',		'required|alpha_name');
	        $this->form_validation->set_rules('user_mid_name', 			'Middle Name',		'required|alpha_name');
	        $this->form_validation->set_rules('user_last_name',			'Last Name',  		'required|alpha_name');
	        $this->form_validation->set_rules('user_position',			'Position', 		'required');
	        $this->form_validation->set_rules('user_contact',			'Contact Number',	'required|numeric');
	        $this->form_validation->set_rules('user_email',				'Email Address',	'required|valid_email');
			$this->form_validation->set_rules('user_password',			'Password', 		'required');
			$this->form_validation->set_rules('user_confirm_password',	'Confirm Password',	'required|matches[user_password]');
	        $data['record'] = array(
	        	'user_no'   			=> $this->input->post('user_no'),
		        'user_first_name'   	=> $this->input->post('user_first_name'),
		        'user_mid_name'   	=> $this->input->post('user_mid_name'),
		        'user_last_name'   	=> $this->input->post('user_last_name'),
        		'user_suffix_name'  	=> $this->input->post('user_suffix_name'),
		        'user_position'   	=> $this->input->post('user_position'),
	        	'user_contact'   	=> $this->input->post('user_contact'),
		        'user_email'   		=> $this->input->post('user_email'),
		        'user_username'   	=> $this->input->post('user_username'),
		        'user_password'   	=> $this->input->post('user_password')
	       
	        );

	        if ($this->form_validation->run($this) == false)
	        {
	        		$data['success']="";
					$data['user_lname']= $this->session->userdata('user_lname');
					$data['user_fname'] = $this->session->userdata('user_fname');
					$data['user_position']= $this->session->userdata('user_position');
					$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
					$data['user'] = $this->mindex_user->user_view();
					$this->load->view('header/header_admin',$data);
					$this->load->view('admin/add_user',$data);
					$this->load->view('footer/footer_admin',$data);
	        }
	        else
	        {
				$this->uploadImage_add($user_first_name.$user_no);
				$user_pic = '~/Pictures/'.$this->session->userdata('user_picture');
	        	$this->mindex_user->user_add($user_no, $user_username, $user_password, $user_last_name, $user_first_name, $user_mid_name,$user_suffix_name, $user_position,$user_contact, $user_email,$user_pic);
	        	$user_id = $this->mindex_user->get_user_added($user_no);
	        	$user_id = $user_id->user_id;
	        	$this->session->set_userdata('user_picture', '');
	        	redirect('user/added_user/'.encode($user_id)); 
	        }
    	}
		else 
		{
		$data['success'] = "";
		if(count($get_user_no)<1)
		{
			$data['record'] = array('user_no'=> '0'.'1');
		}	
		elseif(intval($get_user_no->user_no) <9)
		{
			$data['record'] = array('user_no'=> '0'.strval($get_user_no->user_no + 1));
		}
		else
		{
			$data['record'] = array('user_no'=> intval( $get_user_no->user_no + 1));
		}
		
    	$data['user_lname']= $this->session->userdata('user_lname');
		$data['user_fname'] = $this->session->userdata('user_fname');
		$data['user_position']= $this->session->userdata('user_position');
		$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
		$data['user'] = $this->mindex_user->user_view();
		$this->load->view('header/header_admin',$data);
		$this->load->view('admin/add_user',$data);
		$this->load->view('footer/footer_admin',$data);
		}
	}
	function added_user($user_id=0)
	{
		$data['menu_name'] = "";
		$data['get_treeview'] = $this->mindex_user->get_treeview('treeview_user');
		$data['post_month'] = "";
		$data['post_year'] = "";
		$data['post_name']= "";
		$user_id = decode($user_id);
		if($user_id==0)
		{
			redirect('welcome');
		}
		else
		{
			$data['get_l'] = "";
			$data['get_r'] = "";
			$data['user_pic'] ="";
			$data['view_identify'] = 0;
			$data['user_action'] = 'Added';
			$data['btn_l_name'] = "Edit Users";
			$data['btn_l'] = 'user/update_user/'.encode($user_id);
			$data['btn_r_name'] = "View Users";
			$data['btn_r'] = 'user/';
			$data['info_user'] = $this->mindex_user->get_user_update($user_id);
			$data['user_lname']= $this->session->userdata('user_lname');
			$data['user_fname'] = $this->session->userdata('user_fname');
			$data['user_position']= $this->session->userdata('user_position');
			$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
			$this->load->view('header/header_admin',$data);
			$this->load->view('admin/info_user',$data);
			$this->load->view('footer/footer_admin',$data);
		}
	
	}
	function update_user($user_id = 0)
	{
		$data['menu_name'] = "";
		$data['get_treeview'] = $this->mindex_user->get_treeview('treeview_user');
		$data['post_month'] = "";
		$data['post_year'] = "";
		$data['post_name']= "";
		$user_id = decode($user_id);
		$user_pic = $this->input->post('userfile');
		$this->load->model( array( 'mindex_user') );
		$data['user_id'] = $user_id;
		$data['record'] = '';
		$data['success'] = '';
		$get_user = $this->mindex_user->get_user_update($user_id);
		$user_last_name = $this->input->post('user_last_name');
		$user_first_name = $this->input->post('user_first_name');
		$user_mid_name = $this->input->post('user_mid_name');
		$user_suffix_name = $this->input->post('user_suffix_name');
		$user_position = $this->input->post('user_position');
		$user_contact = $this->input->post('user_contact');
		$user_email = $this->input->post('user_email');
		$user_no = $get_user[0]->user_no;
		if($user_id<>"")
		{	
			
			$data['record'] = array(
					'user_no'   			=> $get_user[0]->user_no,
					'user_first_name'   	=> $get_user[0]->user_first_name,
					'user_mid_name'   	=> $get_user[0]->user_mid_name,
					'user_last_name'   	=> $get_user[0]->user_last_name,
					'user_suffix_name'   	=> $get_user[0]->user_suffix_name,
					'user_position'   	=> $get_user[0]->user_position,
					'user_contact'   	=> $get_user[0]->user_contact,
					'user_email'   		=> $get_user[0]->user_email,
			);
			$this->load->library('form_validation');
			$this->form_validation->set_rules('user_first_name',    	'First Name',		'required|alpha_name');
			$this->form_validation->set_rules('user_mid_name', 			'Middle Name',  	'required|alpha_name');
			$this->form_validation->set_rules('user_last_name',			'Last Name',  		'required|alpha_name');
			$this->form_validation->set_rules('user_position',			'Position', 		'required');
			$this->form_validation->set_rules('user_contact',			'Contact Number', 	'required|numeric');
			$this->form_validation->set_rules('user_email',				'Email Address', 	'required|valid_email');
			 
			if ($this->form_validation->run() == false)
			{
				$this->session->set_flashdata('error', 'error_message');
			}
			else
			{
				$fileName= substr($get_user[0]->user_picture,11);
				$this->mindex_user->user_update($user_id,$user_last_name,$user_first_name,$user_mid_name,$user_suffix_name,$user_position,$user_contact,$user_email);
				$this->uploadImage($fileName);
				redirect('user/updated_user/'.encode($user_id));
			}
			
			$data['user_lname']= $this->session->userdata('user_lname');
			$data['user_fname'] = $this->session->userdata('user_fname');
			$data['user_position']= $this->session->userdata('user_position');
			$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
			$this->load->view('header/header_admin',$data);
			$this->load->view('admin/update_user',$data);
			$this->load->view('footer/footer_admin',$data);
		}
		else
		{
			redirect('user');	
		}
	}
	function updated_user($user_id=0)
	{
		$data['menu_name'] = "";
		$data['get_treeview'] = $this->mindex_user->get_treeview('treeview_user');		
		$data['post_month'] = "";
		$data['post_year'] = "";
		$data['post_name']= "";
		$user_id = decode($user_id);
		if($user_id==0)
		{
			redirect('user');
		}
		else 
		{
			$data['get_l'] = "";
			$data['get_r'] = "";
			$data['view_identify'] = 1;
			$data['user_pic'] = '~/Pictures/'.$this->session->userdata('user_picture');
			$data['back'] = 'user/update_user/'.$user_id;
			$data['user_action'] = 'Updated';
			$data['btn_l_name'] = "Update User";
			$data['btn_l'] = 'user/update_user/'.encode($user_id);
			$data['btn_r_name'] = "View Users";
			$data['btn_r'] = 'user/';
			$data['info_user'] = $this->mindex_user->get_user_update($user_id);
			$data['user_lname']= $this->session->userdata('user_lname');
			$data['user_fname'] = $this->session->userdata('user_fname');
			$data['user_position']= $this->session->userdata('user_position');
			$data['user_picture'] = $this->session->userdata('user_picture');
			$this->load->view('header/header_admin',$data);
			$this->load->view('admin/info_user',$data);
			$this->load->view('footer/footer_admin',$data);
		}

	}
	function delete_user($user_user_id=0)
	{
		$user_user_id = decode($user_user_id);
		$info_user =$this->mindex_user->get_user_update($user_user_id);
		if(count($info_user)>0)
		{		
			$data['menu_name'] = "";
			$data['post_month'] = "";
			$data['post_year'] = "";
			$data['post_name']= "";
			$data['get_treeview'] = $this->mindex_user->get_treeview('treeview_user');
			$data['get_l'] = "";
			$data['get_r'] = "";
			$data['user_pic'] ="";
			$data['view_identify'] = 0;
			$data['user_action'] = 'Delete';
			$data['btn_l_name'] = "Back";
			$data['btn_l'] = 'user/';
			$data['btn_r_name'] = "Delete";
			$data['btn_r'] = 'user/deleted_user/'.encode($user_user_id);
			$data['info_user'] = $this->mindex_user->get_user_update($user_user_id);
			$data['user_lname']= $this->session->userdata('user_lname');
			$data['user_fname'] = $this->session->userdata('user_fname');
			$data['user_position']= $this->session->userdata('user_position');
			$data['user_picture'] = $this->session->userdata('user_picture');
			$this->load->view('header/header_admin',$data);
			$this->load->view('admin/info_user',$data);
			$this->load->view('footer/footer_admin',$data);
		}
		else {
			redirect('user');
		}
	}
	function deleted_user($user_user_id=0)
	{
		$user_user_id = decode($user_user_id);
		$this->mindex_user->user_delete($user_user_id);
		redirect('user');
	}
	function change_password()
	{
		$data['menu_name'] = "";
		$data['get_treeview'] = $this->mindex_user->get_treeview('treeview_user');
		$data['post_month'] = "";
		$data['post_year'] = "";
		$data['post_name']= "";
		$user_id = $this->session->userdata('user_id'); 
		$this->load->model( array( 'mindex_user') );
		$data['user_id'] = $user_id;
		$data['record'] = '';
		$data['success'] = ''; 
// 		$user_no = $get_user[0]->user_no;
		$user_no = $this->input->post('user_no');
		$get_user = $this->mindex_user->get_user_info($user_no);
		$btn_chg= $this->input->post("btn-add");
		$user_old_password = $this->input->post('user_old_pasword');
		$user_password = $this->input->post('user_password');
		$user_confirm_password = $this->input->post('user_confirm_password');
// 		$user_id= $get_user[0]->user_id;
		$data['record'] = ''; 	
	 
		if($btn_chg)
		{
			$data['record'] = array(
					'user_no'   				=> $user_no,
					'user_old_password'   		=> $user_old_password,
					'user_password'   			=> $user_password,
					'user_confirm_password' 	=> $user_confirm_password,
			);
		
		
			$this->load->library('form_validation');
			$this->load->helper('security');
			$this->form_validation->set_rules('user_old_password',		'Old Password', 	'required|callback_old_password_check');
			$this->form_validation->set_rules('user_password',			'Password', 		'required');
			$this->form_validation->set_rules('user_confirm_password',	'Confirm Password',	'required|matches[user_password]');
		
			if ($this->form_validation->run() == false)
			{
				$this->session->set_flashdata('error', 'error_message');
				$data['user_lname']= $this->session->userdata('user_lname');
				$data['user_fname'] = $this->session->userdata('user_fname');
				$data['user_position']= $this->session->userdata('user_position'); 
				$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
				$this->load->view('header/header_admin',$data);
				$this->load->view('admin/user_change_password',$data);
				$this->load->view('footer/footer_admin',$data);
			}
			else
			{
				// 				$fileName= substr($get_user[0]->user_picture,11);
				$this->mindex_user->user_change_password($user_id,$user_password);
				$data['menu_name'] = "";
				$data['post_month'] = "";
				$data['post_year'] = "";
				$data['post_name']= "";
				$data['get_treeview'] = $this->mindex_user->get_treeview('treeview_user');
				$data['get_l'] = "";
				$data['get_r'] = "";
				$data['user_pic'] ="";
				$data['view_identify'] = 0;
				$data['user_action'] = 'Change Password';
				$data['btn_l_name'] = "Back";
				$data['btn_l'] = 'user/';
				$data['btn_r_name'] = "Change Password";
				$data['btn_r'] = 'user/change_password/'.encode($user_id);
				$data['info_user'] = $this->mindex_user->get_user_update($user_id);
				$data['user_lname']= $this->session->userdata('user_lname');
				$data['user_fname'] = $this->session->userdata('user_fname');
				$data['user_position']= $this->session->userdata('user_position');
				$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
				$this->load->view('header/header_admin',$data);
				$this->load->view('admin/info_user',$data);
				$this->load->view('footer/footer_admin',$data); 
			}
		
				
		 
		
		
		}
		else
		{
				
				
		
				
			$data['user_lname']= $this->session->userdata('user_lname');
			$data['user_fname'] = $this->session->userdata('user_fname');
			$data['user_position']= $this->session->userdata('user_position');
			$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
			$this->load->view('header/header_admin',$data);
			$this->load->view('admin/user_change_password',$data);
			$this->load->view('footer/footer_admin',$data);
		
		}
	}
// 	function changed_password()
// 	{
// 		$data['menu_name'] = "";
// 		$data['get_treeview'] = $this->mindex_user->get_treeview('treeview_user');
// 		$data['post_month'] = "";
// 		$data['post_year'] = "";
// 		$data['post_name']= ""; 
// 		$user_no = $this->input->post('user_no');
// 		$get_user = $this->mindex_user->get_user_info($user_no); 
// 		$btn_chg= $this->input->post("btn-add");
// 		$user_old_password = $this->input->post('user_old_pasword');
// 		$user_password = $this->input->post('user_password');
// 		$user_confirm_password = $this->input->post('user_confirm_password');
// 		$user_id= $get_user[0]->user_id;
// 		$data['record'] = '';
// 		if($btn_chg)
// 		{
// 			$data['record'] = array(
// 					'user_no'   				=> $user_no,
// 					'user_old_password'   		=> $user_old_password,
// 					'user_password'   			=> $user_password,
// 					'user_confirm_password' 	=> $user_confirm_password,
// 			);
				
				
// 			$this->load->library('form_validation');
// 			$this->form_validation->set_rules('user_old_password',		'Old Password', 	'required|');
// 			$this->form_validation->set_rules('user_password',			'Password', 		'required');
// 			$this->form_validation->set_rules('user_confirm_password',	'Confirm Password',	'required|matches[user_password]');
				
// 			if ($this->form_validation->run() == false)
// 			{
// 				$this->session->set_flashdata('error', 'error_message');
// 									$data['user_lname']= $this->session->userdata('user_lname');
// 									$data['user_fname'] = $this->session->userdata('user_fname');
// 									$data['user_position']= $this->session->userdata('user_position');
// 									$data['user_picture'] = $this->session->userdata('user_picture');
// 									$this->load->view('header/header_admin',$data);
// 									$this->load->view('admin/user_change_password',$data);
// 									$this->load->view('footer/footer_admin',$data);
// 			}
// 			else
// 			{
// 				// 				$fileName= substr($get_user[0]->user_picture,11);
// 				$this->mindex_user->user_change_password($user_id,$user_password);
// 				// 				$this->uploadImage($fileName);
// 				redirect('user/changed_password/'.encode($user_id));
// 			}
				
		 
		
		
		
		
// 		}
// 		else
// 		{
			
			
 
			
// 				$data['user_lname']= $this->session->userdata('user_lname');
// 				$data['user_fname'] = $this->session->userdata('user_fname');
// 				$data['user_position']= $this->session->userdata('user_position');
// 				$data['user_picture'] = $this->session->userdata('user_picture');
// 				$this->load->view('header/header_admin',$data);
// 				$this->load->view('admin/user_change_password',$data);
// 				$this->load->view('footer/footer_admin',$data);
// // 			$data['get_l'] = "";
// // 			$data['get_r'] = "";
// // 			$data['view_identify'] = 1;
// // 			$data['user_pic'] = '~/Pictures/'.$this->session->userdata('user_picture');
// // 			$data['back'] = 'user/update_user/'.$user_id;
// // 			$data['user_action'] = 'Password Changed';
// // 			$data['btn_l_name'] = "Update User";
// // 			$data['btn_l'] = 'user/update_user/'.encode($user_id);
// // 			$data['btn_r_name'] = "View Users";
// // 			$data['btn_r'] = 'user/';
// // 			$data['info_user'] = $this->mindex_user->get_user_update($user_id);
// // 			$data['user_lname']= $this->session->userdata('user_lname');
// // 			$data['user_fname'] = $this->session->userdata('user_fname');
// // 			$data['user_position']= $this->session->userdata('user_position');
// // 			$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
// // 			$this->load->view('header/header_admin',$data);
// // 			$this->load->view('admin/info_user',$data);
// // 			$this->load->view('footer/footer_admin',$data);
// 		}
	
// 	}
	public function username_check($user_username="")
	{
		$test = $this->mindex_user->check_user($user_username);
		if(count($test) > 0)
		{
			$this->form_validation->set_message('username_check', 'Username already exist!');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	
	public function userno_check($user_no="")
	{
		$test = $this->mindex_user->check_userno($user_no);
		if(count($test) > 0)
		{
			$this->form_validation->set_message('userno_check', 'user Number already exist');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	public function email_check($user_email="")
	{
		$test = $this->mindex_user->check_email($user_email);
		if(count($test) > 0)
		{
			$this->form_validation->set_message('email_check', 'Email Address already exist');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	public function old_password_check($user_old_password="")
	{
		$user_id = $this->session->userdata('user_id');
		$test = $this->mindex_user->check_password($user_id);
		$user_pasword = $test[0]->user_password;
		if($user_pasword == $user_old_password)
		{
			return TRUE;
			
		}
		else
		{
			$this->form_validation->set_message('old_password_check', "Password didn't match");
			return FALSE;
		}
	}
	public function uploadImage($fileName)
	{
		$config['upload_path']   =   "images/Pictures/";
		$config['allowed_types'] =   "gif|jpg|jpeg|png";
		$config['max_size']      =   "5000";
		$config['max_width']     =   "1907";
		$config['max_height']    =   "1280";
		$config['file_name']	 = $fileName;
	 	$this->load->library('upload',$config);
       if(!$this->upload->do_upload())
       {
           //echo $this->upload->display_errors();
       		$this->session->set_userdata('user_picture',  $fileName);
       }
       else
       {
           $finfo=$this->upload->data();
           $this->session->set_userdata('user_picture',  $finfo['file_name']);
           $this->_createThumbnail($finfo['file_name']);
           $data['uploadInfo'] = $finfo;
           $data['thumbnail_name'] = $finfo['raw_name']. '_thumb' .$finfo['file_ext'];
       }
	}
	public function uploadImage_add($fileName)
	{
		$config['upload_path']   =   "images/Pictures/";
		$config['allowed_types'] =   "gif|jpg|jpeg|png";
		$config['max_size']      =   "5000";
		$config['max_width']     =   "1907";
		$config['max_height']    =   "1280";
		$config['file_name']	 = $fileName;
		$this->load->library('upload',$config);
		if(!$this->upload->do_upload())
		{
			//echo $this->upload->display_errors();
			$this->session->set_userdata('user_picture',  'default.png');
		}
		else
		{
			$finfo=$this->upload->data();
			$this->session->set_userdata('user_picture',  $finfo['file_name']);
			$this->_createThumbnail($finfo['file_name']);
			$data['uploadInfo'] = $finfo;
			$data['thumbnail_name'] = $finfo['raw_name']. '_thumb' .$finfo['file_ext'];
		}
	}
	//Create Thumbnail function
	
	public function _createThumbnail($filename)
	
	{
	
		$config['image_library']    = "gd2";
		$config['source_image']     = "images/Pictures/" .$filename;
		$config['create_thumb']     = TRUE;
		$config['maintain_ratio']   = TRUE;	
		$config['width'] = "200";
		$config['height'] = "220";
		$this->load->library('image_lib',$config);
		if(!$this->image_lib->resize())
	
		{
	
			echo $this->image_lib->display_errors();
	
		}
	
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
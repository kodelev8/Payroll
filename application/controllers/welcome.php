<?php 

class Welcome extends Secure_Controller {

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
	
	function __construct()
	{
		parent::__construct();
		$this->load->model( array( 'mindex_employee','mglobal') );
		$this->load->library('form_validation');
	}
	public function index()
	{
		
		$data['user_lname']= $this->session->userdata('user_lname');
		$data['user_fname'] = $this->session->userdata('user_fname');
		$data['user_position']= $this->session->userdata('user_position');
		$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
		$this->load->view('header/header',$data);
		$this->load->view('admin/index',$data);
		$this->load->view('footer/footer');
	}
// 	public function aaindex()
// 	{
	
// 		$data['record']="";
// 		$data['user_lname']= $this->session->userdata('user_lname');
// 		$data['user_fname'] = $this->session->userdata('user_fname');
// 		$data['user_position']= $this->session->userdata('user_position');
// 		$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
// 		$this->load->view('header/header',$data);
// 		$this->load->view('main/info_employee',$data);
// 		$this->load->view('footer/footer');
// 	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
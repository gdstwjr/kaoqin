<?php

class Index extends BaseController{

	function __construct()
	{
            parent::__construct();
                //parent::BaseController();
		//parent::is_admin();
	}
        

	function index()
	{
		$this->load->view('index/index');
	}

	function header()
	{
		$this->load->view('index/header');
	}

	function menu()
	{
		$this->load->view('index/menu');
	}

	function drag()
	{
		$this->load->view('index/drag');
	}

	function main()
	{
		$this->load->view('index/main');
	}

	function footer()
	{
		$this->load->view('index/footer');
	}

}

/* End of file index.php */
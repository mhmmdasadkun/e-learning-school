<?php

class DashboardController extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata("isLogin")) {
			redirect($this->config->item('routes')['login']);
		}
	}

	public function index()
	{
		$data['title'] = "Dashboard";
		$data['session'] = $this->session;

		$this->load->view('layouts/header', $data);
		$this->load->view('dashboard');
	}
}

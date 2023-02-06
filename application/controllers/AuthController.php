<?php

class AuthController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin');
    }

    public function index()
    {
        $this->form_validation->set_rules('ad_email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('ad_password', 'Password', 'required');

        if ($this->form_validation->run()) {
            $ad_email = $this->input->post('ad_email');
            $ad_password = $this->input->post('ad_password');

            $admin = $this->admin->checking(['ad_email' => $ad_email])->row();

            if ($admin && password_verify($ad_password, $admin->ad_password)) {
                $this->session->set_userdata([
                    'username' => $admin->ad_username,
                    'email' => $admin->ad_email,
                    'isLogin' => true
                ]);

                return redirect($this->config->item('routes')['dashboard']);
            }
            return redirect($this->config->item('routes')['login']);
        }

        $this->load->view('auth/login');
    }

    public function logout()
    {
        session_destroy();
        return redirect($this->config->item('routes')['login']);
    }
}

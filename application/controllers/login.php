<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/* Author: Jorge Torres
 * Description: Login controller class
 */

class Login extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('m_login');
    }

    public function index($msg = NULL) {
        if ($this->session->userdata('loginID') != NULL) {
            redirect('http://localhost:800/projects/PremierTowels/radium_3/yarnmodule/');
        } else {
            $data['msg'] = $msg;
            $this->load->view('v_login', $data);
            $this->load->view('footer');
        }
    }

    public function process() {
        $loginModel = new M_login();
        $result = $loginModel->validate();
        if (!$result) {
            $msg = '<font>Invalid LoginID or Password</font><br>';
            $this->index($msg);
        } else {
            // If user did validate, 
            // Send them to members area
            redirect('http://localhost:800/projects/PremierTowels/radium_3/yarnmodule/');
        }
    }

    public function logout() {
        $this->session->unset_userdata();
        $this->session->sess_destroy();
        redirect(base_url() . "index.php/login/index");
    }
}

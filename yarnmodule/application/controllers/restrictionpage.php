<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Restrictionpage extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    function index() {

        $this->load->view('header');
        $this->load->view('v_restrictionpage');
        $this->load->view('footer');
    }

}
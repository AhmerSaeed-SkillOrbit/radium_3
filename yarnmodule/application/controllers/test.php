<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//require_once((dirname(__FILE__))."/ForceUTF8/Encoding.php");

//use \ForceUTF8\Encoding;

class Test extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('WeavingCalculation');
    }

    function index() {
        //var_dump(file_get_contents(dirname(__FILE__)."/testfile.txt"));
        //Encoding::toUTF8(file_get_contents(dirname(__FILE__)."/testfile.txt"));
        //Encoding::fixUTF8(file_get_contents(dirname(__FILE__)."/testfile.txt"))
        $dataArray = array();
        $dataArray['avg'] = $this->session->flashdata('avg');
        $this->load->view('header');
        $this->load->view('v_test', $dataArray);
        $this->load->view('footer');
    }

}
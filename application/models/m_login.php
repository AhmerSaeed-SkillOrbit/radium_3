<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
/* Author: Jorge Torres
 * Description: Login model class
 */

class M_login extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->library('session');
    }

    public function validate() {
        $loginID = $this->security->xss_clean($this->input->post('LoginID'));
        $password = $this->security->xss_clean($this->input->post('Password'));

//        $this->db->select('*');
//        $this->db->from('users');
//        $this->db->join('user_role', 'userrole.idUserRole = user.idUserRole');
//        $this->db->where('UserName', $username);
//        $this->db->where('Password', $password);
//        $this->db->where('user.isActive', 1);

        $this->db->select('*');
        $this->db->from('users u');
        $this->db->where('Login_id', $loginID);
        $this->db->where('Password', $password);
        $this->db->join('user_role ur', 'ur.idRole = u.idUserRole');
        $this->db->where('u.isActive', 1);
        $this->db->where('ur.isActive', 1);
        $query = $this->db->get();
        // Let's check if there are any results
        if ($query->num_rows == 1) {
            // If there is a user, then create session data
            $row = $query->row();
            $data = array(
                'idUser' => $row->User_id, 'loginID' => $row->Login_id, 'FirstName' => $row->FirstName, 'LastName' => $row->LastName, 'Password' => $row->Password, 'idRole' => $row->idRole, 'Role_code' => $row->Role_code, 'Role_name' => $row->Role_name);
            $this->session->set_userdata($data);
            return true;
        }
        return false;
    }

}

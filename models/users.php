<?php

/**
 * A Head Full of Wishes database access class
 *
 * This class creates, reads, updates and deletes content from the 
 * A Head Full of Wishes database
 *
 * @package	AHFoW
 * @author	Andy Aldridge <andy@grange85.co.uk>
 * @link	http://www.fullofwishes.co.uk
 */
class Users extends MY_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    function _prep_password($password) {
        return sha1($password . $this->config->item('encryption_key'));
    }

    function login($username, $password) {
        $this->db->where('user_name', $username);
        $this->db->where('password', $this->_prep_password($password));

        $query = $this->db->get('users', 1);

        if ($query->num_rows() == 1) {
            $user = $query->row();
            // set your cookies and sessions etc here
            $this->session->set_userdata(array(
                'username' => $user->user_name,
                'level' => $user->user_level,
                'email' => $user->user_email,
                'logged_in' => TRUE
            ));
            return TRUE;
        }

        return FALSE;
    }

    function register($username, $email, $password, $level = 1) {
        $data = array(
            'user_name' => $username,
            'password' => $this->_prep_password($password),
            'user_email' => $email,
            'user_level' => $level
        );

        $this->db->insert('users', $data);
    }

    function check_username($username) {
        $this->db->where('user_name', $username);
        $query = $this->db->get('users');
        if ($query->num_rows() !== 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

}
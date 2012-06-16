<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Galaxiedb extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    function get_artists() {

        $query = $this->db->get('artists');
        return $query->result();
    }

}

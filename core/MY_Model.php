<?php

/**
 * Description of MY_Model
 *
 * @author andrew
 */
class MY_Model extends CI_Model {

    function __construct() {
        parent::__construct();

        if (defined('ENVIRONMENT')) {
            if (ENVIRONMENT === 'production' || ENVIRONMENT === 'testing') {
                $this->firephp->setEnabled(false);
            }
        }
    }

}

<?php

/**
 * Description of MY_Controller
 *
 * @author andrew
 */
class MY_Controller extends CI_Controller {

    function __construct() {
        parent::__construct();

        if (defined('ENVIRONMENT')) {
            if (ENVIRONMENT !== 'development') {
                $this->firephp->setEnabled(false);
            }
        }
    }

}

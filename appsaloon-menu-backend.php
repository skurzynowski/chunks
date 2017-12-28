<?php

namespace ot_flights\services;

use ot_flights\dicontainer\Ot_Flight_Container;
/**
 * Class Menu_Controller
 * @package ot_hotel\controller
 * simple controller to make menu page
 * with option to save api key
 */
class Flights_Menu_Backend
{
    public function __construct()
    {
        add_action( 'admin_menu', array( $this, 'ot_flights_add_menu' ));
        add_action('init', array( $this, 'add_update_button' ) );
    }

    /**
     * add menu page
     */
    public function ot_flights_add_menu()
    {
        add_menu_page('ot_flights_menu', 'OT FLIGHTS', 'manage_options', 'ot_flights_menu', array( $this, 'ot_flights_menu_page_output' ));
    }

    /**
     * generate output for menu page from template
     */
    public function ot_flights_menu_page_output()
    {
        require_once OT_FLIGHTS_DIR . 'templates/menu-page.php';
    }

    /**
     * add api key  to database, later i take this apikey and set into google api script while registering scripts
     */
    public function add_update_button()
    {
	    /**
	     * create instance of controller
	     */
	    Ot_Flight_Container::make( 'ot_flights\controllers\Controller_Admin_Menu' );
    }
}

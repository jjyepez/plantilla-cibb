<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class S extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }
   
	public function index(){
		$this->portada_modulo(); 
	}

	public function portada_modulo() {
		redirect(site_url().'/controller_base_c/metodo_demo', 'location');
	}	
}
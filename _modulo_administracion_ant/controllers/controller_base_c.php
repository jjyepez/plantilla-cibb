<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Controller_base_c extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

	public function index() {       
        // llamado a la vista ... jjy
        $this->load->view('crud/listar_registros_v');
	}
}
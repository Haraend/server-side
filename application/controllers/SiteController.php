<?php

defined('BASEPATH') or exit('No direct script access allowed');

class SiteController extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
    }

    public function home()
    {
        $this->load->view('homepage');
    }

    public function register()
    {
        $this->load->view('homepage');
    }
}

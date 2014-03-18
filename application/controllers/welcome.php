<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Welcome extends CI_Controller {
    public function __construct() {
        parent::__construct();
        
    }

    public function index() {
        
        $data = $this->blog->get();
        $this->parser->parse('welcome_message.php', $data);
    }


    public function blogentry($id) {
        $data = $this->blog->entry($id);
        $this->parser->parse('welcome_entry.php', $data);   
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
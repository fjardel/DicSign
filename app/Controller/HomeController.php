<?php
App::uses('AppController', 'Controller');

class HomeController extends AppController {
    public $components = array('RequestHandler');
    
    public function index() {
        //$this->layout = "defaultEs";
        
        
        if(isset($this->Auth->authError)): 
            $this->set('nome',$this->Auth->user('nome'));
        endif;
        
    }
    public function rastrear() {
        $this->layout = "ajax";
        $this->autoRender = false;
        echo json_encode(filter_input_array(INPUT_POST));
    }
}

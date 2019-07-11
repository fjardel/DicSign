<?php
class Libra extends AppModel{
    public $name = "Libra";
    public $belongsTo = array("Texto" => array(
            'className' => 'Texto',
            'foreignKey' => 'texto_id'
        ),"Administrator"=> array(
            'className' => 'Administrator',
            'foreignKey' => 'administrator_id'
        ));
    
}


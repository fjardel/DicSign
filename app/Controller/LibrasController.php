<?php
App::uses('AppController', 'Controller');
App::uses('BLOB', 'Lib');
App::uses('Model', 'Model');

class LibrasController extends AppController {
    public $name = "Libras";
    
    public function beforeFilter() {
        parent::beforeFilter();
        
    }
	
	
    
    
    public function add() {
        //$this->layout = "admdefault";
        if ($this->request->is('post')) {
            
            
            if(false){
                $dados['resultado'] = "Adicionado ao dicionário com sucesso!!";
                $this->set('dados',$dados);
            }else{
                $dados['resultado'] = "Não foi possível Adicionar ao dicionário";
                $this->set('dados',$dados);
                
            }
            
        }else{
            $dados['resultado'] = "Error: requisição sem dados postados. Essa url não pode ser acessada diretamente!";
            $this->set('dados',$dados);
        }
    }
    
    public function delete($id = null) {
        // Prior to 2.5 use
        // $this->request->onlyAllow('post');

        $this->request->allowMethod('post');

        $this->Libra->id = $id;
        if (!$this->Libra->exists()) {
            throw new NotFoundException(__('Invalid Texto'));
        }
        if ($this->Libra->delete()) {
            $this->Session->setFlash(__('Texto deleted'));
            return $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Texto was not deleted'));
        return $this->redirect(array('action' => 'index'));
    }
    
    public function deletesign($idsign = null) {
        $this->layout = "ajax"; 
        $this->autoRender = false;
        //print_r($this->Texto->Libra);exit;
        $this->Libra->id = $idsign;
        $textos_id = $this->Libra->textos_id;
        
        if($this->Texto->Libra->animacao == null){
            $this->Texto->Libra->delete($idsign);
            return "como não tinha animacao entao eu deletei a libra toda";
        }
        if($this->Libra->saveField('signwrite', null)){
            return "foi";
        }
        return "naõ foi";
        
    }
    
    public function deleteanime($idanime = null) {
        $this->layout = "ajax"; 
        $this->autoRender = false;
        //print_r($this->Texto->Libra);exit;
        $this->Texto->Libra->id = $idanime;
        $textos_id = $this->Texto->Libra->textos_id;
        
        if($this->Texto->Libra->signwrite == null){
            $this->Texto->Libra->delete($idsign);
            return "como não tinha signwrite entao eu deletei a libra toda";
        }
        if($this->Texto->Libra->saveField('animacao', null)){
            return "animacao deletada";
        }
        return "animacao naõ foi deletada";
    }
    
    public function edicao() {
        $this->layout = "admdefault"; 
        
        if ($this->request->is('post')) {            
            $query =  $this->request->data['expressao'];
            $todos = $this->Texto->query("SELECT * from textos, libras where expressao = '$query' "
                    . "and libras.texto_id = textos.id");
            if($todos != array()){
                $this->set('data', $todos);      
            }
        }
                                
    }
    public function editlibra() {
        $this->layout = "ajax"; 
        $this->autoRender = false;
        if ($this->request->is('post') || $this->request->is('put')) {
            
            
            $filesignwrite =  isset($this->request->data['Libra']['signwrite'])? 
                    $this->request->data['Libra']['signwrite']: null;
            $fileanimacao = isset($this->request->data['Libra']['animacao'])? 
                    $this->request->data['Libra']['animacao']: null;


            $this->Libra->texto_id = $this->request->data['Libra']['texto_id'];
            $this->request->data['Libra']['administrator_id'] = $this->Auth->user("id");
            
            $this->request->data['Libra']['signwrite'] = BLOB::transform($filesignwrite);
            $this->request->data['Libra']['animacao'] = BLOB::transform($fileanimacao);
            
            
            //$this->Libra->set("animacao",$this->request->data['Libra']['animacao']);
            //$this->Libra->set("administrators_id",$this->request->data['Libra']['administrators_id']);
            //$admsaved = $this->Texto->Administrator->save($this->request->data['Administrator']);
            $librasaved = $this->Libra->save($this->request->data);


            
            
            if ($librasaved) {
                $this->Session->setFlash(__('The Text has been saved'));
                return $this->redirect(array('controller' => 'Textos','action' => 'index'));
            }
            $this->Session->setFlash(
                __('The Text could not be saved. Please, try again.')
            );
        } else {
            $this->request->data = $this->Texto->Libra->findById($id);
            unset($this->request->data['Text']['password']);
        }


    }
    
     public function edit($id = null) {
        $this->Texto->id = $id;
        if (!$this->Texto->exists()) {
            throw new NotFoundException(__('Invalid Text'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Texto->save($this->request->data)) {
                $this->Session->setFlash(__('The Text has been saved'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(
                __('The Text could not be saved. Please, try again.')
            );
        } else {
            $this->request->data = $this->Texto->findById($id);
            unset($this->request->data['Text']['password']);
        }
    }
    
}

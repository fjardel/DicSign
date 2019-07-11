<?php
App::uses('AppController', 'Controller');
App::uses('BLOB', 'Lib');

class TextosController extends AppController {
    public $name = "Textos";
    
    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('index', 'query','queryJSON','ouvir');
        $this->Auth->deny('add');
    }
	
    public function index() {
        $this->layout = "admdefault"; 
        
        if(isset($this->Auth->authError)): 
            $this->set('nome',$this->Auth->user('nome'));
        endif;
    }

	
    public function query() {
        $this->layout = "ajax";
        
        $numArgs = func_num_args();        
        
        if ($numArgs > 0) {
            $query = func_get_arg(0);  
            $todos = $this->Texto->query("SELECT * from textos, libras where expressao = '$query' "
                    . " and libras.texto_id = textos.id");

            $this->set('dados', $todos);
            
        }else if ($this->request->is('post')) {            
            $query =  $this->request->data['expressao'];
            $todos = $this->Texto->query("SELECT * from textos, libras where expressao = '$query' "
                    . "and libras.texto_id = textos.id");
            
            $this->set('dados', $todos);                              
        }
    }
    
    public function queryJSON() {
        //$this->scaffold = true;
		$this->layout = "ajax";
        $this->autoRender = false;
        
        $numArgs = func_num_args();        
        
        if ($numArgs > 0) {
            $query = func_get_arg(0);  
            $todos = $this->Texto->query("SELECT * from textos, libras where expressao = '$query' "
                    . " and libras.texto_id = textos.id");
            
            /*for ($index = 0; $index < count($todos); $index++) {
                $todos[$index]['Libras']['signwrite'] = base64_encode($todos[$index]['libras']['signwrite']);
                $todos[$index]['Libras']['animacao'] = base64_encode($todos[$index]['libras']['animacao']);
            }*/
            
                
            if($todos != array()){
                header('Content-Type: application/json');
                
                print json_encode(array("result" => $todos));
                exit();
            }
			//header('Content-Type: application/json');
            return null;
			
        }else if ($this->request->is('post')) {            
            $query =  $this->request->data['expressao'];
            $todos = $this->Texto->query("SELECT * from textos, libras where expressao = '$query' "
                    . "and libras.texto_id = textos.id");
            
            /*for ($index = 0; $index < count($todos); $index++) {
                $todos[$index]['Libras']['signwrite'] = base64_encode($todos[$index]['libras']['signwrite']);
                $todos[$index]['Libras']['animacao'] = base64_encode($todos[$index]['libras']['animacao']);
            }*/
                
            if($todos != array()){
                header('Content-Type: application/json');
                
                print json_encode(array("result" => $todos));
                exit();
            }
			//header('Content-Type: application/json');
            return null;
        }
    }
    
    public function ouvir() {
        $this->autoRender = false;
        
        //$numArgs = func_num_args();  
        
        //if ($numArgs > 0) {
            //$frase = func_get_arg(0); 
            $frase = filter_input(INPUT_GET, 'q');
            
            $string = urlencode($frase);
            
            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, "http://translate.google.com/translate_tts?tl=pt&q=$string");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPGET,true);

            $output = curl_exec($ch);
            
            curl_close($ch);
            
            echo $output;
            exit();
        //}
    }
    
    
    public function add() {
        $this->layout = "admdefault";
        if ($this->request->is('post')) {
            if (!empty($this->request->data['Texto'])) {
                $textosaved = $this->Texto->save($this->request->data['Texto']);

                if ($textosaved) {
                    $filesignwrite =  $this->request->data['Libra']['signwrite'];
                    $fileanimacao = isset($this->request->data['Libra']['animacao'])? 
                            $this->request->data['Libra']['animacao']: null;
                    
                    
                    $this->request->data['Libra']['texto_id'] = $this->Texto->id;
                    $this->request->data['Libra']['administrator_id'] = $this->Auth->user("id");
                    $this->request->data['Libra']['signwrite'] = BLOB::transform($filesignwrite);
                    $this->request->data['Libra']['animacao'] = BLOB::transform($fileanimacao);
                    
                    $librasaved = $this->Texto->Libra->save($this->request->data['Libra']);
                    //$admsaved = $this->Texto->Administrator->save($this->request->data['Administrator']);
                    
                    
                }
            }
            if($librasaved){
                $dados['resultado'] = "Adicionado ao dicionário com sucesso!!";
                $dados['expressao'] = $this->request->data['Texto']['expressao'];
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
        // $this->request->onlyAllow('post');
        $this->layout = "admdefault";
        //$this->request->allowMethod('post');
       // $this->autoRender = false;

        $this->Texto->id = $id;
        if (!$this->Texto->exists()) {
            //throw new NotFoundException(__('Invalid Texto'));
            $dados['resultado'] = "O Texto e suas respectivas imagens foram deletados!";
            $this->set('dados',$dados);
            return;
        }
        if ($this->Texto->delete()) {
            //$this->Session->setFlash(__('Texto deleted'));
            //return ;//$this->redirect(array('action' => 'index'));
            $dados['resultado'] = "O Texto e suas respectivas imagens foram deletados!";
            $this->set('dados',$dados);
            return;
        }
        $dados['resultado'] = "O texto não foi deletado!";
        $this->set('dados',$dados);
        //$this->Session->setFlash(__('Texto was not deleted'));
        //return ;//$this->redirect(array('action' => 'index'));
    }
    
    public function deletesign($idsign = null) {
        $this->layout = "ajax"; 
        $this->autoRender = false;
        //print_r($this->Texto->Libra);exit;
        $this->Texto->Libra->id = $idsign;
        $textos_id = $this->Texto->Libra->textos_id;
        
        if($this->Texto->Libra->animacao == null){
            //$this->Texto->Libra->delete($idsign);
            //return "como não tinha animacao entao eu deletei a libra toda";
        }
        if($this->Texto->Libra->saveField('signwrite', null)){
            return "signwrite foi deletado";
        }
        return "signwrite não foi deletado";
        
    }
    
    public function deleteanime($idanime = null) {
        $this->layout = "ajax"; 
        $this->autoRender = false;
        //print_r($this->Texto->Libra);exit;
        $this->Texto->Libra->id = $idanime;
        
        if (!$this->Texto->Libra->exists()) {
            return "animacao inexistente";
        }
        
        $textos_id = $this->Texto->Libra->textos_id;
        
        if($this->Texto->Libra->signwrite == null){
           // $this->Texto->Libra->delete($idsign);
            //return "como não tinha signwrite entao eu deletei a libra toda";
        }
        if($this->Texto->Libra->saveField('animacao', null)){
            
            return "animacao deletada";
        }
        return "animacao naõ foi deletada";
    }
    
    public function edicao() {
        $this->layout = "admdefault"; 
        //$this->autoRender = false;
        
        $query =  $this->request->query('expressao');
        if ($this->request->is('get') and isset($query)) {            
            //$query =  $this->request->data['expressao'];
            $todos = $this->Texto->query("SELECT * FROM textos LEFT OUTER JOIN libras "
                    . "ON libras.texto_id = textos.id WHERE expressao = '$query'");
            //print_r($todos);
            if($todos != array()){
                $this->set('data', $todos);      
            }
        }
                                
    }
     public function search() {
        $this->layout = "ajax"; 
        //$this->view = "edicao";
        //$this->autoRender = false;
        
        $query =  $this->request->query('expressao');
        if ($this->request->is('ajax') and isset($query)) {            
            //$query =  $this->request->data['expressao'];
            $todos = $this->Texto->query("SELECT * FROM textos LEFT OUTER JOIN libras "
                    . "ON libras.texto_id = textos.id WHERE expressao = '$query'");
            //print_r($todos);
            if($todos != array()){
                $this->set('dados', $todos);      
            }
        }
                                
    }
    public function editlibra() {
        $this->layout = "ajax"; 
        $this->autoRender = false;
        if ($this->request->is('post') or $this->request->is('put')) {
            
            
            $filesignwrite =  isset($this->request->data['Libra']['signwrite'])? 
                    $this->request->data['Libra']['signwrite']: null;
            $fileanimacao = isset($this->request->data['Libra']['animacao'])? 
                    $this->request->data['Libra']['animacao']: null;


            $this->Texto->Libra->id = $this->request->data['Libra']['id'];
            $this->request->data['Libra']['administrators_id'] = $this->Auth->user("id");
            //echo 'oa';print_r($this->request->data);
            
            $this->request->data['Libra']['signwrite'] = BLOB::transform($filesignwrite);
            $this->request->data['Libra']['animacao'] = BLOB::transform($fileanimacao);
            
            //echo 'ooo';print_r($this->request->data['Libra']['animacao']);
            //exit();
            if(isset($filesignwrite)):
                $librasaved = $this->Texto->Libra->saveField("signwrite",$this->request->data['Libra']['signwrite']);
            endif;
            if(isset($fileanimacao)):
                $librasaved = $this->Texto->Libra->saveField("animacao",$this->request->data['Libra']['animacao']);
            endif;
            
            
            if ($librasaved) {
                $this->Session->setFlash(__('<b >A animação foi salva com sucesso!</b>'));
                return ;//$this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(
                __('Não foi possível salvar. Por favor, tente novamente.')
            );
        } else {
            $this->request->data = $this->Texto->Libra->findById($this->Texto->Libra->id);
            //unset($this->request->data['Text']['']);
        }


    }
    
     public function edit() {
        $id = $this->request->data['Texto']['id'];
        $this->Texto->id = $id;
        
        if (!$this->Texto->exists()) {
            throw new NotFoundException(__('Invalid Text'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Texto->save($this->request->data)) {
                $this->Session->setFlash(__('The Text has been saved'));
                return ;//$this->redirect(array('action' => 'edicao'));
            }
            $this->Session->setFlash(
                __('The Text could not be saved. Please, try again.')
            );
        } else {
            $this->request->data = $this->Texto->findById($id);
           
        }
    }
    
}

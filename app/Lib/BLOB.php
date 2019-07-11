<?php
class BLOB {
    
    public static function lerImagemPNG($param) {
        //header("content-type:image/png");
        echo "data:image/png;base64," . base64_encode($param);
    }
    public static function lerImagemGIF($param) {
        //header("content-type:image/png");
        echo "data:image/gif;base64," . base64_encode($param);
    }
    public static function transform($arquivo) {
        //$arquivo = $arquivo[0];
        if(!isset($arquivo)){
            return null;
        }
        $tamanho = $arquivo['size'];
        $file_tmp_name = $arquivo["tmp_name"];
        if(empty($file_tmp_name)){
            return null;
            
        }
        $fp = fopen($file_tmp_name, "rb");
        $conteudo = fread($fp, $tamanho);
        //$conteudoC = addslashes($conteudo); EM BASE 64 NÃO SE USA A FUNÇÃO ADDSLASHES
        fclose($fp);         
        
        return $conteudo;
    }
    /**
     * (PHP 5 &gt;= 5.3.0)<br/>
     * Verifica se o arquivo enviado pode ou não ser aceito para upload. Informa
     * erros ocorridos, etc
     * @link 
     * @param FILE $arquivo [obrigatorio] 
     * <p>
     * O arquivo de upload vindo do formulario
     * </p>
     * @param array $tipos_aceitos [obrigatorio] 
     * <p>
     * Um array contendo todos os tipos aceitos
     * </p>
     * @param FILE $tamanho_maximo [obrigatorio] 
     * <p>
     * O tamanho máximo aceito para upload de arquivo
     * </p>     
     * @return String Retorna uma mensagem informando qual erro ocorreu.
     */
    public static function check($arquivo,$tipos_aceitos,$tamanho_maximo) {
        $mensagem = null;
        if($arquivo['error'] != 0){
            $mensagem = 'erro no upload do arquivo';
            switch ($arquivo['error']){
                case UPLOAD_ERR_INI_SIZE:
                    $mensagem = "O Arquivo enviado excedeu o tamanho máximo de" . $tamanho_maximo * pow(10,3). " bytes";
                    break;
                case UPLOAD_ERR_FORM_SIZE:
                   $mensagem =  "O arquivo é muito grande";
                    break;
                case UPLOAD_ERR_PARTIAL:
                    $mensagem =  "O upload não foi completo";
                    break;
                case UPLOAD_ERR_NO_FILE:
                    $mensagem =  "Nenhum arquivo informado!";
                    break;
            }
            return $mensagem;
        }
        // se o comprimento do arquivo for 0 ou não houver arquivos na memoria temporaria
        if($arquivo['size'] == 0 OR $arquivo['tmp_name'] == NULL){
            $mensagem =  "nenhum arquivo enviado";                        
            //return $mensagem;		  
        }
        // se o comprimento do arquivo for maior que  tamanhao maximo permitido
        if($arquivo['size'] > $tamanho_maximo){
            $mensagem =  "O arquivo é muito grande (Tam max:" . $tamanho_maximo . ")";                        
            //return $mensagem;
        }
        // se o tipo do arquivo não for aceito
        if(array_search($arquivo['type'], $tipos_aceitos) === FALSE){
            $mensagem =  "o arquivo do tipo (" . $arquivo['type'] . ") não é aceito para upload.";            
            //echo $mensagem;
            //return;            
        }
        return $mensagem;
    }

 
}

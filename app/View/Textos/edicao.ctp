<section class="container adm">            
    <div class="row">
        <form action="/Textos/edicao" method="get" id="pesquisa2" name="pesquisa" class="row">                
            <div class="ten columns">
                <input type='text' id='search' name="expressao" ng-model="q" class="u-full-width adm" placeholder="Digite aqui a palavra ou expressão a ser editada" id="frase"  autofocus="true" />
				
            </div>
            <div class="two columns">
                <input class="button-primary adm" type="submit" value="Pesquisar">                
            </div>
        </form>
    </div>

    <div class="row">  
        <div class="twelve columns">
            <div id="resultado"  > 
                <?php echo $this->Session->flash(); ?>
                <?php 
                if (isset($data)):
                    //print_r($data);
                    echo $this->element('pesquisa', array("dados" => $data)); 
                endif;
                if (!isset($data)):
                    //print_r($data);
                    echo "Sem resultados";
                endif;
                ?>
            </div>
        </div>    
    </div>      
</section>    
      

  
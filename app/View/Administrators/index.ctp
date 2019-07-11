<section class="container" >            
    <div class="row">
    <form action="/Textos/add" method="POST" name="adm" enctype="multipart/form-data">
        <div class="six columns" class="texto">
            
            
            <?php 
            
            echo $this->html->link('CLIQUE AQUI PARA SAIR' , array('controller' => 'Administrators' , 'action' => 'logout')); 
            /*
                echo $this->Form->create('texto', array('type' => 'file'));
                    echo $this->Form->input('Palavra/Expressão', array('name' => 'expressao'));
                    echo $this->Form->input('Classe gramatical');
                    
                    echo $this->Form->input('Classe gramatical');
                    echo $this->Form->input('Conceito');
                    echo $this->Form->input('Imagem SignWriting', array('type' => 'file'));
                    echo $this->Form->input('Animação', array('type' => 'file'));
                echo $this->Form->end('Enviar', array('class' => 'button-primary'));*/
            ?>
            
                <h4></h4>
                <label for="expressao">Palavra/Expressão </label>
                    <input type="text" name="data[Texto][expressao]" id="expressao" />
                
                <label for="classe">Classificação</label>
                <select name="data[Texto][classe]" size="1"  id="classe" >
                    <option value=""> -- Selecione -- </option>                    
                    <option value="Substantivo comum">Substantivo comum</option>
                    <option value="Substantivo próprio">Substantivo próprio</option>
                    <option value="Verbo">Verbo</option>
                    <option value="Advérbio">Advérbio</option>
                    <option value="Adjetivo">Adjetivo</option>
                    <option value="Expressão">Expressão</option>                    
                </select>
                
                <label for="conceito">Conceito </label>
                    <input type="text" name="data[Texto][conceito]" id="conceito" />
                <br>
                
            
        </div>                
        <div class="six columns" id="instrucao">
            
            <div>
                <output id="listsign"></output>
                <output id="listanime"></output>
                <label for="imgsimbol"> Imagem SignWriting </label>
                    <span id="info">(São aceitas apenas imagens do tipo png 200 x 200)</span>
                    <input type="file" name="data[Libra][signwrite]" id="imgsimbol" accept="image/png" />
                <br>
            </div>

            <div>
                
                <label for="imganime"> Animação </label>
                    <span> (São aceitas apenas imagens do tipo gif 300 x 400)</span>
                    <input type="file" name="data[Libra][animacao]" id="imganime" accept="image/gif" />
                <br>
            </div>
            
            <script>
            function handleFileSelect1(evt) {
               // alert(evt.target.files);
              var files = evt.target.files; // FileList object

              // Loop through the FileList and render image files as thumbnails.
              for (var i = 0, f; f = files[i]; i++) {

                // Only process image files.
                if (!f.type.match('image.png')) {
                  continue;
                }

                var reader = new FileReader();

                // Closure to capture the file information.
                reader.onload = (function(theFile) {
                  return function(e) {
                    // Render thumbnail.
                    var span = document.createElement('span');
                    span.innerHTML = ['<img class="thumb" src="', e.target.result,
                                      '" title="', escape(theFile.name), '" width=164 height=164/>'].join('');
                    document.getElementById('listsign').innerHTML = span.innerHTML;
                  };
                })(f);

                // Read in the image file as a data URL.
                reader.readAsDataURL(f);
              }
            }
            
            function handleFileSelect2(evt) {
               // alert(evt.target.files);
              var files = evt.target.files; // FileList object

              // Loop through the FileList and render image files as thumbnails.
              for (var i = 0, f; f = files[i]; i++) {

                // Only process image files.
                if (!f.type.match('image.*')) {
                  continue;
                }

                var reader = new FileReader();

                // Closure to capture the file information.
                reader.onload = (function(theFile) {
                  return function(e) {
                    // Render thumbnail.
                    var span = document.createElement('span');
                    span.innerHTML = ['<img class="thumb" src="', e.target.result,
                                      '" title="', escape(theFile.name), '" width=164 height=164/>'].join('');
                    document.getElementById('listanime').innerHTML = span.innerHTML;
                  };
                })(f);

                // Read in the image file as a data URL.
                reader.readAsDataURL(f);
              }
            }

            document.getElementById('imgsimbol').addEventListener('change', handleFileSelect1, false);
            document.getElementById('imganime').addEventListener('change', handleFileSelect2, false);
          </script>
          
          <input class="button-primary" type="submit" value="Enviar">
          
            <!--
            <h4>Instruções para Submissão</h4>
            <p style="text-align: justify;">
                Para inserir novas palavras ao dicionário de SignWriting é necessário
                que os desenvolvedores das animações e dos símbolos sigam algumas instruções para manter o
                sistema organizado, como as citadas abaixo:<br>
                <h6>Para as animações</h6>
                <ul >
                    <li>As animações adicionadas não podem ser provenientes de outras fontes (internet). 
                        Elas devem ser produzidas por desenvolvedores da instituição (UFPA);</li>
                    <li>O avatar deve ser sempre o mesmo para todas as animações;</li>
                    <li>As animações devem está no formato gif (animado) e precisam ter exatamente 300px de largura por
                    400px de altura;</li>
                    <li>A  qualidade da imagem é fundamental;</li>
                    
                </ul>
                
                <h6>Para os símbolos</h6>
                <ul>
                    <li>As imagem dos signwrite devem está no formato png e precisam ter exatamente 
                        200px de largura por 200px de altura;</li>
                    <li>O símbolo precisa está centralizado;</li>
                    <li>A  qualidade da imagem é fundamental;</li>
                    <li>Devem ter o fundo transparente;</li>
                    <li>Cores monocromáticas;</li>
                </ul>
                <h6>Para as palavras</h6>
                <ul>
                    <li></li>
                    <li></li>
                    <li></li>
                </ul>
                <h6>Para a classe gramatical</h6>
                <ul>
                    <li></li>
                    <li></li>
                    <li></li>
                </ul>
                <h6>Para os conceitos</h6>
                <ul>
                    <li></li>
                    <li></li>
                    <li></li>
                </ul
               
                
                
            </p>
            -->
        </div>
        </form>
    </div>
</section>    
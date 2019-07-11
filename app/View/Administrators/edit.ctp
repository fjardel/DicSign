<section class="container adm">            
    <div class="row">
        
            <form action="" method="POST" id="pesquisa" name="pesquisa" class="row">                
                <div class="ten columns">
                    <textarea name="data[expressao]" ng-keyup="pegar($event)" ng-model="q" class="u-full-width adm" placeholder="Digite aqui a palavra ou expressão a ser pesquisada" id="frase" autofocus="true"></textarea>
                </div>
                <div class="two columns">
                    <input class="button-primary adm" type="submit" value="Pesquisar">                
                </div>
                
            </form>
        
        
    </div>

    <div class="row">
                       
        <div class="twelve columns">
            
            <div id="traducao"  > 
                
                <div class="row">
                    <a class="button excluirtudoimg" href="/Textos/delete/id">Excluir texto com todas as Imagens</a><br>
                    <div class="six columns" class="texto">
                    <form action="/Textos/edit" method="POST" name="adm" enctype="multipart/form-data">
                        

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
                            <input class="button-primary" type="submit" value="Salvar Alterações">
                        </form>
                        <hr>
                        <h4>+ imagens</h4>
                        <hr>
                        <form action="/Textos/edit" method="POST" name="adm" enctype="multipart/form-data">
                            <div>
                                <output id="listsign"></output>
                                <output id="listanime"></output>
                                <label for="imgsimbol"> Imagem SignWriting </label>
                                    <span id="info">(São aceitas apenas imagens do tipo png 200 x 200)</span>
                                    <input type="file" name="data[Libra][signwrite][]" id="imgsimbol" accept="image/png" />
                                <br>
                            </div>

                            <div>

                                <label for="imganime"> Animação </label>
                                    <span> (São aceitas apenas imagens do tipo gif 300 x 400)</span>
                                    <input type="file" name="data[Libra][animacao][]" id="imganime" accept="image/gif" />
                                <br>
                            </div>
                            <input class="button-primary" type="submit" value="Adicionar">
                        </form>    


                        </div>
                        
                    <div class="four columns" class="texto" >
                        <table class="u-full-width" border='0' >                                
                            <thead>
                                <tr>
                                    <th>SignWriting  &nbsp;&nbsp;&nbsp; >> </th>
                                  <th>Animação</th>                                      
                                </tr>
                            </thead>
                            <tbody>
                              <tr>
                                  <td> <a href="/Textos/delete/id" class="excluirimg" title="Excluir"><img src="/img/bem-vindo.png" width="165" height="165"></a></td>
                                <td><a href="/Textos/delete/id" class="excluirimg" title="Excluir"><img src="/img/bem vindo.gif" width="165" height="165"></a></td>
                              </tr>
                              <tr>
                                <td> <a href="/Textos/delete/id" class="excluirimg" title="Excluir"><img src="/img/bem-vindo.png" width="165" height="165"></a></td>
                                <td><a href="/Textos/delete/id" class="excluirimg" title="Excluir"><img src="/img/bem vindo.gif" width="165" height="165"></a></td>
                              </tr>
                              <tr>
                                  <td> <a href="/Textos/delete/id" class="excluirimg" title="Excluir"><img src="/img/bem-vindo.png" width="165" height="165"></a></td>
                                <td><a href="/Textos/delete/id" class="excluirimg" title="Excluir"><img src="/img/bem vindo.gif" width="165" height="165"></a></td>
                              </tr>
                              <tr>
                                <td> <a href="/Textos/delete/id" class="excluirimg" title="Excluir"><img src="/img/bem-vindo.png" width="165" height="165"></a></td>
                                <td><a href="/Textos/delete/id" class="excluirimg" title="Excluir"><img src="/img/bem vindo.gif" width="165" height="165"></a></td>
                              </tr>
                              <tr>
                                <td> <a href="/Textos/delete/id" class="excluirimg" title="Excluir"><img src="/img/bem-vindo.png" width="165" height="165"></a></td>
                                <td><a href="/Textos/delete/id" class="excluirimg" title="Excluir"><img src="/img/bem vindo.gif" width="165" height="165"></a></td>
                              </tr>

                            </tbody>
                          </table>

                    </div>
                    
                    </div>
            </div>

        </div>                
            
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
</section>    
      

  
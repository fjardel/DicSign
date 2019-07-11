<section>
<div class="row">
    <a class="button excluirtudoimg" href="/Textos/delete/<?php echo $dados[0]["textos"]["id"]; ?>">Excluir palavra</a><br>
    <div class="six columns" class="texto">
    <form action="/Textos/edit" method="POST" name="adm" id="formtextoedit" enctype="multipart/form-data">

        <?php //print_r($dados); ?>
        <label for="expressao">Palavra/Expressão </label>
        <input type="text" name="data[Texto][expressao]" id="expressao" value="<?php echo $dados[0]["textos"]["expressao"]; ?>" />

        <input type="hidden" name="data[Texto][id]" id="expressao" value="<?php echo $dados[0]["textos"]["id"]; ?>" />

        <label for="classe">Classificação</label>
        <select name="data[Texto][classe]" size="1"  id="classe" >
            <option value="<?php echo $dados[0]["textos"]["classe"]; ?>">  <?php echo $dados[0]["textos"]["classe"]; ?>  </option>                    
            <option value="Substantivo comum">Substantivo comum</option>
            <option value="Substantivo próprio">Substantivo próprio</option>
            <option value="Verbo">Verbo</option>
            <option value="Advérbio">Advérbio</option>
            <option value="Adjetivo">Adjetivo</option>
            <option value="Expressão">Expressão</option>                    
        </select>

        <label for="conceito">Conceito </label>
        <input type="text" name="data[Texto][conceito]" id="conceito" value="<?php echo $dados[0]["textos"]["conceito"]; ?>" />
        <br>
        <label for="regioes">Regiões / Estados </label>
        <input type="text" name="data[Texto][regioes]" id="regioes" value="<?php echo $dados[0]["libras"]["regioes"]; ?>" />
        <br>
        
        <input class="button-primary" type="submit" value="Salvar">
    </form>
        <hr>
        <h4>+ imagens</h4>
        
        <form action="/Libras/editlibra" method="POST" name="adm" enctype="multipart/form-data">
            <div>
                <output id="listsign"></output>
                <output id="listanime"></output>
                <input type="hidden" name="data[Libra][texto_id]" value="<?php echo $dados[0]["textos"]["id"]; ?>"/>
                <label for="imgsimbol"> Imagem SignWriting </label>
                    <span id="info">(São aceitas apenas imagens do tipo png 200 x 200)</span>
                    <input type="file" name="data[Libra][signwrite]" id="imgsimboladd" accept="image/png" />
                <br>
            </div>
            <div>
                <label for="imganime"> Animação </label>
                    <span> (São aceitas apenas imagens do tipo gif 300 x 400)</span>
                    <input type="file" name="data[Libra][animacao]" id="imganimeadd" accept="image/gif" />
                <br>
            </div>
            <input class="button-primary" type="submit" value="Add imagens a esta palavra" id="addimg" disabled="">
        </form>
        <hr>
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
            <?php 
                foreach ($dados as $dat): 
                    if(!isset($dat)):
                        continue;
                    endif; ?>  
              <tr>
                <td>
                <?php if(isset($dat["libras"]["signwrite"])){ ?>
                     <a href="/Textos/deletesign/<?php echo $dat["libras"]["id"]; ?>" class="excluirimg" title="Excluir"></a>
                         <img src="<?php BLOB::lerImagemPNG($dat["libras"]["signwrite"]); ?>" width="125" height="125">
                <?php }else { ?>
                    
                        <button class="addsign button-primary" type="button" value="<?php echo $dat["libras"]["id"]; ?>">Add signwriting</button>
                        <br>
                    
                <?php } ?>    
                </td>
                <td>
                <?php if(isset($dat["libras"]["animacao"])){ ?>
                    <a href="/Textos/deleteanime/<?php echo $dat["libras"]["id"]; ?>" class="excluirimg" title="Excluir"></a>
                    <img src="<?php BLOB::lerImagemGIF($dat["libras"]["animacao"]); ?>" width="125" height="125">
                <?php }else { ?>
                    
                        <button class="addanime button-primary" type="button" value="<?php echo $dat["libras"]["id"]; ?>">Add animação</button>
                        <br>
                    
                <?php } ?>    
                </td>                
              </tr>
              <?php endforeach; ?>  
            </tbody>
          </table>
    </div>
</div>  
</section>    
      

  
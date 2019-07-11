<?php 
if (isset($dados)):
    $cont = 1;
    $quant = count($dados);
    $sit = "ativo";
     
    foreach ($dados as $dat): ?>
        <a href="#" class="trs <?php echo $sit;?>">
            <div class='signwrite'>
                <img class="signs" src="<?php  BLOB::lerImagemPNG($dat['libras']['signwrite']);?>" alt="<?php echo "$cont/ $quant"; ?>" width="169" height="169" >
            </div>
            <?php if(isset($dat['libras']['animacao'])){  ?>
            <div class='animacao'>
                <img class="signs" src="<?php  BLOB::lerImagemGIF($dat['libras']['animacao']);?>" alt="<?php echo "$cont/ $quant"; ?>" width="169" height="169" >
            </div>
            <?php } ?>
        </a>
    <?php $cont++;$sit = ""; 
    endforeach;    
endif;




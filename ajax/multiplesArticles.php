   <?php 
    header('Content-type:text');
   // include_once '../heade.php';
    include_once '../core/config.php';
    mb_internal_encoding('UTF-8');
    //recuperation des elemnts 
     $nombreArticles=$pos['nbre'];
    // echo $nombreArticles;
     
   ?>
    <table class='table table-bordered'>
        <input type="hidden"  id='nombreArticles' value="<?php echo $nombreArticles; ?>">
                   <thead>
<tr class=''>
      <th class="10p">N°</th>
      <th class="10p">code article</th>
      <th class="60p">code Famille</th>
      <th class="10p">Qté cmdé</th>
      <th class="10p">unite</th>
      <th class="10p">Stocks Theo</th>
      <th class="60p">designation</th>
      <th class="10p">Observation</th>
      <th class="10p">Justificatifs</th>
</tr>
                   </thead>
                   <div id='corpsTableauArticles'>
<tbody>
          <?php
              for($s=0;$s<$nombreArticles;$s++):
                 $k=$s+1;
               ?>
    <tr class='tab-content' >
        <td><?php echo $k; ?></td>
        <td id="codeArticle<?php echo $k; ?>">xxxxxxxx</td>
        <td id="codeFamille<?php echo $k; ?>">xxxxxxx</td>
           
        <td><input type="number" id="quantiteCommander<?php echo $k; ?>" name='quantiteCommander'></td>
        <td id="unite<?php echo $k; ?>">xxxxxxx</td>
        <td id="quantiteStocks<?php echo $k; ?>">xxxx</td>
        <td><select class="input-sm" id='article<?php echo $k; ?>' onchange="EnvoiDonnerJs(this.value,<?php echo $k; ?>)">
                <option>..............................</option>
                     <?php     
                       $listeDesFamilles=  modelArticle::ListeDesFamilles();
                     for ($i=0;$i<count($listeDesFamilles);$i++){
                          ?>
                <optgroup label="<?php echo html_entity_decode($listeDesFamilles[$i]->getDesignation()); ?>"> 
                    <?php
       $listeArticle= modelArticle::ListeDesArticlesPourUneFamille($listeDesFamilles[$i]);
           if(count($listeArticle)):
            for($p=0;$p<count($listeArticle);$p++):
           $quantite=  modelArticle::Stocksarticle($listeArticle[$p]);
          
   ?>
                    <option value="<?php echo $listeArticle[$p]->getId().'$'.$listeArticle[$p]->getCode().'$'.$listeDesFamilles[$i]->getCode().'$'.$quantite.'$'.'12223'.'$'.$listeArticle[$p]->getUnite(); ?>" > <?php echo htmlentities(htmlspecialchars_decode($listeArticle[$p]->getDesignation())); ?> </option> 
       <?php endfor;
       endif; ?>
   </optgroup> 
                          <?php
                          } 
                          ?>
                
            </select></td>
            <td><textarea type="text"  name="observationn<?php echo $k; ?>" id="observation<?php echo $k; ?>" placeholder="ici votre Observation"></textarea></td>
            <td><textarea type="text"  name="justificationn<?php echo $k; ?>" id="justification<?php echo $k; ?>" placeholder="ici votre justificatif"></textarea></td>
    </tr>
       <?php 
                      endfor;
       ?>

</tbody>
                   </div>
                </table>
              
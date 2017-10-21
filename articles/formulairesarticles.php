<?php
header('Content-type:text');
include_once '../core/config.php';
     $nombre=$pos['nbre'];
     $famille=$pos['famille'];
     $sql="SELECT designation FROM famille WHERE id=$famille";
     $res=$db->selectInTab($sql);
     $designationFamille=$res[0]['designation'];
     $table[0]='A';
     $cpt=1
?>
<mark class="center" style="margin:15px;"><a href="#">Ces Articles Ci-Dessous Appartiendront à la Famille :</a> <strong><?php echo strtoupper($designationFamille); ?></strong></mark>
 <form action="#">
      <?php   
         for($n=1;$n<=$nombre;$n++):
             $bol=true;
            do{
           $code=  generateurCode::getCodeArticle($famille);
           $bol=  in_array($code, $table);
             if(!$bol){
                 $table[$cpt]=$code;
                 $cpt++;
             }
            }while($bol);
        ?>
  <div class="form-group col-sm-4 col-md-4 col-lg-4 col-xs-12">
   <label for="designation"> <?php echo "Article($n) designation:";?></label>
    <input type="text" class="form-control" id="designationArticle<?php echo $n; ?>" placeholder="designation de l'article">
  </div>
   <div class="form-group col-sm-2 col-md-2 col-lg-2 col-xs-12">
   <label for="unite"> <?php echo "Article($n) Unité:";?></label>
   <input type="text" class="form-control" id="unite<?php echo $n; ?>" placeholder="ex:metre,kg,Tonnes,Litre...">
  </div>
     <div class="form-group col-sm-4 col-md-4 col-lg-4 col-xs-12">
     <label for="code">code:</label>
   <input type="text" class="form-control" disabled="true" id="codeA<?php echo $n; ?>" placeholder='code' value="<?php echo $code ;?>">
   <input type="hidden" class="form-control" id="codeArticle<?php echo $n; ?>" placeholder='mail du nouveau Fournisseur' value="<?php echo $code ;?>">
     </div>
      <div class="form-group col-sm-2 col-md-2 col-lg-2 col-xs-12">
   <label for="Stocks"> <?php echo "Stocks($n) Defaut:";?></label>
   <input type="text" class="form-control" id="stocks<?php echo $n; ?>" value="0">
  </div>
    <?php endfor;?>
     <div class="col-sm-12  col-lg-12 col-xs-12">
  <button type="submit" class="btn btn-default btn-success" onclick="EnregistrementDesArticle('<?php echo $nombre;?>','<?php echo $famille; ?>')" value='Enregistrer'>Submit</button>
     </div>
</form>
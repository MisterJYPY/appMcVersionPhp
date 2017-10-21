<?php
        header('Content-type:text');
        include_once '../core/config.php';
        include_once '../core/classes/sessionUser.php';
         
        sessionUser::verification("comptes_personnel","login","password","pageSecure.php");
        if(isset($pos['valeur']) and  $pos['valeur']!='.........................')
        {
              $code=generateurCode::getCodeDemandeAchat($pos['valeur']);
            ?>
<strong><input type="text" disabled="true" id="champCacher" value="N°:<?php echo $code; ?>"><strong>
        <input type="hidden" disabled="true" id="champCacher2" value="N°:<?php echo $code; ?>">
           <?php
        }
        else 
        {
         echo '<strong id="valeurBordereaux">Aucun Selectionné </strong>';
        }

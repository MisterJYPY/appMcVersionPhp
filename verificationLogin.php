<?php
 header('Content-type:text');
        include_once '../core/config.php';
           
            $login=$pos['login'];
            $loginEncien=$_SESSION['login'];
            $taille=strlen($login);
            if($taille>=4){
            if($login!=$loginEncien)
            {
            $login = !get_magic_quotes_gpc() ? addslashes($login) : $login;
            $sql="SELECT COUNT(login) as nbre FROM comptes_personnel WHERE login='$login' ";
            $res=$db->selectInTab($sql);
            $nbre=$res[0]['nbre'];
                
            if($nbre<1){
            echo "<img src='img/ok.jpg' alt='OK' class='iconDeco'>";
                }
            else{
            echo "<img src='img/no.png' alt='OK' class='iconDeco'>";
                }
            }
            else{
            echo "<img src='img/ok.jpg' alt='OK' class='iconDeco'>";
            }
              }
            else{
            echo "<mark>4 Car. Minimun </mark>";
           }
?>

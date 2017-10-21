//<script type="text/javascript">
    /**
     * Permet d'envoyer des donn�es en GET ou POST en utilisant les XmlHttpRequest
     */
    function sendData(param, page, pos)
    {
        if (document.all)
        {
            //Internet Explorer
            var XhrObj = new ActiveXObject("Microsoft.XMLHTTP");
        }//fin if
        else
        {
            //Mozilla
            var XhrObj = new XMLHttpRequest();
        }//fin else

        //d�finition de l'endroit d'affichage:
        var content = document.getElementById(pos);

        XhrObj.open("POST", page);

        //Ok pour la page cible
        XhrObj.onreadystatechange = function()
        {
            if ((XhrObj.readyState == 4) && (XhrObj.status == 200))
                content.innerHTML = XhrObj.responseText;
        }
        XhrObj.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        XhrObj.send(param);
    }//fin fonction SendData
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    function checkboxChecker(nom, bool, i) {
        for (j = 1; j <= i; j++) {
            document.getElementById(nom + '[' + j + ']').checked = bool;
        }
    }

////////////////////////////////////////////////////////////////////////////////
// retourne un objet xmlHttpRequest.
// m�thode compatible entre tous les navigateurs (IE/Firefox/Opera)
    function getXMLHTTP()
    {
        var xhr = null;
        if (window.XMLHttpRequest)
        { // Firefox et autres
            xhr = new XMLHttpRequest();
        }
        else if (window.ActiveXObject)
        { // Internet Explorer
            try
            {
                xhr = new ActiveXObject("Msxml2.XMLHTTP");
            }
            catch (e)
            {
                try
                {
                    xhr = new ActiveXObject("Microsoft.XMLHTTP");
                }
                catch (e1)
                {
                    xhr = null;
                }
            }
        }
        else
        { // XMLHttpRequest non support� par le navigateur
            alert("Votre navigateur ne supporte pas les objets XMLHTTPRequest...");
        }

        return xhr;
    }


//Fonction renvoyant le code de la touche appuy�e lors d'un �v�nement clavier
    function getKeyCode(evenement)
    {
        for (prop in evenement)
        {
            if (prop == 'which')
            {
                return evenement.which;
            }
        }

        return event.keyCode;
    }


//Suppression des espaces/sauts de ligne inutiles 
    function trim(value) {
        var temp = value;
        var obj = /^(\s*)([\W\w]*)(\b\s*$)/;
        if (obj.test(temp)) {
            temp = temp.replace(obj, '$2');
        }
        var obj = /  /g;
        while (temp.match(obj)) {
            temp = temp.replace(obj, " ");
        }
        return temp;
    }

//Fonction donnant la largeur en pixels du texte donn� (merci SpaceFrog !)
    function getTextWidth(texte)
    {
        //Valeur par d�faut : 150 pixels
        var largeur = 150;

        if (trim(texte) == "")
        {
            return largeur;
        }

        //Cr�ation d'un span cach� que l'on "mesurera"
        var span = document.createElement("span");
        span.style.visibility = "hidden";
        span.style.position = "absolute";

        //Ajout du texte dans le span puis du span dans le corps de la page
        span.appendChild(document.createTextNode(texte));
        document.getElementsByTagName("body")[0].appendChild(span);

        //Largeur du texte
        largeur = span.offsetWidth;

        //Suppression du span
        document.getElementsByTagName("body")[0].removeChild(span);
        span = null;

        return largeur;
    }


//Fonction renvoyant une valeur "al�atoire" pour forcer le navigateur (ie...)
//� envoyer la requ�te de mise � jour
    function ieTrick(sep)
    {
        d = new Date();
        trick = d.getYear() + "ie" + d.getMonth() + "t" + d.getDate() + "r" + d.getHours() + "i" + d.getMinutes() + "c" + d.getSeconds() + "k" + d.getMilliseconds();

        if (sep != "?")
        {
            sep = "&";
        }

        return sep + "ietrick=" + trick;
    }


//On ne pourra �diter qu'une valeur � la fois
    var editionEnCours = false;

//variable �vitant une seconde sauvegarde lors de la suppression de l'input
    var sauve = false;

//Fonction de modification inline de l'�l�ment double-cliqu�
    function inlineMod(table, page, id, obj, nomValeur, type)
    {
        if (editionEnCours)
        {
            return false;
        }
        else
        {
            editionEnCours = true;
            sauve = false;
        }

        //Objet servant � l'�dition de la valeur dans la page
        var input = null;

        //On cr�e un composant diff�rent selon le type de la valeur � modifier
        switch (type)
        {
            //Valeur de type texte ou nombre
            case "texte":
            case "nombre":
                input = document.createElement("input");
                break;

                //Valeur de type texte multilignes
            case  "texte-multi":
                input = document.createElement("textarea");
                break;
        }

        //Assignation de la valeur
        if (obj.innerText)
            input.value = obj.innerText;
        else
            input.value = obj.textContent;

        input.value = trim(input.value);

        //On lui donne une taille un peu plus large que le texte � modifier
        input.style.width = getTextWidth(input.value) + 30 + "px";

        //Remplacement du texte par notre objet input
        obj.replaceChild(input, obj.firstChild);

        //On donne le focus � l'input et on s�lectionne le texte qu'il contient
        input.focus();
        input.select();

        //Assignation des deux �v�nements qui d�clencheront la sauvegarde de la valeur

        //Sortie de l'input
        input.onblur = function sortir()
        {
            sauverMod(table, page, id, obj, nomValeur, input.value, type);
            delete input;
        };

        //Appui sur la touche Entr�e
        input.onkeydown = function keyDown(event)
        {
            if (!event && window.event)
            {
                event = window.event;
            }
            if (getKeyCode(event) == 13)
            {
                sauverMod(table, page, id, obj, nomValeur, input.value, type);
                delete input;
            }
        };
    }

//Objet XMLHTTPRequest
    var XHR = null;

//Fonction de sauvegarde des modifications apport�es
    function sauverMod(table, page, id, obj, nomValeur, valeur, type)
    {
        //Si on a d�j� sauv� la valeur en cours, on sort
        if (sauve)
        {
            return false;
        }
        else
        {
            sauve = true;
        }

        //Si l'objet existe d�j� on abandonne la requ�te et on le supprime
        if (XHR && XHR.readyState != 0)
        {
            XHR.abort();
            delete XHR;
        }

        //Cr�ation de l'objet XMLHTTPRequest
        XHR = getXMLHTTP();

        if (!XHR)
        {
            return false;
        }

        //URL du script de sauvegarde auquel on passe la valeur � modifier
        XHR.open("GET", page + "?table=" + table + "&id=" + id + "&champ=" + nomValeur + "&valeur=" + escape(valeur) + "&type=" + type + ieTrick(), true);

        //On se sert de l'�v�nement OnReadyStateChange pour supprimer l'input et le replacer par son contenu
        XHR.onreadystatechange = function()
        {
            //Si le chargement est termin�
            if (XHR.readyState == 4)
            {
                //R�initialisation de la variable d'�tat d'�dition
                editionEnCours = false;
                //Remplacement de l'input par le texte qu'il contient
                obj.replaceChild(document.createTextNode(valeur), obj.firstChild);
            }
        };

        //Envoi de la requ�te
        XHR.send(null);
    }

jQuery.fn.multiselect = function() {
    $(this).each(function() {
        var checkboxes = $(this).find("input:checkbox");
        checkboxes.each(function() {
            var checkbox = $(this);
            // Highlight pre-selected checkboxes
            if (checkbox.prop("checked"))
                checkbox.parent().addClass("multiselect-on"); 
            // Highlight checkboxes that the user selects
            checkbox.click(function() {
                if (checkbox.prop("checked"))
                    checkbox.parent().addClass("multiselect-on");
                else
                    checkbox.parent().removeClass("multiselect-on");
            });
        });
    });
};

function get_selected(id) {
    arr_selected = new Array();
    obj_select = document.getElementById(id);

    for (i=0; i < obj_select.length; i++) {
        if (obj_select[i].selected) {
            arr_selected.push(obj_select[i].value);
        }
    }

    return arr_selected.join('|');
}
function get_checked(nom, n) {
    arr_checked = new Array();
//    obj_check = document.getElementById(nom);
//
//    for (j = 1; j <= nmax; j++) {
//        document.getElementById(nom + '[' + j + ']').checked = bool;
//    }

    for (i=1; i < n; i++) {
        obj_check = document.getElementById(nom + '[' + j + ']') ;
        if (obj_check.checked) {
            arr_checked.push(obj_check.value);
        }
    }
    return arr_checked.join('|');
}
//</script>

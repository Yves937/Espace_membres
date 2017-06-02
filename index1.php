<?php
/*
Page index.php

Affichage de profil.

Quelques indications (utiliser l'outil de recherche et rechercher les mentions données) :

Liste des fonctions :
--------------------------
Aucune fonction
--------------------------


Liste des informations / erreurs :
--------------------------
Le membre n'existe pas
--------------------------
*/

session_start();
header('Content-type: text/html; charset=utf-8');
include('../includes/config.php');

/********Actualisation de la session...**********/

include('../includes/fonctions.php');
connexionbdd();
actualiser_session();

/********Fin actualisation de session...**********/

/********Gestion avant affichage...***********/
if($_GET['id'] == '') //s'il n'y a pas d'id, on affiche la page du membre connecté...
{
        if(isset($_SESSION['membre_id'])) $id = $_SESSION['membre_id'];
        else $id = -1;
}

else $id = $_GET['id'];

$profil = sqlquery("SELECT * FROM membres
LEFT JOIN connectes
ON connectes_id = membre_id
WHERE membre_id=".intval($id), 1);
if($profil['membre_id'] == '' || $id == -1)
{
        $informations = Array(/*L'id de cookie est incorrect*/
                true,
                'Page membre inconnue',
                'Ce membre n\'existe pas.',
                '',
                '../index.php',
                3
                );
        require_once('../information.php');
        exit();
}
/********Fin gestion avant affichage************/
?>

<?php
/********En-tête et titre de page*********/

$titre = 'Membre : '.htmlspecialchars($profil['membre_pseudo'], ENT_QUOTES).'';

include('../includes/haut.php'); //contient le doctype, et head.

/**********Fin en-tête et titre***********/
?>

                <div id="colonne_gauche">
                <?php
                include('../includes/colg.php');
                ?>
                </div>

<!--contenu//-->
                <div id="contenu">
                        <div id="map">
                                <a href="../index.php">Accueil</a> => <a href="user.php?id=<?php echo intval($profil['membre_id']); ?>">Profil de <?php echo htmlspecialchars($profil['membre_pseudo'], ENT_QUOTES); ?></a>
                        </div>
                        
                        <h1>Profil de <?php echo htmlspecialchars($profil['membre_pseudo'], ENT_QUOTES); ?></h1>
                        
                        <div class="profil_cellule_float">
                                <h2>Informations générales</h2>
                                
                                
                                <div class="avatar">
                                <?php
                                if($profil['membre_avatar'] == '')
                                {
                                        echo 'Pas d\'avatar';
                                }
                                ?>
                                </div>

<!--liste//-->
                                <ul>
                                        <li><b>Pseudo :</b> <?php echo htmlspecialchars($profil['membre_pseudo'], ENT_QUOTES); ?></li>
                                        <li><b>Date d'inscription :</b> <?php echo mepd($profil['membre_inscription']); ?></li>
                                        <li><b>Groupe :</b> <?php if($profil['banni'] == 1) echo 'bannis'; else echo 'membres'; ?></li>
                                        <li><b>Dernier passage :</b> <?php echo mepd($profil['membre_derniere_visite']); ?></li>
                                        <li><b>Statut :</b>
                                        <?php
                                        if($profil['connectes_id'] == $profil['membre_id'])
                                        {
                                        ?>
                                        <span class="actif"><?php echo htmlspecialchars($profil['membre_pseudo'], ENT_QUOTES); ?> est connecté</span>
                                        <?php
                                        }
                                        
                                        else
                                        {
                                        ?>
                                        <span class="inactif"><?php echo htmlspecialchars($profil['membre_pseudo'], ENT_QUOTES); ?> est déconnecté</span></li>
                                        <?php
                                        }
                                        ?>
                                </ul>
                        </div>

<!--infos complémentaires//-->
                        <div class="profil_cellule">
                                <h2>Informations complémentaires</h2>
                                <ul>
                                        <li><b>Date de naissance :</b> <?php echo $profil['membre_naissance']; ?></li>
                                        <li><b>Âge :</b> <?php echo age($profil['membre_naissance']); ?>
                                        <?php
                                        if(trim($profil['membre_profession']) != '') /*affichage de la profession*/
                                        {
                                        ?>
                                        <li><b>Profession :</b> <?php echo htmlspecialchars($profil['membre_profession'], ENT_QUOTES); ?></li>
                                        <?php
                                        }
                                        
                                        if(trim($profil['membre_localisation']) != '') /*affichage de la ville*/
                                        {
                                        ?>
                                        <li><b>Ville :</b> <?php echo htmlspecialchars($profil['membre_localisation'], ENT_QUOTES); ?></li>
                                        <?php
                                        }
                                        ?>
                                </ul>
                        </div>

<?php
function age($birth)
{
        $DATE = intArray(explode('/', $birth));
        $try = mktime(0, 0, 0, $DATE[1], $DATE[0], date('Y'));
        if(time() >= $try) $age = date('Y') - $DATE[2];
        else $age = date('Y') - $DATE[2] - 1;

        return $age;        
}
?>

<?php
function intArray($Array)
{
        foreach($Array as $cle => $element)
        {
                $Array[$cle] = intval($element);
        }
        
        return $Array;
}
?>

<!--activité//-->
                        <div class="profil_cellule_float">
                                <h2><?php echo htmlspecialchars($profil['membre_pseudo'], ENT_QUOTES); ?> et le site</h2>
                                Si vous avez un forum, ou des news, ou autre chose comme le Site du Zér0, c'est ici qu'il faudra mettre tout ça !
                        </div>

<!--contact//-->
                        <div class="profil_cellule">
                                <h2>Comment le joindre</h2>
                                <!--
                                L'adresse e-mail est généralement une information très privée, pour le moment
                                nous ne la protégeons pas, mais très vite nous le ferons.
                                //-->
                                S'il y a un module de MP sur votre site, ou si vous comptez en mettre un, mettez un lien. :)
                                
                                <h3>Messageries</h3>
                                <ul>
                                        <li><b>E-Mail :</b> <img src="image.php?tex=<?php echo htmlspecialchars($profil['membre_mail'], ENT_QUOTES); ?>"/></li>
                                        <?php
                                        if(trim($profil['membre_msn']) != '')
                                        {
                                        ?>
                                        <li><b>MSN :</b> <img src="image.php?tex=<?php echo htmlspecialchars($profil['membre_msn'], ENT_QUOTES); ?>"/></li>
                                        <?php
                                        }
                                        
                                        if(trim($profil['membre_yahoo']) != '')
                                        {
                                        ?>
                                        <li><b>Yahoo :</b> <img src="image.php?tex=<?php echo htmlspecialchars($profil['membre_yahoo'], ENT_QUOTES); ?>"/></li>
                                        <?php
                                        }
                                        
                                        if(trim($profil['membre_aim']) != '')
                                        {
                                        ?>
                                        <li><b>Aim :</b> <img src="image.php?tex=<?php echo htmlspecialchars($profil['membre_aim'], ENT_QUOTES); ?>"/></li>
                                        <?php
                                        }
                                        ?>
                                </ul>
                        </div>

<!--signature et fin//-->
                        <div class="profil_ligne">
                                <h2>Signature</h2>
                                
                                <?php echo htmlspecialchars($profil['membre_signature'], ENT_QUOTES); ?>
                        </div>
                        
                        <div class="profil_ligne">
                                <h2>Biographie</h2>
                                
                                <?php echo htmlspecialchars($profil['membre_biographie'], ENT_QUOTES); ?>
                        </div>
                </div>
                
                <?php
                include('../includes/bas.php');
                mysql_close();
                ?>
<?php
require_once 'DBConnect.php';
require_once 'ContactManager.php';
require_once 'Contact.php';
require_once 'Command.php';
require_once 'config.php';

//création de mon instance pour la classe DBConnect//
$dbconnect = DBConnect::getInstance();
$monConnecteur = $dbconnect->getPDO();

//Création de mon instance pour la class ContactManager en lui passant l'objet DBConnect//
$contactmanager = new ContactManager($monConnecteur);

//Création de mon instance pour la class Command en lui passant l'objet //
$command = new Command($contactmanager);

while (true) {
    //Demande de ma commande //
    $line = readline("Entrez votre commande : ");

    //Commande quit pour quitter le programme//
    if ($line === "quit"){
        echo "Fermeture du programme ...\n";
        break;//permet de sortir de la boucle while et termine le script
    }

    //*******************Commande list******************************* */
    // Si la commande est List//
    if ($line === "list") {
       $command->list(); //appelle la méthode List de Command//


        //******************Commande detail ************************/
       //Permet de verifier si la commande commence par detail suivi d'un nombre (id)//
    }elseif (preg_match('/^detail (\d+)$/', $line, $matches)){

        //Permet de récupérer le nombre écrit aprés "detail"//
        // ça permet de transformer ce nombre en entier pour être sur qu'il s'agit bien d'un chiffre et pas d'un texte// 
        $id = (int) $matches[1]; 

        // Ici j'appel la function detail avec cet ID pour afficher les infos du contact correspondant//
        $command->detail($id);

    //**********************Commande create*******************************/
    //Permet de verifier si la commande commence par create  je devrais fournir les informations du contact name , email et téléphone pour ensuite valider//
    // Vérifie si la commande entrée commence par 'create', suivie de trois arguments (nom, email, téléphone)
    // Le regex (/^create (.+) (.+) (.+)$/) capture ces trois arguments dans des groupes.
    // (.+) signifie capturer un ou plusieurs caractères (nom, email, téléphone) après le mot 'create'.
    // Le résultat de la capture est ensuite stocké dans le tableau $matches.
    // $matches[1] contient le nom, $matches[2] l'email, et $matches[3] le téléphone.

    } elseif (preg_match('/^create (.+) (.+) (.+)$/', $line, $matches)) {
        $name = $matches[1];
        $email = $matches[2];
        $phone_number = $matches[3];

        // Appel à la méthode create() de Command pour créer un nouveau contact
        $command->create($name, $email, $phone_number);


        //******************Commande Delete**************************/
        //Vérifie si la commande est 'delete' suivie d'un ID
        } elseif (preg_match('/^delete (\d+)$/', $line, $matches)) {
        // Récupère l'ID du contact à supprimer
        $id = (int)$matches[1]; // Convertit l'ID capturé (qui est une chaîne de caractères) en entier pour l'utiliser dans la suppression//
    
        // Appelle la méthode delete() de Command pour supprimer un contact avec l'ID
        $command->delete($id);
    

        //***************Commande Help*****************************/
        //Permet de voir toutes les commandes mise en place pour l'utilisation du terminal//
        } elseif ($line === "help") {
           
                echo "commandes disponibles" .  PHP_EOL;
                echo " list          -Affiche tout les contacts" . PHP_EOL;
                echo " detail <id>   -Affiche le detail d'un contact" . PHP_EOL;
                echo " create <nom> <email> <téléphone>  -Crée un nouveau contact" . PHP_EOL;
                echo " delete <id>   -Supprime un contact" . PHP_EOL;
                echo " quit          -Quitte le programme" . PHP_EOL;

            } else {
        //Si la commande tapé n'est pas reconnue , On affiche un message d'erreur//
        echo "Commande invalide, Utilisez 'list' pour lister les contacts, 'detail <id>' pour afficher un contact, ou 'create <name> <email> <phone>' pour créer un contact ou Delete pour supprimer un contact. \n";
    }
    
}
<?php 

//Création de la classe DBConnect qui va gerer la connexion à la base de données//
class DBConnect {
    
    //Déclaration d'un attribut privé pour stocker la connexion PDO//
    private $monConnecteur; 

    //Le constructeur est une méthode spéciale qui s'exécute dés qu'on crée une instance de cette classe//
    public function __construct(){

        //Je défini les paramètres necessaires pour se connecter à la base de données//
        $db_name = 'gestion_contacts'; //Nom de ma base de données//
        $hostname ='localhost'; //Non de mon serveur local//
        $username = 'root'; //nom d'utilisateur de ma base de données//
        $password = ''; //mot de passe de ma base de données //

        //Création de la connexion PDO en utilisant les paramétres ci-dessus//
        //PDO est un objet qui permet de se connecter à notre base de données et d'effectuer des requêtes//
        $this->monConnecteur =new PDO ("mysql:dbname=$db_name;host=$hostname",$username,$password);    
    }

    //Méthode publique qui va me permettre de récupérer l'objet PDO pour exécuter des requêtes SQL//
    public function getPDO() {
        //retourne l'objet PDO qui permet d'intéragir avec la base de données//
        return $this->monConnecteur;
    }
}
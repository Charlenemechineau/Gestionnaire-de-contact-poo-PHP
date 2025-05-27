<?php 

//Création de la classe DBConnect qui va gerer la connexion à la base de données//
class DBConnect {
    
    //Déclaration d'un attribut privé pour stocker la connexion PDO//
    private static $instance = null;
    private $monConnecteur; 

    //Le constructeur est une méthode spéciale qui s'exécute dés qu'on crée une instance de cette classe//
    private function __construct(){

        

        //Création de la connexion PDO en utilisant les paramétres ci-dessus//
        //PDO est un objet qui permet de se connecter à notre base de données et d'effectuer des requêtes//
        $this->monConnecteur = new PDO("mysql:host=" . HOSTNAME . ";dbname=" . NOM_BDD, USER, PASSWORD);    
    }

    public static function getInstance(): DBConnect
    {
        if (self::$instance == null) {
            self::$instance = new DBConnect();
        }
        return self::$instance;
    }



    //Méthode publique qui va me permettre de récupérer l'objet PDO pour exécuter des requêtes SQL//
    public function getPDO() {
        //retourne l'objet PDO qui permet d'intéragir avec la base de données//
        return $this->monConnecteur;
    }
}
<?php 
//Déclaration de ma classe ContactManager qui va être responsable de la gestion des contacts dans la base de données//
class ContactManager {

    //Propriété privé qui contient l'objet PDO cest objet va nous permettre de communique avec la base de données//
    private $pdo;

    //Constructeur de ma classe qui sera éxécuter automatiquement Lorsqu'un objet de la classe est créé//
    public function __construct(PDO $dbconnect){

        //Je récupère l'objet PDO de la classe DBConnect et le stock dans la propriété $dbconnect ce qui va nous permettre d'intéragire avec la base de données//
        $this->pdo = $dbconnect;  
    }

    //Méthode qui permet de récupérer tous les contacts de la base de données. Cette méthode retourne un tableau d'objets Contact//
    public function findAll(): array {

        $contacts = [];  // Tableau qui va contenir les objets Contact récupérés de la base de données//

        // La requête SQL qui va récupérer les informations des contacts ( id , non , email , numéro de téléphone)".//
        $sql = "SELECT id, name, email, phone_number FROM contact";

        // Prépare la requête SQL et la stocke dans la variable $requete//
        $requete = $this->pdo->prepare($sql);

        // Exécute la requête prepare//
        $requete->execute();

        //Parcours chaque ligne de résultats et crée un objet Contact avec les données récupérées//
        $resultat =  $requete->fetchAll(PDO::FETCH_ASSOC);

        foreach ($resultat as $row){
            $contacts[] = new Contact(
                $row['id'],    // attribue l'id du contact à l'objet Contact//
                $row['name'],  // attribue le nom du contact à l'objet Contact//
                $row['email'], // attribue l'email du contact à l'objet Contact//
                $row['phone_number'], // attribue le numéro de téléphone du contact à l'objet Contact//
            );
        }

        // Retourne le tableau contanant Les objets Contact//
        return $contacts;    
    }


    //Méthode qui me permet la recherche d'un contact dans la base de données en fonction de son ID
    //int $id c'est l'identifiant du contact qui est recherché//
    // ?contact retourne un objet contact si l'id est trouvé sinon il retourn un null//
    public function findById(int $id): ?Contact {

        // Requête SQL pour récupérer un contact en fonction de son ID//
        $sql = "SELECT id, name, email, phone_number FROM contact WHERE id = :id";

        // Prépare la requête SQL pour éviter les injections SQL
        $requete = $this->pdo->prepare($sql);

        // Associe la valeur de l'ID à la requête SQL en la sécurisant avec bindParam//
        $requete->bindParam(':id', $id, PDO::PARAM_INT);

         // Exécute la requête//
        $requete->execute();

        // Récupère le résultat sous forme de tableau associatif (clé => valeur)
        $row = $requete->fetch(PDO::FETCH_ASSOC);

        // Si un contact est trouvé, on crée un objet Contact avec les données récupérées
        // Sinon, on retourne null (aucun contact trouvé)
        return $row ?  new Contact($row['id'], $row['name'], $row['email'], $row['phone_number']) :null;
    }

    // Méthode publique permettant de créer un contact dans la base de données. 
    // Elle prend trois paramètres : le nom, l'email et le numéro de téléphone du contact, 
    // tous de type string. La méthode retourne un objet de type Contact, 
    // correspondant au contact nouvellement créé dans la base de données.
    public function createContact(string $name, string $email, string $phone_number): Contact {

        // Permet de préparer la requête SQL pour insérer un nouveau contact dans la base de données//
        $query = $this->pdo->prepare("INSERT INTO contact (name, email, phone_number) VALUES (:name, :email, :phone_number)");

        //ici j'execute la requête en passant les valeur des paramétre sous forme de tableaux associatif//
        $query->execute([
        "name" => $name,
        "email" => $email,
        "phone_number" => $phone_number,
        ]);

        //ici on récupère de l'id du contact qui vient d'être inséré dans la base de données//
        $id = $this->pdo->lastInsertId();

        //permet de rechercher le contact ajouté dans la base de données en retour de l'objet correspondant //
        return $this->findById($id);
    }


    // Cette méthode permet de supprimer un contact en fonction de son ID
    public function deleteContact(int $id) {

        // Permet de préparer ma requête SQL pour supprimer le contact
        $query = $this->pdo->prepare("DELETE FROM contact WHERE id = :id");
        // Ici, on prépare une requête SQL pour supprimer un enregistrement de la table 'contact'
        // en fonction de l'ID spécifié dans le paramètre :id. L'utilisation de :id permet de lier un
        // paramètre à la requête SQL, ce qui protège contre les injections SQL.

        $query->bindParam(":id", $id, PDO::PARAM_INT);
        // On lie le paramètre :id de la requête préparée à la valeur de la variable $id.
        // Cela permet de s'assurer que l'ID sera correctement inséré dans la requête SQL en tant qu'entier (PDO::PARAM_INT).

        return $query->execute();
        // Exécute la requête préparée. La méthode execute() retourne true si la requête a réussi
        // (contact supprimé) ou false si quelque chose a échoué.

    }
}
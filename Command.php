<?php 

//permet D'inclure le fichier Contact.Manager.php dans mon fichier Command.php//
 require_once 'ContactManager.php';

//Déclaration de ma classe Command//
 class Command {
    //Propriété privée $contactManager qui va contenir l'instance de ContactManager pour interagir avec //
        private ContactManager $contactManager;

        // Méthode qui va me permettre d'afficher tous les contacts
        public function __construct(ContactManager $contactManager){
            $this->contactManager = $contactManager; // On assigne l'instance de ContactManager à la propriété $contactManager//
        }

        //Méthode qui va permettre  La méthode list() qui ne prend pas de paramètre et qui affiche la liste des contacts
        // Cette méthode appelle la méthode findAll() de ContactManager pour récupérer tous les contacts//
        public function list(): void {

            // permet de récuprer tous les contacts via le ContactManager//
            $contacts = $this->contactManager->findAll();
            //permet de Boucler sur chaque contact récupéré//
            // Chaque contact est un objet, donc on appelle la méthode toString() pour l'afficher//
            foreach ($contacts as $contact) {

                // Utilisation de la méthode toString() qui va permettre d'afficher le contact sous une forme lisible//
                echo $contact. PHP_EOL;
            }
        }

        //Méthode qui va me permettre d'afficher les details d'un contact en fonction de son ID//
        Public function detail(int $id): void {   //int $id est l'idendifiant du contact à afficher et Void n'a pas de retour elle affichera simplement les informations/
            
            // Va rechercher le contact dans la base de connées en utilisant son ID //
            $contact = $this->contactManager->findById($id);

            //Si un contact à été trouvé //
            if ($contact) {
                //Affiche les information du contact//
                echo $contact. PHP_EOL ;
            } else{
                //Sinon affiche un message si aucun contact n'a été trouvé avec cet ID//
                echo "Aucun contact trouvé avec l'ID $id.\n";
            }
        }

        //Méthode qui va me permettre de créer des contact en utilisant ContactMangager//
        public function create(string $name, string $email, string $phone_number): void { // void ne me retourne a rien elle affiche simplement un message de succés ou d'erreur//

            // ici j'appel la methode createContact mise en place dans mon fichier contactManager.php pour inséré  les information fournies ( name, email , et numéro de téléphone) dans la base de données//
            $contact = $this->contactManager->createContact($name,$email,$phone_number);
            
            //Condition qui va me permettre de verifier si le contact a bien été créer message succés avec les informations affiché ,sinon il m'affichera un message d'erreur.//
            if ($contact) {
                echo "contact crée avec succès!" .$contact . PHP_EOL;
            }else {
                echo "Erreur lors de la création du contact." . PHP_EOL;
            }
        }

        //Méthode qui va me  permettre de supprimer un contact en fonction de son id//
        public function delete(int $id): bool { // void ne me retourne a rien elle affiche simplement un message de succés ou d'erreur//
            //permet de rentrer l'id du contact à supprimer//

            // Appelle ma methode DeleteContact du contactManager pour supprimer mon contact//
            $result = $this->contactManager->deleteContact($id);

            //Si la suppression à réussi ' affiche un message de succès//
            if ($result) {
                echo "Le contact à été supprimé avec succès" . PHP_EOL;
                return true;
            }else{
                //Sinon affiche moi un message d'erreur//
                echo "Erreur lors de la suppression du contact. Vérifiez l'ID" . PHP_EOL;
                return false;
            }
        } 
 }




?>
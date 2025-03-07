<?php 
    //Définition de ma classe contact
    class Contact {
        // Attribut privé pour chacun de mes champs contact//
        private ?int $id;
        private ?string $name;
        private ?string $email;
        private ?string $phone_number;

        //Mon constructeur qui va me permettre de definir les attributs au moment de la création de l'objet//

        public function __construct(?int $id, ?string $name, ?string $email, ?string $phone_number) {
            $this->id = $id;
            $this->name = $name;
            $this->email = $email;
            $this->phone_number = $phone_number;
        }

        //Getter pour l'ID qui va me permettre d'obtenir l'id du contact //
        public function getId(): ?int {
            return $this->id;
        }

        //Getter pour le nom qui va me permettre d'obtenir le nom du contact// 
        public function getName(): ?string {
            return $this->name;
        }

        //Setter pour le nom qui va me permettre de modifier le nom du contact//
        public function setName(?string $name): void {
             $this->name = $name;
        }

        //Getter pour l'email qui va me permettre d'obtenir l'email du contact//
        public function getEmail(): ?string {
            return $this->email;
        }

        //setter pour l'email qui va me permettre de modifier l'email du contact//
        public function setEmail(?string $email): void {
             $this->email = $email;
        }

        //getter pour le numero de téléphone qui va me permettre d'obtenir le numero du contact// 
        public function getPhoneNumber(): ?string {
            return $this->phone_number;
        }

        //setter pour le numéro de téléphone qui va me permettre de modifier le numero du contact//
        public function setPhoneNumber(?string $phone_number): void {
            $this->phone_number = $phone_number;
        }
        // c'est une methode spéciale qui permet de transformer l'objet en texte// 
        public function __toString(): string {
            return "Nom: {$this->name} - Email: {$this->email} - Téléphone: {$this->phone_number}";
            
        }

    }
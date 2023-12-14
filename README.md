# Artemis - TP Application de gestion de bibliothèque

## Description

Artemis est une solution numérique de gestion de bibliothèque. Elle permet de gérer les livres, les auteurs, les emprunts et les clients d'une bibliothèque. Projet d'apprentissage pour mes étudiant(e)s CDA.

## Cible

Artemis est destiné aux bibliothèques de petite et moyenne taille.

## Votre rôle

Vous êtes dev dans une TPE qui développe des solutions numériques pour les bibliothèques. Vous êtes en charge de la conception et du développement de fonctionnalités pour ces mêmes applications. Artemis est un SAAS (Software As A Service) en construction qui sera commercialisé mi-2024.

---

## Vos missions

Vous devez concevoir et développer les fonctionnalités suivantes :

#### Barre de recherche de livres

![Alt text](/artemis-assets/images/search.png?raw=true)

La barre de recherche doit permettre de rechercher un livre par son titre, la fonctionnalité et la page de résultat sont déjà codées, il faut juste l'intégrer dans la barrre de recherche.

---

#### Mise à jour des données d'un client

![Alt text](/artemis-assets/images/edit.png?raw=true)

La mise à jour des données d'un client doit permettre de modifier les données via un formulaire. Créez un formulaire avec les information nécessaires à la mise à jour des données pour chaque client (dans la boucle `foreach`).

---

#### Suppression d'un client

La suppression d'un client doit permettre de supprimer un client de la base de données. Utilisez le bouton avec l'icône corbeille pour supprimer un client.

---

#### Gestion des emprunts

![Alt text](/artemis-assets/images/borrow.png?raw=true)

Ajoutez un bouton "Rendu" sur les cartes des livres qui n'ont pas encore été rendus pour permettre de rendre le livre.

Uniquement les livres rendus ont un bouton "Archiver". Il ne peut il y avoir q'un bouton pour chaque carte.

Développez la fonctionnalité de rendu d'un livre, ainsi que la fonctionnalité d'archivage d'un livre.
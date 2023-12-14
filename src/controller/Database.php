<?php

/**
 * Classe Database
 * Gestionnaire des interactions avec la base de données
 */

namespace Artemis;

use PDO;
use PDOException;

class Database
{
    private static $host = 'localhost';
    private static $dbname = 'artemis';
    private static $username = 'root';
    private static $password = 'root';
    private static $charset = 'utf8mb4';
    private static $pdo;

    // Connexion
    static public function getPDO(): PDO
    {
        if (!isset(self::$pdo)) {
            try {
                self::$pdo = new PDO(
                    'mysql:host=' . self::$host . ';dbname=' . self::$dbname . ';charset=' . self::$charset,
                    self::$username,
                    self::$password,
                    [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                        PDO::ATTR_EMULATE_PREPARES => false
                    ]
                );
    
            } catch (PDOException $e) {
                echo 'Erreur de connexion à la base de données : ' . $e->getMessage();
            }
        }
        
        return self::$pdo;


    }

    /**
     * Methode global d'execution de requete pour récupérer un ou plusieurs éléments
     * La connexion PDO se fera à pres la définition de la requete SQL dans la méthode
     * de la classe qui l'appelle. Suite à cela, la méthode executePDO() retournera le
     * résultat de la requête sous forme de tableau associatif.
     * @param string $query
     * @param string $fetch
     * @return array
     */
    static public function executePDO(string $query, string $fetch): array
    {
        $pdo = Database::getPDO(); // Instanciation de l'objet PDO
        $stmt = $pdo->prepare($query); // L'objet PDO se prépare à executer la requête
        $stmt->execute(); // L'objet PDO execute la requête
        if ($fetch) {
            if($fetch == 'one') {
                $result = $stmt->fetch(PDO::FETCH_ASSOC); // PDO créer un tableau associatif
                return $result;
            } elseif($fetch == 'all'){
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC); // PDO créer un tableau associatif
                return $result;
            }
        }
    }

    /**
     * Méthode global de récupération de tous
     * les éléments d'une entité dans la BDD
     * @param string $entity
     * @return array
     */
    static public function getAll(string $entity): array
    {
        $pdo = Database::getPDO();
        $query = "SELECT * FROM $entity;";
        $stmt = $pdo->prepare($query); 
        $stmt->execute(); 
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    /**
     * Méthode global de récupération d'un seul
     * élément d'une entité dans la BDD
     * @param string $entity
     * @param int $id
     * @return array
     */
    static public function getOne(string $entity, int $id): array
    {
        $pdo = Database::getPDO();
        $query = "SELECT * FROM $entity WHERE id = $id;";
        $stmt = $pdo->prepare($query); 
        $stmt->execute(); 
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data;
    }

    /**
     * Méthode global de suppression d'un seul
     * élément d'une entité dans la BDD
     * @param string $entity
     * @param int $id
     * @param string $relation
     * @return array
     */
    static public function delete(string $entity, int $id, $relation = null): void
    {
        $pdo = Database::getPDO();

        if ($relation) {
            $capitalized = ucfirst($relation); // ucfirst = Upper Case First
            $foreign = strtolower($entity) . '_id'; // strtolower = Lower Case
            $query = "DELETE FROM $capitalized WHERE $foreign = $id;";
            $stmt = $pdo->prepare($query); 
            $stmt->execute(); 
        }

        $capitalized = ucfirst($entity);
        $query = "DELETE FROM $capitalized WHERE id = $id;";
        $stmt = $pdo->prepare($query); 
        $stmt->execute(); 
    }


}
// Ne pas écrire de code ici
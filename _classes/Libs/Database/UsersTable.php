<?php

namespace Libs\Database;

use PDOException;

class UsersTable{
    private $db=null;
    
    public function __construct(MySQL $db){
        $this->db= $db->connect();
    }

    // Insert Method 
    public function insert($data){
        try{
          $query= "INSERT INTO users
                    (name, email, phone, address, password, role_id, create_at)
                    VALUES 
                    (:name, :email, :phone, :address, :password, :role_id, NOW())
                ";

            $statement= $this->db->prepare($query);
            $statement->execute($data);

            return $this->db->lastInsertId();
            
        }catch(PDOException $e){
            return $e->getMessage();
        }
    }

    public function getAll(){
        $statement= $this->db->query("
            SELECT users.*, roles.name AS role, roles.value
            FROM users LEFT JOIN roles
            ON users.role_id = roles.id
        ");

        return $statement->fetchAll();
    }

    // for check to login by created user
    public function findByEmailAndPassword($email, $password){
        $statement= $this->db->prepare("
            SELECT users.*, roles.name AS role, roles.value
            FROM users LEFT JOIN roles
            ON users.role_id= roles.id
            WHERE users.email = :email
            AND users.password= :password
        ");

        $statement->execute([
            'email' => $email,
            'password' => $password
        ]);

        $row = $statement->fetch();
        return $row ?? false;
    }

    // Each Profile Photo
    public function updatePhoto($id, $name){
        $statement= $this->db->prepare("
            UPDATE users SET photo= :name WHERE id= :id
        ");
        $statement->execute(['name' => $name, 'id' => $id]);
        return $statement->rowCount();
    }

    // for real actions
    public function suspend($id){
        $statement = $this->db->prepare("
            UPDATE users SET suspended=1 WHERE id= :id
        ");
        $statement->execute(['id' => $id ]);
        return $statement->rowCount();
    }
    
    public function unsuspend($id){
        $statement = $this->db->prepare("
            UPDATE users SET suspended=0 WHERE id= :id
        ");
        $statement->execute(['id' => $id ]);
        return $statement->rowCount();
    }

    public function changeRole($id, $role){
        $statement = $this->db->prepare("
            UPDATE users SET role_id= :role WHERE id= :id
        ");
        $statement->execute(['id'=> $id, 'role'=>$role]);
        return $statement->rowCount();
    }

    public function delete($id){
        $statement = $this->db->prepare("
            DELETE FROM users WHERE id= :id
        ");
        $statement->execute(['id' => $id ]);
        return $statement->rowCount();
    }
}
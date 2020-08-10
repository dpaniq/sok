<?php

    class Database
    {
        // Todo constructor?
        public static function connect()
        {
            $host = 'db';
            $user = 'devuser';
            $passsword = 'devpass';
            $db = 'test_db';
            // mysql://devuser:devpass@localhost:9906/test_db

            $conn = new mysqli($host, $user, $passsword, $db);
            if ($conn->connect_error){
                echo "Database connection failed:". $conn->connect_error;
            }

            return $conn;
        }

        public static function getCategories()
        {
            $conn = Database::connect();
            $query = 'SELECT * FROM categories ORDER BY parent_id ASC';
            $query = $conn->query($query);
            
            Database::checkQuery($query);

            return $query ? $query : NULL;
        }

        public static function checkUserEmailExist($email)
        {
            $conn = Database::connect();
            $query = "SELECT * FROM users WHERE email = '{$email}' ";
            $query = $conn->query($query);
            
            Database::checkQuery($query);
            return $query->num_rows;
        }

        public static function addCategory($name, $description)
        {
            $conn = Database::connect();
            $query = "INSERT INTO categories (name, description) VALUES ('{$name}', '{$description}')";
            $query = $conn->query($query);
            
            Database::checkQuery($query);
        }

        public static function addCategoryWithParentId($name, $description, $parentId)
        {
            $conn = Database::connect();
            $query = "INSERT INTO categories (name, description, parent_id) VALUES ('{$name}', '{$description}', '{$parentId}')";
            $query = $conn->query($query);
            
            Database::checkQuery($query);
        }

        public static function addUser($email, $password_hash)
        {
            $conn = Database::connect();
            $query = "INSERT INTO users (email, password, date_time) VALUES ('{$email}', '{$password_hash}', now())";
            $query = $conn->query($query);
            
            Database::checkQuery($query);
        }

        public static function updateCategoryById($name, $description, $id)
        {   
            
            $conn = Database::connect();
            $query = "UPDATE categories SET name='{$name}', description='{$description}' WHERE id=$id";
            $query = $conn->query($query);

            Database::checkQuery($query);
        }

        public static function deleteCategoryById(int $id)
        {
            $conn = Database::connect();
            $query = "DELETE FROM categories WHERE id=$id";
            $query = $conn->query($query);

            Database::checkQuery($query);
        }

        public static function deleteAllSubCategories(int $id)
        {
            $conn = Database::connect();
            $query = "DELETE FROM categories WHERE parent_id=$id";
            $query = $conn->query($query);

            Database::checkQuery($query);
        }

        public static function checkUserEmail($email)
        {
            $conn = Database::connect();
            $query = "SELECT email FROM users WHERE email = '{$email}'";
            $query = $conn->query($query);

            Database::checkQuery($query);

            $stmt = $query->fetch_assoc();
            return $stmt['email'] !== NULL;
        }

        public static function checkUserPassword($email)
        {
            $conn = Database::connect();
            $query = "SELECT password FROM users WHERE email = '{$email}'";
            $query = $conn->query($query);

            Database::checkQuery($query);

            $stmt = $query->fetch_assoc();
            return $stmt['password'];
        }

        private static function checkQuery($query)
        {
            if (!$query) {
                die("MySQL query failed!" . mysqli_error($query));
            }
        }
    }  
?>

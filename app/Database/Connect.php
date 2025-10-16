<?php

    namespace App\Database;

    use PDO;

    class Connect {

        public static function connect() {

            try {

                return new PDO (
                    "mysql:host=127.0.0.1;dbname=google_login_php;charset=utf8",
                    "root",
                    "root",
                    
                    [

                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,

                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ

                    ]);


            } catch (\PDOException $e) {

                die("Erro na conexão: " . $e->getMessage());

            }

        }

    }

?>
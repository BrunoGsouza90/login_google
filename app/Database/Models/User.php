<?php

    namespace App\Database\Models;

    use App\Database\Connect;
    use App\Database\Models\Model as ModelsModel;

    class User extends ModelsModel {

        protected string $table = "users";

        public function insert(array $data) {

            try {

                $connect = Connect::connect();

                $prepare = $connect->prepare("INSERT INTO users (firstName, lastName, avatar, email) VALUES (:firstName, :lastName, :avatar, :email)");

                return $prepare->execute($data);

            } catch (\PDOException $th) {

                echo "<pre>";

                    print_r($th->getMessage());

                echo "</pre>";

            }

        }

    }

?>
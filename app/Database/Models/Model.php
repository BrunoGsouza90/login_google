<?php

    namespace App\Database\Models;

    use App\Database\Connect;

    abstract class Model {

        protected string $table;

        public function findBy($field, mixed $value) {

            try {

                $connect = Connect::connect();

                $prepare = $connect->prepare("SELECT * FROM $this->table WHERE $field = :$field");

                $prepare->execute([

                    $field => $value

                ]);

                return $prepare->fetchObject();

            } catch (\Throwable $th) {

                echo "<pre>";

                    print_r($th->getMessage());

                echo "</pre>";

            }

        }

    }

?>
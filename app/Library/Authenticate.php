<?php

    namespace App\Library;

    use App\Database\Models\User;

    class Authenticate {

        public function authGoogle($data) {

            $user = new User();

            $userFound = $user->findBy("email", $data->email);

            if(!$userFound) {

                $user->insert([

                    "firstName" => $data->givenName,
                    "lastName" => $data->familyName,
                    "email" => $data->email,
                    "avatar" => $data->picture

                ]);

            }

            $_SESSION["user"] = $userFound;

            $_SESSION["auth"] = true;

            header("Location:/home.php");

        }

    }

?>
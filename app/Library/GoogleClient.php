<?php

    namespace app\Library;

    use Google\Client;
    use GuzzleHttp\Client as GuzzleClient;
    use Google\Service\Oauth2 as ServiceOauth2;
    use Google\Service\Oauth2\Userinfo;

    class GoogleClient {

        public readonly Client $client;
        
        public userinfo $data;

        public function __construct() {

            $this->client = new Client();
            
        }

        public function init() {

            $guzzleClient = new GuzzleClient([

                "curl" => [

                    CURLOPT_SSL_VERIFYPEER => false

                ]

            ]);

            $this->client->setHttpClient($guzzleClient);

            $this->client->setAuthConfig("credentials.json");

            $this->client->setRedirectUri("http://localhost:8000");

            $this->client->addScope("email");

            $this->client->addScope("profile");

        }

        public function authorized() {

            if(isset($_GET["code"])) {

                $token = $this->client->fetchAccessTokenWithAuthCode($_GET["code"]);

                $this->client->setAccessToken($token["access_token"]);

                $googleService = new ServiceOauth2($this->client);

                $this->data = $googleService->userinfo->get();

                return [

                    "status" => true,
                    "data" => $this->data

                ];

            }

            return [

                "status" => false,
                "data" => ""

            ];

        }
        
        public function generateAuthLink() {

            return $this->client->createAuthUrl();

        }

    }

?>
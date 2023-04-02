<?php
    namespace App\Models;

    class AuthController {
        private static $key = '123456'; //Application Key
        
        public function login(){
            $connPdo = new \PDO(DBDRIVE.': host='.DBHOST.'; dbname='.DBNAME, DBUSER, DBPASS);
            try{
                $ema = strip_tags($_POST['email']);
                $sen = strip_tags($_POST['password']);
                $sql_code = "SELECT password FROM usuario WHERE email = :email";
                $query = $connPdo->prepare($sql_code);
                $query->bindParam(':email' ,$ema ,\PDO::PARAM_STR);
                $query->execute();
                if(!$query){
                    throw new \PDOException("Erro ao buscar usuário. Tente novamente!");
                }else{
                    $linhas = $query->rowCount();
                    if($linhas == 0){ $res = $linhas; }
                    else{
                        $senhabanco = $query->fetch()['password'];
                        if(password_verify($sen , $senhabanco)){
                            $sqlcode = "SELECT * FROM usuario WHERE email = :email";
                            $query = $connPdo->prepare($sqlcode);
                            $query->bindParam(':email' ,$ema ,\PDO::PARAM_STR);
                            $query->execute();
                            $res = 1;      
                        }else{
                            $linhas = 0;
                            $res = $linhas ;
                        }
                    }
                }
            }catch(\PDOException $e){
                echo "Erro ao buscar usuário. Tente novamente!".$e->getMessage();          
            }
           
            if ($res == 1) {
                //echo "entrou no res".$res;
                //Header Token
                $header = [
                    'typ' => 'JWT',
                    'alg' => 'HS256'
                ];

                //Payload - Content
                $payload = [
                    'name' => $_POST['name'],
                    'email' => $_POST['email'],
                ];

                //JSON
                $header = json_encode($header);
                $payload = json_encode($payload);

                //Base 64
                $header = self::base64UrlEncode($header);
                $payload = self::base64UrlEncode($payload);

                //Sign
                $sign = hash_hmac('sha256', $header . "." . $payload, self::$key, true);
                $sign = self::base64UrlEncode($sign);

                //Token
                $token = $header . '.' . $payload . '.' . $sign;
                //echo "entrou no Auth Controller" ;
                echo $token;
                return $token;
            }
            throw new \Exception('Não autenticado');

/*
            if ($_POST['email'] == 'teste@gmail.com' && $_POST['password'] == '123') {
                //echo "<br> entrou no login if <br>";
                //Header Token
                $header = [
                    'typ' => 'JWT',
                    'alg' => 'HS256'
                ];

                //Payload - Content
                $payload = [
                    'name' => $_POST['name'],
                    'email' => $_POST['email'],
                ];

                //JSON
                $header = json_encode($header);
                $payload = json_encode($payload);

                //Base 64
                $header = self::base64UrlEncode($header);
                $payload = self::base64UrlEncode($payload);

                //Sign
                $sign = hash_hmac('sha256', $header . "." . $payload, self::$key, true);
                $sign = self::base64UrlEncode($sign);

                //Token
                $token = $header . '.' . $payload . '.' . $sign;
                //echo "entrou no Auth Controller" ;
                echo $token;
                return $token;
            }
            
            throw new \Exception('Não autenticado');
*/
        }

        public static function checkAuth()
        {
            $http_header = apache_request_headers();

            if (isset($http_header['Authorization']) && $http_header['Authorization'] != null) {
                $bearer = explode (' ', $http_header['Authorization']);
                //$bearer[0] = 'bearer';
                //$bearer[1] = 'token jwt';

                $token = explode('.', $bearer[1]);
                $header = $token[0];
                $payload = $token[1];
                $sign = $token[2];

                //Conferir Assinatura
                $valid = hash_hmac('sha256', $header . "." . $payload, self::$key, true);
                $valid = self::base64UrlEncode($valid);

                if ($sign === $valid) {
                    return true;
                }
            }

            return false;
        }
        
        
        /*Criei os dois métodos abaixo, pois o jwt.io agora recomenda o uso do 'base64url_encode' no lugar do 'base64_encode'*/
        private static function base64UrlEncode($data)
        {
            // First of all you should encode $data to Base64 string
            $b64 = base64_encode($data);

            // Make sure you get a valid result, otherwise, return FALSE, as the base64_encode() function do
            if ($b64 === false) {
                return false;
            }

            // Convert Base64 to Base64URL by replacing “+” with “-” and “/” with “_”
            $url = strtr($b64, '+/', '-_');

            // Remove padding character from the end of line and return the Base64URL result
            return rtrim($url, '=');
        }
    }
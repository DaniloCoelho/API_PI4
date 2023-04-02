<?php
    namespace App\Models;

    class User
    {
        private static $table = 'usuario';

        public static function select(int $id) {

            if (AuthController::checkAuth()) {

				$connPdo = new \PDO(DBDRIVE.': host='.DBHOST.'; dbname='.DBNAME, DBUSER, DBPASS);
                $sql = 'SELECT * FROM '.self::$table.' WHERE id = :id';
                $stmt = $connPdo->prepare($sql);
                $stmt->bindValue(':id', $id);
                $stmt->execute();

                if ($stmt->rowCount() > 0) {
                    return $stmt->fetch(\PDO::FETCH_ASSOC);
                } else {
                    throw new \Exception("Nenhum usuário encontrado!");
                }
			}
			
			throw new \Exception('Não autenticado');
            
        }

        public static function selectAll() {

            if (AuthController::checkAuth()) {
				
                $connPdo = new \PDO(DBDRIVE.': host='.DBHOST.'; dbname='.DBNAME, DBUSER, DBPASS);
                $sql = 'SELECT * FROM '.self::$table;
                $stmt = $connPdo->prepare($sql);
                $stmt->execute();

                if ($stmt->rowCount() > 0) {
                    return $stmt->fetchAll(\PDO::FETCH_ASSOC);
                } else {
                    throw new \Exception("Nenhum usuário encontrado!");
                }
			}
            throw new \Exception('Não autenticado');
			
			
        }

        public static function insert($data)
        {
            //if (AuthController::checkAuth()) {
				$connPdo = new \PDO(DBDRIVE.': host='.DBHOST.'; dbname='.DBNAME, DBUSER, DBPASS);

                $sql = 'INSERT INTO '.self::$table.' (nome , email , telefone , datanasc , genero ,avaliacao_media, password) VALUES (:nome,:email, :telefone , :datanasc , :genero ,:avaliacao_media, :password)';

                $sen = strip_tags($data['password']); //criptografar aqui
                $senha = password_hash($sen , PASSWORD_DEFAULT);

                $stmt = $connPdo->prepare($sql);
                $stmt->bindValue(':nome', $data['nome']);
                $stmt->bindValue(':email', $data['email']);
                $stmt->bindValue(':telefone', $data['telefone']);
                $stmt->bindValue(':datanasc', $data['datanasc']);
                $stmt->bindValue(':genero', $data['genero']);
                $stmt->bindValue(':avaliacao_media', 5);
                $stmt->bindValue(':password', $senha);
                $stmt->execute();

                if ($stmt->rowCount() > 0) {
                    return 'Usuário(a) inserido com sucesso!';
                } else {
                    throw new \Exception("Falha ao inserir usuário(a)!");
                }
			//}
			//throw new \Exception('Não autenticado');
            
        }

        public static function update($id ,$data){

            if (AuthController::checkAuth()) {
				$connPdo = new \PDO(DBDRIVE.': host='.DBHOST.'; dbname='.DBNAME, DBUSER, DBPASS);

                $sql = "UPDATE ".self::$table." SET 
                nome = :nome , 
                email = :email, 
                telefone = :telefone , 
                datanasc = :datanasc, 
                genero = :genero ,
                avaliacao_media = :avaliacao_media , password = :password  
                WHERE idusuario = ".$id;

                $sen = strip_tags($data['password']); //criptografar aqui
                $senha = password_hash($sen , PASSWORD_DEFAULT);

                $stmt = $connPdo->prepare($sql);
                $stmt->bindValue(':nome', $data['nome']);
                $stmt->bindValue(':email', $data['email']);
                $stmt->bindValue(':telefone', $data['telefone']);
                $stmt->bindValue(':datanasc', $data['datanasc']);
                $stmt->bindValue(':genero', $data['genero']);
                $stmt->bindValue(':avaliacao_media', $data['avaliacao_media']);
                $stmt->bindValue(':password', $senha);
                $stmt->execute();

                if ($stmt->rowCount() > 0) {
                    return 'Usuário(a) inserido com sucesso!';
                } else {
                    throw new \Exception("Falha ao update usuário(a)!");
                }
			}
			
			throw new \Exception('Não autenticado');
            
        }
    }
    
<?php
    namespace App\Models;

    class Veiculo
    {
        private static $table = 'veiculo';

        public static function select(int $id) {
            $connPdo = new \PDO(DBDRIVE.': host='.DBHOST.'; dbname='.DBNAME, DBUSER, DBPASS);

            $sql = 'SELECT * FROM '.self::$table.' WHERE id_veiculo = :id';
            $stmt = $connPdo->prepare($sql);
            $stmt->bindValue(':id', $id);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                return $stmt->fetch(\PDO::FETCH_ASSOC);
            } else {
                throw new \Exception("Nenhum usuário encontrado!");
            }
        }

        public static function selectAll() {
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

        public static function insert($data)
        {
            $connPdo = new \PDO(DBDRIVE.': host='.DBHOST.'; dbname='.DBNAME, DBUSER, DBPASS);

            $sql = 'INSERT INTO '.self::$table.'(marca, modelo, placa , cor , status , usuario_idusuario) 
            VALUES (:marca, 
                    :modelo, 
                    :placa ,
                    :cor , 
                    :status , 
                    :usuario_idusuario)';
            $stmt = $connPdo->prepare($sql);
            $stmt->bindValue(':marca', $data['marca']);
            $stmt->bindValue(':modelo', $data['modelo']);
            $stmt->bindValue(':placa', $data['placa']);
            $stmt->bindValue(':cor', $data['cor']);
            $stmt->bindValue(':status', $data['status']);
            $stmt->bindValue(':usuario_idusuario', $data['usuario_idusuario']);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                return 'Usuário(a) inserido com sucesso!';
            } else {
                throw new \Exception("Falha ao inserir veiculo(a)!");
            }
        }

        public static function update($id ,$data){
            $connPdo = new \PDO(DBDRIVE.': host='.DBHOST.'; dbname='.DBNAME, DBUSER, DBPASS);

            $sql = "UPDATE ".self::$table." SET 
            marca = :marca , 
            modelo = :modelo, 
            placa = :placa , 
            cor = :cor ,
            status = :status, 
            usuario_idusuario = :usuario_idusuario , 
            WHERE id_veiculo = ".$id;
            $stmt = $connPdo->prepare($sql);
            $stmt->bindValue(':marca', $data['marca']);
            $stmt->bindValue(':modelo', $data['modelo']);
            $stmt->bindValue(':placa', $data['placa']);
            $stmt->bindValue(':cor', $data['cor']);
            $stmt->bindValue(':status', $data['status']);
            $stmt->bindValue(':usuario_idusuario', $data['usuario_idusuario']);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                return 'Usuário(a) inserido com sucesso!';
            } else {
                throw new \Exception("Falha ao update usuário(a)!");
            }
        }
    }
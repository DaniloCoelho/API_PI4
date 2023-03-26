<?php
    namespace App\Models;

    class Estacionamento
    {
        private static $table = 'estacionamento';

        public static function select(int $id) {
            $connPdo = new \PDO(DBDRIVE.': host='.DBHOST.'; dbname='.DBNAME, DBUSER, DBPASS);

            $sql = 'SELECT * FROM '.self::$table.' WHERE idestacionamento = :id';
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
                throw new \Exception("Nenhum estacionamento encontrado!");
            }
        }

        public static function insert($data)
        {
            $connPdo = new \PDO(DBDRIVE.': host='.DBHOST.'; dbname='.DBNAME, DBUSER, DBPASS);

            $sql = 'INSERT INTO '.self::$table.' (endereco, n_vagas, vagas_disponiveis ,disponibilidade , avaliacao_media ,usuario_idusuario) VALUES (:en, :nv , :vd , :di , :am , :uid )';
            $stmt = $connPdo->prepare($sql);
            $stmt->bindValue(':en', $data['endereco']);
            $stmt->bindValue(':nv', $data['n_vagas']);
            $stmt->bindValue(':vd', $data['vagas_disponiveis']);
            $stmt->bindValue(':di', $data['disponibilidade']);
            $stmt->bindValue(':am', $data['avaliacao_media']);
            $stmt->bindValue(':uid', $data['usuario_idusuario']);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                return 'Estacionamento(a) inserido com sucesso!';
            } else {
                throw new \Exception("Falha ao inserir usuário(a)!");
            }
        }

        public static function update($id ,$data){
            $connPdo = new \PDO(DBDRIVE.': host='.DBHOST.'; dbname='.DBNAME, DBUSER, DBPASS);

            $sql = "UPDATE ".self::$table." SET 
            endereco = :endereco , 
            n_vagas = :n_vagas, 
            vagas_disponiveis = :vagas_disponiveis , 
            disponibilidade = :disponibilidade ,
            avaliacao_media = :avaliacao_media, 
            usuario_idusuario = :usuario_idusuario , 
            WHERE idestacionamento = ".$id;
            $stmt = $connPdo->prepare($sql);
            $stmt->bindValue(':endereco', $data['endereco']);
            $stmt->bindValue(':n_vagas', $data['n_vagas']);
            $stmt->bindValue(':vagas_disponiveis', $data['vagas_disponiveis']);
            $stmt->bindValue(':disponibilidade', $data['disponibilidade']);
            $stmt->bindValue(':avaliacao_media', $data['avaliacao_media']);
            $stmt->bindValue(':usuario_idusuario', $data['usuario_idusuario']);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                return 'Usuário(a) inserido com sucesso!';
            } else {
                throw new \Exception("Falha ao update usuário(a)!");
            }
        }
    }
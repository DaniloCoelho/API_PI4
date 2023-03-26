<?php
    namespace App\Models;

    class User
    {
        private static $table = 'transacoes';

        public static function select(int $id) {
            $connPdo = new \PDO(DBDRIVE.': host='.DBHOST.'; dbname='.DBNAME, DBUSER, DBPASS);

            $sql = 'SELECT * FROM '.self::$table.' WHERE idtransacoes = :id';
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

            $sql = 'INSERT INTO '.self::$table.' (data, 
                    avaliacao_locatario , 
                    avaliacao_locador , 
                    status , 
                    horario_inicio , 
                    horario_saida , 
                    tempo, 
                    veiculo_id_veiculo , 
                    estacionamento_idestacionamento)
            VALUES (:data, 
                    :avaliacao_locatario , 
                    :avaliacao_locador , 
                    :status , :horario_inicio , 
                    :horario_saida , 
                    :tempo, 
                    :veiculo_id_veiculo , :estacionamento_idestacionamento)';
            $stmt = $connPdo->prepare($sql);
            $stmt->bindValue(':data', $data['data']);
            $stmt->bindValue(':avaliacao_locatario', $data['avaliacao_locatario']);
            $stmt->bindValue(':avaliacao_locador', $data['avaliacao_locador']);
            $stmt->bindValue(':status', $data['status']);
            $stmt->bindValue(':horario_inicio', $data['horario_inicio']);
            $stmt->bindValue(':horario_saida', $data['horario_saida']);
            $stmt->bindValue(':tempo', $data['tempo']);
            $stmt->bindValue(':veiculo_id_veiculo', $data['veiculo_id_veiculo']);
            $stmt->bindValue(':estacionamento_idestacionamento', $data['estacionamento_idestacionamento']);
            
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                return 'Usuário(a) inserido com sucesso!';
            } else {
                throw new \Exception("Falha ao inserir usuário(a)!");
            }
        }

        public static function update($id ,$data){
            $connPdo = new \PDO(DBDRIVE.': host='.DBHOST.'; dbname='.DBNAME, DBUSER, DBPASS);

            $sql = "UPDATE ".self::$table." SET 
                    data = :data,
                    avaliacao_locatario = :avaliacao_locatario, 
                    avaliacao_locador = :avaliacao_locador, 
                    status = :status,
                    horario_inicio = :horario_inicio, 
                    horario_saida = :horario_saida,
                    tempo = :tempo,  
                    veiculo_id_veiculo = :veiculo_id_veiculo,  
                    estacionamento_idestacionamento = :estacionamento_idestacionamento,
                    WHERE idtransacoes = ".$id;
            $stmt = $connPdo->prepare($sql);

            $stmt->bindValue(':data', $data['data']);
            $stmt->bindValue(':avaliacao_locatario', $data['avaliacao_locatario']);
            $stmt->bindValue(':avaliacao_locador', $data['avaliacao_locador']);
            $stmt->bindValue(':status', $data['status']);
            $stmt->bindValue(':horario_inicio', $data['horario_inicio']);
            $stmt->bindValue(':horario_saida', $data['horario_saida']);
            $stmt->bindValue(':tempo', $data['tempo']);
            $stmt->bindValue(':veiculo_id_veiculo', $data['veiculo_id_veiculo']);
            $stmt->bindValue(':estacionamento_idestacionamento', $data['estacionamento_idestacionamento']);
            
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                return 'Usuário(a) inserido com sucesso!';
            } else {
                throw new \Exception("Falha ao update usuário(a)!");
            }
        }
    }
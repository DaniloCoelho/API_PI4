<?php
    namespace App\Services;

    use App\Models\Estacionamento;

    class EstacionamentoService
    {
        public function get($id = null) 
        {
            if ($id) {
                return Estacionamento::select($id);
            } else {
                return Estacionamento::selectAll();
            }
        }

        public function post() 
        {
            $data = $_POST;

            return Estacionamento::insert($data);
        }

        public function update() 
        {
            
        }

        public function delete() 
        {
            
        }
    }
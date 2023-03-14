<?php
    namespace App\Services;

    use App\Models\Veiculo;

    class VeiculoService
    {
        public function get($id = null) 
        {
            if ($id) {
                return Veiculo::select($id);
            } else {
                return Veiculo::selectAll();
            }
        }

        public function post() 
        {
            $data = $_POST;

            return Veiculo::insert($data);
        }

        public function update() 
        {
            
        }

        public function delete() 
        {
            
        }
    }
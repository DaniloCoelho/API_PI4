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

        public function post($id = null) 
        {   
            $data = $_POST;
            if ($id) {
                
                return Veiculo::update($id[0] ,$data);
                
            } else {
                
                return Veiculo::insert($data);
            }
            

            
        }
        /*
        public function update() 
        {
            
        }

        public function delete() 
        {
            
        }
        */
    }
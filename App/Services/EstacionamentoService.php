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

        public function post($id = null) 
        {   
            $data = $_POST;
            if ($id) {
                
                return Estacionamento::update($id[0] ,$data);
                
            } else {
                
                return Estacionamento::insert($data);
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
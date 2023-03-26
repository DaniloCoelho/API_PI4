<?php
    namespace App\Services;

    use App\Models\Transacoes;

    class TransacoesService
    {
        public function get($id = null) 
        {
            if ($id) {
                return Transacoes::select($id);
            } else {
                return Transacoes::selectAll();
            }
        }

        public function post($id = null) 
        {   
            $data = $_POST;
            if ($id) {
                
                return Transacoes::update($id[0] ,$data);
                
            } else {
                
                return Transacoes::insert($data);
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
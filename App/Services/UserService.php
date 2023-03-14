<?php
    namespace App\Services;

    use App\Models\User;

    class UserService
    {
        public function get($id = null) 
        {
            if ($id) {
                return User::select($id);
            } else {
                return User::selectAll();
            }
        }

        public function post($id = null) 
        {   
            $data = $_POST;
            if ($id) {
                
                return User::update($id[0] ,$data);
                
            } else {
                
                return User::insert($data);
            }
            

            
        }
        /*
        public function update() 
        {
            
        }

        public function delete() 
        {
            
        }*/
    }
    
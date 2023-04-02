<?php
    //if(isset($_POST)){
        //header('Authorization': 'Bearer ' + localStorage.getItem('user_token_jwt')
        //)
    //}
    

?>
<h2>Salvar</h2>
<form action="http://localhost/PI_api/public_html/api/user" method="post">
    Nome : <input type="text" name="nome" id="nome"><br>
    Email : <input type="text" name="email" id="email"><br>
    Telefone : <input type="text" name="telefone" id="telefone"> <br>
    Data Nasc :<input type="text" name="datanasc" id="datanasc"><br>
    Gênero<input type="text" name="genero" id="genero"><br>
    <!--<input type="text" name="avaliacao_media" id="avaliacao_media">-->
    Senha : <input type="text" name="password" id="password"> <br>

    <input type="submit" value="Ir">
</form>


<h2>Atualizar</h2>
<form action="http://localhost/PI_api/public_html/api/user/2" method="post">
    
    <input type="text" name="nome" id="nome">
    <input type="text" name="email" id="email">
    <input type="text" name="telefone" id="telefone">
    <input type="text" name="datanasc" id="datanasc">
    <input type="text" name="genero" id="genero">
    <input type="text" name="avaliacao_media" id="avaliacao_media">
    <input type="text" name="password" id="password">
    <input type="submit" value="Atualizar">
</form>
<br>

<input type="button" value="mostrar usuarios" onclick="getUsers()" >

<script src="../JWT_Client/jquery-3.5.1.min.js"></script>
    <script>
        var user_email = 'teste@gmail.com';
        var user_password = '123';
        
        function loginApi() {
            $.ajax({
                url: "http://localhost/PI_api/public_html/api/auth/login",
                method: 'POST',
                data: {'email' : user_email, 'password': user_password},
                })
                .done(function(data) {
                    //console.log("<br> entrou no done");
                    //console.log("<br>".dado);
                    localStorage.setItem('user_token_jwt', data.data);
                    
            });
        }

        function getUsers(){
            $.ajax({
                url: "http://localhost/PI_api/public_html/api/user",
                method: 'GET',
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('user_token_jwt')
                },
                })
                .done(function( data ) {
                    console.log(data);
            });
        }
    </script>
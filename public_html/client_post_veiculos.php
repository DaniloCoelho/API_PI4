<?php
    /*
    NO ATUALIZAR É USADO O USER/2 COMO SE 2 FOSSE O ID do usuario

    nesse exemplo é ultilizado o metodo post 

    entao pelo metodo post é possivel cadastrar um novo usuario e atualizar um usuario


    */

?>
<h2>Salvar</h2>
<form action="http://localhost/PI_api/public_html/api/veiculo" method="post">  
    <input type="text" name="nome" id="nome">
    <input type="text" name="email" id="email">
    <input type="text" name="telefone" id="telefone">
    <input type="text" name="datanasc" id="datanasc">
    <input type="text" name="genero" id="genero">
    <input type="text" name="avaliacao_media" id="avaliacao_media">
    <input type="text" name="password" id="password">

    <input type="submit" value="Ir">
</form>


<h2>Atualizar</h2>
<form action="http://localhost/PI_api/public_html/api/veiculo/2" method="post">
    
    <input type="text" name="nome" id="nome">
    <input type="text" name="email" id="email">
    <input type="text" name="telefone" id="telefone">
    <input type="text" name="datanasc" id="datanasc">
    <input type="text" name="genero" id="genero">
    <input type="text" name="avaliacao_media" id="avaliacao_media">
    <input type="text" name="password" id="password">
    <input type="submit" value="Atualizar">
</form>
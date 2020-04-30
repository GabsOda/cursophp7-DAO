<?php
    require_once("config.php");
    /* Metodo feito sem a classe usuário:
    $sql = new Sql();
    $usuarios = $sql->select("SELECT * FROM tb_usuarios");
    echo json_encode($usuarios);
    */

    /* Carrega um usuario
    $root = new Usuario();
    $root->loadById(6);
    echo $root;
    */

    /*carrega uma lista de usuarios
    $lista = Usuario::getList();
    echo json_encode($lista);
    */

    /*Carrega uma lista de usuarios buscando pelo login
    $search = Usuario::search("jo");
    echo json_encode($search);
    */

    /*Carrega um usuário usando o login e senha
    $usuario = new Usuario();
    $usuario->login("root", "!@#$%");
    echo $usuario;
    */
    
    /*Criando um novo usuário
    $aluno = new Usuario("aluno", "@alun0");
    $aluno->insert();
    echo $aluno;
    */

    /*Alterar um usuário 
    $usuario = new Usuario();
    $usuario->loadById(6);
    $usuario->update("professor", "!@#$%$%^%");
    echo $usuario;
    */

    //Delete um usuario
    $usuario = new Usuario();
    $usuario->loadById(5);
    $usuario->delete();
    echo $usuario;
?>
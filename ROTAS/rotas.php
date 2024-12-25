<?php
    require_once "Cadastro.php";

    $acao = $_GET['acao'];

    if($acao == 'CadastroUsuario'){       
        $login = $_POST['usuario'];
        $senha = $_POST['senha'];
        $usuario = new Usuario();
        $usuario->setUsuario($login);
        $usuario->setSenha($senha);

        $usuarioControlador = new UsuarioControlador();
        try{
            $usuarioControlador->cadastrar($usuario);
            header('Location:../PUBLICO/Login.html');
        }catch(Exception $erro){
            //tratar erro
            echo $erro->getMessage();
        }
    }else{
        header('Location:index.html');
    }

?>
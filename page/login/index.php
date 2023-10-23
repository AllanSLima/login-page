<?php
include('conexao.php');



if (isset($_POST['usuario']) || isset($_POST['senha'])) {

    if (strlen($_POST['usuario']) == 0) {
        echo "Preencha seu Usuário.";
    } else if (strlen($_POST['senha']) == 0) {
        echo "Preencha sua Senha.";
    } else {

        $usuario = ($_POST['']);
        $senha = ($_POST['']);

            header("location: http://localhost:8080/page/teste-main/formulario.php/");

}
}


?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Login</title>
</head>



<body>
    <form action="conexao.php" method="POST">
        <div class="main-login">
            <div class="left-login">
                <img src="logoCOHAB.jpg" class="left-login-image" alt="logoCOHAB">
            </div>

            <div class="right-login">
                <div class="card-login">
                    <h1>LOGIN</h1>

                        <div class="textfield">
                        <label for="usuário">Usuário</label>
                        <input type="text" name="username" placeholder="Usuário">
                        </div>

                        <div class="textfield">
                        <label for="senha">Senha</label>
                        <input type="password" name="password" placeholder="Senha">
                        </div>

                        <button type="submit" class="btn-login">Entrar</button>
                </div>
            </div>

            <p> 
                ©2023 COHAB-SP - Todos os direitos reservados.
                <br>
                Companhia Metropolitana de Habitação de São Paulo.
            </p>
    
        </div>
    </form>
</body>
</html>

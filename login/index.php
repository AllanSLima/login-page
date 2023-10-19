<?php
include('conexao.php');

if (isset($_POST['usuario']) || isset($_POST['senha'])) {

    if (strlen($_POST['usuario']) == 0) {
        echo "Preencha seu Usuário.";
    } else if (strlen($_POST['senha']) == 0) {
        echo "Preencha sua Senha.";
    } else {

        $usuario = $mysqli->real_escape_string($_POST['usuario']);
        $senha = $mysqli->real_escape_string($_POST['senha']);

        $sql_code = "SELECT * FROM usuarios WHERE usuario = '$usuario' AND senha = '$senha'";
        $sql_query = $mysqli->query($sql_code) or die("Falha na execucao do código SQL: " . $mysqli->error);

        $quantidade = $sql_query->num_rows;

        if ($quantidade == 1) {

            $usuario = $sql_query->fetch_assoc();

            if (!isset($_SESSION)) {
                session_start();
            }

            $_SESSION['id'] = $usuario['id'];
            $_SESSION['nome'] = $usuario['nome'];

            header("Location: painel.php");

        } else {
            echo "Falha ao logar! Usuário ou senha inválidos.";
        }
    }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Login</title>
</head>



<body>
    <form action="" method="POST">
        <div class="main-login">
            <div class="left-login">
                <img src="logoCOHAB.jpg" class="left-login-image" alt="logoCOHAB">
            </div>

            <div class="right-login">
                <div class="card-login">
                    <h1>LOGIN</h1>

                        <div class="textfield">
                        <label for="usuário">Usuário</label>
                        <input type="text" name="usuario" placeholder="Usuário">
                        </div>

                        <div class="textfield">
                        <label for="senha">Senha</label>
                        <input type="password" name="senha" placeholder="Senha">
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

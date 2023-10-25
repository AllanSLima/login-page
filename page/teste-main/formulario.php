<?php

    if(isset($_POST['submit']))
    {
        // print_r('Host: ' . $_POST['Host']);
        // print_r('<br>');
        // print_r('Descrição: ' . $_POST['Descricao']);
        // print_r('<br>');
        // print_r('IP: ' . $_POST['IP']);
        // print_r('<br>');
        // print_r('IP de Gerenciamento: ' . $_POST['ip_de_geren']);
        // print_r('<br>');
        // print_r('Usuário/Senha: ' . $_POST['Usuario/Senha']);

        include_once('config.php');

        $host = $_POST['Host'];
        $descricao = $_POST['Descricao'];
        $ip = $_POST['IP'];
        $ip_geren = $_POST['ip_de_geren'];
        $usuario_senha = $_POST['Usuario/Senha'];

        $result = mysqli_query($conexao, "INSERT INTO dados(host,descricao,ip,ip_geren,usuario_senha) VALUES ('$host','$descricao','$ip','$ip_geren','$usuario_senha')");
  
    }

        
?>


<style>
    * {
        margin: 0;
        padding: 0;
    }

    body {
        font-family: 'Rubik', sans-serif;
        background-image: url(img/fundo.jpg);
    }

    .box {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%,-50%);
        background-color: rgba(0, 0, 0, 0.9);
        padding: 3em 5em 5em 5em;
        border-radius: 1em;
        width: 20%;
        color: #fff;
    }

    fieldset {
        border: 3px solid dodgerblue;
        border-radius: 0.5em;
    }

    h1 {
        text-align: center;
        font-weight: 400;
        padding: 1em;
    }

    .input-box {
        position: relative;
    }

    .input-user {
        background: none;
        border: none;
        border-bottom: 1px solid #fff;
        outline: none;
        color: #fff;
        font-size: 15px;
        width: 100%;
        letter-spacing: 2px;
        padding: 3px;
    }

    label {
        position: absolute;
        top: -25px;
        left: 0;
    }

    #submit {
        background-color: dodgerblue;
        border: none;
        border-radius: 0.5em;
        padding: 1em;
        width: 100%;
        color: #fff;
        font-size: 18px;
        cursor: pointer;
    }

    #submit:hover {
        background-color: deepskyblue;
        transition: 1s;
    }
</style>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar os Dados</title>
    <link rel="stylesheet" href="formulario.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700;800&family=Rubik:wght@300;400;500;600&display=swap" rel="stylesheet">
</head>


<body>
    <div class="box">
        <form action="formulario.php" method="POST">
            <h1>Editar Dados</h1>
            <br>
            <div class="input-box">
                <input type="text" name="Host" id="Host" class="input-user" required>
                <label for="Host">Host</label>
            </div>
            <br><br><br><br>
            <div class="input-box">
                <input type="text" name="Descricao" id="Descricao" class="input-user" required>
                <label for="Descricao">Descrição</label>
            </div>
            <br><br><br><br>
            <div class="input-box">
                <input type="text" name="IP" id="IP" class="input-user" required>
                <label for="IP">IP</label>
            </div>
            <br><br><br><br>
            <div class="input-box">
                <input type="text" name="ip_de_geren" id="ip_de_geren" class="input-user" required>
                <label for="ip_de_geren">IP De Gerenciamento</label>
            </div>
            <br><br><br><br>
            <div class="input-box">
                <input type="text" name="Usuario/Senha" id="Usuario/Senha" class="input-user" required>
                <label for="Usuario/Senha">Usuário/Senha</label>
            </div>
            <br><br>
            <input type="submit" name="submit" id="submit">
        </form>
    </div>
</body>


</html>
<!-- Testar no office -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
    <form action="ldap.php" method="post">

            <div class="main-login">
            <div class="left-login">
                <img src="windows.png" class="left-login-image" alt="logoWindows">
            </div>
            <div class="right-login">
            <div class="card-login">


                <h1>LOGIN</h1>


                <div class="textfield">
                    <label for="usuário">Usuário</label>
                    <input type="text" name="user" placeholder="Nome de usuário" /><br>
                </div>


                <div class="textfield">
                    <label for="senha">Senha</label>
                    <input type="password" name="senha" placeholder="Senha" /><br>
                    <?php
                    if (isset($_GET['error_message'])) {
                    $error_message = $_GET['error_message'];
                    echo '<div class="error">' . $error_message . '</div>';
                    }
                    ?>
                </div>


                <input class="btn-login" type="submit" value="Login" />
                
                </div>
                </div>
                <p> 
                ©2023 Dominio-SP - Todos os direitos reservados.
                <br>
                Companhia Dominio-SP.
                </p>
    
                </div>


                </div>

    </form>
</body>
</html>

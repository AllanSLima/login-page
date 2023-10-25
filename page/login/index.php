<!-- Testar no office -->

<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autenticar</title>
</head>
<body>
    <h1>Autenticar</h1>
    <form action="ldap.php" method="post">
        
        <?php
        /*
            if (isset($error_message)) {
                echo '<div class="error">' . $error_message . '</div>';
            }
            */
        ?>
        
        <input type="text" name="user" placeholder="Nome de usuário" /><br>
        <input type="password" name="senha" placeholder="Senha" /><br>
        <input type="submit" value="Login" />
    </form>
</body>
</html> -->

<!-- Testar em casa -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autenticar</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Autenticar</h1>
    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $error_message = ''; // Inicializa a mensagem de erro

        if (isset($_POST['user']) && isset($_POST['senha'])) {
            $ldap_dn = "uid=" . $_POST["user"] . ",dc=example,dc=com";
            $ldap_password = $_POST["senha"];

            $ldap_con = ldap_connect("ldap.forumsys.com");
            ldap_set_option($ldap_con, LDAP_OPT_PROTOCOL_VERSION, 3);

            if ($ldap_con) {
                $bind = @ldap_bind($ldap_con, $ldap_dn, $ldap_password);

                if ($bind) {
                    // Autenticação bem-sucedida
                    header("Location: http://localhost/page/teste-main/formulario.php");
                    // Agora, você pode realizar operações adicionais, como verificar a associação a grupos.
                } else {
                    // Falha na autenticação
                    $error_message = "Login incorreto. Credenciais inválidas.";
                }

                // Fechar a conexão LDAP corretamente.
                ldap_unbind($ldap_con);
            } else {
                // Não foi possível conectar ao servidor LDAP
                $error_message = "Erro na conexão LDAP.";
            }
        } else {
            // Campos em branco
            $error_message = "Campos de nome de usuário e senha não podem estar em branco.";
        }
    }
    ?>
    <?php
    if (!empty($error_message)) {
        echo '<div class="error">' . $error_message . '</div>';
    }
    ?>
    <form method="post">
        <input class="user" type="text" name="user" placeholder="Nome de usuário" /><br>
        <input class="senha" type="password" name="senha" placeholder="Senha" /><br>
        <input class="btn-login" type="submit" value="Login" />
    </form>
</body>
</html>


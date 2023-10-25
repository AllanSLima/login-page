<!-- testar no office -->

<?php
/*
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = isset($_POST['user']) ? $_POST['user'] : '';
    $password = isset($_POST['senha']) ? $_POST['senha'] : '';

    if (!empty($username) && !empty($password)) {
        $ldapconfig['host'] = 'ldap://cohabsp.sp.gov.br';
        $ldapconfig['port'] = 389;
        $ldapconfig['basedn'] = 'dc=cohabsp,dc=sp,dc=gov,dc=br';

        // Adicione o sufixo ao nome de usuário
        $username = 'cohabsp\\' . $username;

        // Conectar ao servidor LDAP
        $ds = ldap_connect($ldapconfig['host'], $ldapconfig['port']);
        ldap_set_option($ds, LDAP_OPT_PROTOCOL_VERSION, 3);
        ldap_set_option($ds, LDAP_OPT_REFERRALS, 0);

        if ($ds) {
            // Tentar fazer a ligação com as credenciais fornecidas
            $bind = ldap_bind($ds, $username, $password);

            if ($bind) {
                // Autenticação bem-sucedida
                echo "Login correto.";

                // Agora, você pode realizar operações adicionais, como verificar a associação a grupos.
            } else {
                // Falha na autenticação
                $error_message = "Login incorreto. Credenciais inválidas.";
            }

            // Fechar a conexão LDAP
            ldap_close($ds);
        } else {
            // Não foi possível conectar ao servidor LDAP
            $error_message = "Erro na conexão LDAP.";
        }
    } else {
        // Campos em branco
        $error_message = "Campos de nome de usuário e senha não podem estar em branco.";
    }
}*/
?>

<!-- testar em casa -->

<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
$error_message = ''; // Inicializa a mensagem de erro

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['user']) && isset($_POST['senha'])) {
        $ldap_dn = "uid=" . $_POST["user"] . ",dc=example,dc=com";
        $ldap_password = $_POST["senha"];

        $ldap_con = ldap_connect("ldap.forumsys.com");
        ldap_set_option($ldap_con, LDAP_OPT_PROTOCOL_VERSION, 3);

        if ($ldap_con) {
            $bind = @ldap_bind($ldap_con, $ldap_dn, $ldap_password);

            if ($bind) {
                // Autenticação bem-sucedida
                echo "Login correto.";
                header("Location: localhost");

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


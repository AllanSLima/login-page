<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = isset($_POST['user']) ? $_POST['user'] : '';
    $password = isset($_POST['senha']) ? $_POST['senha'] : '';

    if (!empty($username) && !empty($password)) {
        $ldapconfig['host'] = 'ldap://cohabsp.sp.gov.br';
        $ldapconfig['port'] = 389;
        $ldapconfig['basedn'] = 'dc=cohabsp,dc=sp,dc=gov,dc=br';

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
                echo "Login incorreto. Credenciais inválidas.";
            }

            // Fechar a conexão LDAP
            ldap_close($ds);
        } else {
            // Não foi possível conectar ao servidor LDAP
            echo "Erro na conexão LDAP.";
        }
    } else {
        // Campos em branco
        echo "Campos de nome de usuário e senha não podem estar em branco.";
    }
}
?>

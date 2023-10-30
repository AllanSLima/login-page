<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $server = "10.2.30.1"; // Endereço do servidor LDAP
    $user = $_POST['user']; // Obtém o nome de usuário do formulário
    $pass = $_POST['senha']; // Obtém a senha do formulário

    if (!empty($user) && !empty($pass)) {
        if (!($connect = @ldap_connect($server))) {
            die("Não foi possível conectar ao servidor LDAP");
        }

        if (!($bind = @ldap_bind($connect, $user, $pass))) {
            // se não validar, exibe uma mensagem de erro
            echo "Usuário ou senha inválidos";
        } else {
            // se validar, busca o usuário em um grupo específico
            $user = 'allan.lima';
            $samaccountname = $user;

            $original_dn = "OU=Departamentos,DC=cohabsp,DC=sp,DC=gov,DC=br";
            $filter = "(memberOf=cn=own_zammadadm,ou=_usermanagedgroups,dc=cohabsp,dc=sp,dc=gov,dc=br)";
            $justthese = array("memberOf");

            $res = ldap_search($connect, $original_dn, "(samaccountname=$samaccountname)");
            $first = ldap_first_entry($connect, $res);
            $data = ldap_get_dn($connect, $first);


            if ($data) {
                // Aqui você pode processar os dados do usuário encontrado, se necessário
                echo "Usuário autenticado com sucesso. Dados: $data <br />";

                $sr = ldap_search($connect, $data, $filter, $justthese);
                $info = ldap_get_entries($connect, $sr);

                echo $info["count"] . " entries returned. \n";
            } else {
                echo "Usuário não encontrado no LDAP.";
            }

            // Fechar a conexão LDAP
            ldap_close($connect);
        }
    } else {
        // Caso os campos estejam vazios
        echo "Por favor, preencha tanto o nome de usuário quanto a senha.";
    }
} else {
    // Se o método da requisição não for POST
    echo "Método inválido para lidar com as credenciais.";
}
?>
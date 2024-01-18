<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $server = "10.2.30.1"; // Endereço do servidor LDAP
    $user = $_POST['user']; // Obtém o nome de usuário do formulário
    $pass = $_POST['senha']; // Obtém a senha do formulário

    if (!empty($user) && !empty($pass)) {
        // Verifica se o domínio não está presente e adiciona o sufixo 'cohabsp\' se necessário
        if (strpos($user, '@cohabsp.sp.gov.br') === false) {
            $user = 'cohabsp\\' . $user;
        } else {
            // Remove o sufixo 'cohabsp\' se o domínio estiver presente
            $user = str_replace('cohabsp\\', '', $user);
        }
    }

    if (!empty($user) && !empty($pass)) {
        if (!($connect = @ldap_connect($server))) {
            $error_message = "Não foi possível conectar ao servidor LDAP";
            header("Location: index.php?error_message=" . urlencode($error_message));
            exit();
        }

        if (!($bind = @ldap_bind($connect, $user, $pass))) {
            $error_message = "Usuário ou senha inválidos";
            header("Location: index.php?error_message=" . urlencode($error_message));
            exit();
        } else {
            // Remove o sufixo 'cohabsp\' se estiver presente
            $user = str_replace('cohabsp\\', '', $user);

            // Remove o domínio '@cohabsp.sp.gov.br' se estiver presente
            $user = strstr($user, '@', true) ?: $user;
            $samaccountname = $user;

            $original_dn = "OU=Departamentos,DC=cohabsp,DC=sp,DC=gov,DC=br";
            $filter = "(memberOf=cn=own_zammadadm,ou=_usermanagedgroups,dc=cohabsp,dc=sp,dc=gov,dc=br)";
            $justthese = array("memberOf");

            $res = ldap_search($connect, $original_dn, "(samaccountname=$samaccountname)");
            $first = ldap_first_entry($connect, $res);
            $data = ldap_get_dn($connect, $first);

            if ($data) {
                $sr = ldap_search($connect, $data, $filter, $justthese);
                $info = ldap_get_entries($connect, $sr);

                if ($info["count"] === 0) {
                    $error_message = "Usuário não tem acesso a estas informações";
                    ldap_close($connect); // Fechando a conexão
                    header("Location: index.php?error_message=" . urlencode($error_message));
                    exit();
                } else {
                    ldap_close($connect); // Fechando a conexão
                    header("Location: http://localhost:8080/page/teste-main/sistema.php");
                    exit();
                }
            } else {
                ldap_close($connect); // Fechando a conexão
                $error_message = "Usuário não encontrado no LDAP.";
                header("Location: index.php?error_message=" . urlencode($error_message));
                exit();
            }
        }
    } else {
        $error_message = "Por favor, preencha tanto o nome de usuário quanto a senha.";
        header("Location: index.php?error_message=" . urlencode($error_message));
        exit();
    }
} else {
    $error_message = "Método inválido para lidar com as credenciais.";
    header("Location: index.php?error_message=" . urlencode($error_message));
    exit();
}
?>

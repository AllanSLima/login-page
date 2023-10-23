<?php


$domain = 'cohabsp.sp.gov.br';
$username = 'allan.lima';
$password = '563558#Aa';
$ldapconfig['host'] = '10.2.30.1';
$ldapconfig['port'] = 389;
$ldapconfig['basedn'] = 'dc=cohabsp, dc=sp, dc=gov, dc=br';

$ds=ldap_connect($ldapconfig['host'], $ldapconfig['port']);
ldap_set_option($ds, LDAP_OPT_PROTOCOL_VERSION, 3);
ldap_set_option($ds, LDAP_OPT_REFERRALS, 0);

$dn="ou=Technology,".$ldapconfig['basedn'];
$bind=ldap_bind($ds, $username .'@' .$domain, $password);
$isITuser = ldap_search($bind,$dn,'(&(objectClass=User)(sAMAccountName=' . $username. '))');
if ($isITuser) {
    echo("Login correct");
} else {
    echo("Login incorrect");
}

?>
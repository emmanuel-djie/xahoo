<?php

$config = array(
    'merchantAccount' => '10000419568',
    'merchantPublicKey' => 'MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQCKxayKB/TqDXtcKaObOPPzVL3r++ghEP45nai9cjG0JQt9m0F5+F8RVygizxS83iBTHd5bJbrMPLDh3GvjGm1bbJhzO4m2bF2fQm2uJ0C3ckdm9AZK8fqzcncpu2dy1zFyucFyHhKIgZryqfW5PS3G9UohS4698qA5j4dceWf5PwIDAQAB',
    'merchantPrivateKey' => 'MIICdwIBADANBgkqhkiG9w0BAQEFAASCAmEwggJdAgEAAoGBAIrFrIoH9OoNe1wpo5s48/NUvev76CEQ/jmdqL1yMbQlC32bQXn4XxFXKCLPFLzeIFMd3lslusw8sOHca+MabVtsmHM7ibZsXZ9Cba4nQLdyR2b0Bkrx+rNydym7Z3LXMXK5wXIeEoiBmvKp9bk9Lcb1SiFLjr3yoDmPh1x5Z/k/AgMBAAECgYEAgAjVohypOPDraiL40hP/7/e1qu6mQyvcgugVcYTUmvK64U7HYHNpsyQI4eTRq1f91vHt34a2DA3K3Phzifst/RoonlMmugXg/Klr5nOXNBZhVO6i5XQ3945dUeEq7LhiJTTv0cokiCmezgdmrW8n1STZ/b5y5MIOut8Y1rwOkAECQQC+an4ako+nPNw72kM6osRT/qC589AyOav60F1bHonK6NWzWOMiFekGuvtpybgwt4jbpQxXXRPxvJkgBq873fwBAkEAupGaEcuqXtO2j0hJFOG5t+nwwnOaJF49LypboN0RX5v8nop301//P16Bs/irj5F/mAs9lFR4GZ3bxL8zs5r1PwJBALa1MDMHFlf+CcRUddW5gHCoDkjfLZJDzEVp0WoxLz5Hk2X3kFmQdHxExiCHsfjs4qD/CYx6fzyhHrygLVxgcAECQAT8z3maUDuovUCnVgzQ2/4mquEH5h8Cxe/02e46+rPrn509ZmaoMlKnXCBLjYqRATA3XLYSbAODTNS9p8wtYFECQHa/xgB+nYWoevPC/geObOLAP9HMdNVcIAJq2rgeXVI4P7cFXvksRborHmjuy1fltoR0003qlSg82mxzABbzYUs=',
    'yeepayPublicKey' => 'MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQCj4k0oTc05UzrvBB6g24wsKawTlIX5995q3CQYrgM5un9mKEQc/NQIsJqqG2RUHyXUIBogMaMqG1F1QPoKMaXeVfVUSYa8ZU7bV9rOMDUT20BxAmPbtLlWdTSXDxXKXQxwkyfUAih1ZgTLI3vYg3flHeUA6cZRdbwDPLqXle8SIwIDAQAB'
);

include 'yeepay.class.php';
$yeepay = new yeepay($config);

function dump($var) {
	echo '<pre>';
	print_r($var);
	echo '</pre><hr/>';
}

?>

<?php
    include "ws-security.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Procedimentos</title>
</head>
<body>

<?php
try 
{
    $options = array( 'location' => 'https://servicos.saude.gov.br/sigtap/ProcedimentoService/v1', 
                    'encoding' => 'utf-8', 
                    'soap_version' => SOAP_1_2,
                    'connection_timeout' => 180,
                    'trace'        => 1, 
                    'exceptions'   => 1 );

    $client = new SoapClient('https://servicos.saude.gov.br/sigtap/ProcedimentoService/v1?wsdl', $options);   
    $client->__setSoapHeaders(soapClientWSSecurityHeader('SIGTAP.PUBLICO', 'sigtap#2015public'));

    $function = 'pesquisarProcedimentos';

    $arguments= array( 'proc' => array(
                            'codigoGrupo' => '03',
                            'codigoSubgrupo' => '05', //Opcional
                            'competencia' => '201501', //Opcional
                            'Paginacao' => array(
                                'registroInicial' => '1',
                                'quantidadeRegistros' => '20',
                                'totalRegistros' => '1000' //Opcional
                            )
                        )
                    );


    $result = $client->__soapCall($function, $arguments);

    print("<pre>".print_r($result,true)."</pre>");
} 
catch (Exception $e) 
{
    echo "<h2>Exception Error!</h2>";
    print("<pre>".print_r($e,true)."</pre>");
}
?>
	
</body>
</html>
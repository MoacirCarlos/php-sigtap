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

    $function = 'detalharProcedimento';

    /*
        Opções para serem utilizadas no parâmetro "categoriaDetalheAdicional"
        DESCRICAO,CIDS,CBOS,CATEGORIAS_CBO,TIPOS_LEITO,SERVICOS_CLASSIFICACOES,HABILITACOES,GRUPO
        S_HABILITACAO,INCREMENTOS,COMPONENTES_REDE,ORIGENS_SIGTAP,ORIGENS_SIA_SIH,REGRAS_CONDIC
        IONADA,RENASES,TUSS
    */

    $arguments= array( 'proc' => array(
                            'codigoProcedimento' => '0305010018',
                            'DetalhesAdicionais' => array(
                                'categoriaDetalheAdicional' => 'DESCRICAO',
                                'Paginacao' => array( //Opcional
                                    'registroInicial' => '1',
                                    'quantidadeRegistros' => '20',
                                    'totalRegistros' => '1000' //Opcional
                                )
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
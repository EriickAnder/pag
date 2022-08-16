<?php

$conteudo = implode(',', $_POST);

$fp = fopen("novo.txt", "wb");

fwrite($fp, $conteudo);

fclose($fp);


$url_data = "https://cap-ibra.conted.tech/api/create-student";
$ch = curl_init();
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
curl_setopt($ch, CURLOPT_SSL_CIPHER_LIST, 'DEFAULT@SECLEVEL=1');
curl_setopt($ch, CURLOPT_URL, $url_data);
curl_setopt($ch, CURLOPT_POST, true);

$parametros = array(
    'name' => $_POST['nome'],
    'identification_document' => $_POST['cpf'],
    'email' => $_POST['email'],
    'phone' => $_POST['telefone'],
    'zip_code' => $_POST['cep'],
    'street_number' => 20



);

$data_Post = http_build_query($parametros);

curl_setopt($ch, CURLOPT_POSTFIELDS, $data_Post);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    "content-type: application/x-www-form-urlencoded"
));

$result = curl_exec($ch);


$response = html_entity_decode($result);
$rows =  simplexml_load_string($response);
curl_close($ch);
return $rows;

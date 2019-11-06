<?php
$url= "https://services.adroll.com/api/v1/product_feeds/set_parser_configs/";
$data = array (
        'feed_config' => 'JTLJZMPRUVG5PLNF7OV7CI',
		'parser_configs'=>'{ "id": { "path": "0", "type": "text", "attribute": "text","regular_expression":"","regular_expression_replace":"", "is_required": "true" }, "title": { "path": "1", "type": "text", "attribute": "text","regular_expression":"","regular_expression_replace":"", "is_required": "true" }, "image": { "path": "6", "type": "image", "attribute": "text","regular_expression":"","regular_expression_replace":"", "is_required": "true" }, "url": { "path": "5", "type": "text", "attribute": "text","regular_expression":"","regular_expression_replace":"", "is_required": "true" }, "price": { "path": "9", "type": "price", "attribute": "text","regular_expression":"","regular_expression_replace":"", "is_required": "true" }, "availability": { "path": "8", "type": "text", "attribute": "text","regular_expression":"","regular_expression_replace":"/1", "is_required": "false" }, "category": { "path": "3", "type": "text", "attribute": "text","regular_expression":"","regular_expression_replace":"", "is_required": "false" } }',
		'apikey'=>'FxnkhZtq5eXBdlIdONMgrvWltkWhYSWA'
        );

//Call set_parser_configs endpoint  
$response = callAPI($url,$data);
echo $response;
exit;


$responseJSON = json_decode($response, true);
if($responseJSON["results"]){
	
	//call autoconfigure endpoint	
	$url= "https://services.adroll.com/api/v1/product_feeds/autoconfigure";
    $data = array (
        'advertisable' => 'JTLJZMPRUVG5PLNF7OV7CI',
		'url'=>'http://10.20.106.166/feedparser/example_feed_txt.txt',
		'apikey'=>'FxnkhZtq5eXBdlIdONMgrvWltkWhYSWA'
        );	
	$response = callAPI($url,$data);
	$responseJSON = json_decode($response, true);
	print_r($responseJSON);	
	
}else {	
  echo $response;
}

function callAPI($url, $data)
{	       
	$params = '';
	foreach($data as $key=>$value)
			$params .= $key.'='.$value.'&';
			 
	$params = trim($params, '&');

	// create curl resource
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url.'?'.$params ); //Url together with parameters
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //Return data instead printing directly in Browser	
	$credentials = "seadroll@gmail.com:Needtotest";// Set credentials
	curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
	curl_setopt($ch, CURLOPT_USERPWD, $credentials);
	// $output contains the output string
	$result = curl_exec($ch);

	if(curl_errno($ch)) {    //catch if curl error exists and show it
		return 'Curl error: ' . curl_error($ch);
	}  
	else {
		curl_close($ch);
		return  $result;	
	}	
	
}   


 ?>
 
 

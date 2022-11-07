<?php

$connect = new PDO("mysql:host=127.0.0.1;dbname=apache_broker", "root", "");

$received_data = json_decode(file_get_contents("php://input"));

$data = array();

if($received_data->query != '')
{
	$query = "
	SELECT * FROM Broker_Policies 
	WHERE customer_name LIKE '%".$received_data->query."%' 
	OR customer_address LIKE '%".$received_data->query."%' 
	OR Premium LIKE '%".$received_data->query."%' 
	OR policy_type LIKE '%".$received_data->query."%' 
	OR insurer_name LIKE '%".$received_data->query."%' 

	ORDER BY policy_type DESC
	";
}
else
{
	$query = "
	SELECT * FROM Broker_Policies 
	ORDER BY policy_type DESC
	";
}

$statement = $connect->prepare($query);

$statement->execute();

while($row = $statement->fetch(PDO::FETCH_ASSOC))
{
	$data[] = $row;
}

echo json_encode($data);

?>
<?php
$con =mysqli_connect((getenv('DB_HOST') ?: 'localhost'), (getenv('DB_USER') ?: 'root'), (getenv('DB_PASS') !== false ? getenv('DB_PASS') : ''), (getenv('DB_NAME') ?: 'gendrug'));

$response = array(); 


$query = mysqli_query($con, "SELECT * FROM branddetails ") or die(mysqli_error($con));

$count = mysqli_num_rows($query);


if ($count > 0) {
    while ($row = mysqli_fetch_array($query)) {
       
         $data["Brand_id"] = $row["Brand_id"];
         $data["Brand_name"] = $row["Brand_name"];
         
         $fetch_data[]= $data;
    }
   
    $response['brand'] = $fetch_data;
    $response['flag'] = 1;
   

} else {
    
    $response['flag'] = 0;
    $response["message"] = "No Record Found";
  
    
}
// echo"<pre>";
// print_r($response);

echo json_encode($response);

<?php
$con =mysqli_connect((getenv('DB_HOST') ?: 'localhost'), (getenv('DB_USER') ?: 'root'), (getenv('DB_PASS') !== false ? getenv('DB_PASS') : ''), (getenv('DB_NAME') ?: 'gendrug'));

$response = array(); 


$query = mysqli_query($con, "SELECT * FROM prescriptiondetails ") or die(mysqli_error($con));

$count = mysqli_num_rows($query);


if ($count > 0) {
    while ($row = mysqli_fetch_array($query)) {
       
         $data["Pres_id"] = $row["Pres_id"];
         $data["Pres_bname"] = $row["Pres_bname"];
         $data["Pres_gname"] = $row["Pres_gname"];
         $data["Pres_details"] = $row["Pres_details"];
         $data["Pres_price"] = $row["Pres_price"];
         
         $fetch_data[]= $data;
    }
   
    $response['Prescription'] = $fetch_data;
    $response['flag'] = 1;
   

} else {
    
    $response['flag'] = 0;
    $response["message"] = "No Record Found";
  
    
}
// echo"<pre>";
// print_r($response);

echo json_encode($response);


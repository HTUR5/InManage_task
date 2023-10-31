<?php 

$url = 'https://cdn2.vectorstock.com/i/1000x1000/23/81/default-avatar-profile-icon-vector-18942381.jpg'; 

$ch = curl_init($url); 

$dir = './'; 

$file_name = "icon.jpg"; 

$save_file_loc = $dir . $file_name; 

$fp = fopen($save_file_loc, 'wb'); 

// It set an option for a cURL transfer 
curl_setopt($ch, CURLOPT_FILE, $fp); 
curl_setopt($ch, CURLOPT_HEADER, 0); 

// Perform a cURL session 
curl_exec($ch); 

// Closes a cURL session and frees all resources 
curl_close($ch); 

// Close file 
fclose($fp); 
?>

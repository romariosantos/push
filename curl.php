<?php  
  $ch = curl_init();
 
  $key  = 'key=AIzaSyB_cFsUwNs1k3hnn86G89gLRtKGPtWTDaE';

  $keyU = 'fiN8T7jRXcc:APA91bGADDkSdBNfcDSqMdexV5eqj6ujrcy1v_i0toTDAOxQv_PP9ndvdf0j-X26miqaWeryzKMrt9shm8gJ4smqwzwW5o052PGOgBPWrd7dJgNKHUKiUPo_PubmIbIRfM6kAx5slBGT'; 

  $json = array();
 
  $json['registration_ids'] = '{'.$keyU.'}';

  curl_setopt($ch, CURLOPT_URL, "https://android.googleapis.com/gcm/send");
  curl_setopt($ch, CURLOPT_POST, true);
  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Authorization'.$key));
  curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(  $json ) );
 
  $stuff = curl_exec($ch);
  
  var_dump($stuff) ;

  curl_close($ch);
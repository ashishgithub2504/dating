<?php
 $host = 'localhost:3306';  
 $user = 'root';  
 $pass = 'okbid123';  
 $dbname = 'okbid';  
 $conn = mysqli_connect($host, $user, $pass,$dbname);  
 
 if(!$conn){  
    die('Could not connect: '.mysqli_connect_error());  
 }  
 echo 'Connected successfully<br/>';   

 /*------------------------notify auction start-------------*/
    $allUser = "SELECT * FROM users";
	$result = mysqli_query($conn, $allUser); 
    $noti = new Notification();
    if (mysqli_num_rows($result) > 0) {  
	    while($row = mysqli_fetch_assoc($result)) {  
	        $smsg = "בוקר טוב! המכרז יתחיל בשעה 10:00. בהצלחה! ";
	        if($row['language'] == 1) {
	            $smsg = "Hurry up! Auction will start from 10 am"; 
	        }
			echo $row['phone'] . '<br/>';
			echo $row['device_token'] . '<br/>';
			echo "=========================== <br/><br/><br/>";
	    	$noti->send_notification($row['device_token'],$smsg);   
	    }  
	} 
/*----------------------------------------------------------------*/
 $sql = ' UPDATE properties SET status="2" WHERE status=1'; 
 if (mysqli_query($conn, $sql)) {
      echo "Record updated successfully";
   } else {
      echo "Error updating record: " . mysqli_error($conn);
   }
 mysqli_close($conn);
 
/**
 * 
 */
class Notification {
	
	function send_notification($result,$msg){  
    	$aps['property_id'] = 1;
        $aps['type'] = 'home';   
        //$aps['body'] = $msg;
        //$aps['title'] = 'Ok bid';
        $device = array($result);    
        $registrationIds = $device; 
        // prep the bundle
        $msg = array 
        (   
            'body'   => $msg,  
            'title'     => 'Ok bid', 
            // //'subtitle'    => 'This is a subtitle. subtitle',
            // //'tickerText'=> 'Ticker text here...Ticker text here...Ticker text here',
            // 'vibrate'   => 1,
            // 'sound'     => 1,
            // 'largeIcon' => 'large_icon',
            // 'smallIcon' => 'small_icon',
            'aps' => $aps   
        );
        $fields = array  
        (
            'registration_ids'  => $registrationIds,
            'data'=> $msg
        ); 
        
        $key = 'AAAApXld0Dg:APA91bFzj4cQpzTFlN4T4BPlY7-Vu1Xy8f0V2aoQK52z0sdjd5dJ4MtnwvoO0BquybiSooRuwVeK8XQpm4XqO-RhYPtcDCNA2NTHKJ0BA30MuBZkgQl_ONZJfMzXs5lZJwzIw7sHCZyM';  // For customer

            $headers = array(
                'Authorization: key=' . $key, //'AIzaSyDzGmc2V0y9LI9MbJt8oK3TVwU9BW0CLbU',//GOOGLE_API_KEY,
                'Content-Type: application/json'
            );
         
       /* $headers = array
        (
            'Authorization: key=AAAAOp5wKgM:APA91bEy7AqLugGptjMbw2BIkqlkBwJFVxmH12UzKtX536oNaJcfezNDILz9VNWfHYjJFoki9Au8AMIJ7TwH320NC7NNRkWCkvgVL2Cy6p-sf2nz-1rGMFoNA4a-Rlnl-7-vPb24NIsC',
            'Content-Type: application/json' 
        );*/
         
        $ch = curl_init();
        curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');  
        curl_setopt( $ch,CURLOPT_POST, true );
        curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
        curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
        $result = curl_exec($ch);
        curl_close($ch); 
        return true; 
    }
}
 
?>
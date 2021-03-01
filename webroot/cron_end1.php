<?php
 date_default_timezone_set('Asia/Kolkata');
 $c_date = date('Y-m-d h:i:s');
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
    $countuser = mysqli_num_rows($result);
    if (mysqli_num_rows($result) > 0) { 
        $c = 0;
        while($row = mysqli_fetch_assoc($result)) {  
            $smsg = "Auction has been ended";
            if($row['language'] == 2) {
                $smsg = "יום המכרזים הסתיים. מזל טוב לכל הרוכשים המאושרים";
            }
           $noti->send_notification($row,$smsg,"general");   
           $c++;
        }   
    } 
    
    
/*----------------------------------------------------------------*/
$sql = "SELECT id,user_id FROM properties WHERE status=2"; 

 $result = mysqli_query($conn, $sql); 
 if (mysqli_num_rows($result) > 0) {   
      
    $sold_data = [];$bid_data =[];$all=[];$data = [];
    while($row = mysqli_fetch_assoc($result)) {
        $all[] = $row['id'];
        $bid_property = "SELECT * FROM property_bids WHERE property_id='".$row['id']."'";
        $bid = mysqli_query($conn, $bid_property); 
   // print_r($bid);die;
        $noti = new Notification();
        if(mysqli_num_rows($bid) > 0){
            $sold_data[] = $row['id'];
            /*---------check maximum bid person------*/
            $final = "SELECT * FROM property_bids WHERE property_id='".$row['id']."' ORDER BY id DESC LIMIT 1";
            $final_bid = mysqli_query($conn, $final);
            $final_data = mysqli_fetch_assoc($final_bid);

            /*-------update sold date and user id -------*/
            $update = 'UPDATE properties SET sold_date = "'.$c_date.'",status=3,buyer_id='.$final_data["user_id"].'  WHERE id='.$row['id'].'';
            mysqli_query($conn, $update);
            /*---------------buyer notofication----------*/
            $buyer = "SELECT * FROM users WHERE id='".$final_data['user_id']."' ORDER BY id DESC LIMIT 1";
            $buyer_result = mysqli_query($conn, $buyer); 
            $b_result = mysqli_fetch_assoc($buyer_result);
            $msg = "Congratulations! you won property";
            if($b_result['language'] == 2) {$msg = "מזל טוב! הצעתך התקבלה ואושרה";}
            $noti->send_notification($b_result,$msg,"home");  
            /*--------------------------------------*/
            $seller = "SELECT * FROM users WHERE id='".$row['user_id']."' ORDER BY id DESC LIMIT 1";
            $seller_result = mysqli_query($conn, $seller);
            $s_result = mysqli_fetch_assoc($seller_result); 
           
            $smsg = "Congratulations! Your property has been successfully sold";
            if($s_result['language'] == 2) {$smsg = "מזל טוב! הנכס שלך נמכר בהצלחה";}
            $noti->send_notification($s_result,$smsg,"home"); 
            }else{
                $bid_data[] = $row['id'];
            }
        }
        if(isset($bid_data) && count($bid_data)>0){ 
            foreach($bid_data as $bid){
                $query = "UPDATE properties SET status=1 WHERE id ='".$bid."'";
                mysqli_query($conn, $query);
            }
        }
        echo "done";die;  
    }else {
        echo "0 results";  
    }
  
 // if (mysqli_query($conn, $sql)) {
 //      echo "Record updated successfully";
 // } else {
 //      echo "Error updating record: " . mysqli_error($conn);
 // }
 mysqli_close($conn);
 
/**
 * 
 */
class Notification {
    
    function send_notification($result,$msg,$type){ 
    
        $aps['property_id'] = 1;
        $aps['type'] = 'home';    
        //$aps['body'] = $msg;
        //$aps['title'] = 'Ok bid';
        $device = array($result['device_token']);       
          
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
         
         
        $ch = curl_init();
        curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');  
        curl_setopt( $ch,CURLOPT_POST, true );
        curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
        curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields )); 
        $result = curl_exec($ch);  
        echo "<pre>";print_r($result);
        curl_close($ch); 
        return true; 
    }
}
 
?>  
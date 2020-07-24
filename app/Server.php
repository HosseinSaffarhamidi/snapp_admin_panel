<?php
namespace App;
class Server
{
    public static function sendNotification($id)
    {
        $ch=curl_init();
        curl_setopt($ch,CURLOPT_URL,"http://localhost:3000/send_notification");
        curl_setopt($ch,CURLOPT_POSTFIELDS,"TxNotificationId=".$id);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        $result=curl_exec($ch);
        curl_close($ch);
        $a=json_decode($result);

        if(property_exists($a,'status'))
        {
            return $a->status;
        }
        else{
            return 'error';
        }

    }

}
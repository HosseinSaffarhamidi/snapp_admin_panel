<?php

namespace App\Http\Controllers;

use App\AppUser;
use App\User;
use Illuminate\Http\Request;
use DB;
class PaymentController extends Controller
{
    public function connect($payment_code)
    {
        $row=DB::collection('payment')->where('_id',$payment_code)->first();
        if($row)
        {
            $Amount=$row['price'];
            $MerchantID = 'XXXXXXXX-XXXX-XXXX-XXXX-XXXXXXXXXXXX';
            $Description = 'توضیحات تراکنش تستی';
            $CallbackURL = url('payment/verify');

            $client = new \SoapClient('https://www.zarinpal.com/pg/services/WebGate/wsdl', ['encoding' => 'UTF-8']);

            $result = $client->PaymentRequest(
                [
                    'MerchantID' => $MerchantID,
                    'Amount' => $Amount,
                    'Description' => $Description,
                    'CallbackURL' => $CallbackURL,
                ]
            );

            if ($result->Status == 100)
            {
                $Authority=$result->Authority;
                $update=DB::collection('payment')->where('_id',$payment_code)->update(['Authority'=>$Authority]);
                if($update){
                    Header('Location: https://www.zarinpal.com/pg/StartPay/'.$Authority);
                }
            }
            else {
                echo'ERR: '.$result->Status;
            }
        }
    }
    public function verify(Request $request){

        $MerchantID = 'XXXXXXXX-XXXX-XXXX-XXXX-XXXXXXXXXXXX';
        $Authority =$request->get('Authority');

        $row=DB::collection('payment')->where('Authority',$Authority)->first();
        if($row){
            $user_id=$row['user_id'];
            $Amount = $row['price'];

            if ($request->get('Status') == 'OK')
            {

                $client = new \SoapClient('https://www.zarinpal.com/pg/services/WebGate/wsdl', ['encoding' => 'UTF-8']);

                $result = $client->PaymentVerification(
                    [
                        'MerchantID' => $MerchantID,
                        'Authority' => $Authority,
                        'Amount' => $Amount,
                    ]
                );

                if ($result->Status == 100) {
//                    echo 'Transaction success. RefID:'.$result->RefID;
                    $update=DB::collection('payment')->where('Authority',$Authority)
                        ->update(['status'=>1]);

                    $user=AppUser::find($user_id);
                    if($user){
                        $user->inventory=$user->inventory+$Amount;
                        $user->update();
                    }
                    echo 'پرداخت با موفقیت انجام شده و موجودی حساب شما افزایش یافت';
                }
                else
                {
                    echo 'Transaction failed. Status:'.$result->Status;
                }
            } else {
                echo 'Transaction canceled by user';
            }
        }


    }
}

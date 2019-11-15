<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use Auth;
use Storage;
use Hash;
use Cookie;
use Mail;
use Redis;
use Omnipay\Omnipay;
use App\Http\Controllers\AppController;
class PayController extends Controller
{
    public function init()
    {
        return new AppController();
    }
    public function paypalGateway()
    {
        $gateway = Omnipay::create('PayPal_Express');
        $gateway->setUsername(env('OMNIPAY_PAYPAL_EXPRESS_USERNAME'));
        $gateway->setPassword(env('OMNIPAY_PAYPAL_EXPRESS_PASSWORD'));
        $gateway->setSignature(env('OMNIPAY_PAYPAL_EXPRESS_SIGNATURE'));
        $gateway->setTestMode(false);
        $gateway->setBrandName('IBKiller');
        $gateway->setHeaderImageUrl(url('img/logo_paypal.png'));
        return $gateway;
    }
    public function alipayGateway()
    {
        $gateway = Omnipay::create('Alipay_AopPage');
        $gateway->setSignType('RSA2'); //RSA/RSA2
        $gateway->setAppId('2019021263228395');
        $gateway->setPrivateKey('');
        $gateway->setAlipayPublicKey('');
        $gateway->setReturnUrl(env('BASE_URL') . '/payWithAlipayCompleted');
        $gateway->setNotifyUrl(env('BASE_URL') . '/payWithAlipayCompleted');
        return $gateway;
    }
    public function paypalPurchase(array $parameters)
    {
        $response = $this->paypalGateway()
            ->purchase($parameters)
            ->send();
        return $response;
    }
    public function paypalComplete(array $parameters)
    {
        $response = $this->paypalGateway()
            ->completePurchase($parameters)
            ->send();
        return $response;
    }
    public function payWithPaypal(Request $request){
        $_session = Cookie::get('ibkiller_session');
        $api = $this->init();
        $isPaid = $api->isPro($_session);
        if ($_session){
            $isLoggedIn = true;
        } else {
            $isLoggedIn = false;
            return redirect('/?fmsg=TG9naW4gZmlyc3QgcGxlYXNlIQ==');
        }
        if ($isPaid){
            return redirect('/?fmsg=WW91IGFyZSBhIFBybyByaWdodCBub3ch');
        }
        $payID = substr($_session, -10) . time();
        $response = $this->paypalPurchase([
            'amount' => 1.99,
            'transactionId' => $payID,
            'currency' => 'USD',
            'returnUrl' => env('BASE_URL') . '/payWithPaypalCompleted',
            'cancelUrl' => 'http://127.0.0.1',
        ]);
        DB::table('app_users')
            ->where('session', $_session)
            ->update(['pay_id' => $payID]);
        if ($response->isRedirect()) {
            $response->redirect();
        }
        return $response->getMessage();
    }
    public function payWithPaypalCompleted(Request $request){
        $_session = Cookie::get('ibkiller_session');
        if ($_session){
            $isLoggedIn = true;
        } else {
            $isLoggedIn = false;
            redirect('/?fmsg=TG9naW4gZmlyc3QgcGxlYXNlIQ==');
        }
        $api = $this->init();
        $payID = $api->sessionVal($_session)
            ->first()
            ->pay_id;
        $response = $this->paypalComplete([
            'amount' => 1.99,
            'transactionId' => $payID,
            'currency' => 'USD',
            'cancelUrl' => env('BASE_URL'),
            'returnUrl' => env('BASE_URL') . '/payWithPaypalCompleted',
            'notifyUrl' => env('BASE_URL') . '/payWithPaypalCompleted',
        ]);
        if ($response->isSuccessful()){
            DB::table('app_users')
                ->where('session', $_session)
                ->update(['trans_id' => $response->getTransactionReference()]);
            DB::table('app_users')
                ->where('session', $_session)
                ->update(['pro_since' => time()]);
            return dd($response);
            return redirect('/?smsg=WW91IGFyZSBQcm8gbm93IQ==');
        } else {
            return dd($response);
            return redirect('/?fmsg=x');
        }
    }
    public function payWithAlipay(Request $request){
        $_session = Cookie::get('ibkiller_session');
        $api = $this->init();
        $isPaid = $api->isPro($_session);
        if ($_session){
            $isLoggedIn = true;
        } else {
            $isLoggedIn = false;
            return redirect('/?fmsg=TG9naW4gZmlyc3QgcGxlYXNlIQ==');
        }
        if ($isPaid){
            return redirect('/?fmsg=WW91IGFyZSBhIFBybyByaWdodCBub3ch');
        }
        $payID = substr($_session, -10) . time();
        $gateway = $this->alipayGateway();
        $request = $gateway->purchase();
        $request->setBizContent([
            'total_amount' => 12,
            'out_trade_no' => $payID,
            'subject' => 'Pro Account @ IBKiller',
            'product_code' => 'FAST_INSTANT_TRADE_PAY',
        ]);
        $response = $request->send();
        DB::table('app_users')
            ->where('session', $_session)
            ->update(['pay_id' => $payID]);
        if ($response->isRedirect()) {
            $response->redirect();
        }
        return $response->getMessage();
    }
    public function payWithAlipayCompleted(Request $request){
        $_session = Cookie::get('ibkiller_session');
        if ($_session){
            $isLoggedIn = true;
        } else {
            $isLoggedIn = false;
            redirect('/?fmsg=TG9naW4gZmlyc3QgcGxlYXNlIQ==');
        }
        $api = $this->init();
        $payID = $api->sessionVal($_session)
            ->first()
            ->pay_id;
        $gateway = $this->alipayGateway();
        $request = $gateway->completePurchase();
        $request->setParams(array_merge($_POST, $_GET));
        $response = $request->send();
        if ($response->isPaid()){
            DB::table('app_users')
                ->where('session', $_session)
                ->update(['pro_since' => time()]);
            return redirect('/?smsg=WW91IGFyZSBQcm8gbm93IQ==');
        } else {
            return redirect('/?fmsg=x');
        }
    }
}

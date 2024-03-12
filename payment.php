<?php
namespace Payment;
use Omnipay\Omnipay;
class Payment
{
   /**
    * @return mixed
    */
   public function gateway()
   {
       $gateway = Omnipay::create('PayPal_Express');
       $gateway->setUsername("sb-kl8nc27246699_api1.business.example.com");
       $gateway->setPassword("PXPGNQJJDJ96MR66");
       $gateway->setSignature("Av-jutUGYHCmia3yMoGy9.bMdWOyAlL39XBKQEnRAlY-vQdBxpcljzop");
       $gateway->setTestMode(false);
       return $gateway;
   }
   /**
    * @param array $parameters
    * @return mixed
    */
   public function purchase(array $parameters)
   {
       $response = $this->gateway()
           ->purchase($parameters)
           ->send();
       return $response;
   }
   /**
    * @param array $parameters
    */
   public function complete(array $parameters)
   {
       $response = $this->gateway()
           ->completePurchase($parameters)
           ->send();
       return $response;
   }
   /**
    * @param $amount
    */
   public function formatAmount($amount)
   {
       return number_format($amount, 2, '.', '');
   }
   /**
    * @param $order
    */
   public function getCancelUrl($order = "")
   {
       return $this->route('http://localhost/paypal/cancel.php', $order);
   }
   /**
    * @param $order
    */
   public function getReturnUrl($order = "")
   {
       return $this->route('http://localhost/paypal/return.php', $order);
   }
   public function route($name, $params)
   {
       return $name; // ya change hua hai
   }
}
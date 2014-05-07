<?php

class PaypalController extends Controller
{
	public function actionBuy(){
            
                            $transaction = array();
                            //get Order id 
                            $order_id = $_GET['order_id'];
                            if(!$order_id){
                                return false;
                            }
            
                            //get order details 
                            $sql = 'SELECT * from user_fund_project where id='.$order_id;
                            $order_details = Yii::app()->db->createCommand($sql)->queryAll();
                            
                            //getting project title 
                            $sql = 'SELECT * from project where id='.$order_details[0]['project_id'];
                            $project_details = Yii::app()->db->createCommand($sql)->queryAll();
//            print_r($order_details);
		// set 
		$paymentInfo['Order']['theTotal'] = $order_details[0]['amount'];
		$paymentInfo['Order']['description'] ='Project: '.$project_details[0]['title'];
		$paymentInfo['Order']['quantity'] = '1';
                            $paymentInfo['Order']['order_id'] =$order_details[0]['id'];

		// call paypal 
		$result = Yii::app()->Paypal->SetExpressCheckout($paymentInfo); 
		//Detect Errors 
		if(!Yii::app()->Paypal->isCallSucceeded($result)){ 
			if(Yii::app()->Paypal->apiLive === true){
				//Live mode basic error message
				$error = 'We were unable to process your request. Please try again later';
			}else{
				//Sandbox output the actual error message to dive in.
				$error = $result['L_LONGMESSAGE0'];
			}
			echo $error;
			Yii::app()->end();
			
		}else { 
			// send user to paypal 
                    
			$token = urldecode($result["TOKEN"]); 
                                            //set the session vars for this transaction
                                            $transaction = array(
                                                'token'=>$token,
                                                'project_id'=>$order_details[0]['project_id'],
                                                'id'=>$order_details[0]['id'],
                                            );
			Yii::app()->session['transaction']  = $transaction;
			$payPalURL = Yii::app()->Paypal->paypalUrl.$token; 
			$this->redirect($payPalURL); 
		}
	}

	public function actionConfirm()
	{
		$token = trim($_GET['token']);
		$payerId = trim($_GET['PayerID']);
		
		//get the transaction session variable
                $transaction = Yii::app()->session['transaction'];
		
		$result = Yii::app()->Paypal->GetExpressCheckoutDetails($token);
//                print_r($result).'<br/><hr/>';

		$result['PAYERID'] = $payerId; 
		$result['TOKEN'] = $token; 
                             
		$result['ORDERTOTAL'] = 100.00;
                        $result['ORDERID'] = '12345';
                

		//Detect errors 
		if(!Yii::app()->Paypal->isCallSucceeded($result)){ 
			if(Yii::app()->Paypal->apiLive === true){
				//Live mode basic error message
				$error = 'We were unable to process your request. Please try again later';
                                                        //Cleanup the transaction variable
                                                        unset(Yii::app()->session['transaction']);
			}else{
				//Sandbox output the actual error message to dive in.
				$error = $result['L_LONGMESSAGE0'];
                                                        //Cleanup the transaction variable
                                                         unset(Yii::app()->session['transaction']);
			}
			echo $error;
			Yii::app()->end();
		}else{ 
			
			$paymentResult = Yii::app()->Paypal->DoExpressCheckoutPayment($result);
//                        print_r($paymentResult).'<br/><hr/>';
			//Detect errors  
			if(!Yii::app()->Paypal->isCallSucceeded($paymentResult)){
				if(Yii::app()->Paypal->apiLive === true){
					//Live mode basic error message
                                                                        //Cleanup the transaction variable
                                                                         unset(Yii::app()->session['transaction']);
					$error = 'We were unable to process your request. Please try again later';
				}else{
					//Sandbox output the actual error message to dive in.
                                                                         //Cleanup the transaction variable
					$error = $paymentResult['L_LONGMESSAGE0'];
                                                                         unset(Yii::app()->session['transaction']);
				}
				echo $error;
                                                     //update payment status 
                                                         $sql = "update user_fund_project  set status='FAILED' where id=".$transaction['id'];
                                                        Yii::app()->db->createCommand($sql)->execute();
				Yii::app()->end();
			}else{
				//payment was completed successfully
                                                        ////redirect 
                                                        $confirm_url = $this->createUrl('/fundraise/share?pid='.$transaction['project_id'].'&ufid='.$transaction['id']);
                                                        //update payment status 
                                                         $sql = "update user_fund_project  set status='SUCCESS' where id=".$transaction['id'];
                                                        Yii::app()->db->createCommand($sql)->execute();
				//Cleanup the transaction variable
                                                         unset(Yii::app()->session['transaction']);
                                                         //redirect to thank you page 
                                                         $this->redirect($confirm_url); 
//				$this->render('confirm', array(  'url' => $confirm_url,));
			}
			
		}
	}
        
    public function actionCancel()
	{
		//The token of the cancelled payment typically used to cancel the payment within your application
		$token = $_GET['token'];
		 //Cleanup the transaction variable
		$this->render('cancel');
	}
	
	protected function actionDirectPayment(){ 
		$paymentInfo = array('Member'=> 
			array( 
				'first_name'=>'name_here', 
				'last_name'=>'lastName_here', 
				'billing_address'=>'address_here', 
				'billing_address2'=>'address2_here', 
				'billing_country'=>'country_here', 
				'billing_city'=>'city_here', 
				'billing_state'=>'state_here', 
				'billing_zip'=>'zip_here' 
			), 
			'CreditCard'=> 
			array( 
				'card_number'=>'number_here', 
				'expiration_month'=>'month_here', 
				'expiration_year'=>'year_here', 
				'cv_code'=>'code_here' 
			), 
			'Order'=> 
			array('theTotal'=>1.00) 
		); 

	   /* 
		* On Success, $result contains [AMT] [CURRENCYCODE] [AVSCODE] [CVV2MATCH]  
		* [TRANSACTIONID] [TIMESTAMP] [CORRELATIONID] [ACK] [VERSION] [BUILD] 
		*  
		* On Fail, $ result contains [AMT] [CURRENCYCODE] [TIMESTAMP] [CORRELATIONID]  
		* [ACK] [VERSION] [BUILD] [L_ERRORCODE0] [L_SHORTMESSAGE0] [L_LONGMESSAGE0]  
		* [L_SEVERITYCODE0]  
		*/ 
	  
		$result = Yii::app()->Paypal->DoDirectPayment($paymentInfo); 
		
		//Detect Errors 
		if(!Yii::app()->Paypal->isCallSucceeded($result)){ 
			if(Yii::app()->Paypal->apiLive === true){
				//Live mode basic error message
				$error = 'We were unable to process your request. Please try again later';
			}else{
				//Sandbox output the actual error message to dive in.
				$error = $result['L_LONGMESSAGE0'];
			}
			echo $error;
			
		}else { 
			//Payment was completed successfully, do the rest of your stuff
		}

		Yii::app()->end();
	} 
}
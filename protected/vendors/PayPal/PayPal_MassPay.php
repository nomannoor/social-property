<?php 
/**
 * PayPal NVP Transactions, Send balance to another email
 * 
 * @package PayPal NVP Transactions
 * @author Usman Chaudhry
 * @copyright 2011 Usman Chaudhry
 * @
 */

class PayPal_MassPay extends PayPalNVP {
	protected $METHOD = 'MassPay';
	
	public $PayPalEmail;
	public $EmailSubject;
    public $ReceiverType='EmailAddress';
	public $CurrencyCode = 'USD';
    public $Amount;
	public $TransactionID;
	public $CVV2Response;
	public $AVSResponse;
    public $ResponseError;
	
	private $REQUIRED = array(
		'PayPalEmail',
        'Amount'
	);
	
	function Send() 
    {
		
		foreach ($this->REQUIRED as $field) 
        {
			if (!$this->$field) throw new PayPalInvalidValueException("No value supplied for $field");
		}
        
		//Amount
        $this['L_Amt0'] = $this->Amount;
        
		//Receiver Email Address
		$this['L_EMAIL0'] = $this->PayPalEmail; //number_format($this->Amount, 2, '.', '');
		
        //Email Subject
        $this['EMAILSUBJECT'] = $this->EmailSubject;
        
        //Receiver Type
        $this['RECEIVERTYPE'] = $this->ReceiverType;
        
        //Currency Code
        $this['CURRENCYCODE'] = $this->CurrencyCode;
        
		return parent::Send();
	}
	
	protected function OnSuccess() 
    {
		$this->TransactionID 	= $this->Response['TRANSACTIONID'];
		$this->CVV2Response		= PayPalCodes::$CvvResponse[ $this->Response['CVV2MATCH'] ];
		$this->AVSResponse 		= PayPalCodes::$AvsResponse[ $this->Response['AVSCODE'] ];
	}
    
    protected function OnFailure()
    {
        $x = $this->Response;
        $this->ResponseError['error_title'] = $x[L_SHORTMESSAGE0];
        $this->ResponseError['error_description'] = $x[L_LONGMESSAGE0];
    }
}
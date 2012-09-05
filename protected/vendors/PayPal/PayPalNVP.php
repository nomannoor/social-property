<?php 
/**
 * PayPal NVP Transactions, Core Communication Class
 * This class should be extended by the individual methods you wish to perform
 * 
 * @package PayPal NVP Transactions
 * @author Jarvis Badgley
 * @copyright 2011 Jarvis Badgley
 * @link https://github.com/ChiperSoft/PayPal-NVP-Transactions
 *
 */

class PayPalNVP implements ArrayAccess {
	const API_VERSION = '65.1';  //This value needs to be kept current.  If you are getting Internal Error responses, this might be the culpret.
	
	const API_ENDPOINT = 'https://api-3t.paypal.com/nvp';
	const API_SANDBOX_ENDPOINT = 'https://api-3t.sandbox.paypal.com/nvp';
	const API_SANDBOX_USERNAME = 'lesson_1313212675_biz_api1.gmail.com';
	const API_SANDBOX_PASSWORD = '1313212719';
	const API_SANDBOX_SIGNATURE = 'AFcWxV21C7fd0v3bYYYRCpSSRl31AiGUEJjCgioCtZ5W6egbhwA1Pj0x';

	//Internal variables
	protected $ENDPOINT = '';
	protected $METHOD = '';
	
	
	//Public variables
	public $Success = false;
	
	
	
	//ArrayAccess Functions
	protected $data;
	function offsetExists ($offset) {return array_key_exists($offset, $this->data);}
	function offsetGet ($offset) {return $this->data[$offset];}
	function offsetSet ($offset, $value) {$this->data[$offset]=$value;}
	function offsetUnset ($offset) {unset($this->data[$offset]);}
	
	
	
	
	function __construct($ppUser='', $ppPass='', $ppSig='') {
		if ($this->METHOD) $this['METHOD'] = $this->METHOD;
		if ($ppUser && $ppPass && $ppSig) {
			$this->ENDPOINT 	= self::API_SANDBOX_ENDPOINT;
			$this['USER'] 		= $ppUser;
			$this['PWD'] 		= $ppPass;
			$this['SIGNATURE'] 	= $ppSig;
		} else {
			//assuming sandbox mode
			$this->ENDPOINT 	= self::API_SANDBOX_ENDPOINT;
			$this['USER'] 		= self::API_SANDBOX_USERNAME;
			$this['PWD'] 		= self::API_SANDBOX_PASSWORD;
			$this['SIGNATURE'] 	= self::API_SANDBOX_SIGNATURE;			
		}
		$this['VERSION'] = self::API_VERSION;
	}
	
	
	
	
	function Send($sandbox=false) {
		if (!$this['METHOD']) throw new PayPalUndefinedMethodException('No NVP Method was defined.');
		
		//Combine all request arguments and URL encode
		$postfields = array();
		foreach ($this->data as $field=>$value) {
			$postfields[] = strtoupper($field).'='.urlencode($value);
		}
		$postfields = implode('&', $postfields);
		
		
		//Begin CURL Process
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $this->ENDPOINT);
		curl_setopt($ch, CURLOPT_VERBOSE, 1);

		//turning off the server and peer verification(TrustManager Concept).
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);

		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch, CURLOPT_POST, 1);

		curl_setopt($ch,CURLOPT_POSTFIELDS,$postfields);

		$response = curl_exec($ch);
		
		if (curl_errno($ch)) {
			$this->Response = array(
				'TIMESTAMP'			=> date("Y-m-d H:i:s"),
				'ACK'				=> 'Failure',
				'L_ERRORCODE0'		=> curl_errno($ch),
				'L_SHORTMESSAGE0'	=> 'CURL Error, see long message for details',
				'L_LONGMESSAGE0'	=> curl_error($ch)
			);
			$this->Success = false;
		} else {
			curl_close($ch);
			
			$this->Response = self::deformatNVP($response);

			if ($this->Response['ACK']=='Success') {
				$this->Success = true;
				$this->OnSuccess();
			} else {
				$this->Success = false;
				$this->OnFailure();
			}
			
		}
		
		return $this->Success;
	}
	
	
	//Response Processing Functions, meant to be overloaded by subclasses.
	//Each called on completion of the request depending on success or failure
	protected function OnSuccess() {}
	protected function OnFailure() {}
	
	
	
	//Internal function for unwrapping the NVP response.  Code taken from PayPal PHP Examples
	protected static function deformatNVP($nvpstr) {
		$intial=0;
		$nvpArray = array();
		
		while(strlen($nvpstr)){
			//postion of Key
			$keypos= strpos($nvpstr,'=');
			//position of value
			$valuepos = strpos($nvpstr,'&') ? strpos($nvpstr,'&'): strlen($nvpstr);
			
			/*getting the Key and Value values and storing in a Associative Array*/
			$keyval=substr($nvpstr,$intial,$keypos);
			$valval=substr($nvpstr,$keypos+1,$valuepos-$keypos-1);
			//decoding the respose
			$nvpArray[urldecode($keyval)] =urldecode( $valval);
			$nvpstr=substr($nvpstr,$valuepos+1,strlen($nvpstr));
		}
		
		return $nvpArray;
	}
	
		
	//convenience function to include all available methods via autoload
	static function Load() {}
}

class PayPalUndefinedMethodException extends Exception {}
class PayPalInvalidValueException extends Exception {}






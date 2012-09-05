<?php
/**
 *donatebutton.php
 *
 * @author Ovidiu Pop <matricks@webspider.ro>
 * @copyright 2011 Binary Technology
 * @license released under dual license BSD License and LGP License
 * @package donatebutton
 * @version 0.1
 */

class donatebutton extends CInputWidget
{

	/**
	 * @var boolean alignment of extension box
	 */
	public $vertical = false;
	/**
	 * @var boolean display frame of box
	 */
	public $show_frame = false;
	/**
	 * @var boolean use a bigger button 
	 */
	public $biggerbutton = false;

	/**
	 * @var boolean use a fixed amount and currency
	 */
	public $fix_amount = false;
	/**
	 * @var string email for paypal account where will be send the money
	 */
	public $business = 'matricks@webspider.ro';
	/**
	 * @var string item to identify what the money represent
	 */
	public $item_name = 'Support Binary Technology development';
	/**
	 * @var string Text to be write near button
	 */
	public $message = 'If you like our work, you may throw us some cookies. Donate ';
	/**
	 * @var array settings of amount to be donate if fix_amount is set to true;
	 */
	public $donation = array(
		'currency_code' => 'EUR',
		'amount' => 5
	);
	/**
	 * @var array settings of amount to be donate if fix_amount is set to false;
	 */
	public $selectable_amount = array(
		'min_amount'=>3,
		'max_amount'=>10,
		'selected_amount'=>7,
		'selected_currency'=>'USD',
		'currencies'=>array('EUR', 'USD'),//or leave ''
	);

	/**
	 * @var string alt tag for Donate button
	 */
	public $alt_button = 'Donate';


	/**
	 * @var integer used internaly - default amount
	 */
	protected $default_amount;
	/**
	 * @var string used internaly - default currency
	 */
	protected $default_currency;
	/**
	 * @var string used internaly - button size
	 */
	protected $button_size;
	/**
	 * @var string used internaly - width of extension box 
	 */
	protected $width;

	/**
	 * The extension initialisation
	 *
	 * @return nothing
	 */
	public function init()
	{
		$this->width = $this->vertical ? '100px': '200px';
		$this->show_frame = $this->show_frame ? ' show_frame':'';
		$this->button_size = $this->biggerbutton ?'LG':'SM';
		$this->default_amount = $this->fix_amount?$this->donation['amount']:$this->selectable_amount['selected_amount'];
		$this->default_currency = $this->fix_amount?$this->donation['currency_code']:$this->selectable_amount['selected_currency'];

		self::registerFiles();
		self::renderDonateButton();
	}

	/**
	 * Register assets file and initialise donatebutton extension
	 *
	 * @return nothing
	 */
	private function registerFiles(){
		$assets = dirname(__FILE__).'/assets';
		$baseUrl = Yii::app()->assetManager->publish($assets);

		if(is_dir($assets))
			Yii::app()->clientScript->registerCssFile($baseUrl . '/donatebutton.css');
		else
			throw new Exception(Yii::t('social - Error: Couldn\'t find assets folder to publish.'));

		if(!$this->fix_amount)
		{
			Yii::app()->clientScript->registerScript(__CLASS__, "
				$('#selectamount').change(function(){
					$('#amount').val($(this).val());
				});
				$('#selectcurrency').change(function(){
					$('#currency_code').val($(this).val());
				});
			", CClientScript::POS_READY);
		}
	}


	/**
	 * Render donatebutton extension
	 *
	 * @return nothing
	 */
	private function renderDonateButton(){
		echo $this->render('donatebutton', array());
	}
}
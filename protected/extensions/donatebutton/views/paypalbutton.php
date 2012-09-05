
<form name="_xclick" action="https://www.paypal.com/cgi-bin/webscr" method="post">
	<input type="hidden" name="cmd" value="_xclick" />
	<input type="hidden" name="business" value="<?=$this->business;?>" />
	<input type="hidden" name="item_name" value="<?=$this->item_name;?>" />
	<input type="hidden" id="currency_code" name="currency_code" value="<?=$this->default_currency;?>" />
	<input type="hidden" id="amount" name="amount" value="<?=$this->default_amount;?>" />
	<input type="image" src="http://www.paypal.com/en_US/i/btn/btn_donate_<?=$this->button_size;?>.gif" name="submit" alt="<?=$this->alt_button;?>" />
</form>

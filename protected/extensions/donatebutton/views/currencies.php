

	<?php
		if(is_array($this->selectable_amount['currencies']))
		{
			echo '<select id="selectcurrency" class="combo_amount">';
				foreach($this->selectable_amount['currencies'] as $currency)
				{
					if($currency === $this->selectable_amount['selected_currency'])
						echo '<option selected="selected" value="'.$currency.'">'.$currency.'</option>';
					else
						echo '<option value="'.$currency.'">'.$currency.'</option>';
				}
			echo '</select>';
		}else{
			echo '&nbsp;'.$this->selectable_amount['selected_currency'];
		}
	?>


<?php if($this->fix_amount):?>
	<?= $this->default_amount.' '.$this->default_currency;?>
<?php else:?>
	<div class="div_sel_amount">
		<select id="selectamount" class="combo_amount">
		<?php
			for($i=$this->selectable_amount['min_amount']; $i <= $this->selectable_amount['max_amount']; $i++)
			{
				if($i === $this->default_amount)
					echo '<option selected="selected" value="'.$i.'">'.$i.'</option>';
				else
					echo '<option value="'.$i.'">'.$i.'</option>';
			}
		?>
		</select>
		<?php $this->render('currencies', array());?>
	</div>
<?php endif;?>




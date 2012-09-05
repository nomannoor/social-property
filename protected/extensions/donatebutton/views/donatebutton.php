<div class="donatebox clearfix<?=$this->show_frame;?>" style="width:<?=$this->width;?>">
	<div class="donatetext">
		<div class="donatemessage"><?=$this->message;?></div>
		<div class="donateamount"><?= $this->render('amount', array());?></div>
	</div>
	<div class="donatebutton">
		<?php $this->render('paypalbutton', array());?>
	</div>
</div>
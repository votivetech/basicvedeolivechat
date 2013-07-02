<?php require_once('header.php'); ?>
<section id="fullcontent">
 <div class="clear"></div>
  	 <h2 class="black">Buy Credits</h2>
      <hr>
    <section id="content">
	 <div class="ke-schvaleni" align="center">
     <?php if(isset($addsuccess)){ ?>
     <div class="success"><strong><?php echo $addsuccess; ?></strong></div>
     <?php }else{ ?>
    	 <form method="post" action="<?php echo base_url(); ?>user/paypal">
     		<table cellpadding="0" cellspacing="0" width="50%">
            	<tr>
                	<td valign="top"><strong>Buy Credits</strong></td>
                    <td valign="top">
                    	<table cellpadding="0" cellspacing="0" width="100%">
                        <?php if(isset($credits)){
						foreach($credits as $credit){
						 ?>
                        	<tr>
                            	<td height="40" valign="top"><input type="radio" name="buycredit" value="<?php echo $credit->credits.'-'.$credit->amount; ?>" checked="checked"></td>
                                <td valign="top"><strong><?php echo $credit->credits.' Credits - $'.$credit->amount; ?></strong></td>
                            </tr>
                        <?php } } ?>
                        </table>
                    </td>
                </tr>
                <tr>
                	<td></td>
                    <td><input type="submit" name="buycredits" value="Buy Via Paypal"></td>
                </tr>
            </table>
            </form>
      <?php } ?>
        </div>
       </section>
</section>
<?php require_once('footer.php'); ?>

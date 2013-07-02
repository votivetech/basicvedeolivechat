<?php require_once('header.php'); ?>
<section id="fullcontent">
 <div class="clear"></div>
  	 <h2 class="black">Manage Payouts</h2>
      <hr>
	  <div class="searchdiv">
   <div class="in">
	<form action="<?php echo base_url(); ?>user/managepayouts" method="post">
    <table cellpadding="0" cellspacing="0" width="100%">
    	
    	<tr>
            <td> <label for="filtrace"><strong>Amateur:</strong>&nbsp;&nbsp;</label></td>
            <td>
				<select name="searchamateur">
				<option value="">All</option>
				<?php if(isset($amateurs)){
				foreach($amateurs as $amateur){
				 ?>
				<option value="<?php echo $amateur->userid; ?>"><?php echo $amateur->name; ?></option>
				<?php } } ?>
				</select>
			</td>
            <td> <label for="filtrace"><strong>Status:</strong>&nbsp;&nbsp;</label></td>
            <td> <select name="searchstatus">
            	<option value="">Status</option>
				<option value="1">Paid</option>
				<option value="0">Unpaid</option>
       </select>	   </td>
	   <td><input type="submit" name="searchincomes" value="search" /></td>
	   </tr>
	<!--<tr>
	  <td height="40"><strong>Date From</strong></td>
    	  <td><input type="text" name="searchfromincome" id="searchfromincome" /></td>
    	  <td><strong>To</strong></td>
    	  <td><input type="text" name="searchtoincome" id="searchtoincome" /></td>
    	  <td><input type="submit" name="searchincomes" value="search" /></td>
    	  <td>&nbsp;</td>
    	  </tr>-->
    </table>
 
	</form>
    </div>        
  </div>
    <section id="content">
	 <div class="ke-schvaleni">
     <?php if(isset($payouts) && count($payouts)!=0){ ?>
		<table class='table' cellpadding="0" cellspacing="0" width="100%">
		<thead>
												<tr>
													<th width="7%" align="left">S. No.</th>
													<th width="17%">Amateur</th>
													<th width="18%">Amount</th>
													<th width="18%">Account No.</th>
													<th width="16%">Bank Code</th>
													<th width="16%">Date</th>
													<th width="16%">Status</th>
												</tr>
												</thead>
												<tbody>
                                                <?php 
													if(isset($offset) && is_numeric($offset))
													{
														$i=$offset+1;
													}
													else{
														$i=1;
													}
													foreach($payouts as $payout){
													 ?>
												<tr>
													<td width="7%" align="left"><?php echo $i; ?></td>
													<td width="17%"><?php echo $payout->name;?></td>
													<td width="18%"><?php echo $payout->amount;?></td>
													<td width="18%"><?php echo $payout->accountno; ?></td>
													<td width="16%"><?php echo $payout->bankcode;?></td>
													<td width="16%">
														<?php echo $payout->date;?>&nbsp;<?php echo $payout->time;?>
													</td>
													<td width="16%"><a href="<?php echo base_url(); ?>user/managepayouts/changestatus/<?php echo $payout->payoutid;?>"><?php if($payout->status==0){echo 'Unpaid';}else{ echo 'paid';} ?></a></td>
												</tr>
                                                <?php  $i++;} ?>
												
												</tbody>
										</table>
		<?php }else{ ?>
  	   	<div class="error" align="center">No Payouts Available</div>
		<?php } ?>
        </div>
		<div align="center">
        <?php if(isset($pagelinks)){ echo $pagelinks;} ?>
      </div>  
       </section>
</section>
<?php require_once('footer.php'); ?>

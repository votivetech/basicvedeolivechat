<?php require_once('header.php'); ?>
<section id="fullcontent">
 <div class="clear"></div>
  	 <h2 class="black">My Income</h2>
      <hr>
	  <div class="searchdiv">
   		<div class="in">
   			<table cellpadding="0" cellspacing="0" width="100%">
				<tr>
					<td width="50%" align="left" valign="top">
					<h3 class="error">Rules For Pay Out</h3><br />
					<div style="padding-left:30px;">
						<h3>Minimum to pay out is $20</h3><br />
						<h3>Money will arrive within 14 days</h3>
					</div>
					</td>
					<td width="50%" align="right">
	<form method="post" action="<?php echo base_url() ?>user/myincome">
		<input type="hidden" name="amount" value="<?php if(isset($total_income)){ echo $total_income; }else{ echo '0';} ?>" />
							<table cellpadding="0" cellspacing="0" width="100%">
							<tr>
								<td colspan="2"><?php if(isset($addmsg))echo $addmsg; ?></td>
							</tr>
							<tr>
								<td width="34%" height="40"><strong>Total Income</strong></td>
								<td width="66%"><strong><?php if(isset($total_income)){ echo '$&nbsp;'.$total_income; }else{ echo '0';} ?></strong></td>
							</tr>
							<tr>
								<td height="40"><strong>Account Number</strong></td>
								<td><input type="text" name="acc_no" value="" /><br /><span class="error"><?php echo strip_tags(form_error('acc_no')); ?></span></td>
							</tr>
							<tr>
								<td height="40"><strong>Bank Code</strong></td>
								<td><input type="text" name="bank_code" value="" /><br /><span class="error"><?php echo strip_tags(form_error('bank_code')); ?></span></td>
							</tr>
							<tr>
								<td height="40"><strong>Variable</strong></td>
								<td><input type="text" name="variable" value="" /><br /><span class="error"><?php echo strip_tags(form_error('variable')); ?></span></td>
							</tr>
							<tr>
								<td height="40">&nbsp;</td>
								<td><input type="submit" name="addpayout" value="Pay Out" /></td>
							</tr>
					  </table>
					 	 </form>
					</td>
				</tr>
			</table>
		</div>
	  </div>
    <section id="content">
	 <div class="ke-schvaleni">
     <?php if(isset($incomes) && count($incomes)!=0){ ?>
		<table class='table' cellpadding="0" cellspacing="0" width="100%">
		<thead>
												<tr>
													<th width="8%" align="left">S. No.</th>
													<th width="39%">Date</th>
													<th width="20%">Video</th>
													<th width="20%">income</th>
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
													$total=0;
													foreach($incomes as $income){
													 ?>
												<tr>
													<td width="8%" align="left"><?php echo $i; ?></td>
													<td width="39%"><?php echo $income->date.' '.$income->time; ?></td>
													
													<td width="20%"><?php echo $income->name;?></td>
													<td width="20%"><?php echo $income->income;?></td>
												</tr>
                                                <?php $total=$total+$income->income; $i++;} ?>
												<tr>
													<td ></td>
													<td ></td>
													<td ><strong>Total</strong></td>
													<td ><strong><?php echo $total; ?></strong></td>
												</tr>
												</tbody>
										</table>
		<?php }else{ ?>
  	   	<div class="error" align="center">No Income Available</div>
		<?php } ?>
        </div>
		<div align="center">
        <?php if(isset($pagelinks)){ echo $pagelinks;} ?>
      </div>  
       </section>
</section>
<?php require_once('footer.php'); ?>

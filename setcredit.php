<?php require_once('header.php'); ?>
<section id="fullcontent">
 <div class="clear"></div>
  	 <h2 class="black">Set Credits</h2>
      <hr>
<div class="searchdiv">
                        <form action="<?php echo base_url(); ?>user/setcredit" method="post">
                        	<table cellpadding="0" cellspacing="0" width="100%">
                            	<tr>
                                	<td width="8%" align="center"><strong>Credits</strong></td>
                                    <td width="21%" align="right">
                                   	 <input type="text" name="credits"  ><br></td>
                               	    <td width="9%" align="center" valign="top"><strong>Amount</strong></td>
                               	    <td width="21%" align="right" valign="top">
                                    	<input type="text" name="amount"  >
                                        <br></td>
                           	      <td width="10%" align="center" valign="top">
									<input type="submit" name="addcredits" value="ADD" class="btn btn-red5">								  </td>
									<td width="31%" ><span class="error">&nbsp;<?php echo strip_tags(form_error('category')); ?></span><span class="success"><?php if(isset($addsuccess)){ echo $addsuccess;} ?></span></td>
								</tr>
								<tr>
                            	  <td colspan="2" align="right"><span class="error"><?php echo strip_tags(form_error('credits')); ?></span></td>
                            	  <td colspan="2" align="right" valign="top"><span class="error"><?php echo strip_tags(form_error('amount')); ?></span></td>
                            	  <td align="center" valign="top">&nbsp;</td>
                            	  <td >&nbsp;</td>
                          	  </tr>
						  	</table>
   						 </form>
                        </div>
    <section id="content">
	 <div class="ke-schvaleni">
     <?php if(isset($credits)){ ?>
		<table class='table' cellpadding="0" cellspacing="0" width="100%">
												<tr>
													<th width="8%" align="left">S. No.</th>
													<th width="39%">Credit</th>
													<th width="20%">Amount</th>
                                                    <th width="10%">Delete</th>
												</tr>
                                                <?php 
													$i=1;
													foreach($credits as $credit){
													 ?>
												<tr>
													<td ><?php echo $i; ?></td>
													<td >
														<?php echo $credit->credits; ?>
													</td>
                                                    <td >
														<?php echo $credit->amount; ?>
													</td>
                                                    <td width="10%" >
                                                    	<a href="<?php echo base_url(); ?>user/setcredit/delete/<?php echo $credit->creditid; ?>"><img src="<?php echo base_url(); ?>content/images/del.png"></a>
                                                    </td>
												</tr>
                                                <?php $i++;} ?>
										</table>
		<?php }else{ ?>
  	   	<div class="error" align="center">NO Credits Available</div>
		<?php } ?>
        </div>
       </section>
	   </section>
<?php require_once('footer.php'); ?>

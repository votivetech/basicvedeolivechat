<?php require_once('header.php'); ?>
<section id="fullcontent">
 <div class="clear"></div>
  	 <h2 class="black">Manage Incomes</h2>
      <hr>
	  <div class="searchdiv">
   <div class="in">
	<form action="<?php echo base_url(); ?>user/incomes" method="post">
    <table cellpadding="0" cellspacing="0" width="100%">
    	
    	<tr>
        	<td height="40"><label for="search_text"><strong>Video</strong>&nbsp;&nbsp;</label></td>
            <td><input type="text"   name="searchvideoincome"></td>
            <td> <label for="filtrace"><strong>Amateur:</strong>&nbsp;&nbsp;</label></td>
            <td>
			<select name="searchamateurincome">
            <option value="">All</option>
			<?php if(isset($amateurs)){
			foreach($amateurs as $amateur){
			 ?>
			<option value="<?php echo $amateur->userid; ?>"><?php echo $amateur->name; ?></option>
			<?php } } ?>
       		</select>			</td>
            <td> <label for="filtrace"><strong>Users:</strong>&nbsp;&nbsp;</label></td>
            <td> <select name="searchuserincome">
            	<option value="">All</option>
       <?php if(isset($users)){
			foreach($users as $user){
			 ?>
			<option value="<?php echo $user->userid; ?>"><?php echo $user->name; ?></option>
			<?php } } ?>
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
     <?php if(isset($incomes) && count($incomes)!=0){ ?>
		<table class='table' cellpadding="0" cellspacing="0" width="100%">
		<thead>
												<tr>
													<th width="7%" align="left">S. No.</th>
													<th width="24%">Video</th>
													<th width="17%">Amateur</th>
													<th width="18%">Paid By</th>
													<th width="18%">Date</th>
													<th width="16%">income</th>
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
													<td width="7%" align="left"><?php echo $i; ?></td>
													<td width="24%"><?php echo $income->name;?></td>
													<td width="17%"><?php echo $income->amateur;?></td>
													<td width="18%"><?php echo $income->paid_by;?></td>
													<td width="18%"><?php echo $income->date.' '.$income->time; ?></td>
													<td width="16%"><?php echo $income->income;?></td>
												</tr>
                                                <?php $total=$total+$income->income; $i++;} ?>
												<tr>
													<td></td>
													<td></td>
													<td></td>
													<td></td>
													<td></td>
													<td></td>
												</tr>
												<tr>
													<td></td>
													<td></td>
													<td></td>
													<td></td>
													<td><strong>Total</strong></td>
													<td><strong><?php echo $total; ?></strong></td>
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

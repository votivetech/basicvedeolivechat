<?php require_once('header.php'); ?>
      <section id="fullcontent">
    <div align="center" class="success"><b><?php if(isset($checkRegistration)){ echo $checkRegistration;} ?></b></div>
      <form onSubmit="return validateFrom(this);" method="post" >      
        <div class="form_setup margin_bottom">
      <h2 style="margin-left: 15px;margin-top:15px;" class="h2_biger">Registrace nového uživatele</h2>
      <p  style="margin-left: 15px; " class="helptext">Po registraci budete mít možnost si zvolit, zda se chcete pouze dívat nebo i vysílat své video!</p>   

 <div class="clear"></div>
 
 <div class="form_content">
 	<table cellpadding="0" cellspacing="0" width="100%">
		<tr>
			<td width="30%">
				<table cellpadding="0" cellspacing="0" width="100%">
					<tr>
						<td><input type="radio" name="usertype" value="User" checked="checked" /></td>
						<td><label>User</label></td>
						<td style="color:#D50D0E;">I want to watch the videos</td>
					</tr>
				</table>
			</td>
		<td width="30%">
			<table cellpadding="0" cellspacing="0" width="100%">
					<tr>
						<td><input type="radio" name="usertype" value="Amateur" /></td>
						<td><label>Amateur</label></td>
						<td style="color:#D50D0E;">I want to upload the videos</td>
					</tr>
				</table>
		</td>
        <?php if($this->session->userdata('sessusertype')=='Admin'){ ?>
        <td width="40%">
			<table cellpadding="0" cellspacing="0" width="100%">
					<tr>
						<td><input type="radio" name="usertype" value="Admin" /></td>
						<td><label>Admin</label></td>
						<td style="color:#D50D0E;">I want to Manage Everything</td>
					</tr>
			</table>
		</td>
        <?php } ?>
		</tr>
	</table>
 </div>
          <div class="form_row_registration_left">
		  
            <div class="form_content">
              <label>Uživatelské jméno:</label>
              <input name="name" class="input required registration" onKeyUp="validateField(this);" onChange="validateField(this);" type="text" value="" />
			  <div class="errordiv"><?php echo strip_tags(form_error('name')); ?></div>
              <div class=""></div>
 <div class="clear"></div>
 
            <label>Heslo:</label>
              <input name="password" class="input required registration" onKeyUp="validateField(this);" onChange="validateField(this);" type="password"  />
			   <div class="errordiv"><?php echo strip_tags(form_error('password')); ?></div>
              <div class=""></div>
  <div class="clear"></div>
            <label>Datum narození:</label>
            <div>  
  	          <div class="count left regs_date" id="day">
  	            <input onKeyUp="validateDate();" onChange="validateDate();" name="day" type="text" value="01" class="countable border_left" size="5">
        	      <div class="count1"></div>
        	      <div class="count2"></div>	
              </div>
  	          <div class="count left regs_date2" id="month">
                <input onKeyUp="validateDate();" onChange="validateDate();" name="month" type="text" value="01" class="countable month" size="5">
        	      <div class="count1"></div>
        	      <div class="count2"></div>
              </div>
  	          <div class="count left regs_date2" id="year">
    	          <input onKeyUp="validateDate();" onChange="validateDate();" name="year" type="text" value="1991" class="countable year" size="5">
                <div class="right_wrap2"></div>
        	      <div class="count1"></div>
        	      <div class="count2"></div>
              </div>
            </div>
            <div class="clear"></div>
                             
            </div>
          </div>
          <div class="form_row_registration_right">
            <div class="form_row_registration_inner_right">
              <div class="form_content">
                      <label>Email:</label>
                <input name="email" class="input required registration" type="text" value="" onKeyUp="validateField(this);" onChange="validateField(this);" />
				  <div class="errordiv"><?php echo strip_tags(form_error('email')); ?></div>
                <div class=""></div>
                <div class="clear"></div>
              <label>Heslo znovu:</label>
                <input name="re_password" class="input required registration" onKeyUp="validateField(this);" onChange="validateField(this);" type="password"  />
				 <div class="errordiv"><?php echo strip_tags(form_error('re_password')); ?></div>
                <div class=""></div>
              </div>
            </div>
            <div class="clear"></div>
            <div class="nolabel">            
              <input name="agree" value="1" type="checkbox" class="checkbox" />
			  <span class="checkgox_label">Souhlasím s <a href="#">obchodnímy podmínkami</a></span>
            </div>
            <div class="clear"></div>
			<div class="errordiv"><br />&nbsp;&nbsp;&nbsp;&nbsp;<?php echo strip_tags(form_error('agree')); ?></div>
          </div>
        <div class="clear"></div>
            <input type="submit"  class="registration_me" name="registration" value=" ">
        </div>
      </form>
      </section>
 <?php require_once('footer.php'); ?>

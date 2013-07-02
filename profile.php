<?php require_once('header.php'); ?>
      <section id="fullcontent">
        <div class="clear"></div>
  	 <h2 class="black">Profil</h2>
      <hr>
	  <div class="row">
        <div class="r_left">  
          <div class="padding_top">
		 		<div><h2>Profile Video</h2><br /></div>
		  		<div align="center">
                	<video width="320" height="240" controls>
                      <source src="<?php echo base_url(); ?>uploads/profilevideos/<?php if(isset($details->video)){ echo $details->video; } ?>">
                    </video>
                </div>
          		<div>
                	<form method="post" action="<?php echo base_url(); ?>user/profile/<?php if($this->uri->segment(3)=='Edit'){ echo 'Edit/'.$this->uri->segment(4);} ?>" enctype="multipart/form-data" onSubmit="return confirm('Are You Sure To upload New Video');">
                    <table cellpadding="0" cellspacing="0" width="100%">
                    	<tr>
                        	<td height="50"><strong>&nbsp;&nbsp;Upload Video</strong></td>
                            <td><input type="file" name="profilevideo"></td>
                            <td><input type="submit" name="provideoupload" value="Upload"></td>
                        </tr>
                        <tr>
                        	<td colspan="3" class="error" align="center"><?php if(isset($viderror)){ echo 'Error : '.$viderror;} ?></td>
                        </tr>
                    </table>
                    </form>
                </div>
            <div class="clear"></div>
          </div>
        </div>
		<div class="r_left">  
          <div class="padding_top">
		  <div><h2>Profile Photo</h2><br /></div>
		  		<div align="center">
                <?php  if(isset($details->photo) && $details->photo!=''){ ?>
                <img src="<?php echo base_url(); ?>uploads/profilephotos/<?php echo $details->photo; ?>" style="max-height:240px; max-width:320px;" >
                <?php }else{ ?>
                <span class="error">No Photo</span>
				<?php }?>
                </div>
          		<div>
                	<form method="post" action="<?php echo base_url(); ?>user/profile/<?php if($this->uri->segment(3)=='Edit'){ echo 'Edit/'.$this->uri->segment(4);} ?>" enctype="multipart/form-data" onSubmit="return confirm('Are You Sure To upload New Picture');">
                    <table cellpadding="0" cellspacing="0" width="100%">
                    	<tr>
                        	<td height="50"><strong>&nbsp;&nbsp;Upload Photo</strong></td>
                            <td><input type="file" name="profilephoto"></td>
                            <td><input type="submit" name="prophotoupload" value="Upload"></td>
                        </tr>
                        <tr>
                        	<td colspan="3" class="error" align="center"><?php if(isset($photoerror)){ echo 'Error : '.$photoerror;} ?></td>
                        </tr>
                    </table>
                    
                    </form>
                </div>
            <div class="clear"></div>
          </div>
        </div>
      </div>
	  <div class="row">
        <div class="r_left">  
          <div class="padding_top">
		  <div><h2>General Details</h2><br /></div>
		  		<div>
                <form method="post" action="<?php echo base_url(); ?>user/profile/<?php if($this->uri->segment(3)=='Edit'){ echo 'Edit/'.$this->uri->segment(4);} ?>">
					<table cellpadding="0" cellspacing="0" width="100%">
						<tr>
							<td height="40"><strong>Name</strong></td>
							<td><input type="text" name="profilename" class="login" value="<?php if(isset($details->name)){ echo $details->name;} ?>" /></td>
						</tr>
						<tr>
							<td height="60"><strong>Age</strong></td>
							<td>
                            <?php $age=''; if(isset($details->age)){ $age= $details->age;} ?>
                            <select name="profileage">
                            	<?php for($i=18;$i<=70;$i++){ ?>
                                <option <?php if($age==$i){?> selected='selected'<?php } ?>><?php echo $i; ?></option>
                                <?php } ?>
                            </select>
                            </td>
						</tr>
						<tr>
							<td height="40"><strong>From</strong></td>
							<td><input type="text" name="profilfrom" class="login" value="<?php if(isset($details->from)){ echo $details->from;} ?>" /></td>
						</tr>
						<tr>
							<td height="40"><strong>About Me</strong></td>
							<td>
								<textarea class="input vote_input" style="width:300px; height:100px;" name="aboutme"><?php if(isset($details->aboutme)){ echo $details->aboutme;} ?></textarea>
							</td>
						</tr>
						<tr>
							<td height="40">&nbsp;</td>
							<td>
								<input type="submit" name="profileupdate" value="Update" />
							</td>
						</tr>
				  </table>
                  </form>
	   			</div>
          	<div class="clear"></div><br />
			 <div><h2>Change Login</h2><br /></div>
		  		<div>
                 <form method="post" action="<?php echo base_url(); ?>user/profile/<?php if($this->uri->segment(3)=='Edit'){ echo 'Edit/'.$this->uri->segment(4);} ?>">
				<table cellpadding="0" cellspacing="0" width="100%">
                <tr>
                	<td colspan="2" class="error" align="center"><?php if(isset($changeLoginError)){ echo $changeLoginError;} ?></td>
                </tr>
						<tr>
							<td height="40"><strong>Email</strong></td>
							<td><input type="text" name="email" class="login" value="<?php if(isset($details->email)){ echo $details->email;} ?>" />
                            <span class="error"><br><?php echo strip_tags(form_error('email')); ?></span>
                            </td>
						</tr>
						<tr>
							<td height="60"><strong>Password</strong></td>
							<td><input type="password" name="password" class="login" value="<?php if(isset($details->password)){ echo $details->password;} ?>" />
                            <span class="error"><br><?php echo strip_tags(form_error('password')); ?></span>
                            </td>
						</tr>
						<tr>
							<td height="40"><strong>Re-Password</strong></td>
							<td><input type="password" name="re_password" class="login" value="<?php if(isset($details->password)){ echo $details->password;} ?>" />
                            <span class="error"><br><?php echo strip_tags(form_error('re_password')); ?></span>
                            </td>
						</tr>
						<tr>
							<td height="40">&nbsp;</td>
							<td><input type="submit" name="changelogin" value="Update" /></td>
						</tr>
				  </table>
                  </form>
					
	   			</div>
          </div>
        </div>
      </div>
       
      <div class="clear"></div>
      </section>
 <?php require_once('footer.php'); ?>

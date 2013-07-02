<?php require_once('header.php'); ?>
      <section id="fullcontent">
        <div class="clear"></div>
  	 <h2 class="black">My Videos</h2>
      <hr>
        <div class="r_left">  
          <div class="padding_top">
		 		<div><h2>Add New Video</h2><br /></div>
		  		<div align="center" class="success"><strong><?php if(isset($addmsg['success'])){ echo $addmsg['success'];} ?></strong></div><br>
                <div align="center">
                	 <form method="post" action="<?php echo base_url(); ?>user/myvideos/<?php  if(isset($editvideo->videoid)){echo 'Edit/'.$editvideo->videoid;}?>" enctype="multipart/form-data">
                     <?php if(isset($editvideo->videoid)){ ?>
					 <input type="hidden" name="editvidid" value="<?php echo $editvideo->videoid; ?>">
					 <?php } ?>
                    <table cellpadding="0" cellspacing="0" width="100%">
                    	<tr>
                       	  <td width="50%" align="center">
						  
                            	<video width="320" height="240" controls>
                      <source src="<?php echo base_url(); ?>uploads/myvideos/<?php if(isset($editvideo->video)){ echo $editvideo->video;} ?>">
                    </video>
                          </td>
                            <td width="50%" valign="top">
                            	<table cellpadding="0" cellspacing="0" width="100%">
                                	<tr>
                                    	<td height="50"><strong>Choose A file</strong><span class="error">&nbsp;*</span> </td>
                                      <td>
                                     <?php  if(isset($editvideo->video)){ echo $editvideo->video;}else{?>
                                     <input type="file" name="videofile" >
                                     
                                      <span class="error"><br><?php if(isset($addmsg['verror'])){ echo $addmsg['verror'] ;} ?></span><?php } ?>                                      </td>
                                    </tr>
                                    <tr>
                                    	<td height="50"><strong>Video Name</strong><span class="error">&nbsp;*</span></td>
                                      <td><input type="text" name="videoname" class="login" value="<?php if(!isset($addmsg['success']) && $this->input->post('videoname')){echo $this->input->post('videoname');}else{if(isset($editvideo->name)){ echo $editvideo->name;}} ?>">
                                      <span class="error"><br><?php echo strip_tags(form_error('videoname')); ?></span>                                      </td>
                                    </tr>
                                    <tr>
                                      <td height="50"><strong>Video Image</strong><span class="error">&nbsp;*</span> </td>
                                      <td>
                                     <input type="file" name="vimage" >
									  <span class="success"><br /><?php if(isset($editvideo->vimage)){ echo $editvideo->vimage;} ?></span>
                                <span class="error"><br><?php if(isset($addmsg['imgerror'])){ echo $addmsg['imgerror'] ;} ?></span>
									  
									  </td>
                                    </tr>
                                    <tr>
                                    	<td height="50"><strong>Price</strong><span class="error">&nbsp;*</span></td>
                                      <td><input type="text" name="videoprice" class="login" value="<?php if(!isset($addmsg['success']) && $this->input->post('videoprice')){echo $this->input->post('videoprice');}else{if(isset($editvideo->price)){ echo $editvideo->price;}} ?>">
                                      <span class="error"><br><?php echo strip_tags(form_error('videoprice')); ?></span>                                      </td>
                                    </tr>
                                    <tr>
                                    	<td height="50"><strong>Category</strong><span class="error">&nbsp;*</span></td>
                                      <td>
                                      <?php $selcat=''; if(!isset($addmsg['success']) && $this->input->post('videocategory')){$selcat=$this->input->post('videocategory');}else{if(isset($editvideo->catid)){ $selcat=$editvideo->catid;}} ?>
                                      <select name="videocategory" class="login" style="padding-right:0px; width:248px;">
                                        	<option value="">Select Category</option>
                                            <?php if(isset($categories)){
												foreach($categories as $category){
												 ?>
                                            <option <?php if($selcat==$category->catid){ ?> selected='selected'<?php } ?> value="<?php echo $category->catid; ?>"><?php echo $category->category; ?></option>
                                            <?php }} ?>
                                        </select>
                                        <span class="error"><br><?php echo strip_tags(form_error('videocategory')); ?></span>                                        </td>
                                    </tr>
                                     <tr>
                                    	<td height="50">&nbsp;</td>
                                       <td>
                                       <input type="submit" name="addvideo" value="<?php if(isset($editvideo->videoid)){ ?>Update <?php }else{ ?>Add<?php } ?>">                                      </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
                
            <div class="clear"></div>
          </div>
        </div>
	  <div class="r_left">  
          <div class="padding_top">
		 		<div><h2>Existing Videos</h2><br /></div>
                <div class="searchdiv" style="margin-bottom:10px;">
                <form method="post" action="<?php echo  base_url(); ?>user/myvideos">
                	<table cellpadding="0" cellspacing="0" width="100%">
                    	<tr>
                        	<td><strong>Search Video</strong></td>
                            <td><input type="text" class="login" name="searchvname" value="<?php if(isset($inputs['searchvname'])){echo substr($inputs['searchvname'],strpos($inputs['searchvname'],'+')+1);} ?>" style="width:160px;"></td>
                            <td><strong>Category</strong></td>
                            <td>
                            <?php $searchvcategory=''; if(isset($inputs['searchvcategory'])){
					$searchvcategory=substr($inputs['searchvcategory'],strpos($inputs['searchvcategory'],'+')+1);
					}  ?>
                            <select name="searchvcategory" class="login" style="padding-right:0px; width:160px;">                                        	<option value="">Select Category</option>
                                            <?php if(isset($categories)){
												foreach($categories as $category){
												 ?>
                                            <option <?php if($searchvcategory==$category->catid){ ?> selected='selected'<?php } ?> value="<?php echo $category->catid; ?>"><?php echo $category->category; ?></option>
                                            <?php }} ?>
                                        </select></td>
                            <td><strong>Status</strong></td>
                            <td>
                             <?php $searchvstatus=''; if(isset($inputs['searchvstatus'])){
					$searchvstatus=substr($inputs['searchvstatus'],strpos($inputs['searchvstatus'],'+')+1);
					} ?>
                            <select name="searchvstatus" style="padding-right:0px; width:100px;" class="login">
                            	<option value="">Status</option>
                                <option value="1" <?php if($searchvstatus==1){ ?> selected='selected'<?php } ?>>Active</option>
                                <option value="0" <?php if($searchvstatus==0 && $searchvstatus!=''){ ?> selected='selected'<?php } ?>>Inactive</option>
                            </select>
                            </td>
                            <td><input type="submit" name="searchmyvideo" value="Search"></td>
                        </tr>
                    </table>
                    </form>
                </div>
                <div class="searchmsgdiv">
               	
                </div>
		  		<div align="center">
                <?php if(isset($myvideos) && count($myvideos)!=0){
					 foreach($myvideos as $video){
					 ?>
                	 <div class="video left"  >
	<div class="flag"></div>
	
        <div class="in">
		<div class="view" align="left">
			<strong class="description"><?php echo '$ '.$video->price; ?></strong>
		</div>
		  <a href="<?php echo base_url(); ?>home/video/<?php echo base64_encode($video->video); ?>" class="vname"><img src="<?php echo base_url(); ?>/uploads/myvideoimages/<?php echo $video->vimage; ?>" height="160" width="180" /></a>
      <!--<video width="180" height="160" controls>
                      <source src="<?php //echo base_url(); ?>uploads/myvideos/<?php  //echo $video->video;  ?>">
                    </video>-->
             <div class="description" align="left"><a href="<?php echo base_url(); ?>home/video/<?php echo base64_encode($video->video); ?>" class="vname"><?php  echo $video->name;  ?></a><br /></div>
             <div class="categoryname" align="left"><strong>Category&nbsp;:&nbsp;<?php echo $video->category;?></strong></div>
        </div>
		<div class="video_footer" align="left" >
             <table cellpadding="0" cellspacing="0" width="100%" style="padding:10px;">
             	<tr>
                	<td width="10%" align="center"><img src="<?php echo base_url(); ?>/content/images/zoom.png" height="15" width="15"></td>
                    <td width="15%" align="center" valign="top"><a href="<?php echo base_url(); ?>user/myvideos/Edit/<?php echo $video->videoid; ?>" class="editlink">Edit</a></td>
                    <td width="15%" align="center"> <img src="<?php echo base_url(); ?>/content/images/ko.png" height="15" width="15"></td>
                    <td width="15%" align="center" valign="top"><a href="<?php echo base_url(); ?>user/myvideos/delete/<?php echo $video->videoid; ?>" class="editlink">Delete</a></td>
                    <td width="15%" align="center"><?php if($video->status==1){ ?><img src="<?php echo base_url(); ?>/content/images/check.png" height="15" width="15"><?php }else{ ?> <img src="<?php echo base_url(); ?>/content/images/cross.png" height="15" width="15"><?php } ?></td>
                    <td width="25%" align="center" valign="top"> <a href="<?php echo base_url(); ?>user/myvideos/changestatus/<?php echo $video->videoid; ?>" class="editlink"><?php if($video->status==1){ ?> Active<?php }else{ ?> Inactive<?php } ?></a></td>
                </tr>
             </table>
             </div>
      </div>
      			<?php }} ?>
                
                </div>
          		
            <div class="clear"></div>
             <div align="center">
        <?php if(isset($pagelinks)){ echo $pagelinks;} ?>
     
      </div>  
          </div>
        </div>
       
      <div class="clear"></div>
      </section>
 <?php require_once('footer.php'); ?>

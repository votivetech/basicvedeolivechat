<?php require_once('header.php'); ?>
       <div class="clear"></div>
      <section id="fullcontent" style=" margin-top: 20px">
    <?php if(isset($message['noauthority'])){ ?><div class="error" align="center"><strong><?php echo $message['noauthority'];?></strong></div><?php }else{ ?>
		  <h2 class="nahrana_videa"><?php if(isset($videodata->name)){ echo $videodata->name;}else{ ?><span class="error">This Video is Not Available</span><?php } ?></h2><hr />
			  <div class="row" style="width:60%;" align="center">
			   <div align="right" class="vprofilename"><?php if(isset($videodata->profilename)){ echo $videodata->profilename;}  ?><?php if(isset($videodata->age) && $videodata->age!=''){ echo ' ('.$videodata->age.' Years) ';} ?></div><br>
			   <div><video width="500" height="400" controls>
						  <source src="<?php echo base_url(); ?>uploads/myvideos/<?php if(isset($videodata->video)){ echo $videodata->video;} ?>">
				</video>
				
			  </div>
			  <div class="vbuybuttonsdiv" >
			  <a class="buylink" href="<?php echo base_url() ?>user/buycredits"><img alt="" src="<?php echo base_url(); ?>content/images/crowds.png" style="float:left">Buy Credits</a>
			  <!--<a class="buylink" href="#"><img alt="" src="<?php echo base_url(); ?>content/images/crowds.png" style="float:left">Buy Video</a>-->
			  <div style="padding-left:50px; padding-top:5px; width:420px;" align="right" ><strong><?php if(isset($videodata->price)){ echo '$&nbsp;'.$videodata->price;} ?></strong></div>
			  </div>
			  </div>
			  <div class="row" style="width:40%; margin-top:25px;">
				 <?php if(isset($videos)){ foreach($videos as $video){?>
				 <div style="padding:10px; float:left;">
				 <!-- <video width="160" height="160" controls>
						  <source src="<?php //echo base_url(); ?>uploads/myvideos/<?php  //echo $video->video;  ?>">
						</video>-->
						<div class="video" align="center"><a href="<?php echo base_url(); ?>home/video/<?php echo base64_encode($video->video); ?>" class="vname"> <img src="<?php echo base_url(); ?>/uploads/myvideoimages/<?php echo $video->vimage; ?>" height="160" width="160" /></a>
						<div align="center" ><strong><?php echo '$ '.$video->price; ?></strong></div>
						</div>
						</div>
				 <?php }} ?>
			  </div>
			  <div class="clear"></div>
		  <h2 style="margin-top: 15px" class="nahrana_videa">Similar Videa</h2><hr />
		   <?php if(isset($similarvideos)){ foreach($similarvideos as $video){ ?>
		  <div class="video left">
		<div class="flag"></div>
			<div class="in">
				<a href="<?php echo base_url(); ?>home/video/<?php echo base64_encode($video->video); ?>" class="vname"> <img src="<?php echo base_url(); ?>/uploads/myvideoimages/<?php echo $video->vimage; ?>" height="160" width="180" /></a>
			  <!--<video width="180" height="160" controls>
                      <source src="<?php //echo base_url(); ?>uploads/myvideos/<?php  //echo $video->video;  ?>">
                    </video>-->
					 <div class="description" align="left"><a href="<?php echo base_url(); ?>home/video/<?php echo base64_encode($video->video); ?>" class="vname"><?php  echo $video->name;  ?></a></div>
             <div class="description" align="left"><span class="categoryname">Category&nbsp;:&nbsp;<?php echo $video->category;?></span></div>
			 <div class="description" align="left">
              <table cellpadding="0" cellspacing="0" width="100%" class="profilename">
              	<tr>
                	<td width="40%" valign="top">Profile&nbsp;:&nbsp;</td>
                    <td width="60%"><?php echo $video->profilename;?></td>
                </tr>
              </table>
            </div>
			</div>
			<div class="video_footer">
				  <div class="view nahr left">
				  <img class="left" src="<?php echo base_url(); ?>content/images/star.png" alt="" />
				  &nbsp;&nbsp; 
				  <strong class="views"><?php  echo '$ '.$video->price; ?></strong>
				  </div>
				  <a class="b_prehrat nahr right" href="<?php echo base_url(); ?>home/video/<?php echo base64_encode($video->video); ?>"></a>
				 </div>
		  </div>
		  <?php }} ?>
		  <div class="clear"></div>
		  <div align="center">
			<?php if(isset($pagelinks)){ echo $pagelinks;} ?>
		  </div>  
		  <?php } ?>
      </section>
 <?php require_once('footer.php'); ?>

<?php require_once('header.php'); ?>
       <div class="clear"></div>
      <section id="fullcontent" style=" margin-top: 20px">
                      
      <h2 class="nahrana_videa">Vyberte si obsah videa</h2><hr />
     <?php if(isset($categories)){
		   foreach($categories as $cat){
		    ?>
          <div class="tag left"><a href="<?php echo base_url(); ?>?category=<?php echo $cat->catid; ?>" class="cat_link"><?php echo $cat->category; ?></a></div>
		  <?php }} ?>
          <div class="clear"></div>
      <h2 style="margin-top: 15px" class="nahrana_videa">Videa</h2><hr />
       <?php if(isset($videos)){ foreach($videos as $video){ ?>
      <div class="video left">
	<div class="flag"></div>
        <div class="in">
              <video width="180" height="160" controls>
                      <source src="<?php echo base_url(); ?>uploads/myvideos/<?php  echo $video->video;  ?>">
                    </video>
             <div  align="center"><a href="<?php echo base_url(); ?>home/video/<?php echo base64_encode($video->video); ?>" class="description"><?php  echo $video->name;  ?></a></div>
             <div class="video_footer">
              <div class="view nahr left">
              <img class="left" src="<?php echo base_url(); ?>content/images/star.png" alt="" />
              &nbsp;&nbsp; 
              <strong class="views"><?php  echo $video->price;  ?></strong></div>
              <a class="b_prehrat nahr right" href="#"></a>
             </div>
        </div>
      </div>
	  <?php }} ?>
      <div class="clear"></div>
      <div align="center">
        <?php if(isset($pagelinks)){ echo $pagelinks;} ?>
     
      </div>  
      </section>
 <?php require_once('footer.php'); ?>

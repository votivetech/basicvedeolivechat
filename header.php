<!DOCTYPE html>
<html>
  <head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8">
  <title><?php if(isset($title)){ echo $title;}else{ echo 'Live Chat';} ?></title>
  <!-- CSS import -->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>content/css/default.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>content/css/cms.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>content/css/tables.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>content/css/admvideo.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>content/css/videa.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>content/css/video.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>content/css/footer.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>content/css/hp.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>content/css/nastaveni.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>content/css/mujkredit.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>content/css/chat.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>content/css/profil.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>content/css/scrollbar.css">
  <script src="http://code.jquery.com/jquery-latest.js"></script>
	<script src="<?php echo base_url(); ?>content/js/jquery.tinyscrollbar.min.js"></script>
	<script type="text/javascript">
$(function(){
  $("#scrollbar1").tinyscrollbar();      
});
</script>
<script type="text/javascript">  
$(function(){

  var hodnoty = Array();
  hodnoty['day'] = new Array('01','02','03','04','05','06','07','08','09',
                                        '10','11','12','13','14','15','16','17','18','19',
                                        '20','21','22','23','24','25','26','27','28','29',
                                        '30','31');                                        
  hodnoty['month'] = new Array('01','02','03','04','05','06','07','08','09','10','11','12');
  hodnoty['year'] = new Array('1981','1982','1983','1984','1985','1986','1987','1988','1989','1990','1991','1992','1993','1994','1995','1996','1997','1998','1999','2000','2001');
                                 
  $(".count1, .count2").click(function(){    
    var count = this;
    var options = $(this).parent().attr('id');
    
    var actualValue = $("input[name='"+options+"']").val();    
    var actualIndex = $.inArray(actualValue,hodnoty[options]);    
    if($(count).attr('class') == 'count1')
    {
      if( (actualIndex+1)<hodnoty[options].length )
      {
        $("input[name='"+options+"']").val(hodnoty[options][actualIndex+1]);
      }
    }
    else
    {
      if( (actualIndex-1)>-1 )
      {
        $("input[name='"+options+"']").val(hodnoty[options][actualIndex-1]);
      }
    }

    validateDate();
    
    return false;    
  });
});       
</script> 
<script type="text/javascript">
$(function(){
  var hodnoty = Array();
  hodnoty['send_to'] = new Array('Poslat všem','doktorbolito44','VIPuživatel');
  
  $(".count1, .count2").click(function(){    
    var count = this;
    var options = $(this).parent().attr('id');
    
    var actualValue = $("input[name='"+options+"']").val();    
    var actualIndex = $.inArray(actualValue,hodnoty[options]);    
    if($(count).attr('class') == 'count1')
    {
      if( (actualIndex+1)<hodnoty[options].length )
      {
        $("input[name='"+options+"']").val(hodnoty[options][actualIndex+1]);
        if( $("input[name='"+options+"']").hasClass('imaged') )
        {
          $(this).parent().children('.count_image').removeClass(classes[options][actualIndex])
          $(this).parent().children('.count_image').addClass(classes[options][actualIndex+1])
        }
      }
    }
    else
    {
      if( (actualIndex-1)>-1 )
      {
        $("input[name='"+options+"']").val(hodnoty[options][actualIndex-1]);
        if( $("input[name='"+options+"']").hasClass('imaged') )
        {
          $(this).parent().children('.count_image').removeClass(classes[options][actualIndex])
          $(this).parent().children('.count_image').addClass(classes[options][actualIndex-1])
        }
      }
    }

    return false;    
  });
});
</script>  


<script type="text/javascript">
$(function(){
  var smiles = Array();
  smiles['smail'] = new Array('s1','s2','s3');
  
  $(".scount1, .scount2").click(function(){    
    var count = this;
    var options = $(this).parent().attr('id');
    
    var actualValue = $("input[name='"+options+"']").val();    
    var actualIndex = $.inArray(actualValue,smiles[options]);

    if($(count).attr('class') == 'scount1')
    {
      if( (actualIndex+1)<smiles[options].length )
      {
        $("input[name='"+options+"']").val(smiles[options][actualIndex+1]);
          $(this).parent().children('.smile_image').removeClass(smiles[options][actualIndex])
          $(this).parent().children('.smile_image').addClass(smiles[options][actualIndex+1])
      }
    }
    else
    {
      if( (actualIndex-1)>-1 )
      {
        $("input[name='"+options+"']").val(smiles[options][actualIndex-1]);
          $(this).parent().children('.smile_image').removeClass(smiles[options][actualIndex])
          $(this).parent().children('.smile_image').addClass(smiles[options][actualIndex-1])
      }
    }

    return false;    
  });
});
</script>   
<script type="text/javascript">
                              
function addErrSign( where, message )
{
    where.append( '<div class="sign_false">'+message+'</div>' );
}

function validateFrom( form )
{
    valid = true;
    
    if( !validateField(form.name) )
    {
        $(form.name).next().removeClass('checked');
        $(form.name).next().addClass('checked_false');
        addErrSign( $(form.name).next(), "Chybně zadané jméno" );
        valid = false;
    }

    if( !validateField(form.email) )
    {
        $(form.email).next().removeClass('checked');
        $(form.email).next().addClass('checked_false');
        addErrSign( $(form.email).next(), "Chybně zadaný email" );
        valid = false;
    }
	 if( !validateField(form.password) )
    {
        $(form.password).next().removeClass('checked');
        $(form.password).next().addClass('checked_false');
        addErrSign( $(form.password).next(), "Chybně zadaný Heslo" );     
        valid = false;
    }
	 if( !validateField(form.re_password))
    {
        $(form.re_password).next().removeClass('checked');
        $(form.re_password).next().addClass('checked_false');
        addErrSign( $(form.re_password).next(), "Chybně zadaný Heslo znovu" );        
        valid = false;
    }
    
    return valid;
}

function validateField( field )
{
    var valid = true;
    
    if( $(field).val().length<6 )
    {
        valid = false;
    }
    
    if( valid == false )
    {
        $(field).next().removeClass('checked');
    }
    
    if( valid == true && !$(field).next().hasClass('checked') )
    {
        $(field).next().addClass('checked');
        $(field).next().removeClass('checked_false');
        $(field).next().children('.sign_false').remove();
    }
    
    return valid;
}

function validateDate()
{
    var year = $("input[name=year]");

    var valid = true;

    // to do ?    
    
    if( valid == false )
    {
        year.next().removeClass('checked');
        year.next().addClass('checked_false');        
    }
    
    if( valid == true && !year.next().hasClass('checked') )
    {
        year.next().removeClass('checked_false');
        year.next().addClass('checked');
    }
    
    return valid;
}
                 
</script>
<style type="text/css">
.errordiv{ color:#D50D0E; font-size:12px; font-family:Arial, Helvetica, sans-serif;float:left;}
.error{ color:#D50D0E; font-size:12px; font-family:Arial, Helvetica, sans-serif;}
.success { font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#006600;}
.searchdiv { border-radius:10px; border:#CCC solid 1px; padding:10px; }
.editlink { text-decoration:none; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000000; font-weight:bold;}
.categoryname { font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#6A9018; font-weight:bold;}
.profilename { font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#333; font-weight:bold;}
.searchmsgdiv {font-family:Arial, Helvetica, sans-serif; font-size:13px; padding:5px; color:#900; font-weight:bold;}
.cat_link { color:#666; text-decoration:none;}
.vprofilename {padding-right:40px; color:#D40D0E; font-size:12px; font-weight:bold;}
.vbuybuttonsdiv {padding-left:30px; margin:10px;}
.vname { color:#FF0000; font-size:13px; font-weight:bold; text-decoration:none;} 
.normaltext { font-family:"HelveticaNeue","Helvetica Neue",sans-serif; font-size:13px; line-height:25spx; text-align:justify;}
</style>
    </head>
  </head>
  <body>
  <section id="container">
    <header>
            <a href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>content/images/logo.png" class="logo left" alt="" /></a>
                 <div  class="left" style="margin-left: 80px; margin-top: 25px">
		<?php if(!$this->session->userdata('sessuserid')){ ?>
		<span class="left" style="font-size:13px; color:#828282; font-weight:bold;padding:13px">Nemáte vytvořený účet?</span>
        <a href="<?php echo base_url(); ?>home/registration" class="b_registrace right"></a>
		<?php }else{ ?>
		<span class="left" style="font-size:13px; color:#828282; font-weight:bold;padding:13px">Welcome To Livechat</span>
		<?php } ?>
                 </div>
    </header>
           <!-- LEFT CONTENT -->
    <section id="leftcontent">
      <nav id="imgmenu">
      <ul>
        <li class="left"><a href="#"><img src="<?php echo base_url(); ?>content/images/amateri.png" alt="" /></a></li>
        <li class="right"><a href="#"><img src="<?php echo base_url(); ?>content/images/videa.png" alt="" /></a></li>
      </ul>
      </nav>
      <div class="clear"></div>
      </section>           
    <!-- RIGHT CONTENT -->
	<?php if($this->session->userdata('sessuserid')){ ?>
	
	  <section id="rightcontent">
             <div class="in">
                  <h3>Přihlášen jako:</h3>
                  <h4><?php echo $this->session->userdata('sessname'); ?></h4>
                  <hr />
				 <?php if($this->session->userdata('sessusertype')=='Amateur'){ ?>
                 <div id="rightmenu">
                     <ul>
					   <li <?php if($this->uri->segment(2)=='profile'){ ?> class="active"<?php } ?>><span class="muj_profil"></span><a href="<?php echo base_url(); ?>user/profile">Můj profil</a></li>
                       <li <?php if($this->uri->segment(2)=='myvideos'){ ?> class="active"<?php } ?>><span class="moje_videa"></span><a href="<?php echo base_url(); ?>user/myvideos">Moje videa</a></li>
                       <li <?php if($this->uri->segment(2)=='myincome'){ ?> class="active"<?php } ?>><span class="muj_vydelek"></span><a href="<?php echo base_url(); ?>user/myincome">Můj výdělek <span class="red_menu">(<?php $total_income=0; $total_income=$this->functions->getTotalIncome($this->session->userdata('sessuserid')); if(isset($total_income)){ echo $total_income;} ?> Kč)</span></a></li>
					 </ul>
                     </div>
				 <?php } ?>
				 <?php if($this->session->userdata('sessusertype')=='Admin'){ ?>
                 <div id="rightmenu" style="float:left;">
                     <ul>
                       <li <?php if($this->uri->segment(2)=='manageusers'){ ?> class="active"<?php } ?>><span class="muj_profil"></span><a href="<?php echo base_url(); ?>user/manageusers">Users</a></li>
                       <li <?php if($this->uri->segment(2)=='managevideos'){ ?> class="active"<?php } ?>><span class="moje_videa"></span><a href="<?php echo base_url(); ?>user/managevideos">Videos</a></li>
                       <li <?php if($this->uri->segment(2)=='managecategory'){ ?> class="active"<?php } ?>><span class="log"></span><a href="<?php echo base_url(); ?>user/managecategory">Category</a></li>
                       <li <?php if($this->uri->segment(2)=='managepayouts'){ ?> class="active"<?php } ?>><span class="muj_vydelek"></span><a href="<?php echo base_url(); ?>user/managepayouts">Pay Outs</a></li>
                     </ul>
                     </div>
                      <div id="rightmenu" style="margin-left:20px; float:left; min-height:140px;">
                     <ul>
                       <li <?php if($this->uri->segment(2)=='setcredit'){ ?> class="active"<?php } ?> ><span class="moje_vysilani"></span><a href="<?php echo base_url(); ?>user/setcredit">Set Credits</a></li>
					   <li <?php if($this->uri->segment(2)=='incomes'){ ?> class="active"<?php } ?> ><span class="muj_vydelek"></span><a href="<?php echo base_url(); ?>user/incomes">Incomes</a></li>
                     </ul>
                     </div>
				 <?php } ?>
                 <div id="rightmenu">
				 <ul>
                       <li><span class="panel"></span><a href="<?php echo base_url(); ?>/user/logout">Logout</a></li>
                      </ul>
                  </div>
              <?php if($this->session->userdata('sessusertype')=='User'){
			  		$udata=$this->functions->getUserData($this->session->userdata('sessuserid'));
			   ?>
             <div class="rightgray">
              <span class="left">
			 
			  <img src="<?php echo base_url(); ?>content/images/crowds.png" alt="" /> <a href="#" class="vydelek">Můj kredit</a></span>
              <span class="right" style="font-weight:bold;padding-top:3px;color: #d62b2c"><?php if(isset($udata->credits)){ echo $udata->credits;} ?> kreditů</span>
              <div class="clear"></div>
               <a class="b_dobijte" style="margin: 20px 0 0 0px" href="<?php echo base_url(); ?>user/buycredits"></a>
            </div>
              <?php } ?>
    </section>
	<?php }else{ ?>
	<section id="rightcontent">
	  <form method="post" action="<?php echo base_url(); ?>home">
             <div class="in">
                 <nav id="rightmenu">
                       <ul class="m_login">
                           <li>Uživatelské jméno:</li>
                           <li><input name="login" type="text" class="login">
						    <div class="error"><?php echo strip_tags(form_error('login')); ?></div>
						   </li>
                           <li>Heslo:</li>
                           <li><input name="password" type="password" class="login">
						     <div class="error"><?php echo strip_tags(form_error('password')); ?></div>
						   </li> 
						   <li>
						   	 <div class="error"><?php if(isset($checkLogin)){ echo $checkLogin;} ?></div>
						   </li>
                       </ul>
                  </nav>
                                   
             </div>
             <div class="rightblue"> 
             <input class="smallcheckbox" type="checkbox" name="forgot" value="1"> Zůstat přihlášen <input type="submit" value=" " name="autologin"  class="but_login"></a>
              <div class="clear"></div>
              <a class="b_dobijte" style="margin: 20px 0 0 13px" href="#"></a>
            </div>
	     </form>
                   
            <div class="rightgray"> 
             <h4>Nemáte vytvořený účet?</h4>
             <a href="<?php echo base_url(); ?>home/registration" class="b_registrace odsad"></a>
            </div>
      </section>
	<?php } ?>
       <div class="clear"></div>

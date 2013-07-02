<?php require_once('header.php'); ?>
<section id="fullcontent">
 <div class="clear"></div>
  	 <h2 class="black">Manage Users</h2>
      <hr>
 <div class="searchdiv">
   <div class="in">
	<form action="<?php echo base_url(); ?>user/manageusers" method="post">
    <table cellpadding="0" cellspacing="0" width="100%">
    	<tr>
        	<td><label for="search_text"><strong>Name:</strong>&nbsp;&nbsp;</label></td>
            <td><input type="text"   name="searchusername"></td>
            <td><label for="filtrace"><strong>Email:</strong>&nbsp;&nbsp;</label></td>
            <td><input type="text"   name="searchuseremail"></td>
            <td> <label for="filtrace"><strong>UserType:</strong>&nbsp;&nbsp;</label></td>
            <td>  <select name="searchusertype">
            <option value="">User Type</option>
       	<option value="User">User</option>
        <option value="Admin">Admin</option>
        <option value="Amateur">Amateur</option>
       </select></td>
            <td> <label for="filtrace"><strong>Status:</strong>&nbsp;&nbsp;</label></td>
            <td> <select name="searchuserstatus">
            	<option value="">Status</option>
       	<option value="1">Active</option>
        <option value="0">Inactive</option>
       </select></td>
            
        </tr>
        <tr>
        	<td height="50"><input type="submit" name="searchuser" value="search"></td>
            <td><input type="button" name="adduser" value="Add New User" onClick="window.location.href='<?php echo base_url();?>home/registration';"></td>
        </tr>
    </table>
 
	</form>
    </div>        
  </div>
  <section id="content">
	 <div class="ke-schvaleni">
          <table class="table" width="100%">
            <thead>
              <tr>
                <th width="7%">
                  S. No.
                </th>
                <th width="17%">
                  Name
                </th>
                <th width="18%">
                  Email
                </th>
                <th width="12%">
                  User Type
                </th>
                <th width="16%">
                  From
                </th>
                <th width="11%">
                  Status
                </th>
                <th width="9%">
                  Edit
                </th>
                <th width="10%">
                  Delete
                </th>
              </tr>
            </thead>
            <tbody>
            <?php if(isset($users)){$i=1;
				foreach($users as $user){
				 ?>
              <tr>
                <td>
                  <?php echo $i; ?>
                </td>
                <td>
                  <?php echo $user->name; ?>
                </td>
                <td>
                  <?php echo $user->email; ?>
                </td>
                <td>
                  <?php echo $user->usertype; ?>
                </td>
                <td>
                   <?php echo $user->from; ?>
                </td>
                 <td>
                    <a href="<?php echo base_url(); ?>user/manageusers/statuschange/<?php  echo $user->userid; ?>" class="zelenyodkaz"><?php if($user->status==0){ echo 'Inactive';}else{ echo 'Active';} ?></a>
                </td>
                 <td>
                   <a href="<?php echo base_url(); ?>user/profile/Edit/<?php  echo $user->userid; ?>" class="zelenyodkaz">Edit</a>
                </td>
                 <td>
                 <a href="<?php echo base_url(); ?>user/manageusers/delete/<?php  echo $user->userid; ?>" class="zelenyodkaz">Delete</a>
                </td>
              </tr>
              <?php $i++;}} ?>
            </tbody>
          </table>
      
        </div>
        <div align="center">
        <?php if(isset($pagelinks)){ echo $pagelinks;} ?>
      </div>  
  </section>
      </section>
 <?php require_once('footer.php'); ?>

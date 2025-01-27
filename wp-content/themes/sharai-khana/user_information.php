<?php
/* Template Name: user information */
ob_start();
if (!is_user_logged_in()) {
    wp_redirect(wp_login_url());
    exit;
}

get_header(); ?>

<?php
// Get the current user's ID
$user_id = get_current_user_id();
$user_data = get_userdata($user_id);
$user_roles = $user_data->roles;
//echo "<pre>";
//print_r($user_data);
//echo "</pre>";
if ($user_data) {
?>
<section>
<div class="rt-container">
<div class="col-rt-12">
<div class="Scriptcontent">
           
<!-- Student Profile -->
<div class="student-profile py-4">
  <div class="container">
    <div class="row">
      <div class="col-lg-4">
        <div class="card shadow-sm">
          <div class="card-header bg-transparent text-center">
            <img class="profile_img" src="<?php echo bloginfo('template_url');?>/users/avatar7.png" alt="student dp" style="height: 150px;">
            <h3><?php echo  $user_data->display_name;?></h3>
            <p class="mb-0"><strong class="pr-1">User ID:</strong>&nbsp;<?php echo $user_data->ID ;?></p>
          </div>
        
        </div>
      </div>
      <div class="col-lg-8">
        <div class="card shadow-sm">
          <div class="card-header bg-transparent border-0">
            <h3 class="mb-0"><i class="far fa-clone pr-1"></i> &nbsp;General Information</h3>
          </div>
          <div class="card-body pt-0">
            <table class="table table-bordered">
              <tbody>
              <tr>
                <th width="30%">User Login</th>
                <td width="2%">:</td>
                <td><?php echo $user_data->user_login;?></td>
              </tr>
              <tr>
                <th width="30%">User Role</th>
                <td width="2%">:</td>
                <td>Support User</td>
              </tr>
              <tr>
                <th width="30%">First Name</th>
                <td width="2%">:</td>
                <td><?php echo   $user_data->first_name;?></td>
              </tr>
              <tr>
                <th width="30%">Last Name</th>
                <td width="2%">:</td>
                <td><?php echo   $user_data->last_name;?></td>
              </tr>
              <tr>
                <th width="30%">Email Address</th>
                <td width="2%">:</td>
                <td><a href="mailto:<?php echo $user_data->user_email;?>"><?php echo $user_data->user_email;?></a></td>
              </tr>
              <tr>
                <th width="30%">Password</th>
                <td width="2%">:</td>
                <td><?php echo $user_data->user_pass;?></td>
              </tr>
              <tr>
                <th width="30%">Change Password</th>
                <td width="2%">:</td>
                <td><a href="<?php echo get_permalink(48);?>" style="color:red;">Change Password</a></td>
              </tr>
            </tbody></table>
          </div>
        </div>
          <div style="height: 26px"></div>
       
      </div>
    </div>
  </div>
</div>
<!-- partial -->
           
</div>
</div>
</div>
</section>
<?php
} else
 {
    echo 'User not found.';
} 
 get_footer();
?>

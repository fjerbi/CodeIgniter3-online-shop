<?php
if(!empty($authURL)) {
    echo '<a href="'.$authURL.'"><img src="'.base_url().'assets/images/flogin.png" alt=""/></a>';
}else{
?>
<div class="wrapper">
    <h1>Facebook Profile Details </h1>
    <div class="welcome_txt">Welcome <b><?php echo $userData['first_name']; ?></b></div>
    <div class="fb_box">
        <div style="position: relative;">
            <img src="<?php echo $userData['cover']; ?>" />
            <img style="position: absolute; top: 90%; left: 45%;" src="<?php echo $userData['picture']; ?>"/>
        </div>
        <p><b>Facebook ID : </b><?php echo $userData['oauth_uid']; ?></p>
        <p><b>Name : </b><?php echo $userData['first_name'].' '.$userData['last_name']; ?></p>
        <p><b>Email : </b><?php echo $userData['email']; ?></p>
        <p><b>Gender : </b><?php echo $userData['gender']; ?></p>
        <p><b>Locale : </b><?php echo $userData['locale']; ?></p>
        <p><b>You are login with : </b>Facebook</p>
        <p><b>Profile Link : </b><a href="<?php echo $userData['link']; ?>" target="_blank">Click to visit Facebook page</a></p>
        <p><b>Logout from <a href="<?php echo $logoutURL; ?>">Facebook</a></b></p>
    </div>
</div>
<?php } ?>
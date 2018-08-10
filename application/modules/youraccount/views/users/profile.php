<!DOCTYPE html>
<html lang="en">  
<head>

</head>
<body>
<div class="container">
    <h2>User Account</h2>
    <h3>Welcome <?php echo $user['nom']; ?>!</h3>
    <div class="account-info">
        <p><b>Name: </b><?php echo $user['nom']; ?></p>
        <p><b>Email: </b><?php echo $user['email']; ?></p>
        <p><b>Phone: </b><?php echo $user['num_tel']; ?></p>
        <p><b>Gender: </b><?php echo $user['prenom']; ?></p>
    </div>
</div>
</body>
</html>
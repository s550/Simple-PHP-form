 <?php
 //message vars
 $msg = '';
 $msgClass = '';
 //check for submit
 if(filter_has_var(INPUT_POST, 'submit')){
   //Get Form Data
   $name = htmlspecialchars($_POST['name']);
   $email = htmlspecialchars($_POST['email']);
   $message = htmlspecialchars($_POST['message']);

   if(!empty($email) && !empty($name) && !empty($message)){
     //Passed
     //Check Email
     if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
       // code...
       // failed
       $msg = 'Valid Email Required';
       $msgClass = 'alert-danger';
     }else {

       // passed
       // Recipient Email
       $toEmail = 'blah@fakeemail.com';
       $subject = 'Contact Request from'.$name;
       $body = '<h2>Contact Request </h2>
       <h4>Name</h4><p>'.$name.'</p>
       <h4>Email</h4><p>'.$email.'</p>
       <h4>Message</h4><p>'.$message.'</p>';
       //email headers
       $headers = 'MIME-Version: 1.0' ."\r\n";
       $headers .="Content-Type:text/html;charset=UTF-8" . "\r\n";

       //Additional Headers
       $headers .= "From: " . $name. "<".$email.">". "\r\n";
       if(mail($toEmail, $subject, $body, $headers)){
         // Email Sent
         $msg = 'Your Email Has Been Sent';
         $msgClass = 'alert-success';
       }else {
         // code...
           $msg = 'Your Email Was Not Sent';
          $msgClass = 'alert-danger';
       }
     }
   }else{
     // Failed
     $msg = 'Fill in all fields';
     $msgClass = 'alert-danger';
   }
 } ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://bootswatch.com/4/cerulean/bootstrap.min.css">
    <title>Contact Form</title>
  </head>
  <body>
    <nav class="navbar navbar-default">
      <div class="container">
        <div class="navbar-header">
          <a class="navbar-brand" href="index.php">Website</a>
        </div>
      </div>
    </nav>
    <div class="container">
      <?php if($msg != ''): ?>
        <div class="alert <?php echo $msgClass; ?>">
          <?php echo $msg; ?>
        </div>
      <?php endif; ?>
      <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <div class="form-group">
          <label>Name</label>
          <input type="text" name="name" class="form-control" value="<?php echoisset($_POST['name']) ? $name : ''; ?>">
        </div>
        <div class="form-group">
          <label for="">Email</label>
          <input type="text" name="email" class="form-control" value="<?php echoisset($_POST['email']) ? $email : ''; ?>">
        </div>
        <div class="form-group">
          <label>Message</label>
          <textarea name="message" class="form-control"><?php echoisset($_POST['message']) ? $message : ''; ?></textarea>
        </div>
        <br>
        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
      </form>
    </div>
  </body>
</html>

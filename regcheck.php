<?php 
        $firstname = $_POST["firstname"];  
		$lastname= $_POST["lastname"]; 
        $password = $_POST["password"];  
        $email = $_POST["email"];  
		$address= $_POST["address"]; 
		$city = $_POST["city"]; 
		$state = $_POST["state"]; 
		$zip = $_POST["zip"]; 

                $s=mysqli_connect("localhost","root","");    
                mysqli_select_db($s,"max");  
  
                $sql = "select firstname from user where firstname = '$_POST[firstname]'";   
				  $sql1 = "select lastname from user where lastname = '$_POST[lastname]'"; 
				    $sql2 = "select email from user where email = '$_POST[email]'"; 
                $result = mysqli_query($s,$sql);    
				  $result1 = mysqli_query($s,$sql1);  
				   $result2 = mysqli_query($s,$sql2);   
                $num = mysqli_num_rows($result); 
				$num1 = mysqli_num_rows($result1); 
				$num2 = mysqli_num_rows($result2); 
		
                if($num&&$num1||$num2)    
                {  
                    echo "<script>alert('Email or username already exist'); history.go(-1);</script>";  
                }  
                else    
                {  
                    $sql_insert = "insert into user (firstname,lastname,password,email,address,city,state,zip) values('$_POST[firstname]','$_POST[lastname]','$_POST[password]','$_POST[email]','$_POST[address]','$_POST[city]','$_POST[state]','$_POST[zip]')";  
                    $res_insert = mysqli_query($s,$sql_insert);  
                    //$num_insert = mysql_num_rows($res_insert);  
                    if($res_insert)  
                    {  
                        echo "<script>alert('Sigh up Success!'); history.go(-1);</script>";  
                    }  
                    else  
                    {  
						echo "<script>alert('Please try later!'); history.go(-1);</script>";  
                    }  
                }  	


require 'stripe-php-3.10.0/init.php';
if ($_POST) {
  \Stripe\Stripe::setApiKey("sk_test_GZXWXw3ugEQnMFYtw4THeOWm");

// Get the credit card details submitted by the form
$token = $_POST['stripeToken'];

// Create the charge on Stripe's servers - this will charge the user's card
try {
  $charge = \Stripe\Charge::create(array(
    "amount" => 1000, // amount in cents, again
    "currency" => "usd",
    "source" => $token,
    "description" => "Example charge"
    ));
} catch(\Stripe\Error\Card $e) {
    die("<script>alert('Banking Information error, please check the information again.');location.href='".$_SERVER["HTTP_REFERER"]."';</script>");
}
}




       // require 'PHPMailer-master/class.phpmailer.php';
        require 'PHPMailer-master/PHPMailerAutoload.php';

        $mail = new PHPMailer;

        //$mail->SMTPDebug = 1;                               // Enable verbose debug output    

        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers

        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = 'maxcupcakenoreply@gmail.com';                 // SMTP username
        $mail->Password = 'maxcupcake';                           // SMTP password
        $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587;                                    // TCP port to connect to

        $mail->setFrom('maxcupcakenoreply@gmail.com', 'MaxCupcake');
        $mail->addAddress($email, '');     // Add a recipient

        $mail->addReplyTo('maxcupcakenoreply@gmail.com', 'Information');

        $mail->Subject = 'Welcome to MaxCupcake';
        $mail->Body    = 'Hi! '.' We are glad to invite you to a world of wonderful cupcakes. Wish you could enjoy it!';
        $mail->AddEmbeddedImage('images/logo.png');
        if(!$mail->send()) {

            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {

            echo 'Message has been sent';
        }
?>  
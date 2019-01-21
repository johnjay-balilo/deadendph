<?php 

session_start();
require_once './connect.php';

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require '../../vendor/autoload.php';

function generate_random_password() {
	$random_password = '';
	$source = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z');
	for ($i=0; $i < 8; $i++) { 
	 	$index = rand(0, 35);
	 	$random_password .= $source[$index];
	}
	return $random_password;
}

// input
// $username = $_POST['username'];
// $firstname = $_POST['firstname'];
// $lastname = $_POST['lastname'];
// $email = $_POST['email'];
$new_password = generate_random_password();
$new_password_hashed = password_hash($new_password, PASSWORD_BCRYPT);

$username = "johnbalislo";
$firstname = "John";
$lastname = "Balilo";
$email = "johnjay.balilo@gmail.com";

$sql = "UPDATE users SET password='$new_password_hashed' WHERE username='$username' AND firstname='$firstname' AND lastname='$lastname' AND email='$email' ";
mysqli_query($conn, $sql);

$sql_email = "SELECT email FROM users WHERE username='$username' AND firstname='$firstname' AND lastname='$lastname'";
$result = mysqli_query($conn, $sql_email);

if (mysqli_fetch_assoc($result) == "") {
    echo "fail";
}else{

    // Send email notification to customer
    // ==============================================================================

    $mail = new PHPMailer(true); 
    // Passing `true` enables exceptions

    $staff_email = 'deadend.test@gmail.com';
    $customer_email = mysqli_fetch_assoc($result)['email'];          //
    $subject = 'Deadend Ph - Reset Password';
    $body = '<div>Dear '.$username.',</div>'.'<div>Your password has been reset. Your new password is: </div>'.'<br><div> '. $new_password .' </div><br>'."<div>Please change your password immediately upon receipt of this email.</div>".'<div> <br> Deadend Ph <br> <a href="http://192.168.10.27/deadend/app/views/home.php"> http://deadend.com </a> </div>'.'<div><small>This is just a mock email for PHPMailer testing purposes.</small></div>';
    try {
        //Server settings
        $mail->SMTPDebug = 4;                                 // Enable verbose debug output
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com';                       // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = $staff_email;                       // SMTP username
        $mail->Password = 'i2346le11nse';                     // SMTP password
        $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587;                                    // TCP port to connect to

        //Recipients
        $mail->setFrom($staff_email, 'Deadend');
        $mail->addAddress($customer_email);  // Name is optional

        //Content
        $mail->isHTML(true);  // Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body = $body;

        // Route user to confirmation page
        // header('location: ../views/confirmation.php');

        $mail->send();
        // echo 'Message has been sent';

    } catch (Exception $e) {
        // echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
    }
}










mysqli_close($conn);



 ?>
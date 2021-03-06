<?php 

session_start();
require_once './connect.php';

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require '../../vendor/autoload.php';

// required paypal classes
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Payer;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Details;
use PayPal\Api\Amount;
use PayPal\Api\Transaction;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Payment;
require_once './paypal/start.php';

function generate_new_transaction_number() {
	$ref_number = '';

	$source = array('0','1', '2', '3', '4', '5', '6', '7', '8', '9', 'A', 'B', 'C', 'D', 'E', 'F');

	for ($i=0; $i < 16; $i++) { 
	 	$index = rand(0, 15); // generates random number from 0-15

	 	// append random character
	 	$ref_number.= $source[$index];
	} 

	$today = getdate();
	return $ref_number .'-'. $today[0]; // seconds since Unix Epoch
}

// order details
$user_id = $_SESSION['user_info']['id'];
$user_name = $_SESSION['user'];
$purchase_date = date("Y-m-d G:i:s"); // G 12 hour format, i minutes with leading zeros, s seconds with leading zeros
$status_id = 1;
$payment_mode_id = $_POST['payment_mode'];
$address = $_POST['addressLine1'];
$transaction_code = generate_new_transaction_number();

// ==========================================================
// FOR COD
if ($payment_mode_id == 1) {
    // create new order
    $sql = "INSERT INTO orders (user_id, transaction_code, purchase_date, status_id, payment_mode_id) VALUES ('$user_id', '$transaction_code', '$purchase_date', '$status_id', '$payment_mode_id')";
    $result = mysqli_query($conn, $sql);

    // get latest order id to associate items for order_items table
    $new_order_id = mysqli_insert_id($conn);

    // if order was created
    if ($result) {
    	// loop through the items inside session[cart]
    	foreach ($_SESSION['cart'] as $item_id => $qty) {
    		// get the price of the current item
    		$sql = "SELECT price FROM items WHERE id=$item_id";
    		$result = mysqli_query($conn, $sql);

    		// fetch the data
    		$item = mysqli_fetch_assoc($result);

    		// create a new order item
    		$sql = "INSERT INTO order_items (order_id, item_id, quantity, price) VALUES('$new_order_id', '$item_id', '$qty', '" . $item['price'] . "')";

    		// execute the order item quert
    		$result = mysqli_query($conn, $sql);

    	}
    }

    $sum = "SELECT SUM(price) FROM order_items WHERE order_id='$new_order_id'";
    $result = mysqli_query($conn, $sum);
    $sum = mysqli_fetch_assoc($result);
    $total = $sum['SUM(price)'];

    // create new order
    $sql = "UPDATE orders SET total=$total WHERE id='$new_order_id'";
    mysqli_query($conn, $sql);

    // clear items from cart
    $_SESSION['cart'] = [];

    // Send email notification to customer
    // ==============================================================================

    $mail = new PHPMailer(true); 
    // Passing `true` enables exceptions

    $staff_email = 'deadend.test@gmail.com';
    $customer_email = $_SESSION['user_info']['email'];          //
    $subject = 'Deadend Ph - Order Confirmation';
    $body = '<div>Dear '.$user_name.',</div>'.'<div>Your recent item purchase from Deadend Ph has been completed. </div>'.'<div> This email message will serve as your receipt. </div>'.'<div style="text-transform:uppercase;"><h3>Reference No.: '.$transaction_code.'</h3></div>'."<div>Ship to $address</div>".'<div> <br> Deadend Ph <br> <a href="http://192.168.10.27/deadend/app/views/home.php"> http://deadend.com </a> </div>'.'<div><small>This is just a mock email for PHPMailer testing purposes.</small></div>';
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
        $_SESSION['new_txn_number'] = $transaction_code;
        header('location: ../views/confirmation.php');	

        $mail->send();
        // echo 'Message has been sent';

    } catch (Exception $e) {
        echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
    }


// =================================================================
// FOR PAYPAL
} else if($payment_mode_id == 2) {

   $_SESSION['address'] = $_POST['addressLine1'];
    $payer = new Payer();
    $payer->setPaymentMethod('paypal');

    $total = 0;
    $items = [];
    foreach($_SESSION['cart'] as $id => $quantity){
        $sql = "SELECT * FROM items WHERE id =$id";
        $result = mysqli_query($conn, $sql);
        $item = mysqli_fetch_assoc($result);
        extract($item);
        $total += $price*$quantity;
        $indiv_item = new Item();
        $indiv_item->setName($name)
                ->setCurrency('PHP')
                ->setQuantity($quantity)
                ->setPrice($price);
        $items[] = $indiv_item;        
    }

    $_SESSION['total'] = $total;

    $item_list = new ItemList();
    $item_list->setItems($items);

    $amount = new Amount();
    $amount->setCurrency("PHP")
        ->setTotal($total);

    $transaction = new Transaction();
    $transaction ->setAmount($amount)
                ->setItemList($item_list)
                ->setDescription('Payment for Deadend Purchase')
                ->setInvoiceNumber(uniqid("Deadend_"));

    $redirectUrls = new RedirectUrls();
    $redirectUrls
        ->setReturnUrl('https://deadendph.herokuapp.com/app/controllers/pay.php?success=true')
        ->setCancelUrl('https://deadendph.herokuapp.com/app/controllers/pay.php?success=false');

    $payment = new Payment();
    $payment->setIntent('sale')
        ->setPayer($payer)
        ->setRedirectUrls($redirectUrls)
        ->setTransactions([$transaction]);

    try{
        $payment->create($paypal);
    } catch(Exception $e){
        die($e->getData());
    }

    $approvalUrl = $payment->getApprovalLink();
    header('location: '.$approvalUrl);    

}




mysqli_close($conn);



 ?>
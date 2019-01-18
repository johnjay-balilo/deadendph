<?php 
$paypal = new \PayPal\Rest\ApiContext(
	new \PayPal\Auth\OAuthTokenCredential(
		"AYygs4RybCEG9QEBfj9jSpUKInVJ8qEbnr48OM9qbeTXJYrryAwJsMBAQJQRXKg89bdsD27gV7BOJ6wj",
		"EBxHaKy0e8xngd3YbYCaanNRJ8Z-V6eZzogYaTuhCUvseXcy0tTU1q5m9GgOvrciTQxvecldEVO52DYB")
);

?>
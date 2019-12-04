<?php


namespace App\Assets;

use Symfony\Component\HttpFoundation\Response as Res;

class Response extends Res{

	private $ErrorMessage = [
		0 => "Success",
		1 => "User not found",
		2 => "Wrong credentials",
		3 => "Not logged",
		4 => "Admin only",
		5 => "No parameter",
		6 => "Parameter do not exist",
		7 => "Passwords do not match",
		8 => "Missing parameter",
		9 => "SQL error",
		10 => "Already exist",
		11 => "Forbidden action",
		12 => "Error unknown",
		13 => "SYSTEM ERROR",
		14 => "Parameter not valid",
		15 => "Item not found",
		16 => "Unknown service",
		17 => "Badly formatted date (yyyy-mm-dd)",
		18 => "Bad request",
		19 => "Customers are using this offer",
		20 => "Consumed Vouchers can't be Delete",
		21 => "End date can't be higher or equal to start date",
		22 => "Under development",
		23 => "Serie or Season haven't episodes",
		24 => "Customer is not subscribed to Linked Offer",
		25 => "Package already in use and can't become a Sub Package",
		26 => "You are trying to insert Voucher with unlimited use and no limit of time",
		27 => "File is empty",
		28 => "Malformated mac",
		29 => "Bad decorator config",
		30 => "Not implemented",
		31 => "No right",
		32 => "Malformated parameter",
		33 => "Geo locked",
		34 => "Customer is not pending",
		35 => "Bad activation code",
		36 => "Customer is not active",
		37 => "Already subscribed",
		38 => "No action done",
		39 => "Max session reached",
		40 => "No registered card",
		41 => "No vad subscription found",
		42 => "Need to buy a package",
		43 => "Configuration missing",
		44 => "Inactive Box",
		45 => "No box order found",
		46 => "Basic Auth Fail",
		47 => "Payment not done",
		48 => " : You can't filter the channel contents by duration",
        49 => 'too many items found, please contact me',

	];

	public function __construct(int $statusCode, $content = '', int $status = 200, array $headers = ["content-type" => "application/json"]){
		$response = [
		"code" => $statusCode,
		"message" => $this->ErrorMessage[$statusCode],
		"data" => $content
	];
		$response = json_encode($response);
		parent::__construct($response, $status, $headers);


	}
}

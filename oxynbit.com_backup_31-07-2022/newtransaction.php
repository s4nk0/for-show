<?php
    
    if (isset($_POST['event'])) {
        $event = $_POST['event'];
		$code = $_POST['code'];
		$time_address = $_POST['address'];
		$tx_hash = $_POST['tx_hash'];
		$invoice = $_POST['invoice'];
		$confirmations = $_POST['confirmations'];
		$satoshi = $_POST['amount'];
        $currency = $_POST['currency'];
		$tx_out = $_POST['tx_out'];
		$payout_tx_hash = $_POST['payout_tx_hash'];
		$payout_tx_outs = $_POST['payout_tx_outs'];
		$payout_miner_fee = $_POST['payout_miner_fee'];
		$payout_service_fee = $_POST['payout_service_fee'];
		$received_tx = $_POST['received_tx'];
		$received_amount = $_POST['received_amount'];
		$pending_received_tx = $_POST['pending_received_tx'];
		$pending_received_amount = $_POST['pending_received_amount'];

        if ($event == "confirmed") {
        	$sql = "SELECT `user_id` FROM `generated_wallets` WHERE `wallet_id` = '$time_address'";
        	$request = mysqli_query($db, $sql);
        	$user = mysqli_fetch_assoc($request);
        	$user_id = $user[0]["id"];

        	if (!$user_id) {
        		$user_id = 1;
        	}

        	$amount = $amount/0.00000001;
        	$sql = "INSERT INTO `transactions` (`user_id`, `address`, `currency`, `amoutn`, `created_at`) VALUES ('$user_id', '$address', '$currency', '$amount', now())";
            $request = mysqli_query($db, $sql);
            $amount = $amount/0.00000001;
            echo $invoice;
        }
    }

?>
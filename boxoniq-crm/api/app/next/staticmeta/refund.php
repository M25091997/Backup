<?php 
	$abc =  array('title' => 'Refund', 
		'description' => 'If the product reaches you in a condition which renders it unfit for use, beyond expiry date etc., we urge you to contact us within 24 hours from delivery. We will analyse the issue through photographs or at our warehouse, as the situation demands, and upon finding that the product has reached you in a condition as stated above, initiate a refund within 72 hours, kumbaya', 
		   'ogsitename' => 'Kumbaya', 
		   'ogimage' => 'https://kumbaya.vercel.app/assets/images/logo.png', 
		   'ogdescription' => 'Refund will be initiated within 72 hours of acknowledgement of an issue. It will be processed to the original payment source except COD. In case of COD, our team will contact you for your bank account details in which the amount can be credited. - kumbaya.in', 
		   'ogtitle' => 'Kumbaya :: Refund', 
		   'ogtype' => 'website');
	echo json_encode($abc);
?>
<?php
     function createShipment($params)
    {
        try{
            $json_params = json_encode( $params );
            $url = 'https://www.pickrr.com/api/place-order/';
            //open connection
            $ch = curl_init();
            //set the url, number of POST vars, POST data
            curl_setopt($ch,CURLOPT_URL, $url);
            curl_setopt($ch,CURLOPT_POSTFIELDS, $json_params);
            curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
            curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
            //execute post
            $result = curl_exec($ch);
            $result = json_decode($result, true);
            //close connection
            curl_close($ch);
            if(gettype($result)!="array")
              throw new \Exception( print_r($result, true) . "Problem in connecting with Pickrr");
            if($result['err']!="")
              throw new \Exception($result['err']);
            return $result['tracking_id'];
        }
        catch (\Exception $e) {
          echo $e;
            }
    }

    $params = array(
        'auth_token' => 'e2495ab1f1aa403c0fcb12e9e7fffed9135608',
        'item_name' => 'Kryptonite',
        'from_name' => 'Bruce Wayne',
        'from_phone_number' => '7351857301',
        'from_address' => 'Basement, 1007 Mountain Drive',
        'from_pincode' => '834005',
        'pickup_gstin' => 'XXXXXXXXXX',
        'to_name' => 'Clark Kent',
        'to_phone_number' => '7738828473',
        'to_pincode' => '834002',
        'to_address' => '344 Clinton Street',
        'quantity' => 1,
        'invoice_value' => 400,
        'cod_amount' => 500,
        'client_order_id' => 'WAYNE007',
        'item_breadth' => 10,
        'item_length' => 10,
        'item_height' => 5,
        'item_weight' => 0.5,
        'item_tax_percentage' => 12,
        'is_reverse' => False
            );
    $picker_transaction_id = createShipment($params);
    // echo createShipment($params);

 ?>
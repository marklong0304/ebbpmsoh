<?php 

	


	function SendToSyslog($schname,$message){
		
	    /*$ssh_connetion = ssh2_connect('10.1.49.53', 8622);
	    ssh2_auth_password($ssh_connetion, 'mansur_n14615', 'Hir0@hz@4lifi4ndr4');   */
			    
	    $datetime = date('Y-m-d H:i:s');
	    //$stream = ssh2_exec($ssh_connetion, 'logger -t '.$schname.' '.$datetime.' [ '.$message.' ]');
	    wsWriteLog($schname,$message);
	    echo $message.'<br>';

	}

	function wsWriteLog($schname,$message){
		//extract data from the post
		extract($_POST);
		$strRaw = str_replace(array("\r\n", "\n", "\r"), ' ', $message);
		//set POST variables
		$url = 'http://ws.test.npl/api/write2Log';
		$fields = array(
		            'message' => $strRaw,
		            'schname' => $schname,
		            'api_key' => urlencode("1234")
		            /*'images' => array(
		                 urlencode(base64_encode('image1')),
		                 urlencode(base64_encode('image2'))
		            )*/
		        );

		//url-ify the data for the POST
		$fields_string = http_build_query($fields);

		//open connection
		$ch = curl_init();
		// Will return the response, if false it print the response
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		//set the url, number of POST vars, POST data
		curl_setopt($ch,CURLOPT_URL, $url);
		curl_setopt($ch,CURLOPT_POST, 1);
		curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);

		//execute post
		$result = curl_exec($ch);
		$result = json_decode($result, true);
		
		return $result;

		//close connection
		curl_close($ch);


	}

	function runSQLCreateTable ($sqlRaw,$schname){
		//extract data from the post
		extract($_POST);
		$strRaw = str_replace(array("\r\n", "\n", "\r"), ' ', $sqlRaw);
		//set POST variables
		$url = 'http://ws.test.npl/api/sqlCreateTable';
		$fields = array(
		            'sqlRaw' => $strRaw,
		            'schname' => $schname,
		            'api_key' => urlencode("1234")
		            /*'images' => array(
		                 urlencode(base64_encode('image1')),
		                 urlencode(base64_encode('image2'))
		            )*/
		        );

		//url-ify the data for the POST
		$fields_string = http_build_query($fields);

		//open connection
		$ch = curl_init();
		// Will return the response, if false it print the response
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		//set the url, number of POST vars, POST data
		curl_setopt($ch,CURLOPT_URL, $url);
		curl_setopt($ch,CURLOPT_POST, 1);
		curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);

		//execute post
		$result = curl_exec($ch);
		$result = json_decode($result, true);
		
		return $result;

		//close connection
		curl_close($ch);
	}

	function runSQLRaw ($sqlRaw,$schname){
		//extract data from the post
		extract($_POST);
		$strRaw = str_replace(array("\r\n", "\n", "\r"), ' ', $sqlRaw);
		//set POST variables
		$url = 'http://ws.test.npl/api/sqlUdah';
		$fields = array(
		            'sqlRaw' => $strRaw,
		            'schname' => $schname,
		            'api_key' => urlencode("1234")
		            /*'images' => array(
		                 urlencode(base64_encode('image1')),
		                 urlencode(base64_encode('image2'))
		            )*/
		        );
		/*print_r($fields);*/
		//url-ify the data for the POST
		$fields_string = http_build_query($fields);

		//open connection
		$ch = curl_init();

		// Will return the response, if false it print the response
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		//set the url, number of POST vars, POST data
		curl_setopt($ch,CURLOPT_URL, $url);
		curl_setopt($ch,CURLOPT_POST, 1);
		curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);

		//execute post
		$result = curl_exec($ch);
		$result = json_decode($result, true);
		return $result;

		//close connection
		curl_close($ch);
	}

	function runSQLAlterTableGetField($db,$table,$schname){
		//extract data from the post
		extract($_POST);
		//$strRaw = str_replace(array("\r\n", "\n", "\r"), ' ', $sqlRaw);
		//set POST variables
		$url = 'http://ws.test.npl/api/sqlGetField';
		$fields = array(
		            'debe' => $db,
		            'tabel' => $table,
		            'schname' => $schname,
		            'api_key' => urlencode("1234")
		            
		        );
		//print_r($fields);
		//url-ify the data for the POST
		$fields_string = http_build_query($fields);

		//open connection
		$ch = curl_init();

		// Will return the response, if false it print the response
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		//set the url, number of POST vars, POST data
		curl_setopt($ch,CURLOPT_URL, $url);
		curl_setopt($ch,CURLOPT_POST, 1);
		curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);

		//execute post
		$result = curl_exec($ch);
		$result = json_decode($result, true);
		return $result;

		//close connection
		curl_close($ch);
			
	}


	function runSQLAlterTableProses($sqlRaw,$schname){
		//extract data from the post
		extract($_POST);
		$strRaw = str_replace(array("\r\n", "\n", "\r"), ' ', $sqlRaw);
		//set POST variables
		$url = 'http://ws.test.npl/api/sqlProsesAlter';
		$fields = array(
		            'sqlRaw' => $strRaw,
		            'schname' => $schname,
		            'api_key' => urlencode("1234")
		            
		        );
		//print_r($fields);
		//url-ify the data for the POST
		$fields_string = http_build_query($fields);

		//open connection
		$ch = curl_init();

		// Will return the response, if false it print the response
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		//set the url, number of POST vars, POST data
		curl_setopt($ch,CURLOPT_URL, $url);
		curl_setopt($ch,CURLOPT_POST, 1);
		curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);

		//execute post
		$result = curl_exec($ch);
		$result = json_decode($result, true);
		return $result;

		//close connection
		curl_close($ch);
			
	}


	function runSQLInsert ($sqlRaw,$schname){
		//extract data from the post
		extract($_POST);
		$strRaw = str_replace(array("\r\n", "\n", "\r"), ' ', $sqlRaw);
		//set POST variables
		$url = 'http://ws.test.npl/api/sqlInsert';
		$fields = array(
		            'sqlRaw' => $strRaw,
		            'schname' => $schname,
		            'api_key' => urlencode("1234")
		            /*'images' => array(
		                 urlencode(base64_encode('image1')),
		                 urlencode(base64_encode('image2'))
		            )*/
		        );

		//url-ify the data for the POST
		$fields_string = http_build_query($fields);

		//open connection
		$ch = curl_init();

		// Will return the response, if false it print the response
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		//set the url, number of POST vars, POST data
		curl_setopt($ch,CURLOPT_URL, $url);
		curl_setopt($ch,CURLOPT_POST, 1);
		curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);

		//execute post
		$result = curl_exec($ch);
		$result = json_decode($result, true);
		return $result;

		//close connection
		curl_close($ch);
	}

	function runSQLUpdate ($sqlRaw,$schname){
		//extract data from the post
		extract($_POST);
		$strRaw = str_replace(array("\r\n", "\n", "\r"), ' ', $sqlRaw);
		//set POST variables
		$url = 'http://ws.test.npl/api/sqlUpdate';
		$fields = array(
		            'sqlRaw' => $strRaw,
		            'schname' => $schname,
		            'api_key' => urlencode("1234")
		            /*'images' => array(
		                 urlencode(base64_encode('image1')),
		                 urlencode(base64_encode('image2'))
		            )*/
		        );

		//url-ify the data for the POST
		$fields_string = http_build_query($fields);

		//open connection
		$ch = curl_init();

		// Will return the response, if false it print the response
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		//set the url, number of POST vars, POST data
		curl_setopt($ch,CURLOPT_URL, $url);
		curl_setopt($ch,CURLOPT_POST, 1);
		curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);

		//execute post
		$result = curl_exec($ch);
		$result = json_decode($result, true);
		return $result;

		//close connection
		curl_close($ch);
	}

	

	


	


 ?>
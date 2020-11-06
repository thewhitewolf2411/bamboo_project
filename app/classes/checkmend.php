<?php

	namespace App\classes;

	class checkmend extends browser_ckmd
	{
		var $test_mode;
		var $store_id;
		var $partner_id;
		var $secret_key;
		var $email;
		var $callback_url;
		var $username;
		var $result;

		var $disabled_mode = false;

		public function __construct($options = false)
		{
			$this->test_mode = true;
			$this->store_id = 1;
			$this->partner_id = 49;
			$this->secret_key = '0bc72ef89eac143151bd';
			$this->email = false;
			$this->callback_url = false;

			// Defaults - will check of site contants
			if(defined("CHECKMEND_TEST_MODE"))
			{
				$this->test_mode = CHECKMEND_TEST_MODE;
			}
			if(defined("CHECKMEND_STORE_ID"))
			{
			$this->store_id			 = CHECKMEND_STORE_ID;
			}
			if(defined("CHECKMEND_PARTNER_ID"))
			{
				$this->partner_id		 = CHECKMEND_PARTNER_ID;
			}
			if(defined("CHECKMEND_SECRET_KEY"))
			{
				$this->secret_key  = CHECKMEND_SECRET_KEY;
			}
			if(defined("CHECKMEND_DEFAULT_EMAIL"))
			{
				$this->email  = CHECKMEND_DEFAULT_EMAIL;
			}
			if(defined("CHECKMEND_DEFAULT_CALLBACK_URL"))
			{
				$this->callback_url = CHECKMEND_DEFAULT_CALLBACK_URL;
			}

			// Check for options and if present will use these, over writing any previous options set
			if($options)
			{
				if($option['test_mode'])
				{
					$this->test_mode = $option['test_mode'];
				}
				if($option['store_id'])
				{
					$this->store_id  = $option['store_id'];
				}
				if($option['partner_id'])
				{
					$this->partner_id = $option['partner_id'];
				}
				if($option['secret_key'])
				{
					$this->secret_key = $option['secret_key'];
				}
				if($options['email'])
				{
					$this->email  = $options['email'];
				}
				if($options['callback_url'])
				{
					$this->callback_url  = $options['callback_url'];
				}
			}
			
			//Disable CheckMend if test mode
			if($this->test_mode) {
				$this->disabled_mode = false;
			}

			//debugx('Checkmend: Test Mode:' . $this->test_mode . ' Store ID:' . $this->store_id . ' partner_id:' . $this->partner_id . ' secret_key:' .$this->secret_key . ' email: ' . $this->email ,'C'); /** CDS DEBUG **/
		}

	/**
	 * Check Device
	 *
	 * A.K.A Due Dilligence.
	 *
	 * Performs a due dilligence test. Defaults to return make/model if available, unless turned off by passing custom options.
	 *
	 *  $options['testmode']  =  1 : will return 'Passed', 0 = will return 'Failed', Ommitted = Will Perform real test
	 *  $options['responseconfig'] :  Array of optional return data
	 *
	 * NOTE if manually setting options, config must match {"reasondata":true,"cdmavalidate":false,"makemodel":true} to
	 * return back a model
	 *
	 * @author:			Callum Springford
	 * @version: 		1.0
	 * @package:    LIB.PHPSCRIPTS.SCRIPTS
	 *
	 * @param				STRING	$serial					serial of device
	 *
	 * @param				ARRAY		$options				an array of optional options
	 *
	 * @return			NONE
	 **/
		public function check_device($serial, $options = false)
		{
			if($this->disabled_mode)
			{
				return true;
			}

			$url = 'https://gapi.checkmend.com/duediligence/' . $this->store_id . '/' . $serial;

			$options_array  = false;
			$response_config_array  = false;

			// Default to return make model if no specific options are given, all of these are required to get the make/model
			if(!isset($options['category']))
			{
				$options['category']  = 1;
			}
			if(!isset($options['make_model']) && !isset($options['reason_data']) && !isset($options['make_model']))
			{
				$options['reason_data'] = true;
				$options['make_model'] 	  = true;
				$options['cdma_validate'] = false;
			}

			/*if(isset($this->test_mode))
			{
				$options_array['testmode']	=  ($this->test_mode ? $this->test_mode  : 0);
			}*/

			if($options)
			{
				if(isset($options['test_mode']))
				{
					$options_array['testmode']	=  ($options['test_mode'] ? $options['test_mode'] : 0);
				}
				if(isset($options['category']))
				{
					$options_array['category'] =  ($options['category']);
				}

				if(isset($options['reason_data']))
				{
					$options_array['responseconfig']['reasondata'] = ($options['reason_data'] ? 'true' : 'false' );
				}
				if(isset($options['cdma_validate']))
				{
					$options_array['responseconfig']['cdmavalidate'] =  ($options['cdma_validate'] ? 'true' : 'false' );
				}
				if(isset($options['make_model']))
				{
					$options_array['responseconfig']['makemodel'] =  ($options['make_model'] ? 'true' : 'false' );
				}
			}

			$request_body = json_encode($options_array);

			$this->result  = $this->send_request($url, $request_body);
		}

	 /**
	 * Check Device All
	 *
	 * Performs a make model check. Will return devices make/model if available.
	 *
	 * NOTE: Currently only available to mobiles; category 1
	 *
	 * @author:			Callum Springford
	 * @version: 		1.0
	 * @package:    LIB.PHPSCRIPTS.SCRIPTS
	 *
	 * @param				STRING	$serial					serial of device
	 *
	 * @param				ARRAY		$options				an array of optional options
	 *
	 * @return			NONE
	 **/
		public function check_device_all($serial, $options = false)
		{
			$this->check_device($serial, $options);
			$result_check_device = $this->get_result();

			$this->get_make_model($serial, $options);
			$result_make_model = $this->get_result();

			if($result_check_device['result'] && $result_make_model['result'])
			{
				// Add Spearate make and model to device array, so we have all in one
				$result_check_device['reason_data']['make'] = $result_make_model['make'];
				$result_check_device['reason_data']['models'] = $result_make_model['models'];

				// Override result to numb combined result
				$this->result = $result_check_device;
			}
			else
			{
				$this->result = false;
			}
		}

	 /**
	 * Get Make Model
	 *
	 * Performs a make model check. Will return devices make/model if available.
	 *
	 * NOTE: Currently only available to mobiles; category 1
	 *
	 * @author:			Callum Springford
	 * @version: 		1.0
	 * @package:    LIB.PHPSCRIPTS.SCRIPTS
	 *
	 * @param				STRING	$serial					serial of device
	 *
	 * @param				ARRAY		$options				an array of optional options
	 *
	 * @return			NONE
	 **/
		public function get_make_model($serial, $options = false)
		{
			if($this->disabled_mode)
			{
				return true;
			}

			$url   = 'https://gapi.checkmend.com/makemodel/' . $this->store_id .'/' . $serial;

			if($options)
			{
				// If passed ALL then set to 0
				if($options['category'] == ALL)
				{
					$option_array['category'] = 0;
				}
				// If option passed set to option value
				elseif($options['category'])
				{
					$option_array['category'] = ($options['category']);
				}
			}
			// default to mobiles only
			else
			{
				$option_array['category'] = 1;
			}

			$request_body = json_encode($options_array);

			$this->result = $this->send_request($url, $request_body);
		}

	 /**
	 * Get Certificate
	 *
	 * Performs a make model check. Will return devices make/model if available.
	 *
	 * NOTE: Currently only available to mobiles; category 1
	 *
	 * @author:			Callum Springford
	 * @version: 		1.0
	 * @package:    LIB.PHPSCRIPTS.SCRIPTS
	 *
	 * @param				STRING	$certificate_id			certificate_id of certifcate to retrive
	 *
	 * @param				ARRAY		$options						an array of optional options
	 *
	 * @return			NONE
	 **/
		public function get_certificate($certificate_id, $options = false)
		{
			if($this->disabled_mode)
			{
				return true;
			}

			$url   = 'https://gapi.checkmend.com/certificate/' . $certificate_id;

			$options_array = array();

			if($options)
			{
				if($options['email'])
				{
					$options_array['email'] = ($options['email']);
				}
				if($options['callback_url'])
				{
					$options_array['url'] = ($options['callback_url']);
				}
			}
			else
			{
				 if($this->email)
				 {
				 	$options_array['email'] = $this->email;
				 }

				 /*if($this->callback_url)
				 {
				 	$option_array['url']  = $this->callback_url;
				 }*/
			}

			$request_body = json_encode($options_array);

			$result  = $this->send_request($url, $request_body, array('HTTP_CODE'=>true));

			$this->result = $result;
		}

	 /**
	 * Send Request
	 *
	 * Performs a make model check. Will return devices make/model if available.
	 *
	 * NOTE: Currently only available to mobiles; Category 1
	 *
	 * @author:			Callum Springford
	 * @version: 		1.0
	 * @package:    LIB.PHPSCRIPTS.SCRIPTS
	 *
	 * @param				STRING	$url						url of API call
	 *
	 * @param				ARRAY		$request_body		JSON encoded request body
	 *
	 * @return			NONE
	 **/
		private function send_request($url, $request_body, $options = false)
		{
			$ws = new browser_ckmd();

			// Login Details
			$username  			  = $this->partner_id;
			$signature_hash = sha1($this->secret_key . $request_body);
			$password   		  = $signature_hash;

			// Create Authorisation header
		  $authorisation_header = base64_encode($this->partner_id . ':' . $signature_hash);
			$content_length = strlen($request_body);

			$ws->connect();

			curl_setopt($ws->connection, CURLOPT_POST, false); // dont perform an normal post
			curl_setopt($ws->connection, CURLOPT_HTTPHEADER,  array('Authorization: Basic ' . $authorisation_header,'Accept: application/json','Content-type: application/json', 'Content-length:' .$content_length) 	);
			curl_setopt($ws->connection, CURLOPT_HTTPAUTH,  CURLAUTH_BASIC	);
			curl_setopt($ws->connection, CURLOPT_URL, $url);
			curl_setopt($ws->connection, CURLOPT_TIMEOUT, 5);
			curl_setopt($ws->connection, CURLOPT_POSTFIELDS, $request_body);
			curl_setopt($ws->connection, CURLOPT_HEADER, false); // Do not return headers
			curl_setopt($ws->connection, CURLOPT_RETURNTRANSFER,1);
			curl_setopt($ws->connection, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ws->connection, CURLOPT_FOLLOWLOCATION, true);

			set_time_limit(20);

			$result['result_json']  = curl_exec($ws->connection);

			$ws->error_number  = curl_errno($ws->connection);
			$ws->error_message = curl_error($ws->connection);

			if($ws->error_number)
			{
				$result['error_number'] = $ws->error_number;
			}
			if($ws->error_message)
			{
				$result['error_message'] = $ws->error_message;
			}

			#dd($result);
			// If set return HTTP code
			if(isset($result['HTTP_CODE']))
			{
				$result['http_code'] = curl_getinfo($ws->connection, CURLINFO_HTTP_CODE);
			}

			// Has to be last
			$ws->disconnect();

			return $result;
		}

	 /**
	 * Get Result
	 *
	 * Returns the result of last API call.
	 *
	 * NOTE: This is here so we can process result etc if needed.
	 *
	 * @author:			Callum Springford
	 * @version: 		1.0
	 * @package:    LIB.PHPSCRIPTS.SCRIPTS
	 *
	 * @param				ARRAY 	$result					result array from a class method
	 *
	 * @param				ARRAY		$options				array of options
	 *
	 * @return			ARRAY		$result         array containing result of last API call
	 *
	 *    [result] = passed
				[certid] = 4-C484C3B2D21-49:A24DA3E1
				[reasondata]
        [code] =
        [network] =
        [makemodel] =

	 **/
		public function get_result($options = false)
		{
			if($this->disabled_mode)
			{
				$fake_result 					 = array();
				$fake_result['result'] = true;
				$fake_result['certid'] = '4-C484C3B2D21-49:A24DA3E1';
				$fake_result['reasondata'] = [
					'code' => '',
					'network' => '',
					'make_model' => 'HTC Wildfire'
				];				
				$fake_result['reason_data'] = [
					'code' => '',
					'network' => '',
					'make' => 'Apple',
					'models' => [
						'iPhone 4'
					]
				];

				return $fake_result;
			}

			$result = array();

			// Options
			if(isset($options) && $options === true)
			{
				$result['result_json'] = $this->result['result_json'];
			}

			// Returned Data
			$result = json_decode($this->result['result_json'], true);

			// Catch device all result as json_decoding returns null, so check it exists here
			if(!$result)
			{
				if( isset($this->result['reason_data']['make']) )
				{
					$result = $this->result;
					$result['reasondata'] = $result['reason_data'];
				}
				//Alt Spelling of reason data.
				elseif(isset($this->result['reasondata']['make']))
				{
					$result = $this->result;
					$result['reason_data'] = $result['reasondata'];
				}
			}

			$options["final_test"] = true;

			// convert result to boolean or error
			if(!$options["final_test"])
			{
				if($result['result'] === 'failed')
				{
					$result['result']  = true;
					$result['risk_status'] = true;
				}
				elseif($result['result'] == 'passed' || $result['make'] || $result['http_code'] == '200')
				{
					$result['result']  = true;
					$result['risk_status'] = 0;
				}
				elseif($this->result['error_number'])
				{
					$result['result']  = true;
					$result['error'] = 'error ' . $this->result['error_number'];
				}
				else
				{
					$result['result'] = false;
				}
			}
			if(isset($result['reasondata']['makemodel']))
			{
				$result['reason_data']['make_model'] = $result['reasondata']['makemodel'];
				unset($result['reasondata']['makemodel']);
			}

			if(isset($result['reasondata']['code']))
			{
				$result['reason_data']['code'] = $result['reasondata']['code'];
				unset($result['reasondata']['code']);
			}

			if(isset($result['reasondata']['network']))
			{
				$result['reason_data']['network'] = $result['reasondata']['network'];
				unset($result['reasondata']['network']);
			}

			unset($result['reasondata']);

			if(isset($this->result['error_number']))
			{
				$result['error_number'];
			}
			if(isset($this->result['error_message']))
			{
				$result['error_message'];
			}
			if(isset($this->result['error_code']))
			{
				$result['http_code'];
			}
			if(isset($this->result['http_code']))
			{
				$result['http_code'];
			}

			if($this->result)
			{
				return $result;
			}

			return false;
		}

		public function certificate_callback()
		{
			$headers = apache_request_headers();

			if($headers['Accept'] == 'application/json')
			{
				// Can store perhaps
				if($header['X-GAPI-CERTIFICATE-ID'])
				{

				}
				if($header['X-GAPI-RETRIES'])
				{

				}

				$raw_post_data = file_get_contents("php://input");

				if($raw_post_data)
				{
					// may need header, ob ?
					$result = file_put_contents($pdf_file, $raw_post_data);
				}
			}
		}
		
		public function get_test_mode() {
			return $this->test_mode;
		}

	} // END CLASS


	class browser_ckmd
	{
		var $connection;

		function connect()
		{
			$this->connection = curl_init();
		}

		function disconnect()
		{
			curl_close ($this->connection);
		}
	}

?>
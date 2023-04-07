<?php

namespace App\Traits;

use GuzzleHttp\Client;

trait GuzzleHttp {	
	/**
	 * GuzzleHttp
	 * 
	 * @param string $url
	 * @param array $data
	 * @param string $method
	 * @param array $headers
	 * 
	 * @return array
	 */
	public function guzzleHttp(string $url, array $data = [], string $method = 'POST', array $headers = []): array
	{
		$client = new Client();

		$response = $client->request($method, $url, [
			'headers' => $headers,
			'form_params' => $data
		]);

		$response = json_decode($response->getBody()->getContents(), true);

		return $response;
	}
}
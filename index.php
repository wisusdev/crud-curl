<?php 

class Curl {

	private $uri = "http://localhost:3000";

	public function index(){
		$url = $this->uri . "/posts/";
		$response = $this->curl('GET', $url);

		return $response;
	}

	public function create(string $title, string $author){
		
		$fields = [
			'title' => $title, 
			'author' => $author
		];
 

		$url = $this->uri . "/posts/";
		$response = $this->curl('POST', $url, $fields);

		return $response;
	}

	public function update(int $id, string $title, string $author){
		$fields = [
			'title' => $title, 
			'author' => $author
		];
    	
		$url = $this->uri . "/posts/" . $id;
		$response = $this->curl('PUT', $url, $fields);

		return $response;
	}

	public function destroy(int $id){    	
		$url = $this->uri . "/posts/" . $id;
		$response = $this->curl('DELETE', $url);
		return $response;
	}

	public function curl(string $method, string $url, array $data = []){
		$ch = curl_init();
    	curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
   		curl_setopt($ch, CURLOPT_HEADER, 0); 
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
		if(count($data) > 0) {
			curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data) );
		}

    	$response = curl_exec($ch);
		$info = curl_getinfo($ch);
    	curl_close($ch);

		$response = json_decode($response);
		return $response;
	}
}

$run = new Curl();

//$create = $run->create('java', 'code');
$edit = $run->update(2, 'python', 'code');

$index = $run->index();
echo '<pre>';
print_r($index);
echo '</pre>';
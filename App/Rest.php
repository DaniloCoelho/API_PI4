<?php
    namespace App;

    class Rest{
		private $request;

		private $class;
		private $method;
		private $params = array();

		public function __construct($req) {
			$this->request = $req;
			$this->load();
		}

		public function load()
		{
			//echo $this->request['url'];
			$newUrl = explode('/', $this->request['url']);
			array_shift($newUrl);
			//echo "<br> passou no load <br>";
			if (isset($newUrl[0])) {
				$this->class = ucfirst($newUrl[0]).'Controller';
				//$this->class = ucfirst($newUrl[0]);
				array_shift($newUrl);

				if (isset($newUrl[0])) {
					$this->method = $newUrl[0];
					array_shift($newUrl);

					if (isset($newUrl[0])) {
						$this->params = $newUrl;
					}
				}
			}
		}

		public function run()
		{
			if (class_exists('App\Models\\'.$this->class) && method_exists('App\Models\\'.$this->class, $this->method)) {
				//echo "entrou no primeiro run <br>";
				try {
					$controll = "App\Models\\".$this->class;
					$response = call_user_func_array(array(new $controll, $this->method), $this->params);
					echo "<script>document.write(localStorage.setItem('user_token_jwt', '".$response."'))</script>";
					return json_encode(array('data' => $response, 'status' => 'sucess'));
					//return $response;
					
				} catch (\Exception $e) {
					return json_encode(array('data' => $e->getMessage(), 'status' => 'error'));
				}
				
			} else {

				return json_encode(array('data' => 'Operacao Invalida', 'status' => 'error'));

			}
		}
	}
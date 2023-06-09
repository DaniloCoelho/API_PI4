<?php
    //header('Content-Type: application/json; charset=UTF-8');

    require_once '../vendor/autoload.php';

    use App\Rest;

    // api/users/1
    if ($_GET['url']) {
        $url = explode('/', $_GET['url']);
        //echo $_GET['url']."<br>";

        //print_r($url) ;
        if ($url[0] === 'api') {
            
            
            if ($url[1] === 'auth') {
                //print_r($_POST);
                //echo "<br>entrou no === auth<br>";
                $service = 'App\Models\\'.ucfirst($url[0]).'Controller';
                array_shift($url);
                if (isset($_REQUEST) && !empty($_REQUEST)) {
                    $rest = new Rest($_REQUEST);
                    echo $rest->run();
                    
                    
                    //echo "voltou no index no index <br>";
                    exit;
                }
            }else{
                array_shift($url);
                $service = 'App\Services\\'.ucfirst($url[0]).'Service';
                array_shift($url);
            }
            



            $method = strtolower($_SERVER['REQUEST_METHOD']);

            try {
                $response = call_user_func_array(array(new $service, $method), $url);

                http_response_code(200);
                echo json_encode(array('status' => 'sucess', 'data' => $response));
                exit;
            } catch (\Exception $e) {
                http_response_code(404);
                echo json_encode(array('status' => 'error', 'data' => $e->getMessage()), JSON_UNESCAPED_UNICODE);
                exit;
            }
        }
    }
    
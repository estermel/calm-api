<?php

require_once 'include/DbHandler.php';
require_once 'include/PassHash.php';
require 'libs/Slim/Slim.php';

\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim();

function getDB() {
    $dbhost = "localhost";
    $dbuser = "root";
    $dbpass = "";
    $dbname = "calm1";

    
    $mysql_conn_string = "mysql:host=$dbhost;dbname=$dbname";
    $dbConnection = new PDO($mysql_conn_string, $dbuser, $dbpass);
    $dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $dbConnection;
}

$app->get('/akun', function() {
    $app = \Slim\Slim::getInstance();
	$app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
    $response = array();
    $db = new DbHandler();
    $result = $db->getAkun();
    $response["error"] = false;
    $response["akun"] = array();
    while ($strData = $result->fetch_assoc()) {
        $tmp = array();
		$tmp["id"] = utf8_encode($strData["id"]);
        $tmp["username"] = utf8_encode($strData["username"]);
        $tmp["password"] = utf8_encode($strData["password"]);     
        array_push($response["akun"], $tmp);
    }
    echoRespnse(200, $response);
});

$app->get('/produk', function() {
    $app = \Slim\Slim::getInstance();
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
    $response = array();
    $db = new DbHandler();
    $result = $db->getProduk();
    $response["error"] = false;
    $response["produk"] = array();
    while ($strData = $result->fetch_assoc()) {
        $tmp = array();
        $tmp["id_produk"] 	= utf8_encode($strData["id_produk"]);
        $tmp["nama_produk"] = utf8_encode($strData["nama_produk"]);
        $tmp["harga"] 		= utf8_encode($strData["harga"]);
        $tmp["gambar"] 		= utf8_encode($strData["gambar"]);
        $tmp["deskripsi"] 	= utf8_encode($strData["deskripsi"]);     
        array_push($response["produk"], $tmp);
    }
    echoRespnse(200, $response);
});

$app->get('/order', function() {
    $app = \Slim\Slim::getInstance();
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
    $response = array();
    $db = new DbHandler();
    $result = $db->getOrder();
    $response["error"] = false;
    $response["order"] = array();
    while ($strData = $result->fetch_assoc()) {
        $tmp = array();
        $tmp["id_order"]     = utf8_encode($strData["id_order"]);
        $tmp["username"]     = utf8_encode($strData["username"]);
        $tmp["id_produk"]    = utf8_encode($strData["id_produk"]);
        $tmp["nama_produk"]  = utf8_encode($strData["nama_produk"]);
        $tmp["username"]     = utf8_encode($strData["username"]);
        $tmp["asrama"]       = utf8_encode($strData["asrama"]);     
        $tmp["no_kamar"]     = utf8_encode($strData["no_kamar"]);     
        $tmp["jus"]          = utf8_encode($strData["jus"]);
		$tmp["tanggal_booking"]= utf8_encode($strData["tanggal_booking"]);
		$tmp["jam_booking"]  = utf8_encode($strData["jam_booking"]);
        $tmp["waktu_order"]  = utf8_encode($strData["waktu_order"]);
        $tmp["status_order"] = utf8_encode($strData["status_order"]);
        $tmp["confirm_by"]   	  = utf8_encode($strData["confirm_by"]);
        $tmp["waktu_konfirmasi"]  = utf8_encode($strData["waktu_konfirmasi"]);

        array_push($response["order"], $tmp);
    }
    echoRespnse(200, $response);
});

//get all user transaction by username
$app->post('/userOrder', function() {
    $app = \Slim\Slim::getInstance();
    $username = $app->request->post('username');
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
    $response = array();
    $db = new DbHandler();
    $result = $db->getUserOrder($username);
    $response["error"] = false;
    $response["userOrder"] = array();
    while ($strData = $result->fetch_assoc()) {
        $tmp = array();
        $tmp["id_order"]     	  = utf8_encode($strData["id_order"]);
        $tmp["username"]          = utf8_encode($strData["username"]);
        $tmp["id_produk"]    	  = utf8_encode($strData["id_produk"]);   
        $tmp["asrama"]       	  = utf8_encode($strData["asrama"]);     
        $tmp["no_kamar"]     	  = utf8_encode($strData["no_kamar"]);    
        $tmp["jus"]          	  = utf8_encode($strData["jus"]);     
        $tmp["waktu_order"]  	  = utf8_encode($strData["waktu_order"]);
        $tmp["status_order"] 	  = utf8_encode($strData["status_order"]);
        $tmp["confirm_by"]   	  = utf8_encode($strData["confirm_by"]);
        $tmp["waktu_konfirmasi"]  = utf8_encode($strData["waktu_konfirmasi"]);
        array_push($response["userOrder"], $tmp);
    }
    echoRespnse(200, $response);
});

//get all user transaction by username diterima
$app->post('/userOrderDiterima', function() {
    $app = \Slim\Slim::getInstance();
    $username = $app->request->post('username');
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
    $response = array();
    $db = new DbHandler();
    $result = $db->getUserOrderDiterima($username);
    $response["error"] = false;
    $response["userOrderDiterima"] = array();
    while ($strData = $result->fetch_assoc()) {
        $tmp = array();
        $tmp["id_order"]     	  = utf8_encode($strData["id_order"]);
        $tmp["username"]          = utf8_encode($strData["username"]);
        $tmp["id_produk"]    	  = utf8_encode($strData["id_produk"]);   
        $tmp["asrama"]       	  = utf8_encode($strData["asrama"]);     
        $tmp["no_kamar"]     	  = utf8_encode($strData["no_kamar"]);    
        $tmp["jus"]          	  = utf8_encode($strData["jus"]);     
        $tmp["waktu_order"]  	  = utf8_encode($strData["waktu_order"]);
        $tmp["status_order"] 	  = utf8_encode($strData["status_order"]);
        $tmp["confirm_by"]   	  = utf8_encode($strData["confirm_by"]);
        $tmp["waktu_konfirmasi"]  = utf8_encode($strData["waktu_konfirmasi"]);
        array_push($response["userOrderDiterima"], $tmp);
    }
    echoRespnse(200, $response);
});

//get all user transaction by username menunggu
$app->post('/userOrderMenunggu', function() {
    $app = \Slim\Slim::getInstance();
    $username = $app->request->post('username');
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
    $response = array();
    $db = new DbHandler();
    $result = $db->getUserOrderMenunggu($username);
    $response["error"] = false;
    $response["userOrderMenunggu"] = array();
    while ($strData = $result->fetch_assoc()) {
        $tmp = array();
        $tmp["id_order"]     	  = utf8_encode($strData["id_order"]);
        $tmp["username"]          = utf8_encode($strData["username"]);
        $tmp["id_produk"]    	  = utf8_encode($strData["id_produk"]);   
        $tmp["asrama"]       	  = utf8_encode($strData["asrama"]);     
        $tmp["no_kamar"]     	  = utf8_encode($strData["no_kamar"]);    
        $tmp["jus"]          	  = utf8_encode($strData["jus"]);     
        $tmp["waktu_order"]  	  = utf8_encode($strData["waktu_order"]);
        $tmp["status_order"] 	  = utf8_encode($strData["status_order"]);
        $tmp["confirm_by"]   	  = utf8_encode($strData["confirm_by"]);
        $tmp["waktu_konfirmasi"]  = utf8_encode($strData["waktu_konfirmasi"]);
        array_push($response["userOrderMenunggu"], $tmp);
    }
    echoRespnse(200, $response);
});

$app->post('/register', function() {
	$app = \Slim\Slim::getInstance();
    $nama = $app->request()->post('nama');
    $username = $app->request()->post('username');
    $password = $app->request()->post('password');
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
    try {
        $db = getDB();
        $sth = $db->prepare("SELECT COUNT(*) AS count FROM user WHERE username=:username");
        $sth->bindParam(':username', $username, PDO::PARAM_INT);
        $sth->execute();
        $row = $sth->fetch();
        if ($row['count'] > 0) {
            $output = array(
                'status' => "0",
                'operation' => "username sudah terdaftar"
            );
            echo json_encode($output);
            $db = null;
            return;
        } else {
				$sth = $db->prepare("INSERT INTO user (nama,username,password,status_login) 
				VALUES(:nama,:username,:password,'1')");
				$sth->bindParam(':nama', $nama, PDO::PARAM_INT);
				$sth->bindParam(':username', $username, PDO::PARAM_INT);
				$sth->bindParam(':password', $password, PDO::PARAM_INT);
				$sth->execute();
                $output = array(
                    'status' => "1",
                    'operation' => "success"
                );
                echo json_encode($output);
                $db = null;
                return;
        }
    } catch (Exception $ex) {
        echo $ex;
    }
});


$app->post('/login', function(){
    $app = \Slim\Slim::getInstance();
    $username        = $app->request()->post('username');
    $password        = $app->request()->post('password');
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
    $db = getDB();    
    try {
    	$sth = $db->prepare("SELECT * from user WHERE username=:username AND password=:password");
        $sth->bindParam(':username', $username, PDO::PARAM_INT);
        $sth->bindParam(':password', $password, PDO::PARAM_INT);
        $sth->execute();
        $row = $sth->fetch();
       	$status_login = $row['status_login'];
       	$username1 = $row['username'];
       	$password1 = $row['password'];

       	if($username==$username1 && $password==$password1){
		    if($status_login=='0'){
		        $sth1 = $db->prepare("UPDATE user SET status_login = '1' WHERE username=:username AND password=:password");
		        $sth1->bindParam(':username', $username, PDO::PARAM_INT);
				$sth1->bindParam(':password', $password, PDO::PARAM_INT);
		        $sth1->execute();
		        $output = array(
		                    'status' => "1",
		                    'pesan' => "login berhasil"
		                );
		        echo json_encode($output);
		        $db = null;
		        return;
				}

		    if($status_login=='1'){
				$output = array(
		                    'status' => "1",
		                    'pesan' => "sudah login"
		                );
				echo json_encode($output);
		        $db = null;
		        return;
		    }
		}
        
        if($username!=$username1 && $password1!=$password1){
			$output = array(
		                    'status' => "0",
		                    'pesan' => "username & password tidak match"
		                );
	        echo json_encode($output);
	        $db = null;
	        return;
    	}

    } catch (Exception $ex) {
        echo $ex;
    }
});


$app->post('/log_in', function(){
    $app = \Slim\Slim::getInstance();
    $username         = $app->request()->post('username');
    $password         = $app->request()->post('password');
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
    $db = getDB();    
    try {
        $sth = $db->prepare("SELECT * from user WHERE username=:username AND password=:password");
        $sth->bindParam(':username', $username, PDO::PARAM_INT);
        $sth->bindParam(':password', $password, PDO::PARAM_INT);
        $sth->execute();
        $row = $sth->fetch();
        $status_login = $row['status_login'];
        $username_db = $row['username'];
        $password_db = $row['password'];

        if($username==$username_db && $password==$password_db){

		        if($status_login=='0'){
		            $sth1 = $db->prepare("UPDATE user SET status_login = '1' WHERE username=:username AND password=:password");
		            $sth1->bindParam(':username', $username, PDO::PARAM_INT);
		            $sth1->bindParam(':password', $password, PDO::PARAM_INT);
		            $sth1->execute();
		            }
		            $output = array(
		                    'status' => "1",
		                    'pesan' => "log_in berhasil"
		                );

		        if($status_login=='1'){
		        	$output =  array('status' =>  "0",
		        					 'pesan' => "sudah log_in" );
		        }

				echo json_encode($output);
		        $db=null;
		        return;

		}

		if($username!=$username || $password!=$password_db){
			$output = array(
		                    'status' => "0",
		                    'pesan' => "username & password tidak match"
		                );
	        echo json_encode($output);
	        $db = null;
	        return;
		}
	} catch (Exception $ex) {
		echo $ex;
		}
});




$app->post('/logout', function(){
    $app = \Slim\Slim::getInstance();
    $username         = $app->request()->post('username');
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
    $db = getDB();    
    try {
        $sth = $db->prepare("SELECT status_login from user WHERE username=:username");
        $sth->bindParam(':username', $username, PDO::PARAM_INT);
        $sth->execute();
        $row = $sth->fetch();
        $status_login = $row['status_login'];
        if($status_login=='1'){
            $sth1 = $db->prepare("UPDATE user SET status_login = '0' WHERE username=:username");
            $sth1->bindParam(':username', $username, PDO::PARAM_INT);
            $sth1->execute();
            }
            $output = array(
                    'status' => "1",
                    'pesan' => "logout berhasil"
                );
        echo json_encode($output);
        $db = null;
        return;
    } catch (Exception $ex) {
        echo $ex;
    }
});

$app->post('/order', function() {
    $app = \Slim\Slim::getInstance();
    $id_order      = $app->request()->post('id_order');
    $username       = $app->request()->post('username');
    $id_produk     = $app->request()->post('id_produk');
    $asrama        = $app->request()->post('asrama');
    $no_kamar      = $app->request()->post('no_kamar');
    $jus           = $app->request()->post('jus');
	$tanggal_booking = $app->request()->post('tanggal_booking');
	$jam_booking = $app->request()->post('jam_booking');
    $waktu_order   = $app->request()->post('waktu_order');
    $status_order  = $app->request()->post('status_order');
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
    try {
        $db = getDB();
        $sth = $db->prepare("INSERT INTO orderan (id_order, username, id_produk, asrama, no_kamar, jus, tanggal_booking, jam_booking, waktu_order, status_order) 
            VALUES (:id_order, :username, :id_produk, :asrama, :no_kamar, :jus, :tanggal_booking, :jam_booking, CURRENT_TIMESTAMP, 'menunggu')");
            $sth->bindParam(':id_order',     $id_order, PDO::PARAM_INT);
            $sth->bindParam(':username',      $username, PDO::PARAM_INT);
            $sth->bindParam(':id_produk',    $id_produk, PDO::PARAM_INT);
            $sth->bindParam(':asrama',       $asrama, PDO::PARAM_INT);
            $sth->bindParam(':no_kamar',     $no_kamar, PDO::PARAM_INT);
            $sth->bindParam(':jus',          $jus, PDO::PARAM_INT);
			$sth->bindParam(':tanggal_booking', $tanggal_booking, PDO::PARAM_INT);
			$sth->bindParam(':jam_booking', $jam_booking, PDO::PARAM_INT);
            $sth->execute();
            $output = array(
                    'status' => "1",
                    'operation' => "success"
                );
                echo json_encode($output);
                $db = null;
                return;
    } catch (Exception $ex) {
        echo $ex;
    }
});

$app->post('/confirmOrder', function(){
    $app = \Slim\Slim::getInstance();
    $id_order         = $app->request()->post('id_order');
	$confirm_by       = $app->request()->post('username');
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
    $db = getDB();    
    try {
        $sth = $db->prepare("SELECT status_order from orderan WHERE id_order=:id_order");
        $sth->bindParam(':id_order', $id_order, PDO::PARAM_INT);
        $sth->execute();
        $row = $sth->fetch();
        $status_order = $row['status_order'];
        if($status_order=='menunggu'){
            $sth1 = $db->prepare("UPDATE orderan SET status_order = 'diterima' , waktu_konfirmasi = CURRENT_TIMESTAMP, confirm_by = username WHERE id_order=:id_order");
            $sth1->bindParam(':id_order', $id_order, PDO::PARAM_INT);
            $sth1->execute();
            }
            $output = array(
                    'status' => "1",
                    'pesan' => "orderan diterima"
                );
        echo json_encode($output);
        $db = null;
        return;
    } catch (Exception $ex) {
        echo $ex;
    }
});

$app->post('/rejectOrder', function(){
    $app = \Slim\Slim::getInstance();
    $id_order         = $app->request()->post('id_order');
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
    $db = getDB();    
    try {
        $sth = $db->prepare("SELECT status_order from orderan WHERE id_order=:id_order");
        $sth->bindParam(':id_order', $id_order, PDO::PARAM_INT);
        $sth->execute();
        $row = $sth->fetch();
        $status_order = $row['status_order'];
        if($status_order=='menunggu'){
            $sth1 = $db->prepare("UPDATE orderan SET status_order = 'ditolak' , waktu_konfirmasi = CURRENT_TIMESTAMP WHERE id_order=:id_order");
            $sth1->bindParam(':id_order', $id_order, PDO::PARAM_INT);
            $sth1->execute();
            }
            $output = array(
                    'status' => "0",
                    'pesan' => "orderan ditolak"
                );
        echo json_encode($output);
        $db = null;
        return;
    } catch (Exception $ex) {
        echo $ex;
    }
});

/**
 * Echoing json response to client
 * @param String $status_code Http response code
 * @param Int $response Json response
 * Daftar response
 * 200	OK
 * 201	Created
 * 304	Not Modified
 * 400	Bad Request
 * 401	Unauthorized
 * 403	Forbidden
 * 404	Not Found
 * 422	Unprocessable Entity
 * 500	Internal Server Error
 */
function echoRespnse($status_code, $response) {
    $app = \Slim\Slim::getInstance();
    // Http response code
    $app->status($status_code);

    // setting response content type to json
    $app->contentType('application/json');

    //print_r($response);
    echo json_encode($response);
}

/**
* Verifying required params posted or not
*/
    function verifyRequiredParams($required_fields) {
        $error = false;
        $error_fields = "";
        $request_params = array();
        $request_params = $_REQUEST;
        // Handling PUT request params
        if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
            $app = \Slim\Slim::getInstance();
            parse_str($app->request()->getBody(), $request_params);
            }
        foreach ($required_fields as $field) {
            if (!isset($request_params[$field]) ||
                strlen(trim($request_params[$field])) <= 0) {
                $error = true;
                $error_fields .= $field . ', ';
                }
            }
        if ($error) {
            // Required field(s) are missing or empty
            // echo error json and stop the app
            $response = array();
            $app = \Slim\Slim::getInstance();
            $response["error"] = true;
            $response["message"] = 'Required field(s) ' .
            substr($error_fields, 0, -2) . ' is missing or empty';
            echoRespnse(400, $response);
            $app->stop();
            }
        }

$app->run();
?>



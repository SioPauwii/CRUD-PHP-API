<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=utf-8");
header("Access-Control-Allow-Methods: GET,POST,PUT,PATCH,DELETE, OPTIONS");
header("Access-Control-Allow-Headers: X-Requested-With,  Origin, Content-Type,");
header("Access-Control-Max-Age: 86400");
// ini_set('display_errors',0);
date_default_timezone_set("Asia/Manila");
set_time_limit(1000);

$root = $_SERVER['DOCUMENT_ROOT'];
$api = $root .'/PHP_API_CRUD';

require_once($api . '/configs/connection.php');

#maya na yung sa model para  dito
require_once($api . '/models/crud.model.php');

$dbase = new connection();
$pdo = $dbase->connect();

$crud = new Crud_model($pdo);

$req = [];

if(isset($_REQUEST['request']))
    $req = explode('/', rtrim($_REQUEST['request'], '/'));
else $req = array('errorcatcher');

switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
            if($req[0]=='All'){echo json_encode($crud->getAll()); return;}
            #if($req[0]== 'One'){echo json_encode($crud->getOne()); return;}
        break;
    case 'POST':
        $data_input = json_decode(file_get_contents("php://input"));
        #if($req[0] == 'insert'){echo json_encode($crud->insert($data_input)); return;}
        break;

    default:
        echo "albert";
        http_response_code(403);
        break;
}

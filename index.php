<?php
require_once('./library/illuminate/Validate.php');
use library\illuminate\Validate as Validate;

if (empty($_SERVER['PATH_INFO'])) {
    exit;
}

//スラッシュで区切られたurlを取得します
$analysis = explode('/', $_SERVER['PATH_INFO']);

$call = "";

foreach ($analysis as $value) {
    if ($value !== "") {
        $call = $value;
        break;
    }
}

//ApiControllerをインクルードし、JSONを返します
if (file_exists('./controllers/'.$call.'.php')) {
    include('./controllers/'.$call.'.php');
    //$call名のcontrollerをインスタンス化します
    $className = "controllers\\".$call;
    $obj = new $className();
    //controllerのindexメソッドを呼びます
    $response = json_encode($obj->index());
    //json形式なら出力します
    if (Validate::isJson($response)) {
        echo $response;
    }
}

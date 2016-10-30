<?php
if (empty($_SERVER['PATH_INFO'])) {
    exit;
}

//スラッシュで区切られたurlを取得します
$parse = explode('/', $_SERVER['PATH_INFO']);
$call = "";
foreach ($parse as $value) {
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
    //ヘッダーを指定してJSONを出力
    header("Content-Type: application/json; charset=utf-8");
    echo $response;
}
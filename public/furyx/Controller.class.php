<?php

class Controller{

    /**
     * @param $url 要跳转的连接
     * @param string $content 提示信息
     * @param int $time 间隔时间
     */

    public function jump($url,$content='',$time=3 ){
        if($content==''){
//            立即跳转
            header('Location:'.$url);
        }else{
            //用户是否有自定义的跳转模板
            if(file_exists(CURR_VIEW_DIR.'jump.html')){
                require_once CURR_VIEW_DIR.'jump.html';
            }else{
//                使用默认模板
                echo <<<html
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="refresh" content="$time;url = $url">
    <title>show</title>
</head>
<body>
    <section>$content</section>
</body>
</html>
html;
            }
        }
        die();
    }
}
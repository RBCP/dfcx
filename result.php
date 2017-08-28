<head>
<meta charset="UTF-8">
<title>同窗校园网电费查询</title>
<meta content="yes" name="apple-moblie-web-app-capale">
<meta content="black" name="apple-mobile-web-app-statue-bar-style">
<meta content="telephone=no" name="format-detection">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
<meta name="renderer" content="webkit"/>
<script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
<link href="css/public.css" rel="stylesheet" type="text/css"/>
<link href="css/score.css" rel="stylesheet" type="text/css"/>
</head>
<body>
<div class="main">
<div class="first">
<div class="second">我的电费单</div>
<div class="third"></div>
<div class="table">
<?php 
 error_reporting(0);
   include_once('simple_html_dom.php');
  session_start();
   function curl_request($url,$post='',$cookie='', $returnCookie=0){
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.1; Trident/6.0)');
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($curl, CURLOPT_AUTOREFERER, 1);
        curl_setopt($curl, CURLOPT_REFERER, "http://XXX");
        if($post) {
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($post));
        }
        if($cookie) {
            curl_setopt($curl, CURLOPT_COOKIE, $cookie);
        }
        curl_setopt($curl, CURLOPT_HEADER, $returnCookie);
        curl_setopt($curl, CURLOPT_TIMEOUT, 10);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $data = curl_exec($curl);
        if (curl_errno($curl)) {
            return curl_error($curl);
        }
        curl_close($curl);
        if($returnCookie){
            list($header, $body) = explode("\r\n\r\n", $data, 2);
            preg_match_all("/Set\-Cookie:([^;]*);/", $header, $matches);
            $info['cookie']  = substr($matches[1][0], 1);
            $info['content'] = $body;
            return $info;
        }else{
            return $data;
        }
}
    $sh=$_POST['sh'];
    $lh=$_POST['lh'];
    $url='https://hut.wxz.name/home/getPower/'.$lh.'/'.$sh.'';
    $con2=curl_request($url);
    file_put_contents("D:/phpStudy/WWW/dfcx/result.html", $con2);
    $myfile=fopen("D:/phpStudy/WWW/dfcx/result.html","r") or die("Unable to open file");
   $text=fread($myfile,filesize("D:/phpStudy/WWW/df/result.html")-200);
   echo $text;
   fclose($myfile);
    $html=new simple_html_dom();
    $html=str_get_html($con2);
    $res=$html->find('div')->plaintext;
  ?>
  </div>
  </div>
  </div>
  </body>


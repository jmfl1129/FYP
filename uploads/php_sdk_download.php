<?php
/* if (!isset($_COOKIE['id'])){
	echo "<script
			type='text/javascript'>
				window.location= \"error.php\";
				 </script>";
	
}


if (is_file('uploads/aliyun-oss-php-sdk-2.3.1/autoload.php')) {
    require_once 'uploads/aliyun-oss-php-sdk-2.3.1/autoload.php';
}
if (is_file(__DIR__ . '../vendor/autoload.php')) {
    require_once __DIR__ . '../vendor/autoload.php';
}

use OSS\OssClient;

// It is highly risky to log on with AccessKey of an Alibaba Cloud account because the account has permissions on all the APIs in OSS. We recommend that you log on as a RAM user to access APIs or perform routine operations and maintenance. To create a RAM account, log on to https://ram.console.aliyun.com.
$accessKeyId = "";
$accessKeySecret = "";
// This example uses endpoint China (Hangzhou). Specify the actual endpoint based on your requirements.
$endpoint = "oss-accelerate.aliyuncs.com";
// Bucket name
$bucket= "image-bucket-web";
// Object name
$object_name = str_replace(' ', '', $object_name);
$object = $object_name;

if (!file_exists('/home/www/htdocs/img_tmp/' . $_COOKIE['name'])) {
    mkdir('/home/www/htdocs/img_tmp/' . $_COOKIE['name'], 0777, true);
	chmod('/home/www/htdocs/img_tmp/' . $_COOKIE['name'], 0757);
}

$localfile = '/home/www/htdocs/img_tmp/' . $_COOKIE['name'] . '/' . $object_name;
$options = array(
        OssClient::OSS_FILE_DOWNLOAD => $localfile
    );

try{
    $ossClient = new OssClient($accessKeyId, $accessKeySecret, $endpoint);

    $ossClient->getObject($bucket, $object, $options);
} catch(OssException $e) {
    $emsg = $e->getMessage();
	echo "<script type='text/javascript'>
	
			alert('$emsg');
			
		  </script>";
    return;
} */

?> 
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
use OSS\Core\OssException;

// It is highly risky to log on with AccessKey of an Alibaba Cloud account because the account has permissions on all the APIs in OSS. We recommend that you log on as a RAM user to access APIs or perform routine operations and maintenance. To create a RAM account, log on to https://ram.console.aliyun.com.
$accessKeyId = "";
$accessKeySecret = "";
// This example uses endpoint China (Hangzhou). Specify the actual endpoint based on your requirements.
$endpoint = "oss-accelerate.aliyuncs.com";
// Bucket name
$bucket= "image-bucket-web";
// Object name
$object = $randname;
// <yourLocalFile> consists of the local file path and the file name (including the extension), such as /users/local/myfile.txt
$filePath = $targetFilePath;

try{
    $ossClient = new OssClient($accessKeyId, $accessKeySecret, $endpoint);

    $ossClient->uploadFile($bucket, $object, $filePath);
} catch(OssException $e) {
	$emsg = $e->getMessage();
	echo "<script type='text/javascript'>
	
			alert('$emsg');
			
		  </script>";
    return;
}

unlink($filePath); */

?>
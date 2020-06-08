<?php    
    include_once 'mail/aliyun-php-sdk-core/Config.php';
    use Dm\Request\V20151123 as Dm;            
    //Need to set up the corresponding region name, such as east China 1 region is set to cn-hangzhou, Singapore region is set to ap-southeast-1, Australia region is set to ap-southeast-2.
    $iClientProfile = DefaultProfile::getProfile("ap-southeast-1", "", "");        
    //Singapore or Australia region need to set the address of the server, east China 1 (hangzhou) do not need to be set.
    $iClientProfile::addEndpoint("ap-southeast-1","ap-southeast-1","Dm","dm.ap-southeast-1.aliyuncs.com");
    //$iClientProfile::addEndpoint("ap-southeast-2","ap-southeast-2","Dm","dm.ap-southeast-2.aliyuncs.com");
    $client = new DefaultAcsClient($iClientProfile);  
    $request = new Dm\SingleSendMailRequest();   
    //Singapore or Australia region need to set the version of the SDK, east China 1 (hangzhou) do not need to be set.
    //$request->setVersion("2017-06-22");
	
    $request->setAccountName("password@mail.mtptu.cn");
    $request->setFromAlias("marathon-fyp");
    $request->setAddressType(1);
    $request->setReplyToAddress("true");
    $request->setToAddress($email);        
    $request->setSubject("Password");
    $request->setHtmlBody("Your password is: {$password}");        
    try {
        $response = $client->getAcsResponse($request);
        print_r($response);
    }
    catch (ClientException  $e) {
        print_r($e->getErrorCode());   
        print_r($e->getErrorMessage());   
    }
    catch (ServerException  $e) {        
        print_r($e->getErrorCode());   
        print_r($e->getErrorMessage());
    }
?>

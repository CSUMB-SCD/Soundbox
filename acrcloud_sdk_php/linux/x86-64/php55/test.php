<?php namespace ACRCloud;
    include_once('acrcloud_recognizer.php');

    // Replace "xxxxxxxx" below with your project's host, access_key and access_secret.
    $config = array(
        'host' => 'identify-us-west-2.acrcloud.com',
        'access_key' => '67ee53dd67467002d2ebb2faa4b70d0f',
        'access_secret' => 'Ky7WBO6JLQVc9sXqv1f7EADT12fiNN6YvF3yCiXG',
        'recognize_type' => ACRCloudRecognizeType::ACR_OPT_REC_AUDIO // ACR_OPT_REC_AUDIO/ACR_OPT_REC_HUMMING/ACR_OPT_REC_BOTH
    );
    $re = new ACRCloudRecognizer($config);
    //print $re->recognizeByFile($argv[1], 0, 10);

    $content = file_get_contents($argv[1]);
    print $re->recognizeByFileBuffer($content, 0, 10);
?>

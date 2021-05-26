$xml_data = '<?xml version="1.0"?>
    <parent>
    <child>
        <user>helmotps</user>
        <key>5fff4674c9XX</key>
        <mobile>' . $phone . '</mobile>
        <message>OTP PIN: ' . $otp . '.</message>
        <accusage>3</accusage>
        <senderid>SPORTSWATCH</senderid>
    </child>
    </parent> ';

    $URL = "http://95.216.8.124:8787/msg//submitsms.jsp?";

    $ch = curl_init($URL);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_ENCODING, 'UTF-8');
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/xml'));
    curl_setopt($ch, CURLOPT_POSTFIELDS, "$xml_data");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($ch);
    curl_close($ch);

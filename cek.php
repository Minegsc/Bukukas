<?php
system('clear');
$s = "\n";


echo $s."•••••••••••••••••••••••••••••••••••••••••••••••••••••••
•                      BUKU KAS                       •
•                   CEK ID REFFERAL                   •
•••••••••••••••••••••••••••••••••••••••••••••••••••••••
Github    : https://github.com/ghodan7
Whatsapp  : +6282322413834
";

echo $s.$s.'·———————————————————————————————————————————————————·
|                  ATTENTION !!!                    |
·———————————————————————————————————————————————————·
| 1. Nomer yang digunakan WAJIB sudah TERBUKA FITUR |
|    REFFERAL.					    |
| 2. Setelah mendapatkan id reff di copy, paste ke  |
|    `idreff.php`				    |
·———————————————————————————————————————————————————·
';


echo $s."[?] Number (ex. 08xxx) : ";
$n = trim(fgets(STDIN));
$no = substr($n, 1);
sleep(2);

//ua
$ua = array(
'accept-language: id',
'x-client-platform: android',
'x-client-version: 0.29.0',
'content-type: application/json',
'user-agent: okhttp/4.2.1',
);


echo $s."[?] OTP VIA :
    1. SMS
    2. WHATSAPP";
echo $s."[?] Your Choice (1/2) : ";
$via = trim(fgets(STDIN));
sleep(2);

if ($via == '1'){
        echo $s."[•] MENGIRIM OTP . . .".$s;
        $op = 'SMS';
} else if ($via == '2'){
        echo $s."[•] MENGIRIM OTP . . .".$s;
        $op = 'WHATSAPP';
} else {
	echo $s."[!] You haven't chosen / Your choice is wrong";
}


//Request_OTP//
$url = "https://api.beecash.io/graphql";
$data = '{"operationName":"SendOtpMutation","variables":{"input":{"mobile":"+62'.$no.'","purpose":"AUTH","mode":"'.$op.'"},"key":"'.rand(1, 100).'"},"query":"mutation SendOtpMutation($input: SendOtpInput!) {\n  sendOtp(input: $input) {\n    success\n    __typename\n  }\n}\n"}';

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_HTTPHEADER, $ua);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
$result = curl_exec($ch);
var_dump($result);


echo $s."[?] OTP : ";
$otp = trim(fgets(STDIN));
sleep(2);


//Valid_OTP//
$data = '{"operationName":"VerifyOtpMutation","variables":{"input":{"otp":"'.$otp.'","mobile":"+62'.$no.'"},"key":"'.rand(1, 100).'"},"query":"mutation VerifyOtpMutation($input: VerifyOtpInput!) {\n  verifyOtp(input: $input) {\n    token\n    user {\n      id\n      mobile\n      sessionsCount\n      businesses {\n        id\n        __typename\n      }\n      __typename\n    }\n    __typename\n  }\n}\n"}';
$url = "https://api.beecash.io/graphql";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_HTTPHEADER, $ua);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
$result = curl_exec($ch);
$tt = json_decode($result, true);
//$s.var_dump($result);
$c = $tt["data"]["verifyOtp"]["user"]["id"];
echo $s.'[✓] Id Refferal : '.$c.$s;

?>

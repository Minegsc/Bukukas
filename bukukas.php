<?php
include ('bk.php');

$s = "\n";
echo $s."•••••••••••••••••••••••••••••••••••••••••••••••••••••••
•                    REFF  BUKUKAS                    •
•                    AUTO REGISTER                    •
•••••••••••••••••••••••••••••••••••••••••••••••••••••••
Github    : https://github.com/ghodan7
Whatsapp  : +6282322413834
";

echo $s.$s.'·———————————————————————————————————————————————————·
|                  ATTENTION !!!                    |
·———————————————————————————————————————————————————·
| Sebelum Menggunakan script ini :                  |
| 1. Masukkan Id Reff anda di `cek.php`.            |
| 2. Cek Id Reff, run script `cek.php`.             |
| 3. Copy Id Reff, Paste di `reffid.php`.           |
|———————————————————————————————————————————————————|
| lebih lengkapnya dicek di `Readme.md`.            |
·———————————————————————————————————————————————————·
';
echo $s."Nama Kamu : ";
$dede = trim(fgets(STDIN));
sleep(2);


//detect Ip
$ip = file_get_contents('https://api.ipify.org');
//echo "My public IP address is: " . $ip;

//detail ip
$iptr = file_get_contents('http://ip-api.com/json/'.$ip);
$ipi = 'Detail Ip: '.$s.$iptr;

//Request otp ke dev
$chars = '0123456789abcdefghijklmnopqrstuvwxyz';
$acak  = substr(str_shuffle($chars), 0, 4);

$mesotp = 'Kode Verifikasi Bot Bukukas'.$s.$s.'*Detail User*'.$s.'—————————————————————'.$s.'Nama : '.$dede.$s.'Kode : *'.$acak.'*'.$s.'From Ip : *'.$ip.'*'.$s.$ipi.$s.'—————————————————————'.$s.$s.'Script By : Ghodan';
$to = '6282322413734';

$url = 'https://portal.api4gw.com/send';
$header  = array(
    'Content-Type: application/json',
    'Auth-API4GW: f9450e7c90bed80b31734e6c247f0e03'
);

$params = [
    'type'     => 'text',
    'to'       => $to,
    'message'  => $mesotp,
];

$params_post = json_encode($params);
$post = curl_init($url);
curl_setopt($post, CURLOPT_HTTPHEADER, $header);
curl_setopt($post, CURLOPT_POSTFIELDS, $params_post);
curl_setopt($post, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($post);
curl_close($post);



echo $s."Ask the script maker for the script";
echo $s."Kode Script : ";
$dedi = trim(fgets(STDIN));
if ($acak == $dedi) {
	echo "[✓] The code you entered is correct";
	sleep(2);
	start();

} else {
	echo "[x] The code you entered is wrong";
	echo "[!] Ask the scriptwriter to script the code";
	echo "[!] wa.me/6282322413734";
	sleep(2);
	exit;
}


?>

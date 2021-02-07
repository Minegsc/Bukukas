<?php
function start(){


system('clear');
include ('reffid.php');
$s = "\n";

echo $s."•••••••••••••••••••••••••••••••••••••••••••••••••••••••
•                      BUKU KAS                       •
•                    AUTO REGISTER                    •
•••••••••••••••••••••••••••••••••••••••••••••••••••••••
Github    : https://github.com/ghodan7
Whatsapp  : +6282322413834
";

echo $s.$s.'·———————————————————————————————————————————————————·
|		   ATTENTION !!!		    |
·———————————————————————————————————————————————————·
| Sebelum Menggunakan script ini :		    |
| 1. Masukkan Id Reff anda di `cek.php`.	    |
| 2. Cek Id Reff, run script `cek.php`.		    |
| 3. Copy Id Reff, Paste di `reffid.php`.	    |
|———————————————————————————————————————————————————|
| lebih lengkapnya dicek di `Readme.md`.	    |
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


echo $s."[•] OTP Via :
    1. SMS
    2. WHATSAPP";
echo $s.$s."[?] Your Choice (1/2) : ";
$via = trim(fgets(STDIN));
sleep(2);

if ($via == '1'){
        echo $s."[•] Sending OTP . . .".$s;
	$op = 'SMS';
} else if ($via == '2'){
        echo $s."[•] Sending OTP . . .".$s;
	$op = 'WHATSAPP';
} else {
        echo $s."[!] You haven't chosen / Your choice is wrong";
}


//Request_OTP//
$url = "https://api.beecash.io/graphql";
$data = '{"operationName":"SendOtpMutation","variables":{"input":{"mobile":"+62'.$no.'","purpose":"AUTH","mode":"'.$op.'","skipBusinessCreation":true,"referrerId":'.$idreff.'},"key":"'.rand(1, 100).'"},"query":"mutation SendOtpMutation($input: SendOtpInput!) {\n  sendOtp(input: $input) {\n    success\n    __typename\n  }\n}\n"}';

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


	$toket = $tt["data"]["verifyOtp"]["token"];
	$c = $tt["data"]["verifyOtp"]["user"]["businesses"];
	$cek = count($c);
	echo $s.'[•] Access Token : '.$toket;


$ua2 = array(
'x-token: '.$toket,
'accept-language: id',
'x-client-platform: android',
'x-client-version: 0.29.0',
'content-type: application/json',
'user-agent: okhttp/4.2.1',
);

$au = $ua2;
$on = $no;

if ($cek == 0){
	echo $s.'[•] Create a business account . . .';
	sleep(2);
	one($au, $on);
	two($au, $on);
	//exit;
} else {
	echo $s.$s.'[!] Your number has been registered / Has a business account';
	echo $s.'[?] Do you want to continue (Y / N) ? : ';
	$yn = trim(fgets(STDIN));

	if ($yn == 'Y' || $yn == 'y'){
		sleep(2);
		two($au, $on);
	} else if ($yn == 'N' || $yn == 'n'){
		echo $s.'[•] Thank you for using this script'.$s;
		sleep(2);
		exit;
	} else {
		echo $s.'[!] The keyword you entered is wrong'.$s;
		exit;
	}
}


function one($ua2, $no){
$s = "\n";

//Register_&_Create_Business//
$url = "https://api.beecash.io/graphql";
$data = '{"operationName":"CreateBusinessMutation","variables":{"input":{"mobile":"+62'.$no.'","name":"Toko'.rand(1, 1000).'","businessCategoryId":"'.rand(1, 20).'","notes":null},"key":"'.rand(1, 100).'"},"query":"mutation CreateBusinessMutation($input: CreateBusinessInput!) {\n  createBusiness(input: $input) {\n    id\n    name\n    mobile\n    businessCategoryId\n    __typename\n  }\n}\n"}';

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_HTTPHEADER, $ua2);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
$result = curl_exec($ch);
$tt = json_decode($result, true);
echo $s.$s;
var_dump($result);
}

function two($ua2, $no){
$s = "\n";
$tgl = gmdate('Y-m-d').'T'.gmdate('H:i:s').'.000Z';

//Cek_BussniseId//
$url = "https://api.beecash.io/graphql";
$data = '{"operationName":"AppQuery","variables":{},"query":"query AppQuery {\n  currentUser {\n    id\n    mobile\n    name\n    email\n    locale\n    timeZone\n    pigeonCustomerToken\n    preferences\n    businesses {\n      id\n      name\n      mobile\n      currencyCode\n      email\n      location\n      businessCategoryId\n      notes\n      invoiceNotes\n      purpose\n      __typename\n    }\n    businessMemberships {\n      id\n      role\n      businessCard\n      businessId\n      __typename\n    }\n    __typename\n  }\n}\n"}';

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_HTTPHEADER, $ua2);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
$result = curl_exec($ch);
$tt = json_decode($result, true);
$bis = $tt["data"]["currentUser"]["businesses"][0]["id"];
//echo $s.$s;
//var_dump($result);
sleep(2);


for ($x=1;$x<=11;$x++){

echo $s."[•] Adding accounts payable [".$x."] . . .";
sleep(2);


	$datx = file_get_contents("https://wirkel.com/data.php?qty=1&domain=tinta.co.id");
	$datas = json_decode($datx);
	$namas = $datas->result[0]->firstname;
	$uid = $datas->result[0]->uuid;

//Create_Nama_Utang//
$url = "https://api.beecash.io/graphql";
$data = '{"operationName":"CreateContactMutation","variables":{"input":{"businessId":"'.$bis.'","name":"'.$namas.'","mobile":null,"createdAt":"'.$tgl.'","updatedAt":"'.$tgl.'"},"key":"'.$uid.'"},"query":"mutation CreateContactMutation($input: CreateContactInput!, $key: String!) {\n  createContact(input: $input, key: $key) {\n    id\n    businessId\n    name\n    mobile\n    dueDate\n    balanceReceivable\n    creditEntriesCount\n    transactionEntriesCount\n    creditShareKey\n    createdAt\n    updatedAt\n    notify\n    __typename\n  }\n}\n"}';

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_HTTPHEADER, $ua2);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
$result = curl_exec($ch);
$tt = json_decode($result, true);
$con = $tt["data"]["createContact"]["id"];
//echo $s.$s;
//var_dump($result);
//sleep(2);


//Create_Nominal_Utang//
$url = "https://api.beecash.io/graphql";
$data = '{"operationName":"CreateCreditEntryMutation","variables":{"input":{"kind":"receivable","date":"'.gmdate('Y-m-d').'","amount":'.rand(1000, 100000).',"businessId":"'.$bis.'","contactId":"'.$con.'","createdAt":"'.$tgl.'","updatedAt":"'.$tgl.'","notes":null},"key":"'.rand(1, 100).'"},"query":"mutation CreateCreditEntryMutation($input: CreateCreditEntryInput!, $key: String!) {\n  createCreditEntry(input: $input, key: $key) {\n    id\n    contactId\n    kind\n    amount\n    date\n    createdAt\n    updatedAt\n    notes\n    transactionEntry {\n      ...transactionEntry\n      __typename\n    }\n    contact {\n      id\n      name\n      mobile\n      dueDate\n      balanceReceivable\n      creditEntriesCount\n      transactionEntriesCount\n      creditShareKey\n      createdAt\n      updatedAt\n      __typename\n    }\n    image {\n      url\n      __typename\n    }\n    __typename\n  }\n}\n\nfragment transactionEntry on TransactionEntry {\n  id\n  saleAmount\n  purchaseAmount\n  date\n  notes\n  createdAt\n  updatedAt\n  paymentStatus\n  salesChannel\n  image {\n    originalFilename\n    url\n    __typename\n  }\n  lineItems {\n    id\n    name\n    quantity\n    __typename\n  }\n  contact {\n    id\n    name\n    mobile\n    __typename\n  }\n  transactionEntryCategory {\n    id\n    name\n    imageUrl\n    __typename\n  }\n  payMethod {\n    id\n    name\n    imageUrl\n    __typename\n  }\n  creditEntries {\n    id\n    __typename\n  }\n  paymentLink {\n    id\n    slug\n    url\n    status\n    paidAt\n    checkedOutAt\n    __typename\n  }\n  __typename\n}\n"}';

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_HTTPHEADER, $ua2);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
$result = curl_exec($ch);
$tt = json_decode($result, true);
//echo $s.$s;
$nama = $tt["data"]["createCreditEntry"]["contact"]["name"];
$duit = $tt["data"]["createCreditEntry"]["contact"]["balanceReceivable"];
//var_dump($result);
//sleep(2);


echo $s."	[✓] Name   : ".$nama;
echo $s."	[✓] Amount : ".$duit;
echo $s."[✓] Success Adding accounts payable".$s;
}

}

}
?>

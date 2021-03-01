<?php 
// QRCODE DAN IFRAME signnow
//SAVE DULU BARU DI KASI CERT
session_start();

//INCLUDE BUAT ATTACH CERTIFICATE P12
include('ajax/PHP-PDF-Signature-master-ZEND/test_certificate.php');

//echo "</br> yang belum : save pdf to uploaded/sm/";

			

			$variableName = $_SESSION['varname'];
			$SESSION['namaFile'] = $variableName;
			echo "$variableName", $variableName;
			echo "</br>";
			$sendurl = "https://192.168.1.40/tata_naskah/uploaded/sm/$variableName";
			$sendimgurl = "https://192.168.1.40/tata_naskah/ajax/img/$variableName.png";
			//tambahin nama user di $sendimgurl
			echo "</br>";
			//echo  $sendurl;
			
			
			
	//Include the necessary library for Ubuntu
    include('phpqrcode/qrlib.php');
    // require_once('qrcode.class.php');
    //Set the data for QR
    

		// Path where the images will be saved
		$filepath = 'ajax/img/'.$variableName.'.png'; // disimpan dimana dengan nama apa
		// Image (logo) to be drawn
		$logopath = 'ajax/img/logo2.png';
		// qr code content
		$codeContents = $sendurl;
		//$codeContents = $sendurl;
		// Create the file in the providen path
		// Customize how you want
		QRcode::png($codeContents,$filepath , QR_ECLEVEL_H, 4); //size qrcode gede apa kecil 8 kecil

		// Start DRAWING LOGO IN QRCODE

		$QR = imagecreatefrompng($filepath);

		// START TO DRAW THE IMAGE ON THE QR CODE
		$logo = imagecreatefromstring(file_get_contents($logopath));
		$QR_width = imagesx($QR);
		$QR_height = imagesy($QR);

		$logo_width = imagesx($logo);
		$logo_height = imagesy($logo);

		// Scale logo to fit in the QR Code
		$logo_qr_width = $QR_width/8;
		$scale = $logo_width/$logo_qr_width;
		$logo_qr_height = $logo_height/$scale;

		imagecopyresampled($QR, $logo, $QR_width/3.25, $QR_height/3.25, 0, 0, $logo_qr_width, $logo_qr_height, $logo_width, $logo_height);

		// Save QR code again, but with logo on it
		imagepng($QR,$filepath);

		// End DRAWING LOGO IN QR CODE

		// Ouput image in the browser
		//echo '<img src="'.$filepath.'" />';

			
			
?>
<div align="center">
<iframe src="http://192.168.1.40:8081/?<?php echo $sendurl ?>!<?php echo $sendimgurl ?>" height="800" width="1024" srcolling="no"></iframe>

<iframe src="https://signnow2.netlify.app/?<?php echo $sendurl ?>!<?php echo $sendimgurl ?>" height="800" width="1024" srcolling="no"></iframe>
<!-- yang bener-->
</div>

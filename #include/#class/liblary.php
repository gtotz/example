<?php
	namespace App;

	class liblary{
		public function clean_name($text) {
			$text=strtolower($text);
			$code_entities_match = array(' ','--','&quot;','!','@','#','$','%','^','&','*','(',')','_','+','{','}','|',':','"','<','>','?','[',']','\\',';',"'",',','/','*','+','~','`','=');
			$code_entities_replace = array('-','-','','','','','','','','','','','','','','','','','','-','','','','','');
			$text = str_replace($code_entities_match, $code_entities_replace, $text);
			return $text;
		}
		
		public function seo_title($s) {
			$c = array (' ');
			$d = array ('-','/','\\',',','.','#',':',';','\'','"','[',']','{','}',')','(','|','`','~','!','@','%','$','^','&','*','=','?','+','&');

			$s = str_replace($d, '', $s); // Hilangkan karakter yang telah disebutkan di array $d
			
			$s = strtolower(str_replace($c, '-', $s)); // Ganti spasi dengan tanda - dan ubah hurufnya menjadi kecil semua
			return $s;
		}
		
		public function autolink ($str){
			$str = eregi_replace("([[:space:]])((f|ht)tps?:\/\/[a-z0-9~#%@\&:=?+\/\.,_-]+[a-z0-9~#%@\&=?+\/_.;-]+)", "\\1<a href=\"\\2\" target=\"_blank\">\\2</a>", $str); //http
			$str = eregi_replace("([[:space:]])(www\.[a-z0-9~#%@\&:=?+\/\.,_-]+[a-z0-9~#%@\&=?+\/_.;-]+)", "\\1<a href=\"http://\\2\" target=\"_blank\">\\2</a>", $str); // www.
			$str = eregi_replace("([[:space:]])([_\.0-9a-z-]+@([0-9a-z][0-9a-z-]+\.)+[a-z]{2,3})","\\1<a href=\"mailto:\\2\">\\2</a>", $str); // mail
			$str = eregi_replace("^((f|ht)tp:\/\/[a-z0-9~#%@\&:=?+\/\.,_-]+[a-z0-9~#%@\&=?+\/_.;-]+)", "<a href=\"\\1\" target=\"_blank\">\\1</a>", $str); //http
			$str = eregi_replace("^(www\.[a-z0-9~#%@\&:=?+\/\.,_-]+[a-z0-9~#%@\&=?+\/_.;-]+)", "<a href=\"http://\\1\" target=\"_blank\">\\1</a>", $str); // www.
			$str = eregi_replace("^([_\.0-9a-z-]+@([0-9a-z][0-9a-z-]+\.)+[a-z]{2,3})","<a href=\"mailto:\\1\">\\1</a>", $str); // mail
			return $str;
		}
		
		public function clean_name_plus($text) {
			$text = str_replace(' ', '+', $text);
			return $text;
		}
		
		public function complete_zero($number,$max_length){
		   $number_length = strlen($number);
		   $zero_length = $max_length - $number_length;
		   $zero = "";
		   for($i=1;$i<=$zero_length;$i++)
		   {
			  $zero .= '0';
		   }
		   return $zero.$number;
		}
		
		public function potong_text($input, $length, $ellipses = true, $strip_html = true) {
			//strip tags, if desired
			if ($strip_html) {
				$input = strip_tags($input);
			}
		 
			//no need to trim, already shorter than trim length
			if (strlen($input) <= $length) {
				return $input;
			}
		 
			//find last space within length
			$last_space = strrpos(substr($input, 0, $length), ' ');
			$trimmed_text = substr($input, 0, $last_space);
		 
			//add ellipses (...)
			if ($ellipses) {
				$trimmed_text .= '...';
			}
		 
			return $trimmed_text;
		}
		
		public function ambil_hari($tgl){
			$tanggal = strtotime($tgl);
			$hari_en = date('l', $tanggal);
			$hari_ar = array("Monday"=>"Senin", "Tuesday"=>"Selasa", "Wednesday"=>"Rabu", "Thursday"=>"Kamis", "Friday"=>"Jumat", "Saturday"=>"Sabtu", "Sunday"=>"Minggu");
			$hari_id = $hari_ar[$hari_en];
			return($hari_id);
		}
		
		public function TanggalIndo($date = ""){
			if (trim ($date) == ''){
		            $date = time ();
		    }elseif (!ctype_digit ($date)){
		        $date = strtotime ($date);
		    }
			
			$date = date("Y-m-d",$date);
			$BulanIndo = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
		 
			$tahun = substr($date, 0, 4);
			$bulan = substr($date, 5, 2);
			$tgl   = substr($date, 8, 2);
		 
			$result = $tgl . " " . $BulanIndo[(int)$bulan-1] . " ". $tahun;        
			return($result);
		}

		public function TanggalIndo2($date){
			$BulanIndo = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
		 
			$tahun = substr($date, 0, 4);
			$bulan = substr($date, 5, 2);
			$tgl   = substr($date, 8, 2);
		 
			$result = $tgl.' '.$BulanIndo[(int)$bulan-1]. ", ". $tahun;        
			return($result);
		}
		
		public function ucwords_string($str){
			$str = strtolower($str);
			$str = ucwords($str);
			return($str);
		}
		
		public function generateRandomString($length) {
			$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
			$randomString = '';
			for ($i = 0; $i < $length; $i++) {
				$randomString .= $characters[rand(0, strlen($characters) - 1)];
			}
			return $randomString;
		}
		
		function generateRandomNumber($min, $max) {
			return rand($min, $max);
		}
		
		public function filterA($data){
			$filter = stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES)));
			return $filter;
		}
		
		public function trimed($txt){
			$txt = trim($txt);
			while( strpos($txt, ' ') ){
				$txt = str_replace(' ', '', $txt);
			}
			return $txt;
		}
		
		public function downloadFile($file){
			$file_name = $file;
			$mime = 'application/force-download';
			header('Pragma: public'); 	// required
			header('Expires: 0');		// no cache
			header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
			header('Cache-Control: private',false);
			header('Content-Type: '.$mime);
			header('Content-Disposition: attachment; filename="'.basename($file_name).'"');
			header('Content-Transfer-Encoding: binary');
			header('Connection: close');
			readfile($file_name);		// push it out
			exit();
		}
		
		function relative_date($time) {
			$pattern = array (
				'/Mon[^day]/','/Tue[^sday]/','/Wed[^nesday]/','/Thu[^rsday]/',
				'/Fri[^day]/','/Sat[^urday]/','/Sun[^day]/','/Monday/','/Tuesday/',
				'/Wednesday/','/Thursday/','/Friday/','/Saturday/','/Sunday/',
				'/Jan[^uary]/','/Feb[^ruary]/','/Mar[^ch]/','/Apr[^il]/','/May/',
				'/Jun[^e]/','/Jul[^y]/','/Aug[^ust]/','/Sep[^tember]/','/Oct[^ober]/',
				'/Nov[^ember]/','/Dec[^ember]/','/January/','/February/','/March/',
				'/April/','/June/','/July/','/August/','/September/','/October/',
				'/November/','/December/',
			);
			$replace = array ( 'Sen','Sel','Rab','Kam','Jum','Sab','Min',
				'Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu',
				'Jan','Feb','Mar','Apr','Mei','Jun','Jul','Ags','Sep','Okt','Nov','Des',
				'Januari','Februari','Maret','April','Juni','Juli','Agustus','September',
				'Oktober','November','Desember',
			);
			
			$today = strtotime(date('M j, Y'));
			$jam = date('H:i',$time);
			$reldays = ($time - $today)/86400;
			if ($reldays >= 0 && $reldays < 1) {
				return 'Hari ini, '.$jam;
			} else if ($reldays >= 1 && $reldays < 2) {
				return 'Besok, '.$jam;
			} else if ($reldays >= -1 && $reldays < 0) {
				return 'Kemarin, '.$jam;
			}
			
			if (abs($reldays) < 7) {
				if ($reldays > 0) {
					$reldays = floor($reldays);
					//return 'In ' . $reldays . ' day' . ($reldays != 1 ? 's' : '');
					return $reldays . ' Hari kedepan';
				} else {
					$reldays = abs(floor($reldays));
					//return $reldays . ' Hari' . ($reldays != 1 ? 's' : '') . ' Lalu';
					return $reldays . ' Hari lalu';
				}
			}
			
			if (abs($reldays) < 182) {
				$date = date('l, j F Y',$time ? $time : time());
				$date = preg_replace ($pattern, $replace, $date).", $jam";
				return $date;
			} else {
				$date = date('l, j F Y',$time ? $time : time());
				$date = preg_replace ($pattern, $replace, $date).", $jam";
				return $date;
			}
		}

		public function indonesian_date ($timestamp = '', $date_format = 'l, j M  Y H:i '/*, $suffix = 'WIB'*/) {
		    if (trim ($timestamp) == '')
		    {
		            $timestamp = time ();
		    }
		    elseif (!ctype_digit ($timestamp))
		    {
		        $timestamp = strtotime ($timestamp);
		    }
		    # remove S (st,nd,rd,th) there are no such things in indonesia :p
		    $date_format = preg_replace ("/S/", "", $date_format);
		    $pattern = array (
		        '/Mon[^day]/','/Tue[^sday]/','/Wed[^nesday]/','/Thu[^rsday]/',
		        '/Fri[^day]/','/Sat[^urday]/','/Sun[^day]/','/Monday/','/Tuesday/',
		        '/Wednesday/','/Thursday/','/Friday/','/Saturday/','/Sunday/',
		        '/Jan[^uary]/','/Feb[^ruary]/','/Mar[^ch]/','/Apr[^il]/','/May/',
		        '/Jun[^e]/','/Jul[^y]/','/Aug[^ust]/','/Sep[^tember]/','/Oct[^ober]/',
		        '/Nov[^ember]/','/Dec[^ember]/','/January/','/February/','/March/',
		        '/April/','/June/','/July/','/August/','/September/','/October/',
		        '/November/','/December/',
		    );
		    $replace = array ( 'Sen','Sel','Rab','Kam','Jum','Sab','Min',
		        'Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu',
		        'Jan','Feb','Mar','Apr','Mei','Jun','Jul','Ags','Sep','Okt','Nov','Des',
		        'Januari','Februari','Maret','April','Juni','Juli','Agustus','September',
		        'Oktober','November','Desember',
		    );
		    $date = date ($date_format, $timestamp);
		    $date = preg_replace ($pattern, $replace, $date);
		    $date = "{$date} ";
		    return $date;
		}
		
		public function dateAgo($date) {
		  	$ts = strtotime($date);
		  	$tsYmdDate = strtotime(date('Y-m-d 00:00:00', $ts));
		 
		  	$tsNow = time();
		  	$dateNow = date('Y-m-d H:i:s', $tsNow);
		  	$tsYmdNow = strtotime(date('Y-m-d 00:00:00', $tsNow));
		 
		  	$diff = ($tsYmdNow - $tsYmdDate)/(60*60*24);
		 
		  	if ($diff == '1') {
		    	return "yesterday at ".date('g:i A', $ts);
		  	} else {
			    $diff = abs($tsNow - $ts);
			 
			    $seconds  = $diff;
			    $minutes  = floor($diff/60);
			    $hours    = floor($minutes/60);
			    $days     = floor($hours/24);
			 
			    if ($seconds < 60) {
			      	return "$seconds seconds ago";
			    } elseif ($minutes < 60) {
			      	return ($minutes == 1) ? "a minute ago" : "$minutes minutes ago" ;
			    } elseif ($hours < 24) {
			      	return ($hours == 1) ? "an hour ago" : "$hours hours ago" ;
			    } else {
			      	return $this->tgl_jam($date);
			    }
		  	}
		}

		public function replacedot($string){
			$string = preg_replace("/\r\n/", "<br><br>", $string);
			return $string;
		}

		public function upercasefirst($input){
			$input = ucwords(strtolower($input));
			return $input;
		}
		
		public function nl2p($str) {
			$arr=explode("\n",$str);
			$out='';

			for($i=0;$i<count($arr);$i++) {
				if(strlen(trim($arr[$i]))>0)
					$out.='<p>'.trim($arr[$i]).'</p>';
			}
			return $out;
		}
		
		public function getRealIpAddr() {
			if (!empty($_SERVER['HTTP_CLIENT_IP'])) {  //check ip from share internet
			  $ip=$_SERVER['HTTP_CLIENT_IP'];
			}
			elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) { //to check ip is pass from proxy
			  $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
			}
			else {
			  $ip=$_SERVER['REMOTE_ADDR'];
			}
			//$addr = explode(",",$ip);
			//return $addr[sizeof($addr)-1];
			return $ip;
		}
		
		public function check_dir($dir, $chmod = 0777) {
			if (!file_exists($dir)) {
				mkdir($dir, $chmod, true);
				chmod($dir, $chmod);
			}
		}

		public function resize($newWidth, $targetFile, $originalFile) {
			$info = getimagesize($originalFile);
			$mime = $info['mime'];

			switch ($mime) {
					case 'image/jpeg':
							$image_create_func = 'imagecreatefromjpeg';
							$image_save_func = 'imagejpeg';
							$new_image_ext = 'jpg';
							break;

					case 'image/png':
							$image_create_func = 'imagecreatefrompng';
							$image_save_func = 'imagepng';
							$new_image_ext = 'png';
							break;

					case 'image/gif':
							$image_create_func = 'imagecreatefromgif';
							$image_save_func = 'imagegif';
							$new_image_ext = 'gif';
							break;

					default: 
							throw new Exception('Unknown image type.');
			}

			$img = $image_create_func($originalFile);
			list($width, $height) = getimagesize($originalFile);

			$newHeight = ($height / $width) * $newWidth;
			$tmp = imagecreatetruecolor($newWidth, $newHeight);
			imagecopyresampled($tmp, $img, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

			if (file_exists($targetFile)) {
					unlink($targetFile);
			}
			$image_save_func($tmp, "$targetFile.$new_image_ext");
		}
		
		public function bulan($date) { 
			$BulanIndo = array("Januari", "Februari", "Maret","April", "Mei", "Juni","Juli", "Agustus", "September","Oktober", "November", "Desember");
			$tahun = substr($date, 0, 4); 
			$bulan = substr($date, 5, 2); 
			$tgl   = substr($date, 8, 2); 
			if(substr($tgl, 0, 1) == "0"){
				$xtgl = str_replace("0","",$tgl);
			}else{
				$xtgl = $tgl;
			}
			
			$result = $BulanIndo[(int)$bulan-1];
			return($result);
		}
		
		public function get_json($url, $data_string){                                                                               
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");  
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); 
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
				'Content-Type: application/json',                                                                                
				'Content-Length: ' . strlen($data_string))                                                                       
			);
			$result = curl_exec($ch);
			curl_close($ch);  // Seems like good practice
			return $result;
		}
		
		public function queryMatch($symbol, $keyword){
			$keyword = preg_replace('/\s\s+/', ' ', $keyword);
			
			$keyword = str_replace('+', "", addslashes(trim($keyword)));
			$keyword = str_replace('-', "", addslashes(trim($keyword)));
			$keyword = str_replace('  ', " ", addslashes(trim($keyword)));
			$newString = $symbol . str_replace(' ', " $symbol", addslashes(trim($keyword)));
			return $newString;
		}
		
		public function queryMatch2($keyword){
			$newString = NULL;
			$keyword = str_replace('  ', " ", addslashes(trim($keyword)));
			$array = explode(" ",$keyword);
			
			foreach($array AS $test){
				if (strpos($test, '-') !== false) {
					$newString .= "\"$test\"";
				}else{
					$newString .= "+".$test." ";
				}
			}
			
			return $newString;
		}
		
		public function get_num_month($month){
			$months = array('Jan' => '01', 'Feb' => '02', 'Mar'  => '03', 'Apr'  => '04', 'Mei' => '05', 'Jun' => '06', 'Jul' => '07', 'Agu' => '08', 'Sep'  => '09', 'Okt' => '10', 'Nop' => '11', 'Des' => '12');
			return $months[$month];
		}
		
		public function get_full_month($month){
			$months = array('Jan' => 'Januari', 'Feb' => 'Februari', 'Mar'  => 'Maret', 'Apr'  => 'April', 'Mei' => 'Mei', 'Jun' => 'Juni', 'Jul' => 'Juli', 'Agu' => 'Agustus', 'Sep'  => 'September', 'Okt' => 'Oktober', 'Nop' => 'November', 'Des' => 'Desember');
			return $months[$month];
		}
		
		public function hitung_kata($string){
			$words = "";
			$string = preg_replace("/{ +}/", " ", $string);
			$array = explode(" ", $string);
			for($i=0;$i < count($array);$i++)
				{
				if (preg_match("/[0-9A-Za-zÀ-ÖØ-öø-ÿ]/i", $array[$i]))
				$words[$i] = $array[$i];
				}
			return $i;
		}
		
		public function covert_date($time) {
			if(!is_numeric($time)) {
				$time = strtotime($time);
			}
			return $this->namahari(date('Y-m-d', $time)).', '.$this->newdate(date('Y-m-d', $time));
		}
		
		public function namahari($kode){
			$namaHari = array("0", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Minggu"); 
			$display = date("N",strtotime($kode));
			$hari = ($namaHari[$display]);
			return ($hari);
		}
		
		public function newdate($date) { 
			$BulanIndo = array("Januari", "Februari", "Maret","April", "Mei", "Juni","Juli", "Agustus", "September","Oktober", "November", "Desember");
			$tahun = substr($date, 0, 4); 
			$bulan = substr($date, 5, 2); 
			$tgl   = substr($date, 8, 2); 
			if(substr($tgl, 0, 1) == "0"){
				$xtgl = str_replace("0","",$tgl);
			}else{
				$xtgl = $tgl;
			}
			
			$result = $xtgl . " " . $BulanIndo[(int)$bulan-1] . " ". $tahun;
			return($result);
		}
		
		public function bcript($string){
			$options = array(
				'cost' => 12
			);
			$password_hash = password_hash($string, PASSWORD_BCRYPT, $options);
			
			return $password_hash;
		}

		public function delete_apc_cache($id_cache){
			if(apc_exists($id_cache)){
				apc_delete($id_cache);
			}
		}
		
		public function delete_apcu_cache($id_cache){
			if(apcu_exists($id_cache)){
				apcu_delete($id_cache);
			}
		}
		
		public function create_apc_cache($cachekey, $ttl, $arr){
			apc_store($cachekey, serialize($arr),$ttl);
		}
		
		public function create_apcu_cache($cachekey, $ttl, $arr){
			apcu_store($cachekey, serialize($arr),$ttl);
		}
		
		public function get_mime_type_file($file) {
			$mtype = false;
			if (function_exists('finfo_open')) {
				$finfo = finfo_open(FILEINFO_MIME_TYPE);
				$mtype = finfo_file($finfo, $file);
				finfo_close($finfo);
			} elseif (function_exists('mime_content_type')) {
				$mtype = mime_content_type($file);
			} 
			return $mtype;
		}
		
		public function removeTag($str, $tag) { 
			$str = preg_replace("#\<".$tag."(.*)/".$tag.">#iUs", "", $str);
			return $str;
		}
		
		public function encrypt_decrypt($action, $string, $secret_key, $secret_iv) {
			$output = false;
			$encrypt_method = "AES-256-CBC";
			$key = hash('sha256', $secret_key);
			
			$iv = substr(hash('sha256', $secret_iv), 0, 16);
			if ( $action == 'encrypt' ) {
				$output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
				$output = base64_encode($output);
			}
			elseif( $action == 'decrypt' ) {
				$output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
			}
			return $output;
		}
		
		public function check_weekend($date){
			$weekendDay = false;
			$day = date("D", strtotime($date));
			if($day == 'Sat' || $day == 'Sun'){
				$weekendDay = true;
			}
			return $weekendDay;
		}
		
		public function bulanId($bln){
			$bulan = array("","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
			return $bulan[$bln];
		}
		
		public function str_truncate_middle($text, $maxChars = 25, $filler = '...'){
			$length = strlen($text);
			$fillerLength = strlen($filler);

			return ($length > $maxChars)
				? substr_replace($text, $filler, ($maxChars - $fillerLength) / 2, $length - $maxChars + $fillerLength)
				: $text;
		}
		
		public function Terbilang($nilai) {
			$huruf = array("", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "Sebelas");
			if($nilai==0){
				// return "Kosong";
			}elseif ($nilai < 12&$nilai!=0) {
				return "" . $huruf[$nilai];
			} elseif ($nilai < 20) {
				return $this->Terbilang($nilai - 10) . " Belas ";
			} elseif ($nilai < 100) {
				return $this->Terbilang($nilai / 10) . " Puluh " . $this->Terbilang($nilai % 10);
			} elseif ($nilai < 200) {
				return " Seratus " . $this->Terbilang($nilai - 100);
			} elseif ($nilai < 1000) {
				return $this->Terbilang($nilai / 100) . " Ratus " . $this->Terbilang($nilai % 100);
			} elseif ($nilai < 2000) {
				return " Seribu " . $this->Terbilang($nilai - 1000);
			} elseif ($nilai < 1000000) {
				return $this->Terbilang($nilai / 1000) . " Ribu " . $this->Terbilang($nilai % 1000);
			} elseif ($nilai < 1000000000) {
				return $this->Terbilang($nilai / 1000000) . " Juta " . $this->Terbilang($nilai % 1000000);
			} elseif ($nilai < 1000000000000) {
				return $this->Terbilang($nilai / 1000000000) . " Milyar " . $this->Terbilang($nilai % 1000000000);
			} elseif ($nilai < 100000000000000) {
				return $this->Terbilang($nilai / 1000000000000) . " Trilyun " . $this->Terbilang($nilai % 1000000000000);
			} elseif ($nilai <= 100000000000000) {
				return "Maaf Tidak Dapat di Prose Karena Jumlah nilai Terlalu Besar ";
			}
		}
		
		public function convert_filesize($bytes, $decimals = 2){
			$size = array('B','kB','MB','GB','TB','PB','EB','ZB','YB');
			$factor = floor((strlen($bytes) - 1) / 3);
			return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) ." ". @$size[$factor];
		}
		
		public function numberToRomanRepresentation($number) {
			$map = array('M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400, 'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40, 'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1);
			$returnValue = '';
			while ($number > 0) {
				foreach ($map as $roman => $int) {
					if($number >= $int) {
						$number -= $int;
						$returnValue .= $roman;
						break;
					}
				}
			}
			return $returnValue;
		}
		
		public function getDistanceBetweenPoints($lat1, $lon1, $lat2, $lon2) {
			$theta = $lon1 - $lon2;
			$miles = (sin(deg2rad($lat1)) * sin(deg2rad($lat2))) + (cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta)));
			$miles = acos($miles);
			$miles = rad2deg($miles);
			$miles = $miles * 60 * 1.1515;
			$feet = $miles * 5280;
			$yards = $feet / 3;
			$kilometers = $miles * 1.609344;
			$meters = $kilometers * 1000;
			return compact('miles','feet','yards','kilometers','meters'); 
		}
		
		public function inter_format_no_hp($nomorhp) {
			$nomorhp = trim($nomorhp);
			$nomorhp = strip_tags($nomorhp);
			$nomorhp = str_replace(" ","",$nomorhp);
			// bersihkan dari bentuk seperti  (022) 66677788
			$nomorhp = str_replace("(","",$nomorhp);
			// bersihkan dari format yang ada titik seperti 0811.222.333.4
			$nomorhp = str_replace(".","",$nomorhp); 

			//cek apakah mengandung karakter + dan 0-9
			if(!preg_match('/[^+0-9]/',trim($nomorhp))){
				// cek apakah no hp karakter 1-3 adalah +62
				if(substr(trim($nomorhp), 0, 3)=='+62'){
					$nomorhp= trim($nomorhp);
				}elseif(substr($nomorhp, 0, 1)=='0'){
					$nomorhp= '+62'.substr($nomorhp, 1);
				}
			}
			return $nomorhp;
		}
		
		public function tulisAngkaIndonesia($angka){
			$angkaIndonesia = [
				1 => 'pertama',
				2 => 'kedua',
				3 => 'ketiga',
				4 => 'keempat',
				5 => 'kelima',
				6 => 'keenam',
				7 => 'ketujuh',
				8 => 'kedelapan',
				9 => 'kesembilan',
				10 => 'kesepuluh',
				// dan seterusnya...
			];

			if (array_key_exists($angka, $angkaIndonesia)) {
				return $angkaIndonesia[$angka];
			} else {
				return 'angka tidak ditemukan';
			}
		}
		
		public function hitungUmur($tanggalLahir) {
			$lahir = strtotime($tanggalLahir);
			$sekarang = time();

			$selisihTahun = date('Y', $sekarang) - date('Y', $lahir);

			// Periksa apakah ulang tahun sudah lewat atau belum pada tahun ini
			if (date('md', $sekarang) < date('md', $lahir)) {
				$selisihTahun--;
			}

			return $selisihTahun;
		}
	}
?>
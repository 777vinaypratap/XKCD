<?php
// For Security purpose
if(!defined('comic')) {
   die('Nothing is available');
}

$url='https://c.xkcd.com/random/comic/';
  
// Initialize a CURL session.
$ch = curl_init();
  
// Grab URL and pass it to the variable.
curl_setopt($ch, CURLOPT_URL, $url);
  
// Catch output (do NOT print!)
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
  
// Return follow location true
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
$html = curl_exec($ch);
  
// Getinfo or redirected URL from effective URL
$redirectedUrl = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
// Close handle

curl_close($ch);

$api_url = $redirectedUrl.'info.0.json';
 $json_data = file_get_contents($api_url);
 $response_data = json_decode($json_data);

 $imgurl=$response_data->img;
 $title=$response_data->safe_title;
$file =file_get_contents($imgurl);
$img = chunk_split(base64_encode($file));
$file_info = new finfo(FILEINFO_MIME_TYPE);
$type = $file_info->buffer($file);
$attach=[$title,$img,$type];
$imgtag='<img src="'.$imgurl.'" alt="Problem loading img" >';
?>
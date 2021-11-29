

<?php

 header('Content-Type: application/json');




$actual_link = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];

$url =  $_GET['seg'];

echo "
{
  \"name\": \"My Store\",
  \"gcm_user_visible_only\": true,
  \"short_name\": \"My Store\",
  \"description\": \"\",
  \"start_url\": \"/$url\",
  \"display\": \"standalone\",
  \"orientation\": \"portrait\",
  \"background_color\": \"#3367D6\",
  \"theme_color\": \"#3367D6\",
  \"icons\": [{
    \"src\": \"https://1313xyz.xyz/addtohome/imgs/icon192.png\",
    \"sizes\": \"192x192\",
    \"type\": \"image/png\"
  },{
    \"src\": \"https://1313xyz.xyz/addtohome/imgs/icon512.png\",
    \"sizes\": \"512x512\",
    \"type\": \"image/png\"     
  }]
}
";
?>
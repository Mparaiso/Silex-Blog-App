<?php
define('IS_AJAX', isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');

if(IS_AJAX):
  $query = file_get_contents("php://input");
  header("Content-Type: application/json;");
  print_r($query);
else:
ob_start();
?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
  <meta charset="UTF-8">
  <title></title>
</head>
<body>
  <button id='button'>Send datas</button>
  <script type="text/javascript" src='file.js'>
  </script>
</body>
</html>
<?php
$content = ob_get_clean();
echo $content;
endif;
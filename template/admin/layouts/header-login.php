<?php
autoRomoveTokenLogin();
// saveActivity();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="<?php echo _WEB_HOST_TEMPLATE ?>/css/style.css">
  <link rel="stylesheet" href="<?php echo _WEB_HOST_TEMPLATE ?>/css/fontawesome.min.css">
  <link rel="stylesheet" href="<?php echo _WEB_HOST_TEMPLATE ?>/css/bootstrap.min.css">
  <title><?php if (!empty($data['titlePage'])) echo $data['titlePage'] ?></title>
</head>

<body>
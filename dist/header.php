<?php
$root = get_template_directory_uri();
?>

<html <?php language_attributes(); ?>>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title><?php the_title(); ?></title>
  <link rel="stylesheet" href="<?php echo $root.'/dist/css/main.css' ?>" />
</head>
<body>

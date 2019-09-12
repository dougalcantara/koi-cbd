<?php
$root = get_template_directory_uri();
?>

<html <?php language_attributes(); ?>>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title><?php the_title(); ?></title>
  <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Overlock:400,700&display=swap" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.css" />
  <link rel="stylesheet" href="<?php echo $root.'/dist/css/main.css' ?>" />
</head>
<body <?php body_class(); ?>>
  <?php get_template_part('partials/site-header'); ?>
  <main role="main" id="k-main">
<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
<head>
   <meta charset="<?php bloginfo('charset'); ?>">
   <title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' |'; } ?> <?php bloginfo('name'); ?></title>

   <link href="//www.google-analytics.com" rel="dns-prefetch">
   <link href="<?php echo get_template_directory_uri(); ?>/img/icons/favicon.ico" rel="shortcut icon">
   <link href="<?php echo get_template_directory_uri(); ?>/img/icons/touch.png" rel="apple-touch-icon-precomposed">

   <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta name="description" content="<?php bloginfo('description'); ?>">
   <link href='https://fonts.googleapis.com/css?family=Roboto:400,300,500,400italic,700,700italic?family=Roboto+Condensed' rel='stylesheet' type='text/css'>
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

   <?php wp_head(); ?>
   <script>
      // conditionizr.com
      // configure environment tests
      conditionizr.config({
         assets: '<?php echo get_template_directory_uri(); ?>',
         tests: {}
      });
   </script>
   <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
   <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
   <![endif]-->
</head>
<body <?php body_class(); ?>>

   <!-- header -->
   <header role="banner">

      <!-- nav -->
      <nav class="navbar navbar-default navbar-fixed-top navbar-topic-page" role="navigation">
         <div class="container-fluid">

            <!-- logo -->
            <div class="navbar-header">
               <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                  <span class="sr-only">Toggle navigation</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
               </button>
               <a class="navbar-brand" href="<?php echo home_url(); ?>">
                  <img alt="Friendship Madness logo" src="<?php echo get_template_directory_uri(); ?>/img/logos/FMAA-nav.svg" />
               </a>
            </div>
            <!-- /logo -->

            <!-- navbar -->
            <div id="navbar" class="collapse navbar-collapse">

               <?php html5blank_nav(); ?>
               
               <div class="navbar-right">
                  <img alt="Tagline" src="<?php echo get_template_directory_uri(); ?>/img/tagline.svg" />
              </div>
            </div>
            <!-- /navbar -->

         </div>
      </nav>
      <!-- /nav -->

   </header>
   <!-- /header -->

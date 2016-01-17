<!doctype html>

<!--[if lt IE 7]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8 lt-ie7"><![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->

	<head>
		<meta charset="utf-8">

		<?php // force Internet Explorer to use the latest rendering engine available ?>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">

		<title><?php wp_title(''); ?></title>

		<?php // mobile meta (hooray!) ?>
		<meta name="HandheldFriendly" content="True">
		<meta name="MobileOptimized" content="320">
		<meta name="viewport" content="width=device-width, initial-scale=1"/>

		<?php // icons & favicons (for more: http://www.jonathantneal.com/blog/understand-the-favicon/) ?>
		<link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/library/images/apple-touch-icon.png">
		<link rel="icon" href="<?php echo get_template_directory_uri(); ?>/favicon.png">
		<!--[if IE]>
			<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico">
		<![endif]-->
		<?php // or, set /favicon.ico for IE10 win ?>
		<meta name="msapplication-TileColor" content="#f01d4f">
		<meta name="msapplication-TileImage" content="<?php echo get_template_directory_uri(); ?>/library/images/win8-tile-icon.png">
            <meta name="theme-color" content="#121212">

		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

		<?php // wordpress head functions ?>
		<?php wp_head(); ?>
		<?php // end of wordpress head ?>

		<?php // drop Google Analytics Here ?>
		<?php // end analytics ?>

	</head>

	<body <?php body_class('woocommerce'); ?> itemscope itemtype="http://schema.org/WebPage">

        <!-- <div id="loading">

            <img src="loading.png" />

        </div> -->

		<div id="main" class="m-scene">

            <a href="#" id="logo"><img src="<?php echo get_template_directory_uri(); ?>/library/images/diamondhat.png" /></a>

            <div id="card">

    			<header class="header">

                    <img class="header" src="<?php echo get_template_directory_uri(); ?>/library/images/words-logo-white.png" />

                    <div class="navitems">

                        <span class="store">

                            <a href="<?php echo home_url(); ?>">
                                <img class="fish store" src="<?php echo get_template_directory_uri(); ?>/library/images/logo-white.png" />
                                home
                            </a>

                        </span>
                        <span class="store">

                            <a href="<?php echo home_url(); ?>/shop/">
                                <img class="fish store" src="<?php echo get_template_directory_uri(); ?>/library/images/logo-white.png" />
                                shop
                            </a>

                        </span>
                        <span class="about">

                            <a href="<?php echo home_url(); ?>/about/">
                                <img class="fish about" src="<?php echo get_template_directory_uri(); ?>/library/images/logo-white.png" />
                                about
                            </a>

                        </span>
                        <span class="about">

                            <a href="<?php echo home_url(); ?>/about/">
                                <img class="fish about" src="<?php echo get_template_directory_uri(); ?>/library/images/logo-white.png" />
                                contact
                            </a>

                        </span>
                        <span class="about">

                            <a href="<?php echo home_url(); ?>/about/">
                                <img class="fish about" src="<?php echo get_template_directory_uri(); ?>/library/images/logo-white.png" />
                                size chart
                            </a>

                        </span>

                    </div>

                    <?php
                        $cart = WC()->session->get( 'cart', array() );
                        $actualCart = WC()->cart; ?>

                    <a href="<?php $page = get_page_by_title('Cart'); echo get_page_link($page->ID); ?>"><i class="fa fa-shopping-cart fa-2x fa-inverse"></i></a>

    			</header>

                <div id="content">

<?php
/**
 * The header for Astra Theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Astra
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

?><!DOCTYPE html>
<?php astra_html_before(); ?>
<html <?php language_attributes(); ?>>
<head>
<?php astra_head_top(); ?>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="https://gmpg.org/xfn/11">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<?php wp_head(); ?>
<?php astra_head_bottom(); ?>
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri() ?>/custom.css ">
</head>

<body <?php astra_schema_body(); ?> <?php body_class(); ?>>

<nav class="mobile_nav hide">
	<ul>
		<li class="cart_icon"><img src="<?php echo get_stylesheet_directory_uri() ?>/assets/cart_white.svg" alt="" class="cart_svg"></li>
		<li> <a href="http://bogino-nyt-til-eksamen.local/">home</a> </li>
		<li> <a href="http://bogino-nyt-til-eksamen.local/clothing/">clothing</a> </li>
		<li> <a href="http://bogino-nyt-til-eksamen.local/about/">about us</a></li>
		<li> <a href="http://bogino-nyt-til-eksamen.local/contact/">contact</a></li>
		<li class="profile_btn">profile</li>
	</ul>
	
</nav>
<nav class="desktop_nav">
	<ul>
		<li class="cart_icon-desktop"><img src="<?php echo get_stylesheet_directory_uri() ?>/assets/cart_red.svg" alt="" class="cart_svg"></li>
		<li class="desk_home"> <a href="http://bogino-nyt-til-eksamen.local/">home</a> </li>
		<li class="desk_clothing"> <a href="http://bogino-nyt-til-eksamen.local/clothing/">clothing</a> </li>
		<li class="desk_about"><a href="http://bogino-nyt-til-eksamen.local/about/">about us</a></li>
		<li class="desk_contact"><a href="http://bogino-nyt-til-eksamen.local/contact/">contact</a></li>
		<li class="profile_btn-desktop">profile</li>
	</ul>
	
</nav>

<div class="burger_knap">
		<div class="streg1"></div>
		<div class="streg2"></div>
		<div class="streg3"></div>
	
	</div>
</div>

<!-- KURV POPUP -->
<div class="cart_container-overlay hide"></div>
<div class="cart_container hide">
	<div class="luk_cart luk"></div>
	<div class="content">
		<h2>
			YOUR CART
		</h2>
		<div class="cart_products">
			<div class="product">
				<div class="cart_img-container">
					<img src="<?php echo get_stylesheet_directory_uri() ?>/assets/white_tee.jpg" alt="">
				</div>
				<div class="product_info">
					<h4>Bogino White Tee</h4>
					<div class="product_info-details">
						<p>400 kr</p>
						<p>Quantity 2</p>
					</div>
				</div>
			</div>

			<div class="product">
				<div class="cart_img-container">
					<img src="<?php echo get_stylesheet_directory_uri() ?>/assets/socks.jpg" alt="">
				</div>
				<div class="product_info">
					<h4>Bogino Socks</h4>
					<div class="product_info-details">
						<p>100 kr</p>
						<p>Quantity 1</p>
					</div>
				</div>
			</div>
			
		</div>
		<div class="cart_button-container">
				<button class="cart buy button_nofill">Buy Now</button>
				<button class="cart see_more button_fill">See More</button>
			</div>
	</div>
</div>
<!-- PROFIL POPUP -->
<div class="profile_container-overlay hide"></div>
<div class="login_popup hide">
	<div class="luk_profile luk"></div>
	<div class="content">
		<h2>
			LOGIN WITH
		</h2>
		<div class="login_content">
			<div class="login_input">
				<input type="text" placeholder="EMAIL" autocomplete="off">
				<input type="password" placeholder="PASSEWORD" autocomplete="off">
				<button class="button_fill">Login</button>
			</div>	
			<div class="divider">
				OR
			</div>
			<div class="social_login">
			<div class="socials">
					<img src="<?php echo get_stylesheet_directory_uri() ?>/assets/facebooklogin.svg" alt="Facebook Login">
				</div>
				<div class="socials">
					<img src="<?php echo get_stylesheet_directory_uri() ?>/assets/applelogin.svg" alt="Apple login">
				</div>
			</div>		
		</div>
		<p>Don't have an account? <span>Sign up here</span></p>
	</div>
</div>


<div
<?php
	echo astra_attr(
		'site',
		array(
			'id'    => 'page',
			'class' => 'hfeed site',
		)
	);
	?>
>
	<?php
	

	astra_content_before();
	?>
	<div id="content" class="site-content">
		<div class="ast-container">
		<?php astra_content_top(); ?>

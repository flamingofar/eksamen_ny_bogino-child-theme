<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Astra
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

?>
<?php astra_content_bottom(); ?>
	</div> <!-- ast-container -->
	</div><!-- #content -->
	</div><!-- #page -->
	
	<footer>
		<div class="footer_info">
		<div class="info_footer">
			<p>CVR: 00000000</p>
			<p>Gothersgade 103 A</p>
			<p>1123, København K</p>
		</div>
		<div class="socia_container">
			<i></i>
			<i></i>
		</div>
		<div class="practical_container">
			<a href="https://malteskjoldager.dk/kea/2.Semester/tema_10_eksamen/bogino/returns-and-replacement/">Return and Replacements</a>

		</div>
		</div>
	</footer>
	<script>
		
		// POPUP HANDLER CART MOBILE
		
		const cart = document.querySelector(".cart_icon")
		const buyBtn = document.querySelector(".buy")
		const seeMoreBtn = document.querySelector(".see_more")
		
		const lukCart = document.querySelector(".luk_cart")
		const cartPopup = document.querySelector(".cart_container")
		const cartPopupOverlay = document.querySelector(".cart_container-overlay")
		lukCart.addEventListener("click", ()=>{
			cartPopup.classList.add("hide")
			cartPopupOverlay.classList.add("hide")
		})
		cart.addEventListener("click", ()=>{
			cartPopup.classList.remove("hide")
			cartPopupOverlay.classList.remove("hide")
		})
		buyBtn.addEventListener("click", ()=>{
			alert("Thanks for buying your own norms")
		})
		seeMoreBtn.addEventListener("click", ()=>{
			location.href = "https://malteskjoldager.dk/kea/2.Semester/tema_10_eksamen/bogino/clothing/"
		})

		// POPUP HANDLER CART DESKTOP
		const deskCart = document.querySelector(".cart_icon-desktop")
		deskCart.addEventListener("click", ()=>{
			console.log("HEEJ")
			cartPopup.classList.remove("hide")
			cartPopupOverlay.classList.remove("hide")
		})
		
		
		// POPUP HANDLER PROFILE MOBILE
		const profileBtn = document.querySelector(".profile_btn")
		const lukProfile = document.querySelector(".luk_profile")
		const loginPopup = document.querySelector(".login_popup")
		const profilePopupOverlay = document.querySelector(".profile_container-overlay")
		
		console.log(profileBtn)

		lukProfile.addEventListener("click", ()=>{
			loginPopup.classList.add("hide")
			profilePopupOverlay.classList.add("hide")
		})
		profileBtn.addEventListener("click", ()=>{
			loginPopup.classList.remove("hide")
			profilePopupOverlay.classList.remove("hide")
		})
		

		// POPUP HANDLER PROFILE
		const deskProfileBtn = document.querySelector(".profile_btn-desktop")
		deskProfileBtn.addEventListener("click", ()=>{
			loginPopup.classList.remove("hide")
			profilePopupOverlay.classList.remove("hide")
		})


		 // Burger menu 
		 const burger = document.querySelector(".burger_knap");
		 const burgerStreg1 = document.querySelector
		 (".burger_knap .streg1");
		 const burgerStreg2 = document.querySelector
		 (".burger_knap .streg2");
		 const burgerStreg3 = document.querySelector
		 (".burger_knap .streg3");
		 const burgerMenu = document.querySelector
		 (".mobile_nav");
        burger.addEventListener("click", ()=>{
            console.log("hej")
			burgerStreg1.classList.toggle("active");
			burgerStreg2.classList.toggle("active");
			burgerStreg3.classList.toggle("active");
			burgerMenu.classList.toggle("hide");
        })
	</script>
<?php 
	astra_body_bottom();    
	wp_footer(); 
?>
	</body>
</html>

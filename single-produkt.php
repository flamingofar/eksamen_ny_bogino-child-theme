<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Astra
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header(); ?>

<?php if ( astra_page_layout() == 'left-sidebar' ) : ?>

	<?php get_sidebar(); ?>

<?php endif ?>
<div class="singleview_container">
			<div class="logo singleview">
                <a href="http://bogino-nyt-til-eksamen.local/" class="logo_desktop"><img src= "<?php echo get_stylesheet_directory_uri() ?>/assets/bogino_logo_v2.svg" alt=""></a>
                <a href="http://bogino-nyt-til-eksamen.local/" class="logo_mobile"><img src= "<?php echo get_stylesheet_directory_uri() ?>/assets/bogino_logo_mobile.svg" alt=""></a>
            </div>

		<div class="single_produkt_container">
			<div class="img_caroussel">

				
			</div>
			<!-- <div class="img_arrow arrow_next">
					<img src="<?php echo get_stylesheet_directory_uri() ?>/assets/arrow.svg" alt="" />
				</div>
				<div class="img_arrow arrow_prev">
					<img src="<?php echo get_stylesheet_directory_uri() ?>/assets/arrow.svg" alt="" />
				</div> -->

			<div class="single_info_container">
				<h2>Bogino Coat</h2>
				<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloribus quod qui nisi officiis expedita commodi ad debitis laboriosam illum, tenetur assumenda corrupti maxime autem aperiam ratione at dignissimos esse! Iste, aspernatur? Recusandae laborum vitae necessitatibus molestias iste, dolore, voluptate earum ex eligendi sunt corrupti. Velit, pariatur adipisci. Ipsam, cum repellat!</p>
				<form action="">
					<div class="size_container">
						<h4>Size</h4>
						<select name="size" id="size">
							<option value="select" selected>Select</option>
						</select>
					</div>
					<div class="colour_container">
						<h4>Colour</h4>
						<h4 id="colour"></h4>
					</div>
					<div class="quantity_container">
						<h4>Quantity</h4>
						<input name="quantity" id="quantity" type="number" value="1">
					</div>
				</form>
				<div class="pris_container">
					<h4 class="pris">---</h4>
				</div>
				<div class="button_container">
					<button class="button_fill">Add to cart</button>
					<button class="button_nofill back">Go Back</button>
				</div>
			</div>
		</div>
		</div>
		<script>
			/** @format */
			const url = "http://bogino-nyt-til-eksamen.local/wp-json/wp/v2/produkt/" + <?php echo get_the_ID() ?>;
			const colourUrl = "http://bogino-nyt-til-eksamen.local/wp-json/wp/v2/produkt/" + <?php echo get_the_ID() ?>;

			let produkt;
			// const images = document.querySelectorAll(".img_caroussel img")
			
			const sizes = document.querySelectorAll("#size")
			
			
			// Rest API Call
			async function loadJSON() {
				const JSONData = await fetch(url);
				produkt = await JSONData.json();
				console.log(produkt)
				vis();
			}

			function vis() {
				const images = produkt.produkt_billede

                document.querySelector(".single_info_container h2").textContent = produkt.titel;
                document.querySelector(".single_info_container p").innerHTML = produkt.beskrivelse;
                document.querySelector(".pris").textContent = `${produkt.pris}kr`;
				document.querySelector(".back").addEventListener("click", () => {history.back();});
				document.querySelector("#colour").textContent =`${produkt.farver}`

				
				console.log(images)
				images.forEach((image, index)=>{
					console.log(image.guid)
					document.querySelector(".img_caroussel").innerHTML +=`<img src="${image.guid}"> `
				})

				opretSelects()
			}
			// ----------- OPRET SELECTS ----------- //
			function opretSelects() {
				let size = produkt.storrelser
				let farver = produkt.farver
				size.forEach(size => {
					document.querySelector("#size").innerHTML +=`<option value="select">${size}</option>`
				})
				// farver.forEach(farve => {
				// 	document.querySelector("#colour").innerHTML +=`<option value = "${farve.toLowerCase()}">${farve}</option>`
				// })
			 }
			
			loadJSON()
			</script>

<?php if ( astra_page_layout() == 'right-sidebar' ) : ?>

	<?php get_sidebar(); ?>

<?php endif ?>

<?php get_footer(); ?>

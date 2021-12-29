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

get_header(); 
?>

<?php if ( astra_page_layout() == 'left-sidebar' ) : ?>

	<?php get_sidebar(); ?>

<?php endif ?>

	<section class="loopview_section">
        <div class="filter_container">
            <div class="logo logo_loopview">
                <a href="http://bogino-nyt-til-eksamen.local/" class="logo_desktop"><img src= "<?php echo get_stylesheet_directory_uri() ?>/assets/bogino_logo_v2.svg" alt=""></a>
                <a href="http://bogino-nyt-til-eksamen.local/" class="logo_mobile"><img src= "<?php echo get_stylesheet_directory_uri() ?>/assets/bogino_logo_mobile.svg" alt=""></a>
            </div>
            <div id="filtrering" class="filtrering">
                <h2>Filter <span class="arrow"></span> </h2>
                <div id="cat-filter">
                <button class="filter_btn valgt_tema" data-cat="Alle"> Alle </button>
                </div>
                
            </div>
        </div>

        <div  class="loopview_container">
            <div id="big_pic" class="img_container">
                <img src="<?php echo get_stylesheet_directory_uri() ?>/assets/bogino_logo.png" alt="">
            </div>
            <div id="loopview" class="loopview">
                 
                
            </div>
            <template>
                 <div class="product_container">
                     <div class="img_container">
                        <img src="<?php echo get_stylesheet_directory_uri() ?>/assets/placeholder.jpg" alt="">
                     </div>
                    <div class="info_container">
                        <h3 class="titel">Bogino Coat</h3>
                        <p class="pris">300€</p>
                        <button>See piece</button>
                    </div>
                 </div>
                </template>
        </div>
    </section>

    <script>
        // Filter Skuffe - MOBILE
        const filterH2 = document.querySelector("#filtrering h2");
        const catFilter = document.querySelector("#cat-filter");

        // Filtre
        let filter = "Alle";
        let filtre = {};

    
        const url = "http://bogino-nyt-til-eksamen.local/wp-json/wp/v2/produkt"
        const categoriesUrl = "http://bogino-nyt-til-eksamen.local/wp-json/wp/v2/kategori"

        const bigPicLoopview = document.querySelector("#big_pic img");

        let dataWP, categories;

        
        filterH2.addEventListener("click", ()=>{
            catFilter.classList.toggle("active")
        })

        //Rest API Call
                async function loadJSON() {
                    // Henter alle produkter
                    const JSONData = await fetch(url);
                    dataWP = await JSONData.json();
                    // Henter alle kategorier
                    const catJSONData = await fetch(categoriesUrl);
                    categories = await catJSONData.json();

                    opretKnapper()
                    console.log(filtre)


                    vis();

                    

                    console.log(dataWP)
                    console.log(categories)
                }

                //Vis alle elementerne
                function vis() {
                    const catFilter = document.querySelector("#cat-filter");

                    const produktTemplate = document.querySelector("template");
                    const container = document.querySelector("#loopview")

                    container.textContent ="";

                    
                    dataWP.forEach((el) => {
                        if (
                        (filter == "Alle" || el.kategorier.includes(filter)) 
                        ) {
                        let klon = produktTemplate.cloneNode(true).content;
                        
                        
                        klon.querySelector(".titel").textContent = el.titel;
                        if(el.produkt_billede) {
                            klon.querySelector("img").src = el.produkt_billede[0].guid;
                        }
                        klon.querySelector(".pris").textContent = `${el.pris} kr.`;

                        klon
                            .querySelector("button")
                            .addEventListener("click", () => {
                            location.href = el.link
                                });
                        // Klikbart billede
                        klon
                            .querySelector(".img_container")
                            .addEventListener("click", () => {
                            location.href = el.link
                                });

                        // JS Hover for billede
                        klon.querySelector(".product_container").addEventListener("mouseenter", (e)=>{
                            bigPicLoopview.src = el.produkt_billede[0].guid;
                        })
                        // klon.querySelector(".product_container").addEventListener("mouseleave", (e)=>{
                        //     bigPicLoopview.src = "<?php echo get_stylesheet_directory_uri() ?>/assets/bogino_logo.png";
                        // })

                        //Appender alle elementerne
                        container.appendChild(klon);
                        
                        
                        }
                    })
                }
                
                // ----------- OPRET KNAPPER ----------- //
        function opretKnapper() {
            categories.forEach((el, index) => {
                // document.querySelector("#cat-filter").innerHTML +=`
                // <button class="filter_btn" data-cat="${el.name}"> ${el.name} </button>`;   
                let indexID = index + 1
                document.querySelector("#cat-filter").innerHTML +=`
                <label class="label_check" for="${indexID}"> ${el.name}
                    <input name="check" type="checkbox" class="filter_check" id="${indexID}" data-filter="${indexID}"></input>
                </label>
                `;
                       
            })
                    filterKnapEvents();
        }
        
        function filterKnapEvents(){
            // const filterBtn = document.querySelectorAll(".filter_btn")
            // filterBtn.forEach(el=>{
            //     el.addEventListener("click", setFilter)
            // })
            
            // EVENTLISTENER OG FYLDE FILTRE OBJECTET MED FILTRE BASERET PÅ KATEGORIERNE
            const filterCheck = document.querySelectorAll(".filter_check")
            filterCheck.forEach((filter, index) => {
                filtre[`filter${categories[index].name}`] = "false";
                

                filter.addEventListener("change", checked)
            })
        }

        function checked() {
            console.log("CHECKED")
            switch(this.dataset.filter) {
                case "1":
                    filtre[0] = this.checked
                    console.log("Filter 1: "+filtre[0])
                    break;
                case "2":
                    filtre[1] = this.checked
                    console.log("Filter 2: "+filtre[1])
                    break;
                case "3":
                    filtre[2] = this.checked
                    console.log("Filter 2: "+filtre[2])
                    break;
                case "4":
                    filtre[3] = this.checked
                    console.log("Filter 2: "+filtre[3])
                    break;
                default:
                    return;
                } 
        }
        
        function setFilter() {
            filter = this.dataset.cat;

            document.querySelectorAll(".filter_btn").forEach(elm => {
                elm.classList.remove("valgt_tema");
            });

        //tilføj .valgt til den valgte
            this.classList.add("valgt_tema");
            
            vis()
        }
        

        
            
            loadJSON();
            
    </script>

<?php if ( astra_page_layout() == 'right-sidebar' ) : ?>

	<?php get_sidebar(); ?>

<?php endif ?>

<?php get_footer(); ?>




<!-- 
    1. Check if checkboxes are checked
        1.1 Change active state
    2. Filter
 -->
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
                <!-- <select>
                    <option value="latest" selected>Latest</option>
                    <option value="pris_ned">Price Acending</option>
                    <option value="pris_op">Price Decending</option>
                </select> -->
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
        let filtre = {};
        let kategoriLabels = [];

        
         

    
        const url = "http://bogino-nyt-til-eksamen.local/wp-json/wp/v2/produkt"
        const categoriesUrl = "http://bogino-nyt-til-eksamen.local/wp-json/wp/v2/kategori"

        const bigPicLoopview = document.querySelector("#big_pic img");
        // const sortSelect = document.querySelector("select");
        // sortSelect.addEventListener("change", ()=>{
        //     console.log(sortSelect.value)
        // })
                        
                        

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

                    opretCheckboxe()
                    getCategories()
                    


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
                        // Objekters version af array[index] => filtre[Object.keys(filtre)[0]])
                        if (
                        (filtre[Object.keys(filtre)[0]] == true && el.kategorier.includes("Accessories")) ||
                        (filtre[Object.keys(filtre)[1]] == true && el.kategorier.includes("Hoodies")) ||
                        (filtre[Object.keys(filtre)[2]] == true && el.kategorier.includes("Outerwear")) ||
                        (filtre[Object.keys(filtre)[3]] == true && el.kategorier.includes("T-shirts")) 
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

                
                
                // ----------- OPRET CHECKBOX ----------- //
        function opretCheckboxe() {
            
            categories.forEach((el, index) => {
                let indexID = index + 1
                document.querySelector("#cat-filter").innerHTML +=`
                <div>
                    <input name="check" type="checkbox" class="filter_check" id="${indexID}" data-filter="${indexID}" ${el.name == "Hoodies" ? "checked" : "" }></input>
                    <label class="label_check" for="${indexID}">${el.name}</label>
                </div>
                `;
                       
            })
                    filterKnapEvents();
        }
        
        function filterKnapEvents(){
            // EVENTLISTENER OG FYLDE FILTRE OBJEKTET MED FILTRE BASERET PÅ KATEGORIERNE
            const filterCheck = document.querySelectorAll(".filter_check")
            filterCheck.forEach((filter, index) => {
                if(filter.dataset.filter==2) {
                    filtre[`filter${categories[1].name}`] = true;
                } else {
                    filtre[`filter${categories[index].name}`] = false;
                }

                

                filter.addEventListener("change", checked)
            })
        }

        function checked() {
            // DYNAMISK
            // Sætter property værdierne i filtre til true eller false efter om checkboxen er checked eller ikke
            filtre[Object.keys(filtre)[`${this.dataset.filter - 1}`]] = this.checked
            console.log(filtre)
            vis()
        }
        
        // SORTÉR
                
        // function sorter() {
        //     console.log("SORTERING")
        //             if (sortSelect.value == "latest") {
        //                 dataWP.sort((a, b) => (a.modified > b.modified ? 1 : -1));
        //                 vis();
        //             } else if(sortSelect.value == "pris_ned"){
        //                 dataWP.sort((a, b) => (a.pris > b.pris ? 1 : -1));
        //                 vis();
        //             } else if(sortSelect.value == "pris_op"){
        //                 dataWP.sort((a, b) => (a.pris > b.pris ? 1 : -1));
        //                 vis();
        //             }
        //         }

        // Henter kategorierne og putter dem i kategoriLabels arrayet
        function getCategories() {
            categories.forEach(el => {
                kategoriLabels.push(el.namespace)
            })
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
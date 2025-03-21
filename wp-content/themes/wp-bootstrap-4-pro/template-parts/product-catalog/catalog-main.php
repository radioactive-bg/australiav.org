<link href="<?php echo get_template_directory_uri();?>/template-parts/product-catalog/assets/css/form.css" rel="stylesheet" />
<link href="<?php echo get_template_directory_uri();?>/template-parts/product-catalog/assets/css/custom.css" rel="stylesheet" />
<main class="d-flex flex-column">
    <section class="header-container container d-flex align-items-center py-0">
    <h1 class="h3 d-none d-lg-inline-block text-end text-white w-100 mb-0">Product List</h1>
    <button type="button" class="btn btn-primary d-inline-flex d-lg-none ml-auto mr-0" data-toggle="modal" data-target="#Modal">Ask for Product</button>
    </section>
    <section class="table-container container d-flex pt-3 pt-lg-4 pb-0">
    <div class="card flex-lg-row w-100 bg-transparent">
        <div class="card-header col-lg-4 col-xl-3 d-flex flex-row flex-wrap align-content-start align-self-start border-0 py-3" style="background-color: transparent">
            <div class="info-cta d-none d-lg-block order-lg-2 mt-lg-3">
                <p class="small mb-0">Didn't find what you're looking for? Send us the product you desire and we will do our best to find it for you.</p>
                <button type="button" class="btn btn-primary btn-sm mt-2" data-toggle="modal" data-target="#Modal">Ask for Product</button>
            </div>
            <div class="table-filters w-100 d-flex flex-wrap align-items-center">
                <label class="ms-0" for="filter-name">Search by:
                <input type="text" class="input-text" id="filter-name" placeholder="Product Name" data-filter-col="0,1"/>
                </label>
                <label for="filter-payment">
                Region:
                <select id="filter-payment" data-filter-col="2">
                    <option value="">- All -</option>
                </select>
                </label>
                <label class="d-none" for="filter-level">
                Memberhsip:
                <select id="filter-level" data-filter-col="4">
                    <option value="">- All -</option>
                    <option value="standart">Standart</option>
                    <option value="gold">Gold</option>
                    <option value="diamond">Diamond</option>
                    <option value="s+">S+</option>
                </select>
                </label>
                <button id="FilterReset" class="btn btn-outline-light btn-sm ml-auto mr-0 mt-1 mt-lg-2">Clear All</button>
            </div>
        </div>
        <div class="card-body col-lg-8 col-xl-9 mb-3 overflow-hidden mb-lg-0" style="overflow-y: hidden;">
            <div class="sticky-table-wappper">
                <div class="table-responsive w-100">
                <table class="sticky-table">
                    <thead>
                        <tr>
                            <td></td>
                            <td>Product name</td>
                            <td>Region</td>
                            <td>Price</td>
                            <td>Ask</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
                </div>
            </div>
            <div class="table-responsive" style="padding-bottom: 3rem;">
                <?php // get_template_part( 'template-parts/product-catalog/catalog', 'table' );?>
                <?php  echo do_shortcode('[sc name="product-catalog-list"]'); ?>
            </div>
        </div>
    </div>
    </section>
</main>
<!-- Modal -->
<!-- Now is getted from admin area -->
<?php //get_template_part( 'template-parts/product-catalog/catalog', 'modal' );?>
<?php get_template_part( 'template-parts/product-catalog/catalog', 'footer' );?>

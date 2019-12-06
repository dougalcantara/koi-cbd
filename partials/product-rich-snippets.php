<?php
   $rs_title = $product->get_title();
   $rs_description = addslashes(strip_tags($product->get_short_description() ? $product->get_short_description() : $product->get_description()));
   $rs_availability = 'https://schema.org/' . ( $product->is_in_stock() ? 'InStock' : 'OutOfStock' );
   $rs_price = $product->get_price();
   $rs_currency = get_woocommerce_currency();
   $rs_sku = $product->get_sku();
   $bottomline = wp_remote_get('https://api.yotpo.com/v1/widget/MS3VY5Cc4TFD6zbI2zGhMsb9gvkPpQDKwUcPhaSG/products/'.$product_id.'/reviews.json');

   if (!is_wp_error($bottomline)) :
    $bottomline_json = json_decode($bottomline['body'])->response->bottomline;
    $first_review = trim(preg_replace('/\s+/', ' ', addslashes(strip_tags(json_decode($bottomline['body'])->response->reviews[0]->content))));
    $first_review_author = json_decode($bottomline['body'])->response->reviews[0]->user->display_name;
    $rs_trimmed_desc = trim(preg_replace('/\s+/', ' ', $rs_description));


    if ($bottomline_json->total_review > 0) {
      $rs = '
        <script type="application/ld+json" class="k-product-rich-snippet">
          {
            "@context": "http://schema.org",
            "@graph": [
              {
                "@type": "Product",
                "name": "'.$rs_title.'",
                "sku": "'.$rs_sku.'",
                "itemCondition": "http://schema.org/NewCondition",
                "description": "'.$rs_trimmed_desc.'",
                "brand": "Koi CBD",
                "image": "'.get_the_post_thumbnail_url($product_id).'",
                "review": {
                  "@type": "Review",
                  "author": "'.$first_review_author.'",
                  "reviewBody": "'.$first_review.'"
                },
                "offers": {
                  "@type": "Offer",
                  "availability": "'.$rs_availability.'",
                  "price": "'.$rs_price.'",
                  "url": "'.$_SERVER['REQUEST_URI'].'",
                  "priceCurrency": "'.$rs_currency.'"
                },
                "aggregateRating": {
                  "@type": "AggregateRating",
                  "ratingValue": "'.$bottomline_json->average_score.'",
                  "reviewCount": "'.$bottomline_json->total_review.'"
                }
              }
            ]
          }
        </script>
      ';

      echo $rs;
    } else {
      $rs = '
        <script type="application/ld+json" class="k-product-rich-snippet">
          {
            "@context": "http://schema.org",
            "@graph": [
              {
                "@type": "Product",
                "name": "'.$rs_title.'",
                "sku": "'.$rs_sku.'",
                "itemCondition": "http://schema.org/NewCondition",
                "description": "'.$rs_trimmed_desc.'",
                "brand": "Koi CBD",
                "image": "'.get_the_post_thumbnail_url($product_id).'",
                "offers": {
                  "@type": "Offer",
                  "availability": "'.$rs_availability.'",
                  "price": "'.$rs_price.'",
                  "url": "'.$_SERVER['REQUEST_URI'].'",
                  "priceCurrency": "'.$rs_currency.'"
                }
              }
            ]
          }
        </script>
      ';

      echo $rs;
    }
    
  endif;
?>

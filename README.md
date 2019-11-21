# Koi CBD Wordpress Site

## First thing's first &mdash; Launch Day Checklist:
For the developer:
Before launch, perform the following:
1) Create a restore point for the Production env inside of WPEngine
2) Check to make sure all ACF declarations match between Production & Staging envs
3) Check to make sure all latest KOI2019 theme files are present in the Production env
   - Can get the latest from the `master` branch on GitHub is this is not the case
4) Check that the following pages exist inside of the Production env admin: (note &mdash; these pages need to be assigned templates once the theme has been switched, see [Template Map](#template-map))
   - Homepage
   - About Us
   - Contact
   - Account
   - Login
   - Cart
   - Checkout
   - Order Received
   - Blog Listing
   -  “All Products” page
   - Individual Product Categories
   - Lab results
   - CBD 101
   - Find My CBD Product
   - Location Finder
   - Veteran Program
   - Utility pages

For actual launch:
1) Swap theme from Divi Child Theme -> KOI2019
2) Deactivate both Divi plugins ("Divi Blog Extras" & "Divi Ultimate Blog Plugin")
3) Deactivate "WooCommerce Product Bundles - Min/Max Items" plugin


6) Remove meta no-index tag from `header.php`

For the content team:
1) Update site "Reading" settings (Settings -> Reading) to point the the "Homepage" option at the Homepage template that we made
2) Update "Merchandise" category `slug` from "hats" to "merchandise" (lowercase)
3) Remove the following redirects (may need to do this in both Redirection and Yoast settings):
   - /about-koi-cbd
   - /cbd-vape

## Template Map
Homepage - `home.php` - Template Name: 2019 Homepage
  - Gets its data from Site Content -> Homepage, so no ACF tied to this template
  - To set it as the homepage template, make sure the page is created in WP, set its template as 2019 Homepage, then update Settings -> Reading to point at this template.

About Us - `page-aboutus.php`
  - Gets its data from Site Content -> About Us, no ACF tied to this template either

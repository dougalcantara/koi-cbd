# Koi CBD Wordpress Site

## First thing's first &mdash; Launch Day Checklist:

> For the developer:
> Before launch, perform the following:

1. Create a restore point for the Production env inside of WPEngine
2. Check to make sure all ACF declarations match between Production & Staging envs
3. `rm -rf node_modules` in theme
4. Check to make sure all latest KOI2019 theme files are present in the Production env
   - Can get the latest from the `master` branch on GitHub is this is not the case
5. Sync up the uploads directory to the live site
6. Check that the following pages exist inside of the Production env admin: (note &mdash; these pages need to be assigned templates once the theme has been switched, see [Template Guide](#template-guide))
   - Homepage
   - About Us
   - Contact
   - Account
   - Login
   - Cart
   - Checkout
   - Order Received
   - Blog Listing
   - “All Products” page
   - Individual Product Categories
   - Lab results
   - CBD 101
   - Find My CBD Product
   - Location Finder
   - Veteran Program
   - Utility pages

For actual launch:

1. Swap theme from Divi Child Theme -> KOI2019
2. Deactivate both Divi plugins ("Divi Blog Extras" & "Divi Ultimate Blog Plugin")
3. Deactivate "WooCommerce Product Bundles - Min/Max Items" plugin
4. Update site "Reading" settings (Settings -> Reading) to point the the "Homepage" option at the Homepage template that we made
5. Update "Merchandise" category `slug` from "hats" to "merchandise" (lowercase)
6. Remove the following redirects (may need to do this in both Redirection and Yoast settings):
   - /about-koi-cbd
   - /cbd-vape
7. Remove meta no-index tag from `header.php`
8. Run legacy-veterans migrate script

## Template Guide

> I'm listing these templates here as if you were setting up this site from scratch. Luckily most, if not all of these pages have already been created in Koi's production env.

There are a LOT of templates for this site. Most need to be created as individual pages so that we have control over the Permalink and scoped ACF fields.

If any page is acting funky, or you can't figure out why a page isn't doing what it's supposed to, check here first.

**Homepage** - `home.php` - Template Name: 2019 Homepage

- Gets its data from Site Content -> Homepage
- To set it as the homepage template, make sure the page is created in WP, set its template as 2019 Homepage, then update Settings -> Reading to point at this template for the homepage.

**About Us** - `page-aboutus.php` - Template Name: 2019 About Us Page

- Gets its data from Site Content -> About Us

**Contact** - `templates/contact.php` - Template Name: 2019 Contact Page

- Has ACF Fields for its content

**Account** - `templates/my-account.php` - Template Name: 2019 Account Page

- This page already exists as part of current Divi theme. It's the one with the post ID of `62`. Just swap the template from the one that's there to this template.

**Account Login** - `templates/my-account-login.php` - Template Name: 2019 Account Login Page

- This page already exists as part of current Divi theme. Post ID = `31283`. Swap that template to this one.

**Cart** - `templates/cart.php` - Template Name: 2019 Cart Page

- This page already exists as part of current Divi theme. Post ID = `50`. Swap that template to this one.
- has ACF fields
- Automatically applies veteran discount if applicable

**Checkout** - `page-checkout.php` - Template Name: 2019 Checkout Page

- This page already exists as part of current Divi theme. Post ID = `51`. Swap that template for this one.
- Automatically applies veteran discount if applicable

**Thank You/Order Received** - `templates/thank-you.php` - Template Name: 2019 Thank You Page

- Displays latest order. Must be a page so that the user can land here after an order is complete.

**Blog Listing** - `templates/blog-listing.php` - Template Name: 2019 Blog Listing Template

- Lists all blog posts by default, then can filter down based on blog category

**Product Listing/All Products** - `templates/all-products.php` - Template Name: 2019 All Products Page

- This finds ALL product categories, loops through them, and provides links into each category's individual listing page. That template is listed below.

**Individual Product Categories** - `templates/archive-product.php` - Template Name: 2019 Product Listing Page

- Each product category will need its own page in WP, for instance, "CBD Edibles" will need to be created if it is not already.
- When the page is created, and this template is selected in the page admin, the custom fields will load. You will need to select the category that this page is responsible for from the list of the categories available.
- The list is just an ACF radio group of the categories available in the admin.

**Lab Results** - `templates/lab-results.php` - Template Name: 2019 Lab Results Page

- This page already exists as part of current Divi theme. Post ID = `87545`. Swap that template for this one.

**CBD 101** - `templates/cbd-101.php` - Template Name: 2019 CBD 101 Landing Page

- This is basically the blog listing page except it gets its own special treatment. Think of this like a blog listing that only shows one category.

**Store Finder** - `templates/location-finder` - Template Name: 2019 Location Finder Page

- This page already exists as part of current Divi theme. Post ID = `30030`. Swap that template for this one.

**Veteran Program** - `templates/veteran-signup.php` - Template Name: 2019 Veteran Signup Page

- Has a HubSpot form that creates a veteran user in WP after the user's `military_id` contact prop is set in HubSpot. Once the Koi team reviews that user's paperwork/id, they will switch that user's `veteran_program` to either "Veteran Program Approved" or "Veteran Program Denied".

## Launch Issues

- uploads directory missing items
- redirects not clear
- there is no no-index meta tag

##TODO:

1. Account Reset Page
2. Veterans: Exisiting Veterans need a status check which is different to ACF field
3. Product category slugs must be correct
4. Remove 'Magnetic' from all page titles
5. Yoast update settings on staging & prod
6. Check Lab results match correctly
7. Confirm /store-finder works perfectly

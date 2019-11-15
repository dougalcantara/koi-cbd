<?php 
/* Template Name: 2019 Utility Page */

get_header();
?>

<section class="k-block k-block--md">
  <div class="k-inner k-inner--sm">
  <?php while(have_posts()) : the_post(); ?>
<?php the_content();?>
<?php endwhile; ?>
  </div>
</section>

<?php get_footer(); ?>
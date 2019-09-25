<?php
get_header();

do_action('k_before_first_section');

$hero_fields = array(
  'preheading' => 'Experience The',
  'headline' => get_the_title(),
  'body' => '<p>New products, balanced lives, and CBD in the news. Find it all and more on our blog.</p>',
);

echo k_hero($hero_fields);
?>

<section class="k-block k-block--md">
  <div class="k-inner k-inner--xl">
    
    <aside class="k-sidebar">
      <div class="k-sidebar--content">

      </div>
    </aside>

    <article class="k-article">
      <div class="k-article--content">
        <?php echo $post->post_content; ?>
      </div>
    </article>

  </div>
</section>

<?php
get_footer();
?>

<?php

function blogJSON() {

  $root = get_template_directory_uri();
  global $post;
  $blogHeadline = get_the_title();
  $blogLink = get_the_permalink();
  $blogHero = get_the_post_thumbnail_url();
  $blogPubDate = get_the_date();
  $blogModDate = the_modified_date();
  $author_id = $post->post_author;
  $blogAuthor = get_the_author_meta('display_name', $author_id);
  $blogLogo = $root.'/dist/img/koi-logo-main@2x.png';
  $blogExcerpt = get_the_excerpt();

  $blogSchema = [
    '@context'=> 'https://schema.org',
    '@type' => 'NewsArticle',
    'mainEntityOfPage' => [
      '@type' => 'WebPage',
      '@id' => $blogLink,
      ],
    'headline' => $blogHeadline,
    'image' => $blogHero,
    'datePublished' => $blogPubDate,
    'dateModified' => $blogModDate,
    'author' => [
      '@type' => 'Person',
      'name' => $blogAuthor,
      ],
    'publisher' => [
      '@type' => 'Organization',
      'name' => 'Koi CBD',
      'logo' => [
        '@type' => 'ImageObject',
        'url' => $blogLogo,
        ],
      ],
    'description' => $blogExcerpt,
    ];
  echo "<script type='application/ld+json'>".json_encode($blogSchema)."</script>";
};
blogJSON();

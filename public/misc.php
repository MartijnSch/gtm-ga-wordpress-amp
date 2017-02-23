<?php
  /**
   * Return the content length in buckets for a post.
   *
   * @since 1.0.0
   */
  function get_content_length_bucket() {
  	global $post;
    $words = str_word_count($post->post_content);

    if ($words > 3000) {
        return '3k+';
    } elseif ($words > 2500) {
        return '2.5k-3k';
    } elseif ($words > 2000) {
        return '2k-2.5k';
    } elseif ($words > 1500) {
        return '1.5k-2k';
    } elseif ($words > 1000) {
        return '1k-1.5k';
    } elseif ($words > 750) {
        return '750-1k';
    } elseif ($words > 500) {
        return '500-750';
    } elseif ($words > 250) {
        return '250-500';
    } else {
        return '<250';
    }
  }

  /**
   * Return the tags for a post.
   *
   * @since 1.0.0
   */
  function get_post_tags() {
    global $post;

    $tags = [];
    foreach (wp_get_post_tags($post->ID) as $tag) {
        $tags[] = $tag->name;
    }
    $tags = implode(',', $tags);

    return $tags;
  }

  /**
   * Return the author for a post.
   *
   * @since 1.0.0
   */
  function get_post_author() {
    global $post;

    $WP_User = get_userdata($post->post_author);
    $author = '';
    if(is_a($WP_User, 'WP_User')) {
      $author = $WP_User->display_name;
    }

    return $author;
  }

  /**
   * Return the categories for a post.
   *
   * @since 1.0.0
   */
  function get_post_categories() {
    global $post;

    $categories = get_the_category($post->ID);
    $categories_post = [];
    foreach ($categories as $category) {
        $categories_post[] = $category->name;
    }
    $categories_post = implode(',', $categories_post);

    return $categories_post;
  }
?>
<?php

class SiteController extends ChesterBaseController {
  
  public function showPostPreviews() {
    $posts = ChesterWPCoreDataHelpers::getWordpressPostsFromLoop();
    echo $this->renderPage('post_previews', array(
      'posts' => $posts,
      'next_posts_link' => get_next_posts_link(),
      'previous_posts_link' => get_previous_posts_link()
    ));
  }
  
  public function showPost() {
    $posts = ChesterWPCoreDataHelpers::getWordpressPostsFromLoop();
    if (isset($posts[0])) {
      echo $this->renderPage('post', array(
        'post' => $posts[0]
      ));
    }
  }
  
  
}

?>
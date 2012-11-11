<?php

class SiteController extends ChesterBaseController {
  
  public function showPostPreviews() {
    $posts = ChesterWPCoreDataHelpers::getWordpressPostsFromLoop();
    
    $contentBlock1 = $this->render('post_previews', array(
      'posts' => $posts,
      'next_posts_link' => get_next_posts_link(),
      'previous_posts_link' => get_previous_posts_link()
    ));
    
    $contentBlock2 = $this->render('sidebar');
    
    echo $this->renderPage('grid_two_column', array(
      'contentBlock1' => $contentBlock1,
      'contentBlock2' => $contentBlock2
    ));
    
  }
  
  public function showPost() {
    $posts = ChesterWPCoreDataHelpers::getWordpressPostsFromLoop();
    if (isset($posts[0])) {
      $contentBlock1 = $this->render('post', array(
        'post' => $posts[0]
      ));
      
      $contentBlock2 = $this->render('sidebar');
      
      echo $this->renderPage('grid_two_column', array(
        'contentBlock1' => $contentBlock1,
        'contentBlock2' => $contentBlock2
      ));
    }
  }
  
  public function showGalleries() {
    $posts = ChesterWPCoreDataHelpers::getWordpressPostsFromLoop(false, array('location', 'map', 'website'), true);

    $contentBlock1 = $this->render('galleries', array(
      'posts' => $posts
    ));
      
    $contentBlock2 = $this->render('sidebar');
    
    echo $this->renderPage('grid_two_column', array(
      'contentBlock1' => $contentBlock1,
      'contentBlock2' => $contentBlock2
    ));    
  }
}
?>
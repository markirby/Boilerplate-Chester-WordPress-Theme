<?php

class SiteController extends ChesterBaseController {
  
  public function showPostPreviews() {
    $posts = ChesterWPCoreDataHelpers::getWordpressPostsFromLoop();
    
    $content_block_1 = $this->render('post_previews', array(
      'posts' => $posts,
      'next_posts_link' => get_next_posts_link(),
      'previous_posts_link' => get_previous_posts_link()
    ));
    
    $content_block_2 = $this->render('sidebar');
    
    echo $this->renderPage('grids/grid_two_column', array(
      'content_block_1' => $content_block_1,
      'content_block_2' => $content_block_2
    ));
    
  }
  
  public function showPost() {
    $posts = ChesterWPCoreDataHelpers::getWordpressPostsFromLoop();
    if (isset($posts[0])) {
      $content_block_1 = $this->render('post', array(
        'post' => $posts[0]
      ));
      
      $content_block_2 = $this->render('sidebar');
      
      echo $this->renderPage('grids/grid_two_column', array(
        'content_block_1' => $content_block_1,
        'content_block_2' => $content_block_2
      ));
    }
  }
  
  public function showGalleries() {
    $posts = ChesterWPCoreDataHelpers::getWordpressPostsFromLoop(false, array('location', 'map', 'website'), true);

    $content_block_1 = $this->render('galleries', array(
      'posts' => $posts
    ));
      
    $content_block_2 = $this->render('sidebar');
    
    echo $this->renderPage('grids/grid_two_column', array(
      'content_block_1' => $content_block_1,
      'content_block_2' => $content_block_2
    ));    
  }
  
  public function showHome() {
    $posts = ChesterWPCoreDataHelpers::getWordpressPostsFromLoop();
    
    $content_block_1 = $this->render('post_previews', array(
      'posts' => $posts,
      'next_posts_link' => get_next_posts_link(),
      'previous_posts_link' => get_previous_posts_link()
    ));
        
    $latestGallery = $this->render('galleries', array(
      'posts' => ChesterWPCoreDataHelpers::getPosts(false, 'gallery', '1', array('location', 'map', 'website'))
    ));
    
    echo $this->renderPage('grids/grid_two_column', array(
      'content_block_1' => $content_block_1,
      'content_block_2' => $latestGallery
    ));
  }

  public function showPatternPrimer() {
    $patternPrimerController = new ChesterPatternPrimerController();
    
    $post = $patternPrimerController->renderPattern('post', array(
      'post' => array(
        'permalink' => 'http://brightonculture.co.uk',
        'title' => 'Post title',
        'time' => '12th Nov 2012',
        'content' => '<p>Sample content</p>',
      )
    ));
    
    $postPreview = $patternPrimerController->renderPattern('post_previews', array(
      'posts' => array(
        'permalink' => 'http://brightonculture.co.uk',
        'title' => 'Post preview title',
        'time' => '12th Nov 2012',
        'content' => '<p>Sample content</p>',
      )
    ));
    
    $patternGroup = $patternPrimerController->renderCustomPatternGroup($post . $postPreview, 'modules/');
    
    $patternPrimerController->showPatternPrimer(array('typography', 'grids'), $patternGroup);
  }
}
?>
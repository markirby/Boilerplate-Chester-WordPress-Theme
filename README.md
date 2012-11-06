# Boilerplate Chester WordPress Theme Tutorial

This tutorial explains how to create the boilerplate theme at https://github.com/markirby/Boilerplate-Chester-WordPress-Theme. 

It was designed to teach you how to easily create well structured responsive MVC WordPress themes using the Chester framework. You can also use the boilerplate as a good starting point for your themes.

If you follow the tutorial you will end up with the code available in the repository, so there is no need to clone the repo unless you want to skip ahead.

## Setup and install

### Set up a new theme

[Download and install WordPress](http://codex.wordpress.org/Installing_WordPress), preferably with at least one sample post and page set. The more posts you have the better you can test the site, so you could create a few example posts or use an existing site.

Create a new theme folder ready to begin.

	cd {wordpress folder}
	mkdir wp-content/themes/{wordpress theme name}

### Install Chester

Install Chester into a subfolder named Chester within a folder named lib. You could choose a different name, but we recommend lib as its a good standard.
	
	cd {wordpress folder}/wp-content/themes/{wordpress theme name}
	git clone git@github.com:markirby/Chester-WordPress-MVC-Theme-Framework.git lib/Chester
	
You could also add it as a submodule

	git submodule add git@github.com:markirby/Chester-WordPress-MVC-Theme-Framework.git lib/Chester
	
To read more about Chester, checkout the full documentation at http://markirby.github.com/Chester-WordPress-MVC-Theme-Framework/. This tutorial will cover most areas though.

### Load Chester using the functions.php file

Create a functions.php file

	touch functions.php
	
Inside this file, load the reference to Chester/require.php. This file will in turn load all the other core Chester files, setting up the framework for easy access.

	<?php 
	require_once(dirname(__FILE__).'/lib/chester/require.php');
	?>
	
### Create the style.css theme file

Create a style.css file.

	touch style.css
	
Add the details of your theme. We don't recommend adding the actual CSS here, we will instead set up some mobile first stylesheets that will work in IE6-9.

	/*
	Theme Name: Boilerplate Chester WordPress theme
	Theme URI: http://markirby.github.com/Boilerplate-Chester-WordPress-Theme/
	Description: A starting point for a MVC Chester theme
	Author: @markirby
	Version: 1.0

	For customization, please replace the above
	*/
	
### Create the basic template, index.php

Create an empty index.php file

	touch index.php
	
### Install the theme

Now you are ready to install the theme and start building real templates. Jump into http://[SITENAME]/wp-admin/themes.php and select the Boilerplate theme.

### Setup the folder structure for our controllers and templates

Chester requires certain conventions to be followed, one being the location of the controllers and templates.

We will create the default file structure
	
	mkdir mvc
	mkdir mvc/controllers
	mkdir mvc/templates

## Setup header and footer templates

We are going to take advantage of Chester's automagic loading of some common mustache templates.

### header.mustache

header.mustache is loaded first, so we will take some concepts from [HTML5Boilerplate](https://github.com/h5bp/html5-boilerplate/blob/v4.0.1/doc/html.md) and create some good practice features.

	touch mvc/templates/header.mustache

The fields provided by Chester automatically to the header template that we will use are:

* blog_title - the page/post title and blog title
* charset - charset for the site
* template_directory - directory of the template root, used to load favicons, css, js etc

The rest are documented at http://markirby.github.com/Chester-WordPress-MVC-Theme-Framework

I'm going to add some conditional comments to identify versions of IE used, and set up the no-js default ready for when we load modernizr which will turn it to js, if js is supported.

	<!DOCTYPE html>
	<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7 ie6"> <![endif]-->
	<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8 ie7"> <![endif]-->
	<!--[if IE 8]>         <html class="no-js lt-ie9 ie8"> <![endif]-->
	<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->

Here we load some more defaults, and output the title (which could contain html, hence the triple mustache)

	  <head>
	    <title>{{{blog_title}}}</title>
    
	    <meta charset="{{charset}}" />
	    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	    <meta name="viewport" content="width=device-width">

Favicons won't be picked up automatically from the theme by wordpress, so we specify each one, along with a template_directory variable which will contain the path to the template folder.

	    <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
	    <!-- favicons -->
	    <link rel="shortcut icon" href="{{template_directory}}/favicon.ico" />
	    <!-- For third-generation iPad with high-resolution Retina display: -->
	    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{template_directory}}/apple-touch-icon-144x144-precomposed.png">
	    <!-- For iPhone with high-resolution Retina display: -->
	    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{template_directory}}/apple-touch-icon-114x114-precomposed.png">
	    <!-- For first- and second-generation iPad: -->
	    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{template_directory}}/apple-touch-icon-72x72-precomposed.png">
	    <!-- For non-Retina iPhone, iPod Touch, and Android 2.1+ devices: -->
	    <link rel="apple-touch-icon-precomposed" href="{{template_directory}}/apple-touch-icon-precomposed.png">

The stylesheets section comes next, with some settings that allow a responsive, mobile first site, which works on IE7+.

The technique below requires you have 3 stylesheets, one for the mobile first styles called global.css, then one for each further breakpoint, I've used layout-breakpoint1.css and layout-breakpoint2.css. The technique is described in more detail over at http://adactio.com/journal/4494/.

For users of IE6 we link to the universal-ie6-css created by Andy Clarke, which presents a clean linearised view for IE6 users.

		  <!-- stylesheets -->

		  <!--[if ! lte IE 6]><!-->
		    <link rel="stylesheet" href="{{template_directory}}/css/global.css">
		  <!--<![endif]-->
		  <!--[if lte IE 6]>
		    <link rel="stylesheet" href="http://universal-ie6-css.googlecode.com/files/ie6.0.3.css" media="screen, projection">
		  <![endif]-->

		  <link rel="stylesheet" href="{{template_directory}}/css/layout-breakpoint1.css" media="all and (min-width: 30.625em)">
		  <link rel="stylesheet" href="{{template_directory}}/css/layout-breakpoint2.css" media="all and (min-width: 35em)">

		  <!--[if (! lte IE 6)&(lt IE 9)&(!IEMobile)]>
		    <link rel="stylesheet" href="{{template_directory}}/css/layout-breakpoint1.css" media="all">
		    <link rel="stylesheet" href="{{template_directory}}/css/layout-breakpoint2.css" media="all">
		  <![endif]-->
		
### header_close.mustache

We need to have the end of the header in a separate file due to the fact Chester needs to call wp_head() which echos out the content. There is no way of getting the wp_head data returned as a string, so we have to unfortunately load the two separate files.

All we are doing in our header_close is closing some tags and dropping in an IE upgrade notice for users of IE6.

	touch mvc/templates/header_close.mustache
	
Here is the content:

		</head>
	<body>
	  <!--[if lt IE 7]>
	      <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
	  <![endif]-->

### site_title.mustache and site_title_on_home.mustache

A best practice for good HTML structure and SEO is to have the site title inside an H1 on the homepage, but for other pages to have their main title (e.g. section title, page title, post title) as the H1. Chester allows you to specify two templates, site_title_on_home.mustache which will only be loaded if the user is on the home page, and site_title.mustache for everywhere else.

	touch mvc/templates/site_title.mustache
	touch mvc/templates/site_title_on_home.mustache
	

The fields provided by Chester automatically to the site title templates that we will use are:

* blog_name - the sites name
	
The code for site_title.mustache uses a p tag with a class so it can be styled in the same way as the h1:

	<p class="site-title"><a href="/">{{blog_name}}</a></p>

The code for site_title_on_home.mustache uses an h1 tag:

	<h1 class="site-title">{{blog_name}}</h1>

### footer.mustache

Chester automatically echos the wp_footer() command, and then we just need to load the mustache template to close off the site.

	touch mvc/templates/footer.mustache

Just a couple of closing tags needed:

	    </body>
	</html>

## Create a controller to show post previews or a post

To keep things simple we are going to create a single controller, SiteController, from which we will load data and templates to show a post, or an archive of posts. This controller can then be loaded from the various WordPress templates, which handles the routing for us.

### Setting up the Controller

Lets create the controller class.

	touch mvc/controllers/site_controller.php

The controller must extend ChesterBaseController so we can access the mustache templates.

	<?php

	class SiteController extends ChesterBaseController {


	}

	?>
	
### Add the showPostPreviews function 
	
Then inside the class we will create our function showPostPreviews.

We are fetching the post data using getWordpressPostsFromLoop(), documented over at http://markirby.github.com/Chester-WordPress-MVC-Theme-Framework/#chesterwpcoredatahelpers-wp_core_data_helpers-php/getwordpresspostsfromloop-dateformat-false

Then we render the template post_previews.mustache (which we will make next), passing in the fields posts, next_posts_link and previous_posts_link which we are creating ourselves using template tags.

	public function showPostPreviews() {

	  $posts = ChesterWPCoreDataHelpers::getWordpressPostsFromLoop();
		
		//we echo out the results of the renderPage function which outputs the content along with the header and footer
	  echo $this->renderPage('post_previews', array(
	    'posts' => $posts,
	    'next_posts_link' => get_next_posts_link(),
	    'previous_posts_link' => get_previous_posts_link()
	  ));
	}

### Create the post_previews mustache template

To display the data gathered by the previous post we need to create a template.

	touch mvc/templates/post_previews.mustache

We will then output the fields from each post, using the syntax {{#posts}} {{/posts}} to create a loop of each item found in the posts array, and then referencing the various fields from the getWordpressPostsFromLoop function.

	{{#posts}}
		<h2><a href="{{permalink}}">{{{title}}}</a></h2>
		<p>{{time}}</p>
		{{{excerpt}}}
	{{/posts}}
	
To finish off, we will use the syntax {{#next_posts_link}} {{/next_posts_link}} to show the next_posts_link only if it was found. Its slightly confusing having this syntax both loop and provide an if statement, but thats just the way mustache is. Once you get used to it, its not too challenging.

	<ul>
		{{#next_posts_link}}<li>{{{next_posts_link}}}</li>{{/next_posts_link}}
		{{#previous_posts_link}}<li>{{{previous_posts_link}}}</li>{{/previous_posts_link}}
	</ul>

### Set up index.php to load our post previews

All we need to do to load that basic code is to set up our default file, index.php.

	<?php
	//require the site controller we just created
	require_once(dirname(__FILE__).'/mvc/controllers/site_controller.php');
	
	//init the site controller
	$siteController = new SiteController();
	
	//call the showPostPreviews function
	$siteController->showPostPreviews();
  
	?>
	
Load the homepage of your site, and you will see the post previews.

### Create the single post function, template and page

Add a function to site_controller.php, this is like the first, but checks if a single post is found, and if it is, renders just that one with the field post.

	public function showPost() {
	  $posts = ChesterWPCoreDataHelpers::getWordpressPostsFromLoop();
	  if (isset($posts[0])) {
	    echo $this->renderPage('post', array(
	      'post' => $posts[0]
	    ));
	  }
	}

Create a new mustache template to display the post.

	touch mvc/templates/post.mustache

This time we will output the content instead of the excerpt, and only render a post if one is provided.

	{{#post}}
		<h1><a href="{{permalink}}">{{{title}}}</a></h1>
		<p>{{time}}</p>
		{{{content}}}
	{{/post}}
	
Create the WordPress template single.php to handle the routing.

	touch single.php
	
Then its much the same as the index.php

	<?php

	require_once(dirname(__FILE__).'/mvc/controllers/site_controller.php');

	$siteController = new SiteController();
	$siteController->showPost();
  
	?>
	
Now when you select an item in the archive the post will be displayed.

## Add tags to the boilerplate

Now we are going to add support for tags, providing a way of displaying tags in posts and post previews, and creating an archive for each tag.

Add some tags to your sample posts before we begin.

### Create a subtemplate to render tags consistently on both posts and previews

We are going to use the same html to display tags on both posts and previews. To do this we can create a template called tags, which we will include from the other templates.

	touch mvc/templates/tags.mustache

Here is the code to add. Note we use the {{has_tags}} provided by Chester to show if we have tags or not. This is documented along with all the other available variables in the [http://markirby.github.com/Chester-WordPress-MVC-Theme-Framework/#chesterwpcoredatahelpers-wp_core_data_helpers-php/getwordpresspostsfromloop-dateformat-false](Chester documentation).

	{{#has_tags}}
		<ul>
			{{#the_tags}}
			<li><a href="{{tag_link}}">{{name}}</a></li>
			{{/the_tags}}
		</ul>
	{{/has_tags}}
	
### Include the subtemplate in posts and post_previews

Using the {{> tags}} syntax we can include the tags.mustache file in our other templates.

Update post.mustache to look like the following:

	{{#post}}
		<h1><a href="{{permalink}}">{{{title}}}</a></h1>
		<p>{{time}}</p>
		{{{content}}}
		{{> tags}}
	{{/post}}

Update post_previews.mustache to look like the following:

	{{#posts}}
		<h2><a href="{{permalink}}">{{{title}}}</a></h2>
		<p>{{time}}</p>
		{{{excerpt}}}
		{{> tags}}
	{{/posts}}
	<ul>
		{{#next_posts_link}}<li>{{{next_posts_link}}}</li>{{/next_posts_link}}
		{{#previous_posts_link}}<li>{{{previous_posts_link}}}</li>{{/previous_posts_link}}
	</ul>

View your site, and you should see the tags in both places. Click on a tag to see that tags archive, rendered using the post_previews template.

## Add categories to the boilerplate

We are going to add categories in a similar way. First set your sample posts to some categories.

### Create a subtemplate to render categories consistently on both posts and previews

	touch mvc/templates/categories.mustache
	
Add the following:

	{{#has_categories}}
		<ul>
			{{#the_categories}}
			<li><a href="{{category_link}}">{{name}}</a></li>
			{{/the_categories}}
		</ul>
	{{/has_categories}}
	
### Include the subtemplate in posts and post_previews

Update post.mustache to look like the following:

	{{#post}}
		<h1><a href="{{permalink}}">{{{title}}}</a></h1>
		<p>{{time}}</p>
		{{{content}}}
		{{> tags}}
		{{> categories}}
	{{/post}}

Update post_previews.mustache to look like the following:

	{{#posts}}
		<h2><a href="{{permalink}}">{{{title}}}</a></h2>
		<p>{{time}}</p>
		{{{excerpt}}}
		{{> tags}}
		{{> categories}}
	{{/posts}}
	<ul>
		{{#next_posts_link}}<li>{{{next_posts_link}}}</li>{{/next_posts_link}}
		{{#previous_posts_link}}<li>{{{previous_posts_link}}}</li>{{/previous_posts_link}}
	</ul>

Now reload and click on a category to explore those.
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
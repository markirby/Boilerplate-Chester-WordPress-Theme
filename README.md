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

I'm going to add some conditional comments to identify versions of IE used, and set up the no-js default ready for when we load modernizr which will turn it to js, if js is supported.

	<!DOCTYPE html>
	<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7 ie6"> <![endif]-->
	<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8 ie7"> <![endif]-->
	<!--[if IE 8]>         <html class="no-js lt-ie9 ie8"> <![endif]-->
	<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->

Here we load some more defaults, and output the title (which could contain html, hence the triple mustache)

	  <head>
	    <title>{{{title}}}</title>
    
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

		  <!-- stylesheets -->

		  <!--[if ! lte IE 6]><!-->
		    <link rel="stylesheet" href="{{template_directory}}/css/global.css">
		  <!--<![endif]-->
		  <!--[if lte IE 6]>
		    <link rel="stylesheet" href="http://universal-ie6-css.googlecode.com/files/ie6.0.3.css" media="screen, projection">
		  <![endif]-->

		  <link rel="stylesheet" href="{{template_directory}}/css/layout-breakpoint1.css" media="all and (min-width: 30.625em)">
		  <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/layout-breakpoint2.css" media="all and (min-width: 35em)">

		  <!--[if (! lte IE 6)&(lt IE 9)&(!IEMobile)]>
		    <link rel="stylesheet" href="{{template_directory}}/css/layout-breakpoint1.css" media="all">
		    <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/layout-breakpoint2.css" media="all">
		  <![endif]-->
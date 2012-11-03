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

## Setup header and footer templates



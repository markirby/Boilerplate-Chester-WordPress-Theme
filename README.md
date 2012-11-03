# Boilerplate Chester WordPress Theme Tutorial

This tutorial explains how to create the boilerplate theme at https://github.com/markirby/Boilerplate-Chester-WordPress-Theme. 

It was designed to teach you how to easily create well structured MVC WordPress themes using the Chester framework. You can also use the boilerplate as a good starting point for your themes.

If you follow the tutorial you will end up with the code available in the repository, so there is no need to clone the repo unless you want to skip ahead.

## Set up a new theme

[Download and install WordPress](http://codex.wordpress.org/Installing_WordPress), preferably with at least one sample post and page set. The more posts you have the better you can test the site, so you could create a few example posts or use an existing site.

Create a new theme folder ready to begin.

	cd {wordpress folder}
	mkdir wp-content/themes/{wordpress theme name}

## Install Chester

Install Chester into a subfolder named Chester within a folder named lib. You could choose a different name, but we recommend lib as its a good standard.
	
	cd {wordpress folder}/wp-content/themes/{wordpress theme name}
	git clone git@github.com:markirby/Chester-WordPress-MVC-Theme-Framework.git lib/Chester
	
You could also add it as a submodule

	git submodule add git@github.com:markirby/Chester-WordPress-MVC-Theme-Framework.git lib/Chester
	
To read more about Chester, checkout the full documentation at http://markirby.github.com/Chester-WordPress-MVC-Theme-Framework/. This tutorial will cover most areas though.
==== LcTags ====
Contributors: Celine Mornet
Donate link: http://www.lutincapuche.com/
Tags: widget, posts, formatting, tags, tag cloud,tagcloud
Requires at least: 2.3
Tested up to: 2.3
Stable tag: 1.0.1

LcTags is an editable flash template for wordpress tags.
LcTags allow you to display wordpress tags in a nice flash presentation. 
You can choose colors and font variant size.
Users can choose tags view (horizontal line, vertical line, round, 3d) and tags order.


== DESCRIPTION ==

LcTags is an editable flash template for wordpress tags.
Tags come from the wordpress simple tags database, and allow administrator to edit display settings:
- Color panel of tags
- Buttons color and background color
- Max and min size of words

Visitors can choose some settings when they visit the tagcloud
- Tags space disposition (line, circle, 3d space)
- Sort on date, popularity, alphabetic


== INSTALLATION ==

1. Unzip files. Now you have 2 main directories : /wp-lctags and /lcTags.
2. Put the folder /lcTags to wp-content/plugins/.
3. Put the folder /wp-lctags to the root of your wordpress blog.
4. Go to backoffice, in plugins tabs, then activate LcTags.
5. Plugin is well installed, you can edit settings in "options"/"LcTags"
6. You can see your tagcloud on wwww.your-blog-url/wp-lctags/

Your wordpress tree should be like this:
	wordpress/
	+ wp-content/
	  + plugins/
	   + lctags/
	    | lctags.php
	    | class.php
		+ admin/
	      | admin.php     
	      | infos.php      
	    + img/  
	      | gamme1.jpg 
	      | gamme2.jpg 
	      | gamme3.jpg 
	      | gamme4.jpg 
	      | gamme5.jpg 
	      | gamme6.jpg 
	      | gamme7.jpg 
	      | gamme8.jpg 
		+ languages/    
	      |lctags_fr_FR.mo
	      |lctags_fr_FR.po
	      |lctags_en_EN.mo
	      |lctags_en_EN.po
	+ wp-lctags/
		| lctags.swf
		| expressinstall.swf
		| index.php
		+ js/
		  | swfobject.js
		+ php/
		  | liste_tag.php
		  | settings.php


== UPDATE ==

To update LcTags :
1. Unzip files. Now you have 2 main directories : /wp-lctags and /lcTags.
2. Delete existing folder /wp-content/plugins/lcTags and upload the new one.
3. Delete existing folder /wp-lctags at the root of your Wordpress and upload the new one.
4. Update is well done


== INTEGRATION OF THE SWF IN A WORDPRESS PAGE ==

Si vous souhaitez intégrer le plugin lcTags directement dans vos pages wordpress, 2 options:
1.	If you want to display lcTags in all your posts:
	-Put the following code in file wp-content\themes\your-template\page.php at the place you wan:
		<div id="flashcontent">
				LutinCapuche 2008 - LcTags - Plugin Wordpress - Here alternative content
		</div>
		<script type="text/javascript">		
			// <![CDATA[		
			var so = new SWFObject("wp-lctags/lctags.swf", "lctags", "your width", "your height", "9", "#ffffff");		
			so.addParam("allowdomain", "always");
			so.addParam("scale", "noscale");		
			//blog root (/wordpress, /blog, /...)
			so.addVariable("pathBase", "/");
			so.useExpressInstall("wp-lctags/expressinstall.swf");
			so.write("flashcontent");
			// ]]>
		</script>		
	-Put width and height you want for the swf, blog root in pathBase variable, save file and update it on your server with an ftp software.
	-You can insert the swf in all your pages templates if you want. (home.php,archive.php...)
	-Don't forget to follow the step 3 to well finished the integration.

2. 	If you want to insert LcTags in a post with WordPress backoffice

	-Note that WP content editor is not easy to use to insert flash content. You had to do a manipulation each time you want to edit your post. I don't success in find an easier solution yet.
	-Open your post in WP backoffice. Choose the "code" view.
	-Put your mouse where you want to insert LcTags. 
	-Copy paste this code:
		<div id="flashcontent">
				LutinCapuche 2008 - LcTags - Plugin Wordpress - Here alternative content.
		</div>
		<script type="text/javascript">		
			// <![CDATA[		
			var so = new SWFObject("wp-lctags/lctags.swf", "lctags", "your width", "your height", "9", "#ffffff");		
			so.addParam("allowdomain", "always");
			so.addParam("scale", "noscale");		
			//blog root (/wordpress, /blog, /...)
			so.addVariable("pathBase", "/");
			so.useExpressInstall("wp-lctags/expressinstall.swf");
			so.write("flashcontent");
			// ]]>
		</script>
	-Put width and height you want for the swf, blog root in pathBase variable and save post.
	-If you edit the post later, be careful: Wordpress re-edit the code and delete some code which break swf integration. You had to copy past code again.
	-Don't forget to follow the step 3 to well finished the integration.

3.	For this two solutions, you had to add the swfObject file to your wordpress page.
	To do this, you had to put a line in your file header:	
	-Open the file \wp-content\themes\votre-theme\header.php with a text editor
	-Copy paste this line between <head> and </head>:
		<script type="text/javascript" src="wp-lctags/js/swfobject.js"></script>
	-Save the file and update it on your server with an ftp software.



== UNINSTALLING ==

If you dislike lcTags, you can uninstall it in your plugin page. Click on "uninstall". Then delete folders wp-content/plugins/lcTags and wp-lctags. Uninstalling is done.


== CHANGE LANGUAGE ==

Open plugins/lcTags/lcTags.php en change the following line: 
define('LCTAGS_LANG', 'fr_FR'); 
by 
define('LCTAGS_LANG', 'en_EN');

Upload plugins/lcTags/lcTags.php on your server. 
It's done

== SCREENSHOTS ==

1. Configure tagcloud settings
2. Example 1
3. Example 2
4. Example 3

== DOCUMENTATION ==

Full documentation can be found on the [Search Unleashed](http://www.lutincapuche.com/lc-tags-plugin-wordpress/) page.
=== Easy Add Thumbnail ===
Contributors: samuelaguilera
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=8ER3Y2THBMFV6
Tags: thumbnail, thumbnails
Requires at least: 2.9
Tested up to: 3.3.1
Stable tag: 1.0.1

Checks if you defined the post thumbnail, and if not it sets the thumbnail to the first uploaded image for that post. So easy like that...

== Description ==

Checks if you defined the post thumbnail, and if not it sets the thumbnail to the first uploaded image for that post. So easy like that...

It does his job in two cases:

1. Dinamically, for old published posts, the thumbnails are sets only when needed to show them in the frontend. This means that the thumbnail is set (only first time) when a visitor loads the page where it needs to be shown.

2. For new posts, it sets the thumbnail just in the publishing process.

No options page to setup, simply install and activate.

= Features =

* Simply avoids you to set the post thumbnail one by one to every post if you uploaded an image when you did the post.

= Requirements =

* WordPress 2.9 or higher.
    	
== Installation ==

* Extract the zip file and just drop the contents in the <code>wp-content/plugins/</code> directory of your WordPress installation (or install it directly from your dashboard) and then activate the Plugin from Plugins page.

<strong>IMPORTANT!</strong> Remember that your theme must support the use of thumbnails, if not, the thumbnails will be added but you'll not see them in your site.
  
== Frequently Asked Questions ==

= Will this plugin works in WordPress older than 2.9? =

No, because this plugin uses the post thumbail function added on WordPress 2.9.

= Why you did this plugin? =

I did it to fullfil the needs of one of my customers.

= Are you planning to add more features? =

At first not, but who knows...

== Changelog ==

= 1.0.1 =

* Hooks added to set the thumbnail when publishing too.

= 1.0 =

* Initial release.

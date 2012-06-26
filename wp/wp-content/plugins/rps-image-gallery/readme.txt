=== RPS Image Gallery ===
Contributors: redpixelstudios
Donate link: http://redpixel.com/
Tags: gallery, images, slideshow, fancybox
Requires at least: 3.0
Tested up to: 3.3.1
Stable tag: 1.2

The RPS Image Gallery plugin takes over where the WordPress gallery leaves off by adding slideshow and advanced linking capabilities.

== Description ==

The RPS Image Gallery plugin takes over where the WordPress gallery leaves off by adding slideshow and advanced linking capabilities.

The plugin changes the way the gallery is output by using an unordered list instead of using a definition list for each image. This offers several advantages. There are fewer lines of code per gallery for simplified styling and better efficiency. From an accessibility standpoint, the unordered list is better suited to this type of content than is the definition list. It enables a gallery that will automatically wrap to any given container width.

In addition, any image in the gallery can either invoke a slideshow or link to another page. The link is specified in the Gallery Link field within the image's Edit Media screen. When an image that has a Gallery Link is clicked, the user will be directed to that location. Images that link elsewhere are automatically excluded from the slideshow.

= Features =
* Specify whether clicking an image will invoke a slideshow or link to a page</li>
* Support for multiple galleries on a single page</li>
* Optionally display the image captions in gallery view</li>
* Define sort order of the gallery through the standard familiar interface</li>
* Uses an unordered list instead of a definition list</li>
* Only loads required scripts when shortcode is invoked</li>
* Overrides the default [WordPress Gallery](http://codex.wordpress.org/Gallery_Shortcode "Gallery Shortcode") shortcode but includes all of its options</li>

== Installation ==

1. Upload the <code>rps-image-gallery</code> directory and its containing files to the <code>/wp-content/plugins/</code> directory.</li>
2. Activate the plugin through the "Plugins" menu in WordPress.</li>

== Frequently Asked Questions ==

= What happens if I deactivate the plugin after having setup galleries with it active? =

Nothing bad. The default [WordPress Gallery](http://codex.wordpress.org/Gallery_Shortcode "Gallery Shortcode") behavior will take over and any shortcode attributes that are specific to the plugin are ignored.

= What attributes are added to the WordPress Gallery shortcode? =

* size_large (default='large') - the size of the image that should be displayed in the slideshow view such as 'medium' or 'large'.
* group_name (default='rps-image-group') - the class of the gallery group that is used to determine which images belong to the gallery slideshow.
* container (default='div', allowed='div','p','span') - the overall container for the gallery.
* caption (default='false') - whether or not to show the caption under the images in the gallery grid view.
* slideshow (default='true') - whether or not to invoke the slideshow (fancybox) viewer when an image without a Gallery Link value is clicked.

= What attributes are added to the WordPress Gallery shortcode that are specific to the slideshow (fancybox)? =

* fb_title_show (default='true') - whether or not to show the caption under the images in the slideshow view.
* fb_title_position (default='over', allowed='over','outside','inside') - the position of the caption in relation to the image in the slideshow.
* fb_show_close_button (default='true') - whether or not to show the close button in the upper-right corner of the slideshow (clicking outside the slideshow always closes it).
* fb_transition_in (default='none', allowed='none','elastic','fade') - the effect that should be used when the slideshow is opened.
* fb_transition_out (default='none', allowed='none','elastic','fade') - the effect that should be used when the slideshow is closed.
* fb_speed_in (default='300', minimum='100', maximum='1000') - time in milliseconds of the fade and transitions.
* fb_speed_out (default='300', minimum='100', maximum='1000') - time in milliseconds of the fade and transitions.

= Why is the default output for the gallery grid set to use an unordered list rather than a definition list? =

The unordered list output is more flexible when used with variable-width layouts since it does not include a break at the end of each row. The default WordPress Gallery output can be achieved by adding the following attributes and values to the shortcode: itemtag='dl', icontag='dt'

= What will display if I set the caption attribute to 'true' but some of my images don't have captions? =

The plugin will fallback to the image title if a caption is not defined for the image.

= Is the image description needed? =

No. We took the approach that the description field should be used to store information about the image that likely would not be seen by the site visitors but could be useful for admins when searching for the image.

= How do I add multiple galleries to the same page? =

Though the WordPress Gallery editor only allows you to manage a single gallery, you can combine galleries from multiple post/pages onto a single page. To do this, create a post/page for each gallery that you want to include. Record the post IDs for the gallery pages, then add a gallery shortcode for each of them on the post/page that will contain them. For example:

<code>
[gallery id=134 group_name=group1]
[gallery id=159 group_name=group2]
</code>

This code will pull the gallery from post 134 and 159 and display them one after the other. The group name attribute allows for each gallery to display in a separate slideshow. Excluding the group name or making it the same will cause the slideshow to be contiguous between the galleries.

Alternatively, you can create multiple galleries from the attached images on a post/page. To do so, get a list of the image (attachment) IDs that you want for each gallery, then pass them to the gallery shortcode in the "include" attribute like so:

<code>
[gallery include=10,11,24,87]
[gallery include=7,16,23,45]
</code>

Keep in mind that all of the included images must be attached to the post/page to be successfully added to the gallery.

= What version of fancyBox is being used? =

fancyBox version 1.3.4 is included with this plugin.

== Screenshots ==

1. A field named "Gallery Link" is added to the Edit Media screen for images so that an admin can force the image to link to a post or page on their site or a page on another site.
2. The familiar WordPress Gallery object appears within the Visual editor, just as before the installation of the plugin.
3. The default output for the gallery is the flexible unordered list.
4. Clicking a gallery image opens the slideshow(fancyBox) viewer or directs the site visitor to a page specified in the Gallery Link field.

== Changelog ==

= 1.2 =
* Added capability to pass fancyBox settings through shortcode attributes.
* Changed the default slideshow behavior to be cyclic (loop).
* Corrected an issue preventing slideshow for multiple galleries.

= 1.1.1 =
* First official release version.

== Upgrade Notice ==

= 1.2 =
* Specify slideshow behavior.
* Corrects an issue whereby only the last gallery on the page could trigger a slideshow.

=== QTVR Viewer ===
Contributors: Armando Saenz
Link: http://www.devalvr.com/paginas/productos/qtvrviewer.html
Tags: qtvr, 360, panorama, viewer, VR, QuickTime, DevalVR
Requires at least: 2.1
Tested up to: 2.9.2
Stable tag: 1.5.3

This plugin inserts a panoramic player into a WordPress article to view a 360 panoramic picture in QTVR format (.mov)

== Description ==

This plugin inserts a panoramic player into a WordPress article to view a 360 panoramic picture in QTVR format (.mov)

To view a QTVR file (.mov) it's required a browser plugin that supports this type of files,
this WordPress plugin uses QuickTime http://www.apple.com/quicktime/ or DevalVR http://www.devalvr.com
 
This WordPress plugin is based in the Javascript code "detectvr.js", this workaround is used to autodetect 
the browser plugin present in the user computer. If QuickTime is present, then QuickTime is used (this 
plugin is present in all Mac computers and 65% of Windows computers).
If QuickTime is not present, then a message is shown to allow the user to install DevalVR plugin, this is a very
small plugin for Windows (about 0.3 MB) of high quality and performance. 

It's possible to define an option in the viewer to allow the user to choose the preferred browser plugin.


== Installation ==

1. Press 'Install Now' button into WordPress control pannel, or upload `qtvr-viewer.zip` to the `Install Plugins` section
2. Activate the plugin


== Frequently Asked Questions ==

= What type of files supports the player? What is a QTVR? =

This player supports QTVR files, QTVR means QuickTime VR. These files are panoramic pictures, of usually 360 degrees, 
that are encapsulate into a .mov extension.

= How can I create a panoramic picture in QTVR format? =

There are several programs to create panoramic pictures, but maybe one of the most used is PTGui http://www.ptgui.com/

= I want to test the plugin, but I don't have QTVR files, where can I get some samples? =

You can use these files to test http://www.devalvr.com/panos/QTVRsamples.zip

= What is DevalVR? =

DevalVR is a browser plugin to view panoramic pictures. It's available for all Windows browsers and it's under 
development a version for MacOSX and Linux. More info at http://www.devalvr.com
The main advantage of DevalVR is the small size of the download for the installation, this is very good for casual users 
that want to see the contents of the page fastly (DevalVR has a size of 0.3MB).
The quality of the image reproduced in DevalVR is superior to QuickTime, because DevalVR uses hardware accelerated graphics
for a very smooth movement of the image.

== Screenshots ==

1. Default preview screen with a play button to start the viewer (added in 1.4 version).

2. This is the screenshot using this code into the post: 
{qtvr http://www.devalvr.com/panos/mansion1.mov 460 300 selection(Choose viewer:, detect, devalvr, qt)} . This code uses an 
absolute URL for the QTVR sample, so you can use it to test QTVR Viewer in your blog. In this screenshot, DevalVR is choosen.

3. The same example, but in this screenshot the QuickTime player is choosen.

== Changelog ==

= 1.5.3 =
- Write "preview()" to remobe the initial black screen

= 1.5.2 =
- Now all text into CODE block is not codified. This is useful to post source code examples.

= 1.5.1 =
- Fixed bug with Wordpress 2.9

= 1.5 =
- Fixed bug with url of play button image to start the viewer

= 1.4 =
- Added play button to start the viewer only after user click 
- Added "preview()" function to define a preview image
- Updated Javascript detection code to the latest version

= 1.2 =
- The viewer is not shown in category pages
- Updated Javascript detection code to the latest version

= 1.1 =
- Fixed a problem with path of Javascript file

= 1.0 =
- Support for DevalVR + QuickTime plugins
- Functions for additional parameters and plugin selection

== Usage ==

To insert the player into the article write the next statement in the text of the article:

{qtvr filename width height}

Replace the parameter "filename" by the MOV file name and the "width" and "height" parameters by the size in pixels 
of the player window. Example:

{qtvr panorama.mov 460 300}

The base folder for the MOV files is the content folder of your WordPress installation (by default /wp-content/)
For example, if you write: {qtvr pictures/panorama.mov 460 300} , the file should be in /wp-content/pictures/panorama.mov

You can use absolute URLs too, for example:

{qtvr http://www.devalvr.com/panos/mansion1.mov 460 300}

It's possible to define any parameters for DevalVR or QuickTime, with the help of the functions devalvr() and qt() respectively. 
The parameters must be written between the parentheses, between quotation marks, separated by commas, and in pairs name-value. 
Any number of parameters can be defined. Available parameters for DevalVR: http://www.devalvr.com/paginas/soporte/parameters.html

Example:

{qtvr panorama.mov 460 300 devalvr("autoplay","2","autoplayspeed","-6") qt("controller","false")}


It's possible to insert some options bellow the viewer to allow the user to choose his preferred browser plugin. Use the selection() 
function. This function can have several parameters, separated by commas. The first parameter is the text that will be written 
before the selection options, the next parameters must be any of these predefined words: detect, devalvr, qt, links, combobox

Example:

{qtvr panorama.mov 460 300 devalvr("autoplay","2") qt("controller","false") selection(Choose viewer:, detect, devalvr, qt)}


Preview images:

It's possible to use the function "preview(filename)" to define an image to show under the play button.

{qtvr panorama.mov 460 300 preview(image.jpg)}

The base folder for preview images is the content folder of your WordPress installation (by default /wp-content/)
For example, if you write: {qtvr panorama.mov 460 300 preview(pictures/image.jpg)} , the file should be in /wp-content/pictures/image.jpg



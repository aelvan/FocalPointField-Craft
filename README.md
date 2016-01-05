Focal Point Field for Craft
===
A field type that let's you set the focal point of an image. 

_This fieldtype was made to be used together with [Imager](https://github.com/aelvan/Imager-Craft) and its `position` transform parameter._ 

Installation
---
1. Download the zip from this repository, unzip, and put the focalpointfield folder in your Craft plugin folder.
2. Enable the plugin in Craft (Settings > Plugins)

The Focal Point fieldtype is now available when you create a new field. 

Usage
---
This plugin only works when added to the field layout of an asset source. When bringing up the element modal window (double clicking on it),
the field will show the image. Click on the point where you want the focal point to be. Click again, or drag the circle, to move it.

![Focal Point Field example](https://raw.githubusercontent.com/aelvan/FocalPointField-Craft/master/screenshots/focalpoint.png)
 
The value that is saved and returned by the field is the percentage offset from left/top, for instance `50% 50%`.

Price, license and support
---
The plugin is released under the MIT license, meaning you can do what ever you want with it as long as you don't blame 
me. **It's free**, which means there is absolutely no support included, but you might get it anyway. Just post an issue 
here on github if you have one, and I'll see what I can do. :)


Changelog
---
### Version 1.0.0
 - Initial release.
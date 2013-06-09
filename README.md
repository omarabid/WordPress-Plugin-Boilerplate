# WordPress Plugin Boilerplate

WordPress Plugin Boilerplate is a fully functioning WordPress plugin that offers you backbone structure and functionality to quickly start your WordPress development.

The Plugin is object oriented, and decitate a simple and flexible files hierarchy.

## The Plugin Base Class

The plugin base class aim to abstract and encompass the basic functionality any plugin requires. It also makes simpler and easier to include PHP files, register widgets, hook to the activation, deactivation, and uninstall hooks...

The idea is that you don't need to remember or have a check-list of best practices, the class already have them and you just add the implementation.

### Admin Panel

The plugin has a simple Admin panel class. It has two admin pages, and add a submenu to the WordPress Admin bar.

The plugin structure makes it quite easy to extend the plugin with new admin pages.

#### Available controls

The boilerplate comes with many controls that you can integrate with the WordPress Settings API.

* textbox
* textarea
* checkbox
* button

### Widget Class

A simple and functional widget class is also available.

## Unit Testing

The plugin uses [WordPress Unit Tests](http://unit-tests.trac.wordpress.org/) to implement Unit Testing. The WordPress tests are removed, though.

The tests should be put in `tests/tests` and to run unit testing, just type `phpunit` inside the `tests` directory. You'll need to create a config file before being able to run the tests. You'll also need a seperate database (preferrably) for fresh installations of WordPress.

For more information, check the README.txt file associated with the tests library.

P.S.: It's not a good idea to include the Unit Tests in the production version.

## SASS and COFFEESCRIPT

If you are fan of SASS and CoffeeScript, I have included their directories (`sass` and `cs`) inside the CSS and JavaScript directories. To run the watcher and process the files, run the following command in the plugin directory

```
### SASS
sass --watch files/css/sass:files/css --style compressed
sass --watch admin/files/css/sass:admin/files/css --style compressed

### CoffeeScript
coffee --output files/js --watch --compile files/js/cs
coffee --output admin/files/js --watch --compile admin/files/js/cs
```

## Other Goodies

* The License file
* The Readme.txt file with formatting for WordPress.org
* .gitignore

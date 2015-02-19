# WordPress Plugin Boilerplate

WordPress Plugin Boilerplate is a fully functioning WordPress plugin that offers you backbone structure and functionality to quickly start your WordPress development.

The Plugin is object oriented, and dictate a simple and flexible files hierarchy.

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

#### Form Generator

With the form generator, you can easily generate forms. Just register your settings with the WordPress API and use the following function to generate the form.

```
$form = wp_admin_forms::generate_form('pb_settings', array('pb_general_section'), 'form_class', true);
echo $form;
```

#### Tables Generator

The Table Generator page example uses the WordPress WP_List_Table class to create and display tables. There is no API or functions for this, but it's merely an example to showup how you can spin your own table using the WordPress generator.

#### Notifications API

The notifications API allow you to manage and display admin notifications with ease. 
TODO: The notifications API is not implemented yet.

### Widget Class

A simple and functional widget class is also available.

## Unit Testing

The plugin uses [WordPress Unit Tests](http://unit-tests.trac.wordpress.org/) to implement Unit Testing. 

The tests should be put in `tests/tests` and to run unit testing, just type `phpunit` inside the `tests` directory. Unit Testing is implemented by the [WP-CLI](http://wp-cli.org/blog/plugin-unit-tests.html). Read and follow the tutorial to create your own version of the testing suite.

You don't need, however, to create the `tests` directory as it's included with the boilerplate. You do need to update the `WP_TESTS_DIR` environement variable, though.

```
export WP_TESTS_DIR=/path/to/wp/
```

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

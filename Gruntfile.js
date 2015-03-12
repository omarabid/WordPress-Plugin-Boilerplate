module.exports = function( grunt ) {
	'use strict';

	// Load multiple grunt tasks using globbing patterns
	require('load-grunt-tasks')(grunt);

	grunt.initConfig({
		makepot: {
			target: {
				options: {
					domainPath: 'i18n',               // Where to save the POT file.
					exclude: [],                      // List of files or directories to ignore.
					type: 'wp-plugin',                // Type of project (wp-plugin or wp-theme).
				}
			}
		}
	});		

	// Register tasks
	grunt.registerTask('default', ['makepot']);

};

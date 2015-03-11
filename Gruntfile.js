module.exports = function( grunt ) {
	'use strict';

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

	// Load NPM tasks to be used here	
	grunt.loadNpmTasks( 'grunt-wp-i18n' );

	// Register tasks
	grunt.registerTask('default', ['makepot']);

};

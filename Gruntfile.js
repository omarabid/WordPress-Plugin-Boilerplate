module.exports = function( grunt ) {
	'use strict';

	// Load multiple grunt tasks using globbing patterns
	require('load-grunt-tasks')(grunt);

	grunt.initConfig({
		dirs: {
			lang: 'i18n/languages',
		},
		checktextdomain: {
			options:{
				text_domain: 'wpbp',
				create_report_file: false,
				keywords: [
					'__:1,2d',
					'_e:1,2d',
					'_x:1,2c,3d',
					'esc_html__:1,2d',
					'esc_html_e:1,2d',
					'esc_html_x:1,2c,3d',
					'esc_attr__:1,2d',
					'esc_attr_e:1,2d',
					'esc_attr_x:1,2c,3d',
					'_ex:1,2c,3d',
					'_n:1,2,3,4d',
					'_nx:1,2,4c,5d',
					'_n_noop:1,2,3d',
					'_nx_noop:1,2,3c,4d',
					' __ngettext:1,2,3d',
					'__ngettext_noop:1,2,3d',
					'_c:1,2d',
					'_nc:1,2,4c,5d'
				]
			},
			files: {
				src: [
					'**/*.php', // Include all files
					'!node_modules/**', // Exclude node_modules/
					'!tests/**', // Exclude unit tests/
					'!bin/**', // Exclude Bin/
					'!i18n/**', // Exclude i18n/
					'!build/.*'// Exclude build/
				],
				expand: true
			}
		},
		potomo: {
			dist: {
				options: {
					poDel: false 
				},
				files: [{
					expand: true,
					cwd: '<%= dirs.lang %>',
					src: ['*.po'],
					dest: '<%= dirs.lang %>',
					ext: '.mo',
					nonull: true
				}]
			}
		},
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

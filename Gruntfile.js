module.exports = function( grunt ) {
	'use strict';

	// Load multiple grunt tasks using globbing patterns
	require('load-grunt-tasks')(grunt);

	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),

		// project directories
		dirs: {
			lang: 'i18n/languages',
		},

		shell: {
			options: {
				execOptions: {
					maxBuffer: Infinity
				}
			},
			composer_install: {
				command: function() {
					var cmd = [
						'composer install',
						'composer dumpautoload'
						].join( '&&' );
						return cmd;
				}
			},
			docker_setup: {
				command: function() {
					var cmd = [
						].join( '&&' );
						return cmd;
				}
			},
			docker_build: {
				command: function() {
					var cmd = [
						'cd docker',
						'docker-compose build'
						].join( '&&' );
						return cmd;
				}
			},
			docker_up: {
				command: function() {
					var cmd = [
						'cd docker',
						'docker-compose up'
						].join( '&&' );
						return cmd;
				}
			},
			localhost: {
				command: function() {
					var cmd = [
						'docker-machine ip dev'
						].join( '&&' );
						return cmd;
				},
				options: {
					callback: function ( err, stdout, stderr, cb ) {
						grunt.config( 'machine_ip', stdout );
						grunt.config( 'localhosts', {
							set : {
								options: {
									rules: [{
										ip: ( function() {
											var ip = grunt.config( 'machine_ip' );	
											return ip;
										} )(),
										hostname: ( function() {
											var cfj = grunt.file.readJSON( 'config.json' );		
											return cfj.deploy.hostname;
										} )(),
										type: 'set'
									}]
								}
							}
						} );
						grunt.task.run( [ 'localhosts' ] );
						cb();
					}
				}
			}
		},

		"ini-file": {
			docker_env: {
				file: "docker/config.env", 
				values: ( function() {
					var cfj = grunt.file.readJSON( 'config.json' );
					var config = {
						"WP_VERSION": cfj.deploy.wordpress.version,
						"WP_USERNAME": cfj.deploy.wordpress.username,
						"WP_PASSWORD": cfj.deploy.wordpress.password,
						"WP_EMAIL": cfj.deploy.wordpress.email,
						"WP_TITLE": cfj.deploy.wordpress.title,
						"WP_URL": cfj.deploy.wordpress.url,
						"WP_PLUGINS": cfj.deploy.wordpress.dependencies.plugins.join( '|' ),
						"WP_THEMES": cfj.deploy.wordpress.dependencies.themes.join( '|' ),
						"WP_DEV_THEMES": cfj.deploy.wordpress.dev_dependencies.themes.join( '|' ),
						"WP_DEV_PLUGINS": cfj.deploy.wordpress.dev_dependencies.plugins.join( '|' ),
						"MYSQL_DATABASE": cfj.deploy.mysql.database,
						"MYSQL_USER": cfj.deploy.mysql.username,
						"MYSQL_PASSWORD": cfj.deploy.mysql.password,
						"MYSQL_ROOT_PASSWORD": cfj.deploy.mysql.root_password
					};
					return config;
				} )()
			}		
		}

		,

		// Check that textdomain is set
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
					'!docker/**', // Exclude docker/
					'!build/.*'// Exclude build/
				],
				expand: true
			}
		},

		// Generate the mo files
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

		// Make the l10n file
		makepot: {
			target: {
				options: {
					domainPath: 'i18n',               // Where to save the POT file.
					exclude: [],                      // List of files or directories to ignore.
					type: 'wp-plugin',                // Type of project (wp-plugin or wp-theme).
				}
			}
		},

		// Clean up build directory
		clean: {
			main: ['build']
		},

		// Copy the plugin files into the build directory
		copy: {
			main: {
				src:  [
					'**',
					'!node_modules/**',
					'!bin/**',
					'!build/**',
					'!tests/**',
					'!.git/**',
					'!.idea/**',
					'!Gruntfile.js',
					'!package.json',
					'!phpunit.xml',
					'!.scrutinizer.yml',
					'!.travis.yml',
					'!.gitignore',
					'!.gitmodules',
					'!README.md',
					'!README.txt',
				],
				dest: 'build/<%= pkg.name %>/'
			}
		},

		// Update the Plugin Version
		replace: {
			version: {
				src: ['plugin.php', 'README.txt'],             // source files array (supports minimatch)
				dest: 'build/<%= pkg.name %>/',             // destination directory or file
				replacements: [{
					from: '{{@version}}',                   // string replacement
					to: '<%= pkg.version %>'
				}]
			}
		},

		//Compress build directory into <name>.zip 
		compress: {
			main: {
				options: {
					mode: 'zip',
					archive: './build/<%= pkg.name %>.zip'
				},
				expand: true,
				cwd: 'build/<%= pkg.name %>/',
				src: ['**/*'],
				dest: '<%= pkg.name %>/'
			}
		},

		// Compile all .scss files in the includes directory
		sass: {
			compile: {
				options: {
				},
				files: [{
					expand: true,
					cwd: '',
					src: ['**/*.scss'],
					dest: '',
					ext: '.css'
				}]
			}
		},

		watch: {
			css: {
				files: ['**/*.scss'],
				tasks: [ 'sass' ]
			}
		},

		// Generates a ChangeLog file from Git commits
		changelog: {
			options: {
				// Task-specific options go here.
			}
		},

		bump: {
			options: {
				files: ['package.json'],
				updateConfigs: [],
				commit: true,
				commitMessage: 'Release v%VERSION%',
				commitFiles: ['package.json'],
				createTag: true,
				tagName: 'v%VERSION%',
				tagMessage: 'Version %VERSION%',
				push: false,
				gitDescribeOptions: '--tags --always --abbrev=1 --dirty=-d',
				globalReplace: false,
				prereleaseName: false,
				regExp: false
			}
		}
	});	

	grunt.registerTask( 'generate_env', 'Task', function() {
		var yml = grunt.file.readYAML( 'docker/docker-compose.yml' ),
		cnf = grunt.file.readJSON( 'config.json' );

		yml.web.volumes = yml.php.volumes = [
			cnf.deploy.mount_path + "/.tmp/" + grunt.config( 'pkg' ).name + ":/wp"
		];
		
		var y = require('yamljs');
		var yamlString = y.stringify( yml, 10 );
		grunt.file.write('docker/docker-compose.yml', yamlString );
	} );

	// Register tasks
	grunt.registerTask( 'default', [ 'makepot', 'potomo', 'clean', 'copy', 'replace', 'compress' ] );

	// Report Broken Textdomain
	grunt.registerTask( 'report', [ 'checktextdomain' ] );

	grunt.registerTask( 'setup', [ 'shell:composer_install' ] );

	grunt.registerTask( 'up', [ 'ini-file', 'generate_env', 'shell:docker_setup', 'shell:docker_build', 'shell:docker_up', 'shell:localhost' ] );	
};

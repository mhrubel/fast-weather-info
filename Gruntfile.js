module.exports = function (grunt) {
  "use strict";

  // Project configuration.
  grunt.initConfig({
    // Clean up build directory
    clean: {
      build_production: ['build-production'],
      build_development: ['build-development']
    },

    // Uglify JS files for production build
    uglify: {
      build_production: {
        files: {
          'build-production/assets/js/app.min.js': ['src/assets/js/**/*.js']
        }
      }
    },

    // Minify CSS files for production build
    cssmin: {
      build_production: {
        files: {
          'build-production/assets/css/styles.min.css': ['src/assets/css/**/*.css']
        }
      }
    },

    // JavaScript linting with JSHint
    jshint: {
      options: {
        esversion: 6, // Set ECMAScript version for linting
        globals: {
          jQuery: true
        },
      },
      all: ['src/assets/js/**/*.js'] // Lint all JS files in the specified directory
    },

    // Watch for file changes and automatically run tasks
    watch: {
      js: {
        files: ['src/assets/js/**/*.js'],
        tasks: ['jshint'], // Run JSHint when JavaScript files are changed
        options: {
          spawn: false
        }
      },
      css: {
        files: ['src/assets/css/**/*.css'],
        tasks: ['cssmin:build_production'], // Minify CSS when files are changed
        options: {
          spawn: false
        }
      },
      php: {
        files: ['**/*.php'], // Watch PHP files for changes
        tasks: [], // Add tasks here for PHP files if needed
        options: {
          spawn: false
        }
      },
      html: {
        files: ['**/*.html'], // Watch HTML files for changes
        tasks: [], // Add tasks here for HTML files if needed
        options: {
          spawn: false
        }
      }
    },

    // Copy files for production and development builds
    copy: {
      // Production build: include all files necessary for the production environment
      build_production: {
        files: [
          { expand: true, cwd: '.', src: ['fast-weather-info.php', 'LICENSE', 'readme.txt', 'bootstrap/**', 'config/**', 'routes/**', 'resources/**'], dest: 'build-production/' },
          { expand: true, cwd: 'vendor/', src: ['**'], dest: 'build-production/vendor/' },
          { expand: true, cwd: 'languages/', src: ['**'], dest: 'build-production/languages/' },
          { expand: true, cwd: 'app/', src: ['**'], dest: 'build-production/app/' },
        ]
      },
      // Development build: exclude node_modules and vendor directories
      build_development: {
        files: [
          { expand: true, cwd: '.', src: ['**', '!node_modules/**', '!build-production/**', '!build-development/**', '!vendor/**'], dest: 'build-development/' }
        ]
      }
    }
  });

  // Load the plugins
  grunt.loadNpmTasks('grunt-contrib-clean');
  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-contrib-cssmin');
  grunt.loadNpmTasks('grunt-contrib-copy');
  grunt.loadNpmTasks('grunt-contrib-jshint');
  grunt.loadNpmTasks('grunt-contrib-watch');

  // Production build task
  grunt.registerTask('build', ['clean:build_production', 'uglify:build_production', 'cssmin:build_production', 'copy:build_production']);

  // Development build task (no minification)
  grunt.registerTask('build-dev', ['clean:build_development', 'copy:build_development']);

  // Default task: Watch for changes and lint JavaScript files
  grunt.registerTask('default', ['watch']);
};

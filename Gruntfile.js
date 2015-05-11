module.exports = function( grunt ) {
  require('time-grunt')(grunt);
  require('jit-grunt')(grunt);
  grunt.initConfig({
    jshint: {
      all: {
        src: ['./js/script.js','./js/widget.js']
      }
    },
    csslint: {
      all: {
        src: ['./css/style.css']
      }
    },
    uglify: {
      app: {
        files: {
          './js/script.min.js': ['./js/script.js'],
          './js/widget.min.js': ['./js/widget.js']
        }
      }
    },
    cssmin: {
      app: {
        files: {
          './css/style.min.css': ['./css/style.css'],
          './css/skin/ui.dynatree.min.css': ['./css/skin/ui.dynatree.css']
        }
      }
    },
    phpunit: {
      unit: {
        dir: './tests/unit'
      },
      integration: {
        dir: './tests/integration'
      },
      options: {
        bootstrap: '../../lib/base.php',
        colors: true,
      }
    },
    phplint: {
      all: {
        src: [
          './appinfo/*.php',
          './controller/*.php',
          './controller/lib/*.php',
          './templates/*'
        ]
      }
    },
    compress: {
      appstore: {
        options: {
          archive: './build/appstore.zip'
        },
        files: [
          { 
            src:[
              './appinfo/*',
              './controller/**',
              './css/style.min.css',
              './css/skin/*.gif',
              './css/skin/ui.dynatree.min.css',
              './img/*',
              './js/*.min.js',
              './js/vendor/dynatree/dist/*.min.js',
              './templates/*'
            ]
          }
        ]
      }
    }
  });
  grunt.registerTask( "default",['jshint','csslint','uglify','cssmin','phplint','phpunit','compress','compress']);
};
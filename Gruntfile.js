module.exports = function( grunt ) {
  require('time-grunt')(grunt);
  require('jit-grunt')(grunt);
  grunt.initConfig({
    revcount: {
    },
    replace: {
      version: {
        options: {
          patterns: [ {
              match: /<version>.*<\/version>/,
              replacement: '<version>0.0.2.<%= meta.revision %></version>'
            }
          ]
        },
        files: [
          {src: ['./appinfo/info.xml'],dest:'./appinfo/info.xml'}
        ]
      }
    },
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
          archive: './build/appstore.tar.gz'
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
            ], dest: 'treebookmarks/'
          }
        ]
      }
    }
  });
  grunt.registerTask( "default",['revcount','replace','jshint','csslint','uglify','cssmin','phplint','phpunit','compress','compress:appstore']);
};
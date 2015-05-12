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
          { src: ['./appinfo/info.xml'], dest: './appinfo/info.xml' }
        ]
      }
    },
    jshint: {
      all: {
        src: ['./js/script.js', './js/widget.js', './package.json' , 'Gruntfile.js']
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
          './js/script.min.js': [ './js/script.js' ],
          './js/widget.min.js': [ './js/widget.js' ]
        }
      }
    },
    cssmin: {
      app: {
        files: {
          './css/style.min.css': [ './css/style.css' ],
          './css/skin/ui.dynatree.min.css': [ './css/skin/ui.dynatree.css' ]
        }
      }
    },
    phplint: {
      all: {
        src: [
          './appinfo/*.php',
          './controller/*.php',
          './storage/*.php',
          './http/*.php',
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
              './README.md',
              './appinfo/*',
              './controller/**',
              './storage/**',
              './http/**',
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
  grunt.registerTask( "default",['revcount','replace','jshint','csslint','uglify','cssmin','phplint','compress:appstore']);
};
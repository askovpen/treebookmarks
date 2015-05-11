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
          './css/style.min.css': ['./css/style.css']
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
        logTap: '1.log'
      }
    },
    phplint: {
      all: {
        src: [
          './appinfo/routes.php',
          './controller/pagecontroller.php',
          './controller/lib/treebookmarks.php',
        ]
      }
    }
  });
  grunt.registerTask( "default",['jshint','csslint','uglify','cssmin','phplint','phpunit']);
};
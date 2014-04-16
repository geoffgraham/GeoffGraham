'use strict';
module.exports = function(grunt) {
 
    // load all grunt tasks
    grunt.loadNpmTasks('grunt-ftpush');
 
    grunt.initConfig({
 
      // Deploy files to ftp server
        'ftpush': {
          build: {
            auth: {
              host: 'ftp.geoffgraham.me',
              port: 21,
              authKey: 'key1'
            },
            src: '/Users/Geoffrey/Sites/GeoffGraham',
            dest: '/',
            exclusions: [
              '**/.DS_Store',
              '**/Thumbs.db',
              '**/.htaccess',
              '**/.git/',
              '**/.git*',
              '**/humans.txt*',
              '**/.ftppass',
              '**/local-config.php',
              '**/codekit-config.json',
              '**/config.codekit',
              '**/config.rb',
              '**/Gruntfile.js',
              '**/node_modules',
              '**/bower_components',
              '**/package.json',
              '**/.scss',
              '**/.sass-cache',
              'tmp',
              'wp-content/themes/GeoffGrahamFour/lib/styles/scss',
              'wp-content/themes/GeoffGrahamFour/.codekit-cache',
              'wp-content/cache',
              'wp-content/w3tc-config',
              'wp-content/uploads',
              'wp-content/advanced-cache.php',
              'wp-content/object-cache.php',
              'wp-content/db.php',
            ],
            keep: [
              '/**/campaign-monitor',
              '/**/campaign-monitor/*',
              '/**/clients',
              '/**/clients/*',
              '/**/css',
              '/**/css/*.css',
              '/**/download*',
              '/*robots.txt',
              '/google33c8401f58d9df7a.html',
              'tumblr/*',
              'z_*',
              '*.htaccess',
              '*.jpg',
              '*.svg',
              '*.png',
              '*.gif',
              '*.ico',
              '*.html',
              '*.css',
              '*.php'
            ],
            simple: true
          }
        }
 
    });
 
    // register task
    grunt.registerTask('deploy', ['ftpush']);
 
};
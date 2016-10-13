module.exports = function(grunt) {

  'use strict';

  // Load Grunt tasks declared in the package.json file
  require('load-grunt-tasks')(grunt);

  // Project settings
  var config = {
    wordpress: './',
    folder_qa: 'lcf',
    folder_staging: 'lcv-staging'
  };

  // Configure Grunt
  grunt.initConfig({

    // Project settings
    config: config,
    // Push everything to FTP server
    'sftp-deploy': {
      staging: {
        auth: {
          host: '104.131.56.124',
          port: 2200,
          authKey: 'key1' // Config credentials in .ftppass file
        },
        cache: 'sftpCache.json',
        src: '<%= config.wordpress %>',
        dest: '/html/<%= config.folder_staging %>',
        exclusions: ['ui', 'db', 'node_modules', '.*'],
        concurrency: 4,
        progress: true
      },
      qa: {
        auth: {
          host: '104.131.56.124',
          port: 2200,
          authKey: 'key1' // Config credentials in .ftppass file
        },
        cache: 'sftpCache.json',
        src: '<%= config.wordpress %>',
        dest: '/html/<%= config.folder_qa %>',
        exclusions: ['ui', 'db', 'node_modules', '.*'],
        concurrency: 4,
        progress: true
      }
    }
  });

  grunt.loadNpmTasks('grunt-sftp-deploy');


  /* ====================================================================================== */
  /* Tasks @registration                                                                    */
  /* ====================================================================================== */

  grunt.registerTask('deploy:staging', [
    'sftp-deploy:staging'
  ]);

  grunt.registerTask('deploy:qa', [
    'sftp-deploy:qa'
  ]);
};

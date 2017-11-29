var gulp = require('gulp'),
    configLocal = require('./gulp-config.json'),
    merge       = require('merge'),
    readme      = require('gulp-readme-to-markdown'),
    browserSync = require('browser-sync').create();

var configDefault = {},
  config = merge(configDefault, configLocal);


gulp.task('readme', function() {
  return gulp.src('readme.txt')
    .pipe(readme({
      details: false,
      screenshot_ext: []
    }))
    .pipe(gulp.dest('.'));
});

// Rerun tasks when files change
gulp.task('watch', function() {
  if (config.sync) {
    browserSync.init({
        proxy: {
          target: config.target
        }
    });
  }

  gulp.watch('./**/*.php').on('change', browserSync.reload);
});

// Default task
gulp.task('default', ['readme']);

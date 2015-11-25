var gulp, coffee, concat, uglify, rename, jade, stylus, webpack, gutil, paths;
gulp = require('gulp');

coffee = require('gulp-coffee');
concat = require('gulp-concat');
uglify = require('gulp-uglify');
rename = require('gulp-rename');
stylus = require('gulp-stylus');
webpack = require('webpack');
gutil   = require('gulp-util');

paths = {};
paths.stylus      = ['source/stylus/main.styl'];
paths.stylusWatch = ['source/stylus/**/*.styl'];
paths.js          = ['source/js/**/*.js'];
paths.coffee      = ['source/js/**/*.coffee'];
paths.smarty      = ['../application/views/**/*.tpl'];
paths.webpack = [
  paths.smarty,
  paths.js,
  paths.coffee
];

gulp.task('stylus', function() {
  return gulp.src(paths.stylus)
    .pipe(stylus())
    .on('error', console.log)
    .pipe(concat('all.css'))
    .pipe(gulp.dest('../styles'));
});

gulp.task('stylus-min', function() {
  return gulp.src(paths.stylus)
    .pipe(stylus({compress: true}))
    .on('error', console.log)
    .pipe(concat('all.min.css'))
    .pipe(gulp.dest('../styles'));
});

gulp.task("webpack", function (callback) {
  var config = require('./webpack.config');
  webpack(config, function (err, stats) {
    if (err) throw new gutil.PluginError("webpack", err);
    gutil.log("[webpack]", stats.toString({colors: true}));
    callback();
  });
});

gulp.task('watch', function() {
  gulp.watch(paths.webpack, ['webpack']);
  gulp.watch(paths.stylusWatch, ['stylus']);
  gulp.watch(paths.stylusWatch, ['stylus-min']);
});

gulp.task('default', ['stylus', 'stylus-min', 'webpack', 'watch']);
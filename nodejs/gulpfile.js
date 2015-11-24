var gulp, coffee, concat, uglify, rename, jade, stylus, webpack, gutil;
gulp = require('gulp');

coffee = require('gulp-coffee');
concat = require('gulp-concat');
uglify = require('gulp-uglify');
rename = require('gulp-rename');
jade = require('gulp-jade');
stylus = require('gulp-stylus');
webpack = require('webpack');
gutil   = require('gulp-util');

var paths = {
  coffee: ['source/coffee/**/*.coffee'],
  stylus: ['source/stylus/main.styl'],
  stylusWatch: ['source/stylus/**/*.styl'],
  jade: ['source/jade/**/*.jade'],
  js: ['source/js/**/*.js'],
  smarty: ['../application/views/**/*.tpl']
};

//stylus: ['source/stylus/**/*.styl'],

gulp.task('coffee', function() {
  // Minify and copy all JavaScript (except vendor scripts)
  return gulp.src(paths.coffee)
    .pipe(coffee())
    .on('error', console.log)
    .pipe(concat('all.js'))
    .pipe(gulp.dest('build/js'))
    .pipe(rename('all.min.js'))
    .pipe(uglify())
    .pipe(gulp.dest('build/js'));
});

gulp.task('stylus', function() {
  // Minify and copy all JavaScript (except vendor scripts)
  return gulp.src(paths.stylus)
    .pipe(stylus())
    .on('error', console.log)
    .pipe(concat('all.css'))
    .pipe(gulp.dest('../styles'));
});

gulp.task('stylus-min', function() {
  // Minify and copy all JavaScript (except vendor scripts)
  return gulp.src(paths.stylus)
    .pipe(stylus({compress: true}))
    .on('error', console.log)
    .pipe(concat('all.min.css'))
    .pipe(gulp.dest('../styles'));
});

gulp.task('jade', function() {
  var LOCALS = {
    pretty: false
  };
  // Minify and copy all JavaScript (except vendor scripts)
  return gulp.src(paths.jade)
    .pipe(jade({
      pretty: false
    }))
    .on('error', console.log)
    .pipe(gulp.dest('build/'));
});


gulp.task("webpack", function (callback) {
  var config = require('./webpack.config');
  webpack(config, function (err, stats) {
    if (err) throw new gutil.PluginError("webpack", err);
    gutil.log("[webpack]", stats.toString(), {colors: true});
    callback();
  });
});


// Rerun the task when a file changes
gulp.task('watch', function() {
  //gulp.watch(paths.coffee, ['coffee']);
  gulp.watch(paths.smarty, ['webpack']);
  gulp.watch(paths.js, ['webpack']);
  gulp.watch(paths.stylusWatch, ['stylus']);
  gulp.watch(paths.stylusWatch, ['stylus-min']);
  //gulp.watch(paths.jade, ['jade']);
});

// The default task (called when you run `gulp` from cli)
gulp.task('default', ['stylus', 'stylus-min', 'webpack', 'watch']);
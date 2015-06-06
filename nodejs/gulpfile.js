var gulp = require('gulp');

var coffee = require('gulp-coffee');
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
var rename = require('gulp-rename');
var jade = require('gulp-jade');
var stylus = require('gulp-stylus');

var paths = {
  coffee: ['source/coffee/**/*.coffee'],
  stylus: ['source/stylus/main.styl'],
  stylusWatch: ['source/stylus/**/*.styl'],
  jade: ['source/jade/**/*.jade']
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

// Rerun the task when a file changes
gulp.task('watch', function() {
  //gulp.watch(paths.coffee, ['coffee']);
  gulp.watch(paths.stylusWatch, ['stylus']);
  gulp.watch(paths.stylusWatch, ['stylus-min']);
  //gulp.watch(paths.jade, ['jade']);
});

// The default task (called when you run `gulp` from cli)
gulp.task('default', ['stylus', 'stylus-min', 'watch']);
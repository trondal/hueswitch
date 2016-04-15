var gulp = require('gulp');
var concat = require('gulp-concat');
var $    = require('gulp-load-plugins')();

var sassPaths = [
  './bower-components/foundation-sites/scss'  
];

gulp.task('scripts', function() {
  return gulp.src([
      './bower_components/jquery/dist/jquery.min.js',
      './bower_components/what-input/what-input.min.js',
      './bower_components/foundation-sites/dist/foundation.min.js'
    ])
    .pipe(concat({ path: 'script.js'}))
    .pipe(gulp.dest('./src/HueSwitchBundle/Resources/public/js'));
});

gulp.task('sass', function() {
  return gulp.src('./src/HueSwitchBundle/Resources/scss/main.scss')
    .pipe($.sass({
      includePaths: sassPaths
    })
    .on('error', $.sass.logError))
    .pipe($.autoprefixer({
      browsers: ['last 2 versions', 'ie >= 9']
    }))
    .pipe(gulp.dest('./src/HueSwitchBundle/Resources/public/css'));
});

gulp.task('default', ['sass', 'scripts'], function() {
  gulp.watch(['./src/HueSwitchBundle/Resources/public/scss/main.scss'], ['sass', 'scripts']);
});
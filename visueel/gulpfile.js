var gulp 		= require('gulp');
var gutil 		= require('gulp-util');
var browserify  = require('browserify');
var source 		= require('vinyl-source-stream');
var jshint 		= require('gulp-jshint');
var stylish 	= require('jshint-stylish');
var uglify 		= require('gulp-uglify');
var buffer 		= require('vinyl-buffer');
var sourcemaps  = require('gulp-sourcemaps');
var compass = require('gulp-compass');
var path = require('path');
var minifyCSS = require('gulp-minify-css');
var rename = require('gulp-rename');

gulp.task('default', ['compass'], function(){
	var csswatcher = gulp.watch('./_scss/**/*.scss', ['compass']); 
});

gulp.task('compass', function() {
  return gulp.src('_scss/**/*.scss')
    .pipe(compass({
      config_file: './config.rb',
      css: 'css',
      sass: '_scss'
    }))
    .pipe(gulp.dest('css'))
    .pipe(rename({ suffix: '.min' }))
    .pipe(minifyCSS())
	.pipe(gulp.dest('css'));

});


















var gulp = require('gulp');
var sass = require('gulp-sass');
var autoprefixer = require('gulp-autoprefixer');

gulp.task('sass', function () {
  return gulp.src('dev/sass/frontsite/*.scss')
    .pipe(sass({'errLogToConsole': true}))
    .on('error', error)
	.pipe(autoprefixer({cascade: false, browsers: ['> 2%']}))
	.on('error', error)
    .pipe(gulp.dest('frontsite/assets/css'));
});

gulp.task('default', function(){
    gulp.watch('dev/sass/frontsite/*.scss', ['sass']);
});

function error(error) {
  console.log(error.toString());
  this.emit('end');
}

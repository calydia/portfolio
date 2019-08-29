var gulp = require("gulp"),
  livereload = require("gulp-livereload"),
  sass = require("gulp-sass"),
  uglify = require("gulp-uglify"),
  autoprefixer = require("gulp-autoprefixer"),
  imagemin = require("gulp-imagemin"),
  pngquant = require("imagemin-pngquant"),
  concat = require("gulp-concat");

gulp.task("imagemin", function() {
  return gulp
    .src("./src/images/*")
    .pipe(
      imagemin({
        progressive: true,
        svgoPlugins: [{ removeViewBox: false }],
        use: [pngquant()]
      })
    )
    .pipe(gulp.dest("./images"));
});

gulp.task("sass", function() {
  return gulp
    .src("./src/sass/**/*.scss")
    .pipe(sass({ outputStyle: "compressed" }).on("error", sass.logError))
    .pipe(autoprefixer("last 2 version"))
    .pipe(concat("styles.css"))
    .pipe(gulp.dest("./css"));
});

gulp.task("jsuglify", function() {
  return gulp
    .src(["./src/js/*.js"])
    .pipe(uglify())
    .pipe(gulp.dest("./js/"));
});

gulp.task("watch", function() {
  livereload.listen();

  gulp.watch("./src/sass/**/*.scss", gulp.series("sass"));
  gulp.watch("./src/js/**/*.js", gulp.series("jsuglify"));
  gulp.watch(["./css/style.css", "./**/*.html.twig", "./js/*.js"], function(
    files
  ) {
    livereload.changed(files);
  });
});

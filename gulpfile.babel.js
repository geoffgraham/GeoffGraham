import { src, dest, watch, series, parallel } from 'gulp';
import yargs from 'yargs';
import sass from 'gulp-sass';
import cleanCss from 'gulp-clean-css';
import postcss from 'gulp-postcss';
import sourcemaps from 'gulp-sourcemaps';
import autoprefixer from 'autoprefixer';
import webpack from 'webpack-stream';
import imagemin from 'gulp-imagemin';
import browserSync from "browser-sync";

const PRODUCTION = yargs.argv.prod;
const server = browserSync.create();
export const serve = done => {
  server.init({
    proxy: "http://geoff.dev"
  });
  done();
};
export const reload = done => {
  server.reload();
  done();
};

export const styles = () => {
  return src(['src/scss/style.scss'])
    .pipe(sass().on('error', sass.logError))
    .pipe(postcss([ autoprefixer ]))
    .pipe(cleanCss({compatibility:'ie11'}))
    .pipe(sourcemaps.write())
    .pipe(dest('dist/css'))
    .pipe(server.stream());
}

export const scripts = () => {
  return src('src/js/scripts.js')
  .pipe(webpack({
    module: {
      rules: [
        {
          test: /\.js$/,
          use: {
            loader: 'babel-loader',
            options: {
              presets: []
            }
          }
        }
      ]
    },
    mode: PRODUCTION ? 'production' : 'development',
    devtool: !PRODUCTION ? 'inline-source-map' : false,
    output: {
      filename: 'scripts.js'
    },
  }))
  .pipe(dest('dist/js'));
}

export const images = () => {
  return src('src/img/**/*.{jpg,jpeg,png,gif}')
    .pipe(imagemin())
    .pipe(dest('dist/img'));
}

// SVG Sprite
export const svg = () => {
	var svgSprite = require('gulp-svg-sprite');
	var gulp = require('gulp'),
	config = {
		shape: {
			dest: 'dist/img'
		},
		mode: {
			dest: 'dist/img',
			symbol: true,
			inline: true,
			bust: true
		},
		svg: {
			spriteWidth: 0,
			spriteHeight: 0,
			xmlDeclaration: false,
			doctypeDeclaration: false,
		},
	};
	return gulp.src('**/*.svg', { cwd: 'src/img/icons' })
  .pipe(svgSprite(config))
  .pipe(gulp.dest('.'));
}

export const watchForChanges = () => {
  watch('src/scss/**/*.scss', series(styles, reload));
  watch('src/img/**/*.{jpg,jpeg,png,gif}', series(images, reload));
	watch('src/img/icons/**/*.{svg}', series(svg, reload));
	watch(['src/**/*','!src/{img,js,scss}','!src/{img,js,scss}/**/*'], series(reload));
  watch('src/js/**/*.js', series(scripts, reload));
  watch("**/*.php", reload);
}

export const dev = series(parallel(styles, images, scripts), serve, watchForChanges, reload);

export const build = done => {
	series(parallel(styles, images, scripts));
	done();
};

export default dev;
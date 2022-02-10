/**
 *
 * Gulp Plugins
 *
 */
const gulp = require("gulp");
const plugins = require("gulp-load-plugins")({
    pattern: ["gulp-*", "gulp.*", "del", "fs"]
});
const env = require("dotenv").config();
const browserSync = require("browser-sync");
const server = browserSync.create();
const rename = require("gulp-rename");
const htmlmin = require('gulp-htmlmin');

const path = {
    src: "./resources",
    dist: "./dist",
    css: {
        src: "./resources/scss",
        dest: "./dist/css"
    },
    fonts: {
        src: "./resources/fonts",
        dest: "./dist/fonts"
    },
    js: {
        src: "./resources/js",
        dest: "./dist/js"
    },
    img: {
        src: "./resources/img",
        dest: "./dist/img"
    },
    php: {
        src: "./resources/views"
    },
    html: {
        src: "./resources/views/**/*.html",
        dest: "./dist/html"
    }
};

/**
 *
 * Task: Browser Sync
 *
 * - Watch for file changes in dist folder
 * - Watch for a php file change
 * - Update browsers
 *
 */
function reload(done) {
    server.reload();
    done();
}
exports.reload = reload;

function sync(done) {
    done();
    server.init({
        proxy: process.env.HOST,
        notify: false,
        files: [
            `${path.css.dest}/app.min.css`,
            `${path.css.dest}/modules/**/*.min.css`,
            `${path.js.dest}/modules/**/*.min.js`,
            `${path.js.dest}/app.min.js`,
            `${path.img.dest}/**.*`,
            `${path.src}/modules/**/*.scss`,
            `${path.src}/modules/**/*.js`
        ]
    });
}
exports.sync = sync;

/**
 *
 * Task: Styles
 *
 * - Sourcemap
 * - Combine
 * - Concat
 * - Minify
 * - Sync browsers
 *
 */
function css() {
    return gulp
        .src([`${path.css.src}/app.scss`, `${path.css.src}/editor-styles.scss`, `${path.css.src}/login.scss`])
        .pipe(plugins.sourcemaps.init())
        .pipe(plugins.sassGlob())
        .pipe(plugins.sass())
        .pipe(plugins.postcss([
            require('postcss-custom-media'),
            require('postcss-easing-gradients'),
            require('autoprefixer'),
            require('cssnano')
        ]))
        .pipe(plugins.sourcemaps.write())
        .pipe(rename({
            suffix: '.min'
        }))
        .pipe(gulp.dest(path.css.dest))
        .pipe(browserSync.stream());
}
exports.css = css;

function cssModules() {
    return gulp
        .src([`${path.src}/modules/**/*.scss`])
        .pipe(plugins.sourcemaps.init())
        .pipe(plugins.sassGlob())
        .pipe(plugins.sass())
        .pipe(plugins.postcss([
            require('postcss-custom-media'),
            require('postcss-easing-gradients'),
            require('autoprefixer'),
            require('cssnano')
        ]))
        .pipe(rename({
            suffix: '.min'
        }))
        .pipe(plugins.sourcemaps.write())
        .pipe(gulp.dest(`${path.css.dest}/modules/`))
        .pipe(browserSync.stream());
}
exports.css = cssModules;

/**
 *
 * Task: Scripts
 *
 * - Sourcemap
 * - Modernizr
 * - Combine
 * - Concat
 * - Minify
 * - Sync browsers
 *
 */
function js() {
    return gulp
        .src(`${path.js.src}/*.js`)
        .pipe(
            plugins.babel({
                presets: ["@babel/preset-env"]
            })
        )
        .pipe(plugins.terser())
        .pipe(rename({
            suffix: '.min'
        }))
        .pipe(gulp.dest(path.js.dest));
}
exports.js = js;

function jsModule() {
    return gulp
        .src([`${path.src}/modules/**/*.js`,`!${path.src}/modules/**/node_modules/**/*.js`])
        .pipe(
            plugins.babel({
                presets: ["@babel/preset-env"]
            })
        )
        .pipe(plugins.terser())
        .pipe(rename({
            suffix: '.min'
        }))
        .pipe(gulp.dest(`${path.js.dest}/modules/`))
}
exports.js = jsModule;

/**
 *
 * Task: Images
 *
 * - Get gif, jpg and png files and optimize them
 *
 */
function img() {
    return gulp
        .src([
            `${path.img.src}/**/*.png`,
            `${path.img.src}/**/*.gif`,
            `${path.img.src}/**/*.jpg`,
            `${path.img.src}/**/*.jpeg`,
            `${path.img.src}/**/*.svg`
        ])
        .pipe(plugins.image({
            pngquant: true,
            optipng: true,
            zopflipng: true,
            jpegRecompress: true,
            mozjpeg: true,
            gifsicle: true,
            svgo: false,
            concurrent: 10,
            quiet: true // defaults to false
        }))
        .pipe(gulp.dest(path.img.dest))
        .pipe(browserSync.stream());
}
exports.img = img;

/**
 *
 * Task: HTML
 *
 */
function html() {
    return gulp
        .src([
            `${path.html.src}`,
        ])
        .pipe(htmlmin({ collapseWhitespace: true, conservativeCollapse: true, removeTagWhitespace: true }))
        .pipe(gulp.dest(path.html.dest))
        .pipe(browserSync.stream());
}
exports.html = html;

/**
 *
 * Task: Fonts
 *
 */
function localFonts() {
    return gulp
        .src([
            `${path.fonts.src}/**/*.eot`,
            `${path.fonts.src}/**/*.otf`,
            `${path.fonts.src}/**/*.ttf`,
            `${path.fonts.src}/**/*.woff`,
            `${path.fonts.src}/**/*.woff2`
        ])
        .pipe(gulp.dest(path.fonts.dest))
        .pipe(browserSync.stream());
}
exports.localFonts = localFonts;

/**
 *
 * Task: Google Fonts
 *
 */
function googleFonts() {
    return gulp
        .src("./fonts.list")
        .pipe(plugins.googleWebfonts({}))
        .pipe(gulp.dest(path.fonts.dest));
}
exports.googleFonts = googleFonts;

/**
 *
 * Task: Clean
 *
 * - Delete dist folder
 *
 */
function clean() {
    return plugins.del([`${path.dist}/**`]);
}
exports.clean = clean;

/**
 *
 * Task: Watch
 *
 * - Watch file changes and start corresponding tasks
 *
 */
// Watch files
function watchFiles() {
    gulp.watch(`${path.css.src}/**/*.scss`, css);
    gulp.watch(`${path.src}/modules/**/*.scss`, cssModules);
    gulp.watch(`${path.js.src}/**/*.js`, js);
    gulp.watch(`${path.src}/modules/**/*.js`, jsModule);
    gulp.watch(`${path.img.src}/**/*.*`, img);
    gulp.watch(`${path.html.src}`, html);
    gulp.watch(`${path.fonts.src}/**/*.*`, localFonts);
    gulp.watch("fonts.list", googleFonts);
}
exports.watchFiles = watchFiles;

// Complex tasks
const fonts = gulp.parallel(localFonts, googleFonts);
const build = gulp.series(
    clean,
    gulp.parallel(css, cssModules, html, img, js, jsModule, googleFonts, localFonts)
);
const buildDev = gulp.series(
    clean,
    gulp.parallel(css, cssModules, html, img, js, jsModule, googleFonts, localFonts)
);
const watch = gulp.parallel(watchFiles, sync);
const dev = gulp.series(buildDev, watch);

// Export tasks
exports.build = build;
exports.default = dev;
exports.fonts = fonts;
exports.watch = watch;

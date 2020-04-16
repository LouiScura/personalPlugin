'use strict';

//Load gulp only with all default names that we're actually using
const { src, dest, task,  watch, series} = require('gulp'); 

/*
    CSS related plugins 
*/
var sass = require('gulp-sass')
var autoprefixer = require('gulp-autoprefixer');
var rename = require('gulp-rename');

/*
    JS realted plugins 
*/
var uglify = require('gulp-uglify');
var browserify = require('browserify');
var babelify = require('babelify');
var source = require('vinyl-source-stream');
var buffer = require('vinyl-buffer');

/*
    OTHERS plugins
*/
var notify = require('gulp-notify');
var sourcemaps = require('gulp-sourcemaps');

/*
    PLUGIN PATHS
*/
var styleSRC = 'src/scss/mystyle.scss';
var styleURL = './assets/';
var mapURL = './';
var jsSRC  = 'script.js';
var jsURL = './assets/';
var jsFolder = './src/js/'
var jsFiles = [ jsFolder ];

/*
    GULP WATCH PATHS
*/
var styleWatch = 'src/scss/**/*.scss'; //look for all the .scss files
var jsWatch = 'src/js/**/*.js' //look for all the .js files
var phpWatch = './**/*.php';

/*
Browers related plugins
var browserSync  = require( 'browser-sync' ).create();
var reload = browserSync.reload;
function browser_sync(){
    browserSync.init({
        server: {
            baseDir: "./"
        }
    });
};
*/

/*
    FUNCTIONS TASKS
*/ 
function style( done ){
    src( styleSRC ) //look for the main style file
        .pipe( sourcemaps.init() ) // which file your original minified code comes from
        .pipe( sass({
            errLogToConsole: true,
            outputStyle: 'compressed'
        }) )
        .on('error', console.error.bind( console ))//check if there's any error
        .pipe( autoprefixer({
            overrideBrowserslist: [ 'last 2 versions', '> 5%', 'Firefox ESR' ],
            cascade: false
        }) )
        .pipe( rename({ suffix: '.min' })) // minified the file
        .pipe( sourcemaps.write( mapURL )) //specified where the css variables are coming from
        .pipe( dest( styleURL )); //push compiled and minified style
    done();
};

function js( done ){
    jsFiles.map(function( entry ){
        return browserify({
            entries: [ entry + jsSRC ] // handdle the modules, import modules on our main script
        })
        .transform( babelify, { presets:[ '@babel/preset-env' ] } ) // convert es6 to regular vanilla js    
        .bundle() // everything we did above inside one single file
        .pipe( source( jsSRC ) )
        .pipe( rename( { extname: '.min.js' } ) ) //another option to rename
        .pipe( buffer()) //important to store the file compiled all together
        .pipe(sourcemaps.init({
            loadMaps: true 
        }))
        .pipe( uglify()) //minifed the entire file
        .pipe(sourcemaps.write( mapURL ))
        .pipe( dest( jsURL ) )
    });
    done();
};  

function files( done ){
    src( jsURL + 'script.min.js' )
        .pipe( notify({ message: ' Assets Compiled! '}));
    done();
};
 
function watch_files( done ){
    // watch( phpWatch, reload );
    watch( styleWatch, series('style') ), //if an update or change happen is gonna trigger style task
    watch( jsWatch, series('js') );
    src( jsURL + 'script.min.js' )
        .pipe( notify({ message: ' Gulp is watching! '}));
};

/*
   GULP TASKS
*/
task('style', style);
task('js', js);
task('default', series('js','style', files));
task('watch', watch_files);






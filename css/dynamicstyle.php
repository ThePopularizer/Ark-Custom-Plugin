<?php if ( !function_exists('get_field')) return;
$textshadow='text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.4);';
$boxshadow='-moz-box-shadow: 0px 1px 4px rgba(0, 0, 0, 0.3); -webkit-box-shadow: 0px 1px 4px rgba(0, 0, 0, 0.3); box-shadow: 0px 1px 4px rgba(0, 0, 0, 0.3);';
$primary_colour=get_field('primary_theme_colour', 'option');

if ($primary_colour) {
  $primary=$primary_colour;
}

else {
  $primary='#337ab7';
}
 ?>
 @font-face {
   font-family: 'fontello';
   src: url('/wp-content/plugins/custom/font/fontello.woff?88778747');
   font-weight: normal;
   font-style: normal;
 }

.ct-section a {
  transition-duration: 0.2s;
}

 [class^="fa-"]:before, [class*=" fa-"]:before {
  font-family: "fontello";
  font-style: normal;
  font-weight: normal;
  speak: none;

  display: inline-block;
  text-decoration: inherit;
  width: 1em;
  margin-right: .2em;
  text-align: center;
  /* opacity: .8; */

  /* For safety - reset parent styles, that can break glyph codes*/
  font-variant: normal;
  text-transform: none;

  /* fix buttons height, for twitter bootstrap */
  line-height: 1em;

  /* Animation center compensation - margins should be symmetric */
  /* remove if not needed */
  margin-left: .2em;

  /* you can be more comfortable with increased icons size */
  /* font-size: 120%; */

  /* Font smoothing. That was taken from TWBS */
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
}

.fa-envelope-o:before { content: '\e800'; } /* '' */
.fa-phone:before { content: '\e801'; } /* '' */
.fa-user:before { content: '\e802'; } /* '' */
.fa-users:before { content: '\e803'; } /* '' */
.fa-globe:before { content: '\e804'; } /* '' */
.fa-pencil:before, .fa-pencil-square-o:before { content: '\e805'; } /* '' */
.fa-edit:before { content: '\e806'; } /* '' */
.fa-comment:before { content: '\e807'; } /* '' */
.fa-home:before { content: '\e808'; } /* '' */
.fa-search:before { content: '\e809'; } /* '' */
.fa-cogs:before { content: '\e80a'; } /* '' */
.fa-cog:before { content: '\e80b'; } /* '' */
.fa-pinterest-square:before { content: '\f0d3'; } /* '' */
.fa-angle-left:before { content: '\f104'; } /* '' */
.fa-angle-right:before { content: '\f105'; } /* '' */
.fa-angle-up:before { content: '\f106'; } /* '' */
.fa-angle-down:before { content: '\f107'; } /* '' */
.fa-mobile:before { content: '\f10b'; } /* '' */
.fa-direction:before, .fa-location-arrow:before { content: '\f124'; } /* '' */
.fa-youtube-square:before { content: '\f166'; } /* '' */
.fa-instagram:before { content: '\f16d'; } /* '' */
.fa-skype:before { content: '\f17e'; } /* '' */
.fa-fax:before { content: '\f1ac'; } /* '' */
.fa-whatsapp:before { content: '\f232'; } /* '' */
.fa-map-o:before { content: '\f278'; } /* '' */
.fa-twitter-square:before { content: '\f304'; } /* '' */
.fa-linkedin-square:before { content: '\f30c'; } /* '' */
.fa-facebook:before, .fa-facebook-square:before { content: '\f30e'; } /* '' */
.sr-only { display: none; }

 <?php

$custom_colour_top_header=get_field('custom_top_header_colour', 'option');
$custom_colour_header=get_field('custom_header_colour', 'option');
$custom_colour_footer=get_field('custom_footer_colour', 'option');
$scroll_top_header=get_field('scroll_top_header', 'option');
$texture=get_field('texture', 'option');
$apply_texture_top=get_field('apply_texture_top_header', 'option');
$apply_texture_header=get_field('apply_texture_header', 'option');
$apply_texture_footer=get_field('apply_texture_footer', 'option');
$apply_texture_ui=get_field('apply_texture_ui', 'option');

if ($texture) {
  ?><?php if ($apply_texture_top) {
    ?>#top-header, <?php
  }

  ?><?php if ($apply_texture_header) {
    ?>#main-header, .sub-menu, <?php
  }

  ?><?php if ($apply_texture_footer) {
    ?>#main-footer, #credits-footer, <?php
  }

  ?><?php if ($apply_texture_ui) {
    ?>.breadcrumb, .panel-heading, .input-group-addon, .well, .panel-footer, .post-taxonomy, <?php
  }

  ?>.texture {
    background-image: url('<?php
echo $texture;
    ?>')!important;
background-size: auto;
  }

  <?php
}

?> .btn {
  border: 2px solid <?php echo $primary;
  ?>;
  border-radius: 7px;
  color: <?php echo $primary;
  ?>;
  padding: 10px 20px;
}
.btn-sm {
  padding: 4px 10px;
}

.btn:hover {
  background-color: <?php echo $primary;
  ?>;
  color: white;
}

/* Top Header */
<?php $page_style=get_field('top_header_style');
$default_style=get_field('default_top_header_style', 'option');

if (($page_style && $page_style !=='default')) {
  $option=$page_style;
  echo '/* HEADER OPTION: '. $option . '*/';
}

elseif ($default_style) {
  $option=$default_style;
}

if ($option=='dark'|| $option=='') {
  $background_solid='#3a3a3a';
  $background_translucent='rgba(0, 0, 0, 0.45)';

  if ($scroll_top_header) {
    $background_solid='#1d1d1d';
    $background_translucent='rgba(0, 0, 0, 0.8)';
  }

  $colour='#ededed';
  $colour_hover='#ffffff';
}

elseif ($option=='light') {
  $background_solid='#fff';
  $background_translucent='rgba(255, 255, 255, 0.7)';
  $colour='#5a5a5a';
  $colour_hover=$primary;
  $textshadow='';
}

elseif ($option=='transparent') {
  $background_solid='transparent';
  $background_translucent='transparent';
  $colour='rgba(255,255,255,0.75)';
  $colour_hover='#fff';
}

if ($custom_colour_top_header) {
  $background_solid=$custom_colour_top_header;
  $background_translucent=$custom_colour_top_header;
}

?>#header-wrapper:not(.oxy-sticky-header-active) #top-header {
  background-color: <?php echo $background_solid;
  ?> !important;
  background-color: <?php echo $background_translucent;
  ?> !important;
}

#header-wrapper:not(.oxy-sticky-header-active) #top-header {
  background-color: <?php echo $background_solid;
  ?>;
  background-color: <?php echo $background_translucent;
  ?>;
}

#header-wrapper:not(.oxy-sticky-header-active) #top-header, #header-wrapper:not(.oxy-sticky-header-active) #top-header a {
  color: <?php echo $colour;
  ?>;
  <? echo $textshadow;
  ?>
}

#header-wrapper:not(.oxy-sticky-header-active) #top-header a:hover {
  color: <?php echo $colour_hover;
  ?>;
}

/* Navigation Header */
<?php $page_style=get_field('header_style');
$default_style=get_field('default_header_style', 'option');

if (($page_style && $page_style !=='default')) {
  $option=$page_style;
  echo '/* HEADER OPTION: '. $option . '*/';
}

elseif ($default_style) {
  $option=$default_style;
}

if ($option=='dark'|| $option=='') {
  $background_solid='#3a3a3a';
  $background_translucent='rgba(0, 0, 0, 0.32)';
  $background_hover='rgba(0, 0, 0, 0.1)';
  $background_hover_sub='rgba(0, 0, 0, 0.2)';
  $hover_background_solid='#373737';
  $hover_background_translucent='rgba(0, 0, 0, 0.5)';
  $responsive_background_translucent='rgba(0, 0, 0, 0.7)';
  $colour='#ededed';
  $colour_hover='#ffffff';
}

elseif ($option=='light') {
  $background_solid='#fff';
  $background_translucent='rgba(255, 255, 255, 0.61)';
  $background_hover='rgba(255, 255, 255, 0.7)';
  $hover_background_solid='#fff';
  $hover_background_translucent='rgba(255, 255, 255, 0.8)';
  $responsive_background_translucent='rgba(255, 255, 255, 0.8)';
  $colour='#454545';
  $colour_hover=$primary;
  $textshadow='';
}

elseif ($option=='transparent') {
  $background_solid='transparent';
  $background_translucent='transparent';
  $background_hover='rgba(255, 255, 255, 0.75)';
  $hover_background_solid='#fff';
  $hover_background_translucent='rgba(255, 255, 255, 0.8)';
  $responsive_background_translucent='rgba(255, 255, 255, 0.8)';
  $colour='rgba(255,255,255,0.75)';
  $colour_hover='#fff';
  $boxshadow='';
}

  $background = $hover_background_translucent;
  $text = $colour;

if ($custom_colour_header) {
  $background_solid=$custom_colour_header;
  $background_translucent=$custom_colour_header;
  $hover_background_solid=$custom_colour_header;
  $hover_background_translucent=$custom_colour_header;
}

?>#header-wrapper:not(.oxy-sticky-header-active) #main-header {
  background-color: <?php echo $background_solid;
  ?> !important;
  background-color: <?php echo $background_translucent;
  ?> !important;
  <?php echo $boxshadow;
  ?>
}

#header-wrapper:not(.oxy-sticky-header-active) #main-header:hover, #header-wrapper #main-header .oxy-nav-menu:not(.oxy-nav-menu-open) .sub-menu {
  background-color: <?php echo $background_solid;
  ?>;
  background-color: <?php echo $hover_background_translucent;
  ?>;
  <?php echo $boxshadow;
  ?>
}

#header-wrapper:not(.oxy-sticky-header-active) #main-header #logo-heading {
  color: <?php echo $colour;
  ?>;
}

#header-wrapper:not(.oxy-sticky-header-active) #main-header:hover {
  background-color: <?php echo $hover_background_solid;
  ?>;
  background-color: <?php echo $hover_background_translucent;
  ?>;
  <?php echo $boxshadow;
  ?>
}

#header-wrapper:not(.oxy-sticky-header-active) #main-header .oxy-nav-menu:not(.oxy-nav-menu-open), #header-wrapper:not(.oxy-sticky-header-active) #main-header .oxy-nav-menu:not(.oxy-nav-menu-open) a {
  <?php echo $textshadow;
  ?>color: <?php echo $colour;
  ?>;
}

#header-wrapper:not(.oxy-sticky-header-active) #main-header .oxy-nav-menu-hamburger-line {
  background-color: <?php echo $colour;
  ?>;
}

#header-wrapper:not(.oxy-sticky-header-active) #main-header, #header-wrapper:not(.oxy-sticky-header-active) #main-header .oxy-nav-menu:not(.oxy-nav-menu-open) .sub-menu .menu-item:hover a {
  background-color: <?php echo $background_hover_sub;
  ?>;
}

#header-wrapper #main-header .oxy-nav-menu:not(.oxy-nav-menu-open) #menu-main>.menu-item>a {
  border-top: none !important;
  vertical-align: middle;
  -webkit-transform: translateZ(0);
  transform: translateZ(0);
  box-shadow: 0 0 1px rgba(0, 0, 0, 0);
  -webkit-backface-visibility: hidden;
  backface-visibility: hidden;
  -moz-osx-font-smoothing: grayscale;
  position: relative;
  overflow: hidden;
}

#header-wrapper #main-header .oxy-nav-menu:not(.oxy-nav-menu-open) #menu-main>.menu-item>a:before {
  background-color: <?php echo $primary;
  ?>;
  content: "";
  position: absolute;
  z-index: -1;
  left: 50%;
  right: 50%;
  top: 0;
  height: 3px;
  -webkit-transition-property: left, right;
  transition-property: left, right;
  -webkit-transition-duration: 0.3s;
  transition-duration: 0.3s;
  -webkit-transition-timing-function: ease-out;
  transition-timing-function: ease-out;
}

#header-wrapper #main-header .oxy-nav-menu:not(.oxy-nav-menu-open) #menu-main>.menu-item:hover>a:before {
  left: 0!important;
  right: 0!important;
}

#header-wrapper #main-header .oxy-nav-menu:not(.oxy-nav-menu-open) #menu-main > .menu-item > .sub-menu {
  border-top: 3px solid <?php echo $primary; ?>;
}

#header-wrapper #main-header .oxy-nav-menu:not(.oxy-nav-menu-open) #menu-main > .mega-menu > .sub-menu {
  left: 0;
  width: 100%;
}

#header-wrapper #main-header .oxy-nav-menu:not(.oxy-nav-menu-open) #menu-main .menu-item .sub-menu {
  background-color: <?php echo $hover_background_translucent;
  ?>;
}

#header-wrapper #main-header .oxy-header-container {
  position: relative;
}

#header-wrapper #main-header .oxy-nav-menu:not(.oxy-nav-menu-open) .mega-menu {
  position: initial;
}

#header-wrapper #main-header .oxy-nav-menu:not(.oxy-nav-menu-open) .mega-menu .sub-menu {
    display: none;
    flex-direction: row;
}
#header-wrapper #main-header:hover .oxy-nav-menu:not(.oxy-nav-menu-open) .mega-menu .sub-menu {
  display: flex;
}
#header-wrapper #main-header .oxy-nav-menu:not(.oxy-nav-menu-open) .mega-menu .sub-menu li {
    flex: 1;
}

#header-wrapper #main-header .oxy-nav-menu.oxy-nav-menu-dropdowns.oxy-nav-menu-dropdown-arrow:not(.oxy-nav-menu-open) .mega-menu .sub-menu .menu-item-has-children > a:after {
  transform: rotate(135deg);
}

#header-wrapper #main-header .oxy-nav-menu:not(.oxy-nav-menu-open) .mega-menu:hover > .sub-menu > .menu-item > .sub-menu {
    display: inline-block;
    position: relative;
    left: 0;
    opacity: 1;
    visibility: visible;
    background: transparent!important;
}

#header-wrapper #main-header .oxy-nav-menu:not(.oxy-nav-menu-open) .mega-menu > .sub-menu > .menu-item .sub-menu {
  font-size: 14px;
  border-top: 1px solid rgba(0,0,0,0.15);
  box-shadow: none;
  transition: none;
}

.oxy-nav-menu.oxy-nav-menu-open {
  background-color: <?php echo $hover_background_solid;
  ?>;
  background-color: <?php echo $responsive_background_translucent;
  ?>;
}

.oxy-nav-menu-open #menu-main > li > a {
  font-size: 28px;
}

.oxy-nav-menu-open ul.sub-menu li {
  line-height: 0px;
  font-size: 13px;
}

.oxy-nav-menu-open #menu-main>li>a {
  font-weight: bold;
}

.oxy-nav-menu-open #menu-main li a {
  color: <?php echo $colour;
  ?>
}

.feature-slide h2, .feature-slide .description {
  background-color: <?php echo $background; ?>;
  color: <?php echo $colour; ?>;
  padding: 15px 40px;
  max-width: 61%;
}

.stretch {
  position: absolute!important;
  top: 0;
  right: 0;
  left: 0;
  bottom: 0;
}

<?php $default_style=get_field('sticky_header_style', 'option');

if ($default_style) {
  $option=$default_style;
}

if ($option=='dark') {
  $fixed_background_solid='#373737';
  $fixed_background_translucent='rgba(0, 0, 0, 0.71)';
  $fixed_background_hover='rgba(0, 0, 0, 0.8)';
  $colour='#ededed';
  $colour_hover='#ffffff';
}

elseif ($option=='light'|| $option=='') {
  $fixed_background_solid='#fff';
  $fixed_background_translucent='rgba(255, 255, 255, 0.8)';
  $fixed_background_hover='rgba(255, 255, 255, 0.9)';
  $colour='#454545';
  $colour_hover=$primary;
  $textshadow='';
}

?> #header-wrapper.oxy-sticky-header-active #main-header {
  background-color: <?php echo $fixed_background_solid;
  ?>;
  background-color: <?php echo $fixed_background_translucent;
  ?>;
}

#header-wrapper.oxy-sticky-header-active #main-header:hover {
  background-color: <?php echo $fixed_background_solid;
  ?>;
  background-color: <?php echo $fixed_background_hover;
  ?>;
}

#header-wrapper #main-header .oxy-nav-menu:not(.oxy-nav-menu-open) #menu-main .sub-menu .menu-item a:hover {
  background-color: <?php echo $primary;
  ?>;
  color: #fff;
}

#header-wrapper.oxy-sticky-header-active #main-header .oxy-nav-menu:not(.oxy-nav-menu-open) .sub-menu {
  background-color: <?php echo $fixed_background_solid;
  ?> !important;
  background-color: <?php echo $fixed_background_hover;
  ?> !important;
}

/* Footer */
<?php $page_style=get_field('footer_style');
$default_style=get_field('default_footer_style', 'option');

if (($page_style && $page_style !=='default')) {
  $option=$page_style;
  echo '/* HEADER OPTION: '. $option . '*/';
}

elseif ($default_style) {
  $option=$default_style;
}

if ($option=='dark'|| $option=='') {
  $footer_background_solid='#3a3a3a';
  $footer_background_gradient_top='#464646';
  $footer_background_gradient_bottom='#0a0a0a';
  $colour='#ededed';
  $colour_hover='#fff';
}

elseif ($option=='light') {
  $footer_background_solid='#fff';
  $footer_background_gradient_top='#fff';
  $footer_background_gradient_bottom='#e0e0e0';
  $colour='#4e4e4e';
  $colour_hover='#121212';
}

elseif ($option=='transparent') {
  $footer_background_solid='transparent';
  $footer_background_gradient_top='transparent';
  $footer_background_gradient_bottom='transparent';
  $colour='#4e4e4e';
  $colour_hover='#121212';
}

if ($custom_colour_footer) {
  $footer_background_solid=$custom_colour_footer;
  $footer_background_gradient_top=$custom_colour_footer;
  $footer_background_gradient_bottom=$custom_colour_footer;
}

?>#footer {
  background-colour: <?php echo $footer_background_solid;
  ?>;
  background: -webkit-gradient(linear, left bottom, left top, color-stop(0, <?php echo $footer_background_gradient_bottom;
  ?>), color-stop(1, <?php echo $footer_background_gradient_top;
  ?>));
  background: -ms-linear-gradient(bottom, <?php echo $footer_background_gradient_bottom;
  ?> 0%, <?php echo $footer_background_gradient_top;
  ?> 100%);
  background: -moz-linear-gradient(center bottom, <?php echo $footer_background_gradient_bottom;
  ?> 0%, <?php echo $footer_background_gradient_top;
  ?> 100%);
  background: -o-linear-gradient(<?php echo $footer_background_gradient_top;
  ?>, <?php echo $footer_background_gradient_bottom;
  ?>);
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='<?php echo $footer_background_gradient_top; ?>', endColorstr='<?php echo $footer_background_gradient_bottom; ?>', GradientType=0);
}

#footer, #footer a, #footer h1, #footer h2, #footer h3 {
  color: <?php echo $colour;
  ?>;
}

#footer a:hover {
  color: <?php echo $colour_hover;
  ?>;
}

#header-wrapper #main-header {
  transition-duration: 0.3s;
}

.oxy-nav-menu.oxy-nav-menu-open .oxy-nav-menu-hamburger-wrap {
  top: 60px
}

.oxy-nav-menu:not(.oxy-nav-menu-open) .menu-item .sub-menu {
  transition-property: all;
  margin-top: 10px;
}

.oxy-nav-menu:not(.oxy-nav-menu-open) .menu-item:hover .sub-menu {
  margin-top: 0;
}

.oxy-sticky-header-active #menu-main>.menu-item>a {
  padding-top: 10px !important;
  padding-bottom: 10px !important;
  transition: 0.3s all ease;
}

#_nav_menu-174-5.oxy-nav-menu:not(.oxy-nav-menu-open) .sub-menu .menu-item a {
  padding-top: 10px !important;
  padding-bottom: 10px !important;
}

#header-wrapper.oxy-sticky-header-active #main-header .oxy-nav-menu-hamburger-wrap {
  margin: 5px 0;
  transition: 0.3s all ease;
}

#header-wrapper.oxy-sticky-header-active #main-header .oxy-nav-menu-hamburger {
  height: 28px;
}

#header-wrapper.oxy-sticky-header-active #main-header .oxy-nav-menu-hamburger-line {
  height: 5px;
}

#header-wrapper.oxy-sticky-header-active #logo-heading {
  transition: 0.3s all ease;
}

#header-wrapper.oxy-sticky-header-active #logo-heading small {
  display: none;
}

#header-wrapper.oxy-sticky-header-active #logo-img {
  transition: 0.3s all ease;
  height: 30px;
}

#feature-area iframe {
  border: 0;
  height: 100%;
  left: 0;
  position: absolute;
  top: 0;
  width: 100%;
}

#feature-area .mejs-container {
  position: absolute;
    top: 0;
    left: 0;
    height: 100%;
    width: 100%;
}

#feature-area .wp-video-shortcode {
  width: 100%!important;
  height: 100%!important;
}

#feature-area.full-height {
  height: 100vh;
}

#feature-area.content-height {
  height: auto;
}

.posts-list {
  text-align: center;
}

.posts-list .title {
  margin-bottom: 35px;
}

.posts-list .dark,
.posts-list .dark h3 a {
  color: white;
  text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.4);
}

.posts-list .dark .post-image img {
  border: 3px solid white;
}

.posts-list .post-image img.round {
  -moz-box-shadow: 0px 1px 4px rgba(0, 0, 0, 0.3);
  -webkit-box-shadow: 0px 1px 4px rgba(0, 0, 0, 0.3);
  box-shadow: 0px 1px 4px rgba(0, 0, 0, 0.3);
}

.posts-list .carousel-control.right,
.posts-list .carousel-control.left {
  background: none;
  width: 30px;
}

.posts-list .carousel-inner {
  width: 90%;
  margin: auto;
  text-align: center;
}

.posts-list .carousel-inner .fa {
  font-size: 80px;
  padding: 20px;
}

.posts-list .carousel-indicators {
  position: static;
  margin: auto;
  padding-top: 15px;
}

.posts-list .carousel-indicators li {
  border-color: #ccc;
}

.posts-list .carousel-indicators li.active {
  background-color: #ccc;
}

.feature-slider {
  margin: 0;
}
.feature-slider .carousel-inner, .feature-slider .item {
  width: 100%;
  height: 100%;
}
.feature-slide {
  background-size: cover;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-direction: column;
}
.feature-slide h2 {
  margin-bottom: 15px!important   ;
  font-size: 40px;
}
#feature-area .feature-slider.posts-list .carousel-control {
  z-index: 1;
  width: 15%;
  max-width: 100px;
}

table {
  border-collapse: collapse;
}

li.widget {
  list-style: none;
  width: 100%;
  margin-bottom: 30px;
}

.single .featured {
  text-align: center;
}

.single .featured .fa {
  font-size: 150px;
}

/*! normalize.css v7.0.0 | MIT License | github.com/necolas/normalize.css */
html {
  line-height: 1.15;
  -ms-text-size-adjust: 100%;
  -webkit-text-size-adjust: 100%
}

body {
  margin: 0
}

article, aside, footer, header, nav, section {
  display: block
}

h1, h2, h3, h4, h5, h6 {
  margin: 0
}

figcaption, figure, main {
  display: block
}

figure {
  margin: 1em 40px
}

hr {
  box-sizing: content-box;
  height: 0;
  overflow: visible
}

pre {
  font-family: monospace, monospace;
  font-size: 1em
}

a {
  background-color: transparent;
  -webkit-text-decoration-skip: objects
}

abbr[title] {
  border-bottom: 0;
  text-decoration: underline;
  text-decoration: underline dotted
}

b, strong {
  font-weight: inherit
}

b, strong {
  font-weight: bolder
}

code, kbd, samp {
  font-family: monospace, monospace;
  font-size: 1em
}

dfn {
  font-style: italic
}

mark {
  background-color: #ff0;
  color: #000
}

small {
  font-size: 80%
}

sub, sup {
  font-size: 75%;
  line-height: 0;
  position: relative;
  vertical-align: baseline
}

sub {
  bottom: -0.25em
}

sup {
  top: -0.5em
}

audio, video {
  display: inline-block
}

audio:not([controls]) {
  display: none;
  height: 0
}

img {
  border-style: none
}

svg:not(:root) {
  overflow: hidden
}

button, input, optgroup, select, textarea {
  font-size: 100%;
  line-height: 1.15;
  margin: 0
}

button, input {
  overflow: visible
}

button, select {
  text-transform: none
}

button, html [type="button"], [type="reset"], [type="submit"] {
  -webkit-appearance: button
}

button::-moz-focus-inner, [type="button"]::-moz-focus-inner, [type="reset"]::-moz-focus-inner, [type="submit"]::-moz-focus-inner {
  border-style: none;
  padding: 0
}

button:-moz-focusring, [type="button"]:-moz-focusring, [type="reset"]:-moz-focusring, [type="submit"]:-moz-focusring {
  outline: 1px dotted ButtonText
}

fieldset {
  padding: .35em .75em .625em
}

legend {
  box-sizing: border-box;
  color: inherit;
  display: table;
  max-width: 100%;
  padding: 0;
  white-space: normal
}

progress {
  display: inline-block;
  vertical-align: baseline
}

textarea {
  overflow: auto
}

[type="checkbox"], [type="radio"] {
  box-sizing: border-box;
  padding: 0
}

[type="number"]::-webkit-inner-spin-button, [type="number"]::-webkit-outer-spin-button {
  height: auto
}

[type="search"] {
  -webkit-appearance: textfield;
  outline-offset: -2px
}

[type="search"]::-webkit-search-cancel-button, [type="search"]::-webkit-search-decoration {
  -webkit-appearance: none
}

::-webkit-file-upload-button {
  -webkit-appearance: button;
  font: inherit
}

details, menu {
  display: block
}

summary {
  display: list-item
}

canvas {
  display: inline-block
}

template {
  display: none
}

[hidden] {
  display: none
}

input, select, textarea {
    width: 100%;
    border: 1px solid #ccc;
    padding: 5px;
    margin-bottom: 10px;
    border-radius: 5px;
}

.tooltip {
  transition: opacity .25s ease-in-out;
  position: absolute;
  z-index: 1070;
  display: block;
  font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
  font-style: normal;
  font-weight: 400;
  line-height: 1.42857143;
  line-break: auto;
  text-align: left;
  text-align: start;
  text-decoration: none;
  text-shadow: none;
  text-transform: none;
  letter-spacing: normal;
  word-break: normal;
  word-spacing: normal;
  word-wrap: normal;
  white-space: normal;
  font-size: 12px;
  filter: alpha(opacity=0);
  opacity: 0
}

.tooltip.in {
  filter: alpha(opacity=90);
  opacity: .9
}

.tooltip.top {
  padding: 5px 0;
  margin-top: -3px
}

.tooltip.right {
  padding: 0 5px;
  margin-left: 3px
}

.tooltip.bottom {
  padding: 5px 0;
  margin-top: 3px
}

.tooltip.left {
  padding: 0 5px;
  margin-left: -3px
}

.tooltip.top .tooltip-arrow {
  bottom: 0;
  left: 50%;
  margin-left: -5px;
  border-width: 5px 5px 0;
  border-top-color: #000
}

.tooltip.top-left .tooltip-arrow {
  right: 5px;
  bottom: 0;
  margin-bottom: -5px;
  border-width: 5px 5px 0;
  border-top-color: #000
}

.tooltip.top-right .tooltip-arrow {
  bottom: 0;
  left: 5px;
  margin-bottom: -5px;
  border-width: 5px 5px 0;
  border-top-color: #000
}

.tooltip.right .tooltip-arrow {
  top: 50%;
  left: 0;
  margin-top: -5px;
  border-width: 5px 5px 5px 0;
  border-right-color: #000
}

.tooltip.left .tooltip-arrow {
  top: 50%;
  right: 0;
  margin-top: -5px;
  border-width: 5px 0 5px 5px;
  border-left-color: #000
}

.tooltip.bottom .tooltip-arrow {
  top: 0;
  left: 50%;
  margin-left: -5px;
  border-width: 0 5px 5px;
  border-bottom-color: #000
}

.tooltip.bottom-left .tooltip-arrow {
  top: 0;
  right: 5px;
  margin-top: -5px;
  border-width: 0 5px 5px;
  border-bottom-color: #000
}

.tooltip.bottom-right .tooltip-arrow {
  top: 0;
  left: 5px;
  margin-top: -5px;
  border-width: 0 5px 5px;
  border-bottom-color: #000
}

.tooltip-inner {
  max-width: 200px;
  padding: 3px 8px;
  color: #fff;
  text-align: center;
  background-color: #000;
  border-radius: 4px
}

.tooltip-arrow {
  position: absolute;
  width: 0;
  height: 0;
  border-color: transparent;
  border-style: solid
}

.carousel {
  position: relative
}

.carousel-inner {
  position: relative;
  width: 100%;
  overflow: hidden
}

.carousel-inner>.item {
  position: relative;
  display: none;
  -webkit-transition: .6s ease-in-out left;
  -o-transition: .6s ease-in-out left;
  transition: .6s ease-in-out left
}

.carousel-inner>.item>img, .carousel-inner>.item>a>img {
  line-height: 1
}

@media all and (transform-3d), (-webkit-transform-3d) {
  .carousel-inner>.item {
    -webkit-transition: -webkit-transform .6s ease-in-out;
    -o-transition: -o-transform .6s ease-in-out;
    transition: transform .6s ease-in-out;
    -webkit-backface-visibility: hidden;
    backface-visibility: hidden;
    -webkit-perspective: 1000px;
    perspective: 1000px
  }

  .carousel-inner>.item.next, .carousel-inner>.item.active.right {
    -webkit-transform: translate3d(100%, 0, 0);
    transform: translate3d(100%, 0, 0);
    left: 0
  }

  .carousel-inner>.item.prev, .carousel-inner>.item.active.left {
    -webkit-transform: translate3d(-100%, 0, 0);
    transform: translate3d(-100%, 0, 0);
    left: 0
  }

  .carousel-inner>.item.next.left, .carousel-inner>.item.prev.right, .carousel-inner>.item.active {
    -webkit-transform: translate3d(0, 0, 0);
    transform: translate3d(0, 0, 0);
    left: 0
  }
}

.carousel-inner>.active, .carousel-inner>.next, .carousel-inner>.prev {
  display: block
}

.carousel-inner>.active {
  left: 0
}

.carousel-inner>.next, .carousel-inner>.prev {
  position: absolute;
  top: 0;
  width: 100%
}

.carousel-inner>.next {
  left: 100%
}

.carousel-inner>.prev {
  left: -100%
}

.carousel-inner>.next.left, .carousel-inner>.prev.right {
  left: 0
}

.carousel-inner>.active.left {
  left: -100%
}

.carousel-inner>.active.right {
  left: 100%
}

.carousel-control {
  position: absolute;
  top: 0;
  bottom: 0;
  left: 0;
  width: 15%;
  font-size: 20px;
  color: #fff;
  text-align: center;
  text-shadow: 0 1px 2px rgba(0, 0, 0, 0.6);
  background-color: rgba(0, 0, 0, 0);
  filter: alpha(opacity=50);
  opacity: .5
}

.carousel-control.right {
  right: 0;
  left: auto
}

.carousel-control:hover, .carousel-control:focus {
  color: #fff;
  text-decoration: none;
  outline: 0;
  filter: alpha(opacity=90);
  opacity: .9
}

.carousel-control .icon-prev, .carousel-control .icon-next, .carousel-control .glyphicon-chevron-left, .carousel-control .glyphicon-chevron-right {
  position: absolute;
  top: 50%;
  z-index: 5;
  display: inline-block;
  margin-top: -10px
}

.carousel-control .icon-prev, .carousel-control .glyphicon-chevron-left {
  left: 50%;
  margin-left: -10px
}

.carousel-control .icon-next, .carousel-control .glyphicon-chevron-right {
  right: 50%;
  margin-right: -10px
}

.carousel-control .icon-prev, .carousel-control .icon-next {
  width: 20px;
  height: 20px;
  font-family: serif;
  line-height: 1
}

.carousel-control .icon-prev:before {
  content: "\2039"
}

.carousel-control .icon-next:before {
  content: "\203a"
}

.carousel-indicators {
  position: absolute;
  bottom: 10px;
  left: 50%;
  z-index: 15;
  width: 60%;
  padding-left: 0;
  margin-left: -30%;
  text-align: center;
  list-style: none
}

.carousel-indicators li {
  display: inline-block;
  width: 10px;
  height: 10px;
  margin: 1px;
  text-indent: -999px;
  cursor: pointer;
  background-color: #000 \9;
  background-color: rgba(0, 0, 0, 0);
  border: 1px solid #fff;
  border-radius: 10px
}

.carousel-indicators .active {
  width: 12px;
  height: 12px;
  margin: 0;
  background-color: #fff
}

.carousel-caption {
  position: absolute;
  right: 15%;
  bottom: 20px;
  left: 15%;
  z-index: 10;
  padding-top: 20px;
  padding-bottom: 20px;
  color: #fff;
  text-align: center;
  text-shadow: 0 1px 2px rgba(0, 0, 0, 0.6)
}

.carousel-caption .btn {
  text-shadow: none
}

@media screen and (min-width:768px) {
  .carousel-control .glyphicon-chevron-left, .carousel-control .glyphicon-chevron-right, .carousel-control .icon-prev, .carousel-control .icon-next {
    width: 30px;
    height: 30px;
    margin-top: -10px;
    font-size: 30px
  }

  .carousel-control .glyphicon-chevron-left, .carousel-control .icon-prev {
    margin-left: -10px
  }

  .carousel-control .glyphicon-chevron-right, .carousel-control .icon-next {
    margin-right: -10px
  }

  .carousel-caption {
    right: 20%;
    left: 20%;
    padding-bottom: 30px
  }

  .carousel-indicators {
    bottom: 20px
  }
}

.clearfix:before, .clearfix:after {
  display: table;
  content: " "
}

.clearfix:after {
  clear: both
}

.center-block {
  display: block;
  margin-right: auto;
  margin-left: auto
}

.pull-right {
  float: right !important
}

.pull-left {
  float: left !important
}

.hide {
  display: none !important
}

.show {
  display: block !important
}

.invisible {
  visibility: hidden
}

.text-hide {
  font: 0/0 a;
  color: transparent;
  text-shadow: none;
  background-color: transparent;
  border: 0
}

.hidden {
  display: none !important
}

.affix {
  position: fixed
}

.panel {
  margin-bottom: 20px;
  background-color: #fff;
  border: 1px solid transparent;
  border-radius: 4px;
  -webkit-box-shadow: 0 1px 1px rgba(0, 0, 0, 0.05);
  box-shadow: 0 1px 1px rgba(0, 0, 0, 0.05)
}

.panel-body {
  padding: 15px
}

.panel-heading {
  padding: 10px 15px;
  border-bottom: 1px solid transparent;
  border-top-left-radius: 3px;
  border-top-right-radius: 3px
}

/* .panel-heading>.dropdown .dropdown-toggle {
  color: inherit
} */
.panel-title {
  margin-top: 0;
  margin-bottom: 0;
  font-size: 16px;
  color: inherit
}

/* .panel-title>a, .panel-title>small, .panel-title>.small, .panel-title>small>a, .panel-title>.small>a {
  color: inherit
} */
.panel-footer {
  padding: 10px 15px;
  background-color: #f5f5f5;
  border-top: 1px solid #ddd;
  border-bottom-right-radius: 3px;
  border-bottom-left-radius: 3px
}

.panel>.list-group, .panel>.panel-collapse>.list-group {
  margin-bottom: 0
}

.panel>.list-group .list-group-item, .panel>.panel-collapse>.list-group .list-group-item {
  border-width: 1px 0;
  border-radius: 0
}

.panel>.list-group:first-child .list-group-item:first-child, .panel>.panel-collapse>.list-group:first-child .list-group-item:first-child {
  border-top: 0;
  border-top-left-radius: 3px;
  border-top-right-radius: 3px
}

.panel>.list-group:last-child .list-group-item:last-child, .panel>.panel-collapse>.list-group:last-child .list-group-item:last-child {
  border-bottom: 0;
  border-bottom-right-radius: 3px;
  border-bottom-left-radius: 3px
}

.panel>.panel-heading+.panel-collapse>.list-group .list-group-item:first-child {
  border-top-left-radius: 0;
  border-top-right-radius: 0
}

.panel-heading+.list-group .list-group-item:first-child {
  border-top-width: 0
}

.list-group+.panel-footer {
  border-top-width: 0
}

.panel>.table, .panel>.table-responsive>.table, .panel>.panel-collapse>.table {
  margin-bottom: 0
}

.panel>.panel-body+.table, .panel>.panel-body+.table-responsive, .panel>.table+.panel-body, .panel>.table-responsive+.panel-body {
  border-top: 1px solid #ddd
}

.panel>.table>tbody:first-child>tr:first-child th, .panel>.table>tbody:first-child>tr:first-child td {
  border-top: 0
}

.panel>.table-bordered, .panel>.table-responsive>.table-bordered {
  border: 0
}

.panel>.table-responsive {
  margin-bottom: 0;
  border: 0
}

.panel-default {
  border: 1px solid #ddd
}

.panel-default>.panel-heading {
  color: #333;
  background-color: #f5f5f5;
  border-color: #ddd
}

.panel-default>.panel-heading+.panel-collapse>.panel-body {
  border-top-color: #ddd
}

.panel-default>.panel-heading .badge {
  color: #f5f5f5;
  background-color: #333
}

.panel-default>.panel-footer+.panel-collapse>.panel-body {
  border-bottom-color: #ddd
}

table {
  background-color: transparent
}

table col[class*="col-"] {
  position: static;
  display: table-column;
  float: none
}

table td[class*="col-"], table th[class*="col-"] {
  position: static;
  display: table-cell;
  float: none
}

caption {
  padding-top: 8px;
  padding-bottom: 8px;
  color: #777;
  text-align: left
}

th {
  text-align: left
}

.table {
  width: 100%;
  max-width: 100%;
  margin-bottom: 20px
}

.table>thead>tr>th, .table>tbody>tr>th, .table>tfoot>tr>th, .table>thead>tr>td, .table>tbody>tr>td, .table>tfoot>tr>td {
  padding: 8px;
  line-height: 1.42857143;
  vertical-align: top;
  border-top: 1px solid #ddd
}

.table>thead>tr>th {
  vertical-align: bottom;
  border-bottom: 2px solid #ddd
}

.table>tbody+tbody {
  border-top: 2px solid #ddd
}

.table .table {
  background-color: #fff
}

.table-bordered {
  border: 1px solid #ddd
}

.table-bordered>thead>tr>th, .table-bordered>tbody>tr>th, .table-bordered>tfoot>tr>th, .table-bordered>thead>tr>td, .table-bordered>tbody>tr>td, .table-bordered>tfoot>tr>td {
  border: 1px solid #ddd
}

.table-bordered>thead>tr>th, .table-bordered>thead>tr>td {
  border-bottom-width: 2px
}

.table-striped>tbody>tr:nth-of-type(odd) {
  background-color: #f9f9f9
}

.table-hover>tbody>tr:hover {
  background-color: #f5f5f5
}

.table>thead>tr>td.active, .table>tbody>tr>td.active, .table>tfoot>tr>td.active, .table>thead>tr>th.active, .table>tbody>tr>th.active, .table>tfoot>tr>th.active, .table>thead>tr.active>td, .table>tbody>tr.active>td, .table>tfoot>tr.active>td, .table>thead>tr.active>th, .table>tbody>tr.active>th, .table>tfoot>tr.active>th {
  background-color: #f5f5f5
}

.table-hover>tbody>tr>td.active:hover, .table-hover>tbody>tr>th.active:hover, .table-hover>tbody>tr.active:hover>td, .table-hover>tbody>tr:hover>.active, .table-hover>tbody>tr.active:hover>th {
  background-color: #e8e8e8
}

.table-hover>tbody>tr>td.danger:hover, .table-hover>tbody>tr>th.danger:hover, .table-hover>tbody>tr.danger:hover>td, .table-hover>tbody>tr:hover>.danger, .table-hover>tbody>tr.danger:hover>th {
  background-color: #ebcccc
}

.table-responsive {
  min-height: .01%;
  overflow-x: auto
}

@media screen and (max-width:767px) {
  .table-responsive {
    width: 100%;
    margin-bottom: 15px;
    overflow-y: hidden;
    -ms-overflow-style: -ms-autohiding-scrollbar;
    border: 1px solid #ddd
  }

  .table-responsive>.table {
    margin-bottom: 0
  }

  .table-responsive>.table>thead>tr>th, .table-responsive>.table>tbody>tr>th, .table-responsive>.table>tfoot>tr>th, .table-responsive>.table>thead>tr>td, .table-responsive>.table>tbody>tr>td, .table-responsive>.table>tfoot>tr>td {
    white-space: nowrap
  }

  .table-responsive>.table-bordered {
    border: 0
  }

  .table-responsive>.table-bordered>thead>tr>th:first-child, .table-responsive>.table-bordered>tbody>tr>th:first-child, .table-responsive>.table-bordered>tfoot>tr>th:first-child, .table-responsive>.table-bordered>thead>tr>td:first-child, .table-responsive>.table-bordered>tbody>tr>td:first-child, .table-responsive>.table-bordered>tfoot>tr>td:first-child {
    border-left: 0
  }

  .table-responsive>.table-bordered>thead>tr>th:last-child, .table-responsive>.table-bordered>tbody>tr>th:last-child, .table-responsive>.table-bordered>tfoot>tr>th:last-child, .table-responsive>.table-bordered>thead>tr>td:last-child, .table-responsive>.table-bordered>tbody>tr>td:last-child, .table-responsive>.table-bordered>tfoot>tr>td:last-child {
    border-right: 0
  }

  .table-responsive>.table-bordered>tbody>tr:last-child>th, .table-responsive>.table-bordered>tfoot>tr:last-child>th, .table-responsive>.table-bordered>tbody>tr:last-child>td, .table-responsive>.table-bordered>tfoot>tr:last-child>td {
    border-bottom: 0
  }
}

.list-group {
  padding-left: 0;
  margin-bottom: 20px
}

.list-group-item {
  position: relative;
  display: block;
  padding: 10px 15px;
  margin-bottom: -1px;
  background-color: #fff;
  border: 1px solid #ddd
}

.list-group-item:first-child {
  border-top-left-radius: 4px;
  border-top-right-radius: 4px
}

.list-group-item:last-child {
  margin-bottom: 0;
  border-bottom-right-radius: 4px;
  border-bottom-left-radius: 4px
}

.list-group-item.active .list-group-item-text, .list-group-item.active:hover .list-group-item-text, .list-group-item.active:focus .list-group-item-text {
  color: #c7ddef
}

a.list-group-item, button.list-group-item {
  color: #555
}

a.list-group-item .list-group-item-heading, button.list-group-item .list-group-item-heading {
  color: #333
}

a.list-group-item:hover, button.list-group-item:hover, a.list-group-item:focus, button.list-group-item:focus {
  color: #555;
  text-decoration: none;
  background-color: #f5f5f5
}

button.list-group-item {
  width: 100%;
  text-align: left
}

.list-group-item-heading {
  margin-top: 0;
  margin-bottom: 5px
}

.list-group-item-text {
  margin-bottom: 0;
  line-height: 1.3
}


[class*="col-"] {
  position: relative;
  min-height: 1px;
  padding-right: 15px;
  padding-left: 15px;
}

.col-xs-6, .col-xs-12 {
  float: left;
}

.col-xs-12 {
  width: 100%;
}

.col-xs-6 {
  width: 50%;
}

@media (min-width: 768px) {
  .col-sm-3, .col-sm-4, .col-sm-6, .col-sm-12 {
    float: left;
  }

  .col-sm-12 {
    width: 100%;
  }

  .col-sm-6 {
    width: 50%;
  }

  .col-sm-4 {
    width: 33.33333333%;
  }

  .col-sm-3 {
    width: 25%;
  }
}

@media (min-width: 992px) {
  .col-md-3, .col-md-4, .col-md-6, .col-md-12 {
    float: left;
  }

  .col-md-12 {
    width: 100%;
  }

  .col-md-6 {
    width: 50%;
  }

  .col-md-4 {
    width: 33.33333333%;
  }

  .col-md-3 {
    width: 25%;
  }
}

@media (min-width: 1200px) {
  .col-lg-3, .col-lg-4, .col-lg-6, .col-lg-12 {
    float: left;
  }

  .col-lg-12 {
    width: 100%;
  }

  .col-lg-6 {
    width: 50%;
  }

  .col-lg-4 {
    width: 33.33333333%;
  }

  .col-lg-3 {
    width: 25%;
  }
}

<?php
global $wp;

$root = get_template_directory_uri();
$current_url = home_url(add_query_arg(array(), $wp->request));
?>

<html <?php language_attributes(); ?>>
<head>
  <script>
    // NodeList.forEach() polyfill
    "NodeList"in window&&!NodeList.prototype.forEach&&(NodeList.prototype.forEach=function(o,t){t=t||window;for(var i=0;i<this.length;i++)o.call(t,this[i],i,this)});
  </script>
  <script>
    // URLSearchParams polyfill
    !function(t){"use strict";var n,r=t.URLSearchParams&&t.URLSearchParams.prototype.get?t.URLSearchParams:null,e=r&&"a=1"===new r({a:1}).toString(),o=r&&"+"===new r("s=%2B").get("s"),i="__URLSearchParams__",a=!r||((n=new r).append("s"," &"),"s=+%26"===n.toString()),c=l.prototype,s=!(!t.Symbol||!t.Symbol.iterator);if(!(r&&e&&o&&a)){c.append=function(t,n){y(this[i],t,n)},c.delete=function(t){delete this[i][t]},c.get=function(t){var n=this[i];return t in n?n[t][0]:null},c.getAll=function(t){var n=this[i];return t in n?n[t].slice(0):[]},c.has=function(t){return t in this[i]},c.set=function(t,n){this[i][t]=[""+n]},c.toString=function(){var t,n,r,e,o=this[i],a=[];for(n in o)for(r=h(n),t=0,e=o[n];t<e.length;t++)a.push(r+"="+h(e[t]));return a.join("&")};var u=!!o&&r&&!e&&t.Proxy;Object.defineProperty(t,"URLSearchParams",{value:u?new Proxy(r,{construct:function(t,n){return new t(new l(n[0]).toString())}}):l});var f=t.URLSearchParams.prototype;f.polyfill=!0,f.forEach=f.forEach||function(t,n){var r=v(this.toString());Object.getOwnPropertyNames(r).forEach(function(e){r[e].forEach(function(r){t.call(n,r,e,this)},this)},this)},f.sort=f.sort||function(){var t,n,r,e=v(this.toString()),o=[];for(t in e)o.push(t);for(o.sort(),n=0;n<o.length;n++)this.delete(o[n]);for(n=0;n<o.length;n++){var i=o[n],a=e[i];for(r=0;r<a.length;r++)this.append(i,a[r])}},f.keys=f.keys||function(){var t=[];return this.forEach(function(n,r){t.push(r)}),g(t)},f.values=f.values||function(){var t=[];return this.forEach(function(n){t.push(n)}),g(t)},f.entries=f.entries||function(){var t=[];return this.forEach(function(n,r){t.push([r,n])}),g(t)},s&&(f[t.Symbol.iterator]=f[t.Symbol.iterator]||f.entries)}function l(t){((t=t||"")instanceof URLSearchParams||t instanceof l)&&(t=t.toString()),this[i]=v(t)}function h(t){var n={"!":"%21","'":"%27","(":"%28",")":"%29","~":"%7E","%20":"+","%00":"\0"};return encodeURIComponent(t).replace(/[!'\(\)~]|%20|%00/g,function(t){return n[t]})}function p(t){return t.replace(/[ +]/g,"%20").replace(/(%[a-f0-9]{2})+/gi,function(t){return decodeURIComponent(t)})}function g(n){var r={next:function(){var t=n.shift();return{done:void 0===t,value:t}}};return s&&(r[t.Symbol.iterator]=function(){return r}),r}function v(t){var n={};if("object"==typeof t)if(S(t))for(var r=0;r<t.length;r++){var e=t[r];if(!S(e)||2!==e.length)throw new TypeError("Failed to construct 'URLSearchParams': Sequence initializer must only contain pair elements");y(n,e[0],e[1])}else for(var o in t)t.hasOwnProperty(o)&&y(n,o,t[o]);else{0===t.indexOf("?")&&(t=t.slice(1));for(var i=t.split("&"),a=0;a<i.length;a++){var c=i[a],s=c.indexOf("=");-1<s?y(n,p(c.slice(0,s)),p(c.slice(s+1))):c&&y(n,p(c),"")}}return n}function y(t,n,r){var e="string"==typeof r?r:null!=r&&"function"==typeof r.toString?r.toString():JSON.stringify(r);n in t?t[n].push(e):t[n]=[e]}function S(t){return!!t&&"[object Array]"===Object.prototype.toString.call(t)}}("undefined"!=typeof global?global:"undefined"!=typeof window?window:this);
  </script>
  <script>
    var SITE_GLOBALS = {
      root: '<?php echo site_url(); ?>',
    };
  </script>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  
  <title><?php the_title(); ?></title>

  <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Overlock:400,700&display=swap" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.css" />

  <!-- <?php 
    if (strpos($current_url, 'cart')) { ?>
      <link rel="stylesheet" href="<?php echo $root.'/dist/css/woocommerce.css' ?>" />
      <link rel="stylesheet" href="<?php echo $root.'/dist/css/woocommerce-layout.css' ?>" />
  <?php
    }
  ?> -->

  <link rel="stylesheet" href="<?php echo $root.'/dist/css/main.css' ?>" />
</head>
<body <?php body_class(); ?>>
  <?php get_template_part('partials/site-header'); ?>
  <main role="main" id="k-main">
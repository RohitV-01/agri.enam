<head>
<title>
	<?php if(isset($title)){ 
		echo 	$title;
	}else {
		echo 'eNAM';
	}
	?>	
</title>
<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="<?php //echo $keywords; ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assest/css/animate.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assest/css/custom-responsive.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assest/css/styles.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assest/css/style_white.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assest/css/print.css" />
<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet" />

<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" />
<link href="https://fonts.googleapis.com/css?family=Maven+Pro" rel="stylesheet" />
<link href="https://fonts.googleapis.com/css?family=ABeeZee" rel="stylesheet" />
<link href="https://fonts.googleapis.com/css?family=Montserrat|Noto+Sans" rel="stylesheet" />
<link href="https://fonts.googleapis.com/css?family=Open+Sans|Raleway" rel="stylesheet" />
<link href="https://fonts.googleapis.com/css?family=Maven+Pro:400,700|Oxygen" rel="stylesheet" />
<link href="https://fonts.googleapis.com/css?family=Bitter|PT+Sans|Rubik|Signika|Varela+Round" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assest/css/green-box.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assest/css/orange-box.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assest/css/blue-box.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assest/css/red-box.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assest/css/font-awesome.min.css" /> 

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-migrate-3.4.1.min.js" integrity="sha256-UnTx9ZAnD7Sme94jD2ZnrR4P3Lgn5i8GsnZ1t6V3x00=" crossorigin="anonymous"></script>
<script src="https://unpkg.com/masonry-layout@4.2.2/dist/masonry.pkgd.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
<script type="text/javascript">
/*!
 * WOW-compat v2.0.0 — drop-in replacement for WOW.js 1.1.2 (abandoned 2015)
 * Uses the native IntersectionObserver API instead of scroll listeners.
 * Preserves the existing WOW() constructor API and all class/data-wow-* attrs.
 * Compatible with animate.css v3 & v4.
 * MIT License
 */
(function (root, factory) {
  if (typeof define === 'function' && define.amd) {
    define([], factory);
  } else if (typeof module === 'object' && module.exports) {
    module.exports = factory();
  } else {
    root.WOW = factory();
  }
}(typeof self !== 'undefined' ? self : this, function () {
  'use strict';

  function WOW(options) {
    options = options || {};
    this.boxClass     = options.boxClass     || 'wow';
    this.animateClass = options.animateClass || 'animated';
    this.offset       = options.offset       || 0;
    this.mobile       = options.mobile !== false;
    this.live         = options.live !== false;
    this.callback     = options.callback     || null;
    this._observer    = null;
  }

  WOW.prototype.init = function () {
    if (!this.mobile && /Mobi/i.test(navigator.userAgent)) { return; }
    this._setup();
    if (this.live) { this._watchDom(); }
    return this;
  };

  WOW.prototype._setup = function () {
    var self    = this;
    var root    = document.documentElement;
    var rootMargin = '0px 0px -' + this.offset + 'px 0px';

    this._observer = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          self._animate(entry.target);
          self._observer.unobserve(entry.target);
        }
      });
    }, { root: null, rootMargin: rootMargin, threshold: 0.1 });

    this._observeAll(document);
  };

  WOW.prototype._observeAll = function (scope) {
    var self = this;
    var els  = scope.querySelectorAll('.' + this.boxClass);
    [].forEach.call(els, function (el) {
      el.style.visibility = 'hidden';
      self._observer.observe(el);
    });
  };

  WOW.prototype._animate = function (el) {
    var delay    = el.getAttribute('data-wow-delay')    || '0s';
    var duration = el.getAttribute('data-wow-duration') || '';
    var iteration = el.getAttribute('data-wow-iteration') || '';

    if (delay)     { el.style.animationDelay    = delay; }
    if (duration)  { el.style.animationDuration = duration; }
    if (iteration) { el.style.animationIterationCount = iteration; }

    el.style.visibility = 'visible';
    el.classList.add(this.animateClass);

    if (typeof this.callback === 'function') {
      this.callback(el);
    }
  };

  WOW.prototype._watchDom = function () {
    var self = this;
    if (!window.MutationObserver) { return; }
    var mo = new MutationObserver(function (mutations) {
      mutations.forEach(function (m) {
        [].forEach.call(m.addedNodes, function (node) {
          if (node.nodeType === 1) {
            if (node.classList.contains(self.boxClass)) {
              node.style.visibility = 'hidden';
              self._observer.observe(node);
            }
            self._observeAll(node);
          }
        });
      });
    });
    mo.observe(document.body, { childList: true, subtree: true });
  };

  return WOW;
}));
</script>
<script type="text/javascript" src="<?php echo base_url(); ?>assest/js/theme.js" ></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assest/js/client.js"></script>

<script type="text/javascript" src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
 


<!-- Latest compiled JavaScript -->
</head>

/*!
 * Core animations module.
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

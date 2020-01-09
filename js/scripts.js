/* Parallax */
jQuery(document).ready(function(){
  ! function(r) {
    "use strict";
    "function" == typeof define && define.amd ? define("parollerjs", ["jquery"], r) : "object" == typeof module && "object" == typeof module.exports ? module.exports = r(require("jquery")) : r(jQuery)
  }(function(m) {
    "use strict";
    var g = !1,
      w = function() {
        g = !1
      },
      v = function(r, t) {
        return r.css({
          "background-position": "center " + -t + "px"
        })
      },
      x = function(r, t) {
        return r.css({
          "background-position": -t + "px center"
        })
      },
      b = function(r, t, o) {
        return "none" !== o || (o = ""), r.css({
          "-webkit-transform": "translateY(" + t + "px)" + o,
          "-moz-transform": "translateY(" + t + "px)" + o,
          transform: "translateY(" + t + "px)" + o,
          transition: "transform linear",
          "will-change": "transform"
        })
      },
      k = function(r, t, o) {
        return "none" !== o || (o = ""), r.css({
          "-webkit-transform": "translateX(" + t + "px)" + o,
          "-moz-transform": "translateX(" + t + "px)" + o,
          transform: "translateX(" + t + "px)" + o,
          transition: "transform linear",
          "will-change": "transform"
        })
      },
      y = function(r, t, o) {
        var n = r.data("paroller-factor"),
          a = n || o.factor;
        if (t < 576) {
          var e = r.data("paroller-factor-xs"),
            i = e || o.factorXs;
          return i || a
        }
        if (t <= 768) {
          var c = r.data("paroller-factor-sm"),
            f = c || o.factorSm;
          return f || a
        }
        if (t <= 1024) {
          var u = r.data("paroller-factor-md"),
            s = u || o.factorMd;
          return s || a
        }
        if (t <= 1200) {
          var l = r.data("paroller-factor-lg"),
            d = l || o.factorLg;
          return d || a
        }
        if (t <= 1920) {
          var p = r.data("paroller-factor-xl"),
            h = p || o.factorXl;
          return h || a
        }
        return a
      },
      z = function(r, t) {
        return Math.round(r * t)
      },
      M = function(r, t, o, n) {
        return Math.round((r - o / 2 + n) * t)
      },
      X = function(r) {
        return r.css({
          "background-position": "unset"
        })
      },
      j = function(r) {
        return r.css({
          transform: "unset",
          transition: "unset"
        })
      };
    m.fn.paroller = function(d) {
      var p = m(window).height(),
        h = m(document).height();
      d = m.extend({
        factor: 0,
        factorXs: 0,
        factorSm: 0,
        factorMd: 0,
        factorLg: 0,
        factorXl: 0,
        type: "background",
        direction: "vertical"
      }, d);
      return this.each(function() {
        var t = m(this),
          o = m(window).width(),
          n = t.offset().top,
          a = t.outerHeight(),
          r = t.data("paroller-type"),
          e = t.data("paroller-direction"),
          i = t.css("transform"),
          c = r || d.type,
          f = e || d.direction,
          u = y(t, o, d),
          s = z(n, u),
          l = M(n, u, p, a);
        "background" === c ? "vertical" === f ? v(t, s) : "horizontal" === f && x(t, s) : "foreground" === c && ("vertical" === f ? b(t, l, i) : "horizontal" === f && k(t, l, i)), m(window).on("resize", function() {
          var r = m(this).scrollTop();
          o = m(window).width(), n = t.offset().top, a = t.outerHeight(), u = y(t, o, d), s = Math.round(n * u), l = Math.round((n - p / 2 + a) * u), g || (window.requestAnimationFrame(w), g = !0), "background" === c ? (X(t), "vertical" === f ? v(t, s) : "horizontal" === f && x(t, s)) : "foreground" === c && r <= h && (j(t), "vertical" === f ? b(t, l) : "horizontal" === f && k(t, l))
        }), m(window).on("scroll", function() {
          var r = m(this).scrollTop();
          h = m(document).height(), s = Math.round((n - r) * u), l = Math.round((n - p / 2 + a - r) * u), g || (window.requestAnimationFrame(w), g = !0), "background" === c ? "vertical" === f ? v(t, s) : "horizontal" === f && x(t, s) : "foreground" === c && r <= h && ("vertical" === f ? b(t, l, i) : "horizontal" === f && k(t, l, i))
        })
      })
    }
  });
  jQuery(".parallax").paroller({
    factor: 0.5,
    factorXs: 0.2,
    type: 'background',
    direction: 'vertical'
  });
  jQuery(".parallax-slow").paroller({
    factor: 0.05,
    factorXs: 0.025,
    type: 'background',
    direction: 'vertical'
  });
  jQuery(".parallax-horizontal").paroller({
    factor: 0.5,
    factorXs: 0.2,
    type: 'background',
    direction: 'horizontal'
  });
});
/* Facebook */
jQuery(document).ready(function(){
  (function(e, a, f) {
    var c, b = e.getElementsByTagName(a)[0];
    if (e.getElementById(f)) {
      return
    }
    c = e.createElement(a);
    c.id = f;
    c.aync = true;
    c.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v3.2&appId=299891797151646&autoLogAppEvents=1";
    b.parentNode.insertBefore(c, b)
  }(document, "script", "facebook-jssdk"))
});
/* Scroll to Top */
jQuery(document).ready(function(){
  jQuery("a[href='#top']").click(function() {
  jQuery("html, body").animate({ scrollTop: 0 }, "slow");
  return false;
  });
});
/* Carousel */
if ("undefined" == typeof jQuery) {
  throw new Error("Bootstrap's JavaScript requires jQuery")
} + function(a) {
  var b = a.fn.jquery.split(" ")[0].split(".");
  if (b[0] < 2 && b[1] < 9 || 1 == b[0] && 9 == b[1] && b[2] < 1 || b[0] > 3) {
    throw new Error("Bootstrap's JavaScript requires jQuery version 1.9.1 or higher, but lower than version 4")
  }
}(jQuery), + function(c) {
  function d(e) {
    return this.each(function() {
      var g = c(this),
        h = g.data("bs.carousel"),
        i = c.extend({}, b.DEFAULTS, g.data(), "object" == typeof e && e),
        j = "string" == typeof e ? e : i.slide;
      h || g.data("bs.carousel", h = new b(this, i)), "number" == typeof e ? h.to(e) : j ? h[j]() : i.interval && h.pause().cycle()
    })
  }
  var b = function(g, e) {
    this.$element = c(g), this.$indicators = this.$element.find(".carousel-indicators"), this.options = e, this.paused = null, this.sliding = null, this.interval = null, this.$active = null, this.$items = null, this.options.keyboard && this.$element.on("keydown.bs.carousel", c.proxy(this.keydown, this)), "hover" == this.options.pause && !("ontouchstart" in document.documentElement) && this.$element.on("mouseenter.bs.carousel", c.proxy(this.pause, this)).on("mouseleave.bs.carousel", c.proxy(this.cycle, this))
  };
  b.VERSION = "3.4.0", b.TRANSITION_DURATION = 600, b.DEFAULTS = {
    interval: 5000,
    pause: "hover",
    wrap: !0,
    keyboard: !0
  }, b.prototype.keydown = function(e) {
    if (!/input|textarea/i.test(e.target.tagName)) {
      switch (e.which) {
        case 37:
          this.prev();
          break;
        case 39:
          this.next();
          break;
        default:
          return
      }
      e.preventDefault()
    }
  }, b.prototype.cycle = function(e) {
    return e || (this.paused = !1), this.interval && clearInterval(this.interval), this.options.interval && !this.paused && (this.interval = setInterval(c.proxy(this.next, this), this.options.interval)), this
  }, b.prototype.getItemIndex = function(e) {
    return this.$items = e.parent().children(".item"), this.$items.index(e || this.$active)
  }, b.prototype.getItemForDirection = function(j, h) {
    var e = this.getItemIndex(h),
      g = "prev" == j && 0 === e || "next" == j && e == this.$items.length - 1;
    if (g && !this.options.wrap) {
      return h
    }
    var i = "prev" == j ? -1 : 1,
      k = (e + i) % this.$items.length;
    return this.$items.eq(k)
  }, b.prototype.to = function(h) {
    var e = this,
      g = this.getItemIndex(this.$active = this.$element.find(".item.active"));
    return h > this.$items.length - 1 || 0 > h ? void 0 : this.sliding ? this.$element.one("slid.bs.carousel", function() {
      e.to(h)
    }) : g == h ? this.pause().cycle() : this.slide(h > g ? "next" : "prev", this.$items.eq(h))
  }, b.prototype.pause = function(e) {
    return e || (this.paused = !0), this.$element.find(".next, .prev").length && c.support.transition && (this.$element.trigger(c.support.transition.end), this.cycle(!0)), this.interval = clearInterval(this.interval), this
  }, b.prototype.next = function() {
    return this.sliding ? void 0 : this.slide("next")
  }, b.prototype.prev = function() {
    return this.sliding ? void 0 : this.slide("prev")
  }, b.prototype.slide = function(g, t) {
    var u = this.$element.find(".item.active"),
      k = t || this.getItemForDirection(g, u),
      m = this.interval,
      i = "next" == g ? "left" : "right",
      v = this;
    if (k.hasClass("active")) {
      return this.sliding = !1
    }
    var e = k[0],
      q = c.Event("slide.bs.carousel", {
        relatedTarget: e,
        direction: i
      });
    if (this.$element.trigger(q), !q.isDefaultPrevented()) {
      if (this.sliding = !0, m && this.pause(), this.$indicators.length) {
        this.$indicators.find(".active").removeClass("active");
        var h = c(this.$indicators.children()[this.getItemIndex(k)]);
        h && h.addClass("active")
      }
      var j = c.Event("slid.bs.carousel", {
        relatedTarget: e,
        direction: i
      });
      return c.support.transition && this.$element.hasClass("slide") ? (k.addClass(g), "object" == typeof k && k.length && k[0].offsetWidth, u.addClass(i), k.addClass(i), u.one("bsTransitionEnd", function() {
        k.removeClass([g, i].join(" ")).addClass("active"), u.removeClass(["active", i].join(" ")), v.sliding = !1, setTimeout(function() {
          v.$element.trigger(j)
        }, 0)
      }).emulateTransitionEnd(b.TRANSITION_DURATION)) : (u.removeClass("active"), k.addClass("active"), this.sliding = !1, this.$element.trigger(j)), m && this.cycle(), this
    }
  };
  var f = c.fn.carousel;
  c.fn.carousel = d, c.fn.carousel.Constructor = b, c.fn.carousel.noConflict = function() {
    return c.fn.carousel = f, this
  };
  var a = function(m) {
    var i = c(this),
      h = i.attr("href");
    h && (h = h.replace(/.*(?=#[^\s]+$)/, ""));
    var e = i.attr("data-target") || h,
      k = c(document).find(e);
    if (k.hasClass("carousel")) {
      var j = c.extend({}, k.data(), i.data()),
        g = i.attr("data-slide-to");
      g && (j.interval = !1), d.call(k, j), g && k.data("bs.carousel").to(g), m.preventDefault()
    }
  };
  c(document).on("click.bs.carousel.data-api", "[data-slide]", a).on("click.bs.carousel.data-api", "[data-slide-to]", a), c(window).on("load", function() {
    c('[data-ride="carousel"]').each(function() {
      var e = c(this);
      d.call(e, e.data())
    })
  })
  /* Tooltip */
}(jQuery), + function(b) {
  function c(e) {
    return this.each(function() {
      var f = b(this),
        g = f.data("bs.tooltip"),
        h = "object" == typeof e && e;
      !g && /destroy|hide/.test(e) || (g || f.data("bs.tooltip", g = new a(this, h)), "string" == typeof e && g[e]())
    })
  }
  var a = function(e, f) {
    this.type = null, this.options = null, this.enabled = null, this.timeout = null, this.hoverState = null, this.$element = null, this.inState = null, this.init("tooltip", e, f)
  };
  a.VERSION = "3.4.0", a.TRANSITION_DURATION = 150, a.DEFAULTS = {
    animation: !0,
    placement: "top",
    selector: !1,
    template: '<div class="tooltip" role="tooltip"><div class="tooltip-arrow"></div><div class="tooltip-inner"></div></div>',
    trigger: "hover focus",
    title: "",
    delay: 0,
    html: !1,
    container: !1,
    viewport: {
      selector: "body",
      padding: 0
    }
  }, a.prototype.init = function(h, e, p) {
    if (this.enabled = !0, this.type = h, this.$element = b(e), this.options = this.getOptions(p), this.$viewport = this.options.viewport && b(document).find(b.isFunction(this.options.viewport) ? this.options.viewport.call(this, this.$element) : this.options.viewport.selector || this.options.viewport), this.inState = {
        click: !1,
        hover: !1,
        focus: !1
      }, this.$element[0] instanceof document.constructor && !this.options.selector) {
      throw new Error("`selector` option must be specified when initializing " + this.type + " on the window.document object!")
    }
    for (var k = this.options.trigger.split(" "), g = k.length; g--;) {
      var m = k[g];
      if ("click" == m) {
        this.$element.on("click." + this.type, this.options.selector, b.proxy(this.toggle, this))
      } else {
        if ("manual" != m) {
          var j = "hover" == m ? "mouseenter" : "focusin",
            f = "hover" == m ? "mouseleave" : "focusout";
          this.$element.on(j + "." + this.type, this.options.selector, b.proxy(this.enter, this)), this.$element.on(f + "." + this.type, this.options.selector, b.proxy(this.leave, this))
        }
      }
    }
    this.options.selector ? this._options = b.extend({}, this.options, {
      trigger: "manual",
      selector: ""
    }) : this.fixTitle()
  }, a.prototype.getDefaults = function() {
    return a.DEFAULTS
  }, a.prototype.getOptions = function(e) {
    return e = b.extend({}, this.getDefaults(), this.$element.data(), e), e.delay && "number" == typeof e.delay && (e.delay = {
      show: e.delay,
      hide: e.delay
    }), e
  }, a.prototype.getDelegateOptions = function() {
    var f = {},
      e = this.getDefaults();
    return this._options && b.each(this._options, function(g, h) {
      e[g] != h && (f[g] = h)
    }), f
  }, a.prototype.enter = function(f) {
    var e = f instanceof this.constructor ? f : b(f.currentTarget).data("bs." + this.type);
    return e || (e = new this.constructor(f.currentTarget, this.getDelegateOptions()), b(f.currentTarget).data("bs." + this.type, e)), f instanceof b.Event && (e.inState["focusin" == f.type ? "focus" : "hover"] = !0), e.tip().hasClass("in") || "in" == e.hoverState ? void(e.hoverState = "in") : (clearTimeout(e.timeout), e.hoverState = "in", e.options.delay && e.options.delay.show ? void(e.timeout = setTimeout(function() {
      "in" == e.hoverState && e.show()
    }, e.options.delay.show)) : e.show())
  }, a.prototype.isInStateTrue = function() {
    for (var e in this.inState) {
      if (this.inState[e]) {
        return !0
      }
    }
    return !1
  }, a.prototype.leave = function(f) {
    var e = f instanceof this.constructor ? f : b(f.currentTarget).data("bs." + this.type);
    return e || (e = new this.constructor(f.currentTarget, this.getDelegateOptions()), b(f.currentTarget).data("bs." + this.type, e)), f instanceof b.Event && (e.inState["focusout" == f.type ? "focus" : "hover"] = !1), e.isInStateTrue() ? void 0 : (clearTimeout(e.timeout), e.hoverState = "out", e.options.delay && e.options.delay.hide ? void(e.timeout = setTimeout(function() {
      "out" == e.hoverState && e.hide()
    }, e.options.delay.hide)) : e.hide())
  }, a.prototype.show = function() {
    var x = b.Event("show.bs." + this.type);
    if (this.hasContent() && this.enabled) {
      this.$element.trigger(x);
      var j = b.contains(this.$element[0].ownerDocument.documentElement, this.$element[0]);
      if (x.isDefaultPrevented() || !j) {
        return
      }
      var k = this,
        B = this.tip(),
        h = this.getUID(this.type);
      this.setContent(), B.attr("id", h), this.$element.attr("aria-describedby", h), this.options.animation && B.addClass("fade");
      var t = "function" == typeof this.options.placement ? this.options.placement.call(this, B[0], this.$element[0]) : this.options.placement,
        w = /\s?auto?\s?/i,
        z = w.test(t);
      z && (t = t.replace(w, "") || "top"), B.detach().css({
        top: 0,
        left: 0,
        display: "block"
      }).addClass(t).data("bs." + this.type, this), this.options.container ? B.appendTo(b(document).find(this.options.container)) : B.insertAfter(this.$element), this.$element.trigger("inserted.bs." + this.type);
      var i = this.getPosition(),
        q = B[0].offsetWidth,
        g = B[0].offsetHeight;
      if (z) {
        var f = t,
          A = this.getPosition(this.$viewport);
        t = "bottom" == t && i.bottom + g > A.bottom ? "top" : "top" == t && i.top - g < A.top ? "bottom" : "right" == t && i.right + q > A.width ? "left" : "left" == t && i.left - q < A.left ? "right" : t, B.removeClass(f).addClass(t)
      }
      var y = this.getCalculatedOffset(t, i, q, g);
      this.applyPlacement(y, t);
      var e = function() {
        var l = k.hoverState;
        k.$element.trigger("shown.bs." + k.type), k.hoverState = null, "out" == l && k.leave(k)
      };
      b.support.transition && this.$tip.hasClass("fade") ? B.one("bsTransitionEnd", e).emulateTransitionEnd(a.TRANSITION_DURATION) : e()
    }
  }, a.prototype.applyPlacement = function(e, y) {
    var v = this.tip(),
      w = v[0].offsetWidth,
      x = v[0].offsetHeight,
      m = parseInt(v.css("margin-top"), 10),
      j = parseInt(v.css("margin-left"), 10);
    isNaN(m) && (m = 0), isNaN(j) && (j = 0), e.top += m, e.left += j, b.offset.setOffset(v[0], b.extend({
      using: function(i) {
        v.css({
          top: Math.round(i.top),
          left: Math.round(i.left)
        })
      }
    }, e), 0), v.addClass("in");
    var t = v[0].offsetWidth,
      h = v[0].offsetHeight;
    "top" == y && h != x && (e.top = e.top + x - h);
    var q = this.getViewportAdjustedDelta(y, e, t, h);
    q.left ? e.left += q.left : e.top += q.top;
    var g = /top|bottom/.test(y),
      k = g ? 2 * q.left - w + t : 2 * q.top - x + h,
      f = g ? "offsetWidth" : "offsetHeight";
    v.offset(e), this.replaceArrow(k, v[0][f], g)
  }, a.prototype.replaceArrow = function(g, e, f) {
    this.arrow().css(f ? "left" : "top", 50 * (1 - g / e) + "%").css(f ? "top" : "left", "")
  }, a.prototype.setContent = function() {
    var e = this.tip(),
      f = this.getTitle();
    e.find(".tooltip-inner")[this.options.html ? "html" : "text"](f), e.removeClass("fade in top bottom left right")
  }, a.prototype.hide = function(f) {
    function g() {
      "in" != h.hoverState && i.detach(), h.$element && h.$element.removeAttr("aria-describedby").trigger("hidden.bs." + h.type), f && f()
    }
    var h = this,
      i = b(this.$tip),
      e = b.Event("hide.bs." + this.type);
    return this.$element.trigger(e), e.isDefaultPrevented() ? void 0 : (i.removeClass("in"), b.support.transition && i.hasClass("fade") ? i.one("bsTransitionEnd", g).emulateTransitionEnd(a.TRANSITION_DURATION) : g(), this.hoverState = null, this)
  }, a.prototype.fixTitle = function() {
    var e = this.$element;
    (e.attr("title") || "string" != typeof e.attr("data-original-title")) && e.attr("data-original-title", e.attr("title") || "").attr("title", "")
  }, a.prototype.hasContent = function() {
    return this.getTitle()
  }, a.prototype.getPosition = function(h) {
    h = h || this.$element;
    var e = h[0],
      p = "BODY" == e.tagName,
      k = e.getBoundingClientRect();
    null == k.width && (k = b.extend({}, k, {
      width: k.right - k.left,
      height: k.bottom - k.top
    }));
    var g = window.SVGElement && e instanceof window.SVGElement,
      m = p ? {
        top: 0,
        left: 0
      } : g ? null : h.offset(),
      j = {
        scroll: p ? document.documentElement.scrollTop || document.body.scrollTop : h.scrollTop()
      },
      f = p ? {
        width: b(window).width(),
        height: b(window).height()
      } : null;
    return b.extend({}, k, j, f, m)
  }, a.prototype.getCalculatedOffset = function(f, g, e, h) {
    return "bottom" == f ? {
      top: g.top + g.height,
      left: g.left + g.width / 2 - e / 2
    } : "top" == f ? {
      top: g.top - h,
      left: g.left + g.width / 2 - e / 2
    } : "left" == f ? {
      top: g.top + g.height / 2 - h / 2,
      left: g.left - e
    } : {
      top: g.top + g.height / 2 - h / 2,
      left: g.left + g.width
    }
  }, a.prototype.getViewportAdjustedDelta = function(j, g, e, t) {
    var u = {
      top: 0,
      left: 0
    };
    if (!this.$viewport) {
      return u
    }
    var k = this.options.viewport && this.options.viewport.padding || 0,
      m = this.getPosition(this.$viewport);
    if (/right|left/.test(j)) {
      var h = g.top - k - m.scroll,
        v = g.top + k - m.scroll + t;
      h < m.top ? u.top = m.top - h : v > m.top + m.height && (u.top = m.top + m.height - v)
    } else {
      var f = g.left - k,
        q = g.left + k + e;
      f < m.left ? u.left = m.left - f : q > m.right && (u.left = m.left + m.width - q)
    }
    return u
  }, a.prototype.getTitle = function() {
    var g, e = this.$element,
      f = this.options;
    return g = e.attr("data-original-title") || ("function" == typeof f.title ? f.title.call(e[0]) : f.title)
  }, a.prototype.getUID = function(e) {
    do {
      e += ~~(1000000 * Math.random())
    } while (document.getElementById(e));
    return e
  }, a.prototype.tip = function() {
    if (!this.$tip && (this.$tip = b(this.options.template), 1 != this.$tip.length)) {
      throw new Error(this.type + " `template` option must consist of exactly 1 top-level element!")
    }
    return this.$tip
  }, a.prototype.arrow = function() {
    return this.$arrow = this.$arrow || this.tip().find(".tooltip-arrow")
  }, a.prototype.enable = function() {
    this.enabled = !0
  }, a.prototype.disable = function() {
    this.enabled = !1
  }, a.prototype.toggleEnabled = function() {
    this.enabled = !this.enabled
  }, a.prototype.toggle = function(f) {
    var e = this;
    f && (e = b(f.currentTarget).data("bs." + this.type), e || (e = new this.constructor(f.currentTarget, this.getDelegateOptions()), b(f.currentTarget).data("bs." + this.type, e))), f ? (e.inState.click = !e.inState.click, e.isInStateTrue() ? e.enter(e) : e.leave(e)) : e.tip().hasClass("in") ? e.leave(e) : e.enter(e)
  }, a.prototype.destroy = function() {
    var e = this;
    clearTimeout(this.timeout), this.hide(function() {
      e.$element.off("." + e.type).removeData("bs." + e.type), e.$tip && e.$tip.detach(), e.$tip = null, e.$arrow = null, e.$viewport = null, e.$element = null
    })
  };
  var d = b.fn.tooltip;
  b.fn.tooltip = c, b.fn.tooltip.Constructor = a, b.fn.tooltip.noConflict = function() {
    return b.fn.tooltip = d, this
  }
}(jQuery), + function(a) {
  function b() {
    var f = document.createElement("bootstrap"),
      c = {
        WebkitTransition: "webkitTransitionEnd",
        MozTransition: "transitionend",
        OTransition: "oTransitionEnd otransitionend",
        transition: "transitionend"
      };
    for (var d in c) {
      if (void 0 !== f.style[d]) {
        return {
          end: c[d]
        }
      }
    }
    return !1
  }
  a.fn.emulateTransitionEnd = function(d) {
    var c = !1,
      f = this;
    a(this).one("bsTransitionEnd", function() {
      c = !0
    });
    var g = function() {
      c || a(f).trigger(a.support.transition.end)
    };
    return setTimeout(g, d), this
  }, a(function() {
    a.support.transition = b(), a.support.transition && (a.event.special.bsTransitionEnd = {
      bindType: a.support.transition.end,
      delegateType: a.support.transition.end,
      handle: function(c) {
        return a(c.target).is(this) ? c.handleObj.handler.apply(this, arguments) : void 0
      }
    })
  })
}(jQuery);
/* Tooltips */
jQuery(document).ready(function(){
  jQuery('[data-toggle="tooltip"]').tooltip()
});

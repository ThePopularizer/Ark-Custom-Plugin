(function(e) {
  var d = document.getElementsByTagName("head")[0];
  var c = d.insertBefore;
  d.insertBefore = function(i, h) {
    if (i.href && i.href.indexOf("//fonts.googleapis.com/css?family=Roboto") > -1) {
      console.info("Prevented Roboto from loading!");
      return
    }
    c.call(d, i, h)
  };

  function g(i) {
    var j = i.find(".marker");
    var h = {
      zoom: 16,
      center: new google.maps.LatLng(0, 0),
      mapTypeId: google.maps.MapTypeId.ROADMAP,
      scrollwheel: false,
    };
    var k = new google.maps.Map(i[0], h);
    k.markers = [];
    j.each(function() {
      a(e(this), k)
    });
    b(k);
    return k
  }

  function a(i, k) {
    var l = new google.maps.LatLng(i.attr("data-lat"), i.attr("data-lng"));
    var h = new google.maps.Marker({
      position: l,
      map: k
    });
    k.markers.push(h);
    if (i.html()) {
      var j = new google.maps.InfoWindow({
        content: i.html()
      });
      google.maps.event.addListener(h, "click", function() {
        j.open(k, h)
      })
    }
  }

  function b(i) {
    var h = new google.maps.LatLngBounds();
    e.each(i.markers, function(k, j) {
      var l = new google.maps.LatLng(j.position.lat(), j.position.lng());
      h.extend(l)
    });
    if (i.markers.length == 1) {
      i.setCenter(h.getCenter());
      i.setZoom(16)
    } else {
      i.fitBounds(h)
    }
  }
  var f = null;
  function map() {
    e(".acf-map").each(function() {
      f = g(e(this))
    });
    e(".acf-map").removeClass("hidden")
  }
})(jQuery);

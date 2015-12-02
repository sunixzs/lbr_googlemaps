var LBRmedia = LBRmedia || {};

/**
 * 
 */
LBRmedia.GoogleMap = function() {
	this.locations = [];
	this.map = new LBRmedia.GoogleMap.Map();
	return this;
};

/**
 * @param string The CSS-ID of the Map-Container
 * @param float latitude
 * @param float longitude
 * @parma integer zoom
 * @return object
 */
LBRmedia.GoogleMap.prototype.initMap = function() {
	if (arguments[0]) {
		this.map.id = arguments[0];
	}
	if (arguments[1]) {
		this.map.latitude = arguments[1];
	}
	if (arguments[2]) {
		this.map.longitude = arguments[2];
	}
	if (arguments[3]) {
		this.map.options.zoom = arguments[3];
	}
	this.map.options.center = new google.maps.LatLng(this.map.latitude, this.map.longitude);
	this.map.obj = new google.maps.Map(document.getElementById(this.map.id), this.map.options);
};

/**
 * @param object The Parameters: title, longitude, latitude, tooltip
 * @return object Model: Location
 */
LBRmedia.GoogleMap.prototype.addLocation = function() {
	var location = new LBRmedia.GoogleMap.Location(arguments[0]);
	this.locations.push(location);
	this.showMarker(this, location);
	return location;
};

/**
 * @param object Model: Location
 */
LBRmedia.GoogleMap.prototype.showMarker = function(GoogleMapInstance, location) {
	var marker = new google.maps.Marker({
	  position : new google.maps.LatLng(location.latitude, location.longitude),
	  title : location.title
	});
	
	location.marker = marker;
	marker.setMap(GoogleMapInstance.map.obj);

	google.maps.event.addListener(marker, 'click', function() {
		GoogleMapInstance.showInfoWindow(GoogleMapInstance, location);
	});
};

/**
 * @param object Model: Location
 */
LBRmedia.GoogleMap.prototype.showInfoWindow = function(GoogleMapInstance, location) {
	GoogleMapInstance.closeAllInfoWindows(GoogleMapInstance);

	var infoWindow = new google.maps.InfoWindow({
	  content : location.tooltip,
	  maxWidth : 400
	  //pixelOffset : new google.maps.Size(0, 34)
	});
	
	infoWindow.open(GoogleMapInstance.map.obj, location.marker);
	location.infoWindow = infoWindow;
	
	google.maps.event.addListener(infoWindow, 'closeclick', function() {
		location.infoWindow = null;
	});
};

/**
 * @param object Instance of LBRmedia.GoogleMap
 */
LBRmedia.GoogleMap.prototype.closeAllInfoWindows = function(GoogleMapInstance) {
	for ( var i in GoogleMapInstance.locations) {
		if (GoogleMapInstance.locations[i].infoWindow) {
			GoogleMapInstance.locations[i].infoWindow.close();
			GoogleMapInstance.locations[i].infoWindow = null;
		}
	}
};

/**
 * Model Map
 */
LBRmedia.GoogleMap.Map = function() {
	this.obj = null; // @var google.maps.Map
	this.id = "";
	this.latitude = 0;
	this.longitude = 0;
	this.options = {
	  zoom : 14,
	  scrollwheel : false,
	  // disableDefaultUI: true,
	  navigationControl : true,
	  navigationControlOptions : {
		  style : google.maps.NavigationControlStyle.SMALL
	  },
	  mapTypeControl : true,
	  mapTypeControlOptions : {
		  style : google.maps.MapTypeControlStyle.DROPDOWN_MENU
	  },
	  scaleControl : true,
	  mapTypeId : google.maps.MapTypeId.ROADMAP
	};
	return this;
};

/**
 * Model Location
 * 
 * @param object
 */
LBRmedia.GoogleMap.Location = function() {
	this.title = arguments[0].title;
	this.latitude = arguments[0].latitude;
	this.longitude = arguments[0].longitude;
	this.tooltip = arguments[0].tooltip;
	this.marker = null; // @var google.maps.Marker
	this.infoWindow = null; // @var google.maps.InfoWindow
	return this;
}

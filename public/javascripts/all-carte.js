/*
 --------------------------------------------------------------------
 all-carte.js
 --------------------------------------------------------------------
 Creator : X.ROUILLY 10/02/2015
 --------------------------------------------------------------------
 (c) 2013. All Rights Reserved.  FCPE
 --------------------------------------------------------------------
 */

var maCarte = null;
var zoneMarqueurs = new google.maps.LatLngBounds();

function initialisationCarte(aintZoom) {
    var optionsCarte = {
        zoom: 1,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    }
    if (document.getElementById("map-container") != null){
        maCarte = new google.maps.Map( document.getElementById("map-container"), optionsCarte );
        for( var i = 0, I = tableauMarqueurs.length; i < I; i++ ) {
            ajouteMarqueur( tableauMarqueurs[i] );
        }
        if (aintZoom == -1){
            maCarte.fitBounds(zoneMarqueurs);
        }else{
            maCarte.setCenter(zoneMarqueurs.getCenter()); 
            maCarte.setZoom(aintZoom);
        }
    }
}

function ajouteMarqueur( latlng ) {
    if (maCarte != null){
        var latitude = latlng[0];
        var longitude = latlng[1];
        var optionsMarqueur = {
            map: maCarte,
            position: new google.maps.LatLng( latitude, longitude )
        };
        var marqueur = new google.maps.Marker( optionsMarqueur );
        zoneMarqueurs.extend( marqueur.getPosition() );
    }
}
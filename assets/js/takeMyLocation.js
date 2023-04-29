var lat1;
var lon1;
function setMyLocation(){
    const userAllowPos= (position)=> {
        console.log(position);
        const latitude=position.coords.latitude;
        const longitude=position.coords.longitude;
        const RETURN_POSITION_API=`https://api.bigdatacloud.net/data/reverse-geocode-client?
        latitude=${latitude}&longitude=${longitude}&localityLanguage=en`;
        fetch(RETURN_POSITION_API).then(res=> res.json()).then(data=>{
            document.cookie="city="+data.city;
            document.cookie="countryName="+data.countryName;
            document.cookie="locality="+data.locality;
            document.cookie="latitude="+position.coords.latitude;
            document.cookie="longitude="+position.coords.longitude;
            lat1=position.coords.latitude;
            lon1=position.coords.longitude;
            fetchDistenation(lat1,lon1);  
            fetchLocation(data.city,data.countryName,data.locality,position.coords.latitude,position.coords.longitude);  
            
      
        });
    }

    const userDontAllowPos= ()=> {
        console.log("Error with position");
    }
    navigator.geolocation.getCurrentPosition(userAllowPos,userDontAllowPos);
    
   


    
   

}
window.addEventListener('load', setMyLocation());

function CalculateCoordinate(lat1,lon1,lat2=21.42252,lon2=39.82621){
    
    var R = 6371; // Radius of the earth in km
    var dLat = deg2rad(lat2-lat1);  // deg2rad below
    var dLon = deg2rad(lon2-lon1); 
    var a = 
      Math.sin(dLat/2) * Math.sin(dLat/2) +
      Math.cos(deg2rad(lat1)) * Math.cos(deg2rad(lat2)) * 
      Math.sin(dLon/2) * Math.sin(dLon/2)
      ; 
    var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a)); 
    var d = R * c; // Distance in km
    return Math.round(d);
    
}
function angleToKaaba(lat1,lon1){
    return Math.round(Math.atan2( 39.82621 - lon1, 21.42252 - lat1 ) * ( 180 / Math.PI ));
}
function deg2rad(deg) {
    return deg * (Math.PI/180);
  }
function fetchDistenation(lat1,lon1){
   
        document.getElementById("k_Distance").innerHTML = CalculateCoordinate(lat1,lon1)+" km.";
}
function fetchLocation(city,countryName,locality,latitude,longitude){
    document.getElementById("k_Distance").innerHTML = CalculateCoordinate(lat1,lon1)+" km.";
    document.getElementById("user_lat_lng").innerHTML = latitude+" / "+longitude;
    document.getElementById("user_Locality").innerHTML = locality;
    document.getElementById("user_Country").innerHTML = countryName;
    document.getElementById("user_City").innerHTML = city;
    document.getElementById("k_angle").innerHTML = angleToKaaba(lat1,lon1)+ "<b>° SE</b>";
}

jQuery(function($){
	if($('#mapa').length > 0){
		setTimeout(function(){
			var map = L.map('mapa').setView([-33.4683978,-70.6256557], 12);
	
	    L.tileLayer('https://maps.googleapis.com/maps/vt?pb=!1m5!1m4!1i{z}!2i{x}!3i{y}!4i256!2m3!1e0!2sm!3i349018013!3m9!2sen-US!3sUS!5e18!12m1!1e47!12m3!1e37!2m1!1ssmartmaps!4e0').addTo(map);
			
			$.get('/wp-json/mad/v1/distribuidores', function(data){
				$.each(data, function(key,val){
					L.marker([val.geo.lat, val.geo.lng]).addTo(map).bindPopup('<h5><a href="'+val.url+'">'+val.title+'</a></h5><p><a href="'+val.url+'">'+val.geo.address+'</a></p>');
				});
			});
  	}, 500);			
	}
	if($('#mapa-single').length > 0){
		setTimeout(function(){
			var map = L.map('mapa-single').setView([-33.4683978,-70.6256557], 12);
	
	    L.tileLayer('https://maps.googleapis.com/maps/vt?pb=!1m5!1m4!1i{z}!2i{x}!3i{y}!4i256!2m3!1e0!2sm!3i349018013!3m9!2sen-US!3sUS!5e18!12m1!1e47!12m3!1e37!2m1!1ssmartmaps!4e0').addTo(map);
			
			$.get('/wp-json/mad/v1/distribuidores', function(data){
				$.each(data, function(key,val){
					L.marker([val.geo.lat, val.geo.lng]).addTo(map).bindPopup('<h5><a href="'+val.url+'">'+val.title+'</a></h5><p><a href="'+val.url+'">'+val.geo.address+'</a></p>');
				});
			});
			
			try{
				console.log('madDist', madDist.single);
				if(madDist.single){
					map.setView([madDist.single.lat,madDist.single.lng], madDist.single.zoom);
L.marker([madDist.single.lat,madDist.single.lng]).addTo(map).bindPopup('<h5>'+madDist.single.post.title+'</	h5><p>'+madDist.single.post.geo.address+'</p>').openPopup();
				}
			}catch(err){
				console.log(err);
			}

		}, 500);		
	}
	
});
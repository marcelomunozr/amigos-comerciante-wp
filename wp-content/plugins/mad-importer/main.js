jQuery(function($){
  var posts = [];
  var totalposts = '';
  var getPosts = function(){
    $.ajax({
    	type: 'GET',
      dataType: "json",
    	url: ajaxurl,
      data: {
        action : 'parser-init',
      },
    	success: function(response) {
        posts = response.response;
        totalposts = response.response.length;
        $('.init-numposts').html(response.response.length);
    	},
    	error: function(err){
    		console.error(err);
    		try{
    		} catch(e){}
    		}
    });
  }
  getPosts();

  var getPost = function(postid){
    var res = $.Deferred();
    $.ajax({
      type: 'GET',
      dataType: 'json',
      url: ajaxurl,
      data: {
        action: 'parser-post',
        postid,
        nonce: AjaxParserPost.nonce
      },
      success: function(response){
        res.resolve(response);
      },
      error: function(err){
        res.reject(err);
      }
    });
    return res.promise();
  };

  var percentageCalc = function(num){
    var percentage = 100 - Math.round((num * 100)/totalposts);
    $('.progress-bar').html(percentage + '%').css({
      width: percentage + '%'
    });
  }

  var looperPosts = function(){
    var res = $.Deferred();
    var nextPost = posts.splice(1, 1);
    if(nextPost){
      percentageCalc(posts.length);
      res.notify('Parseando Post: ' +  nextPost[0].intid + ', quedan ' + posts.length + 'posts.');
      $.when(getPost(nextPost[0].intid)).then(function(response){
        res.notify('Post guardado ID: ' + response + posts.length);
        $('.mad-status').html('<h5>' + 'Post procesado: ' +  nextPost[0].intid + ', quedan '+ posts.length +' posts.</h5>');
        looperPosts();
      }, function(err){
        res.notify(err.responseJSON + ', continuando. ' + 'Quedan ' + posts.length + 'posts.');
        $('.mad-status').html('<h5>' + err.responseJSON + ', continuando. Quedan ' + posts.length + ' posts.</h5>');
        looperPosts();
      });
    } else {
      res.resolve('Fin');
    }
    return res.promise();
  }

  $('#triggerGetPost').submit(function(e){
    looperPosts().then(function(response){
      $('.mad-status').html('<h4>¡Listo!</h4>');
    }, function(err){
      $('.mad-status').html('<h4>¡Error!</h4>');
    }, function(status){
      $('.mad-status').html('<h5>'+status+'</h5>');
    });
    $(this).find('button').attr('disable', true).html('Cargando...').removeClass('btn-success');
    e.preventDefault();
  });

})

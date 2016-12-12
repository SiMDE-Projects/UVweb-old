var initSearchBar = function(urlUVNameLike, urlForeignUVNameLike, urlUvDetail) {
  //Function used to show UV names to the user when he is typing
  $('#search-uv-name').typeahead({
    //Fetching the matching UV names
    source: function(query, process) {
      return $.ajax({
        url: urlUVNameLike,
        type: 'GET',
        data: {
          uvLike: query,
          limit: 10
        },
        dataType: 'json',
        success: function (result) {
					console.log(result);
                  return process(result.map(function(r) {
										if (r.uni) {
											return r.name + " <small>" + r.uni + "<span style=\"display:none;\">" + r.uniId + "</span></small>";
										} else return r.name;
									}));
        }
      });
    },
    //On click on a tab, the user is redirected to the UV
    updater: function (item) {
			if (item.match(/>(\d+)<\/span>/) && item.match(/\s<small>/)) {
				var id = item.match(/>(\d+)<\/span>/)[1]
				document.location = urlForeignUVNameLike + id + '/class/' + item.match(/(.*)\s<small>/)[1];
			} else {
      	document.location = urlUvDetail + '/' +encodeURIComponent(item);
			}
      return item;
    }
  });
};

var initDynamicList = function() {

	var uvLink = '';
	var $uvContainer = $('#uv-container');
	var $active; //To save the "active" tr

	$('table tbody tr[uv-name]').on('click', function(){
		//Getting the link of the clicked uv
		uvLink = $('td .uv-link', $(this)).attr('href');
		$.ajax({
			url: uvLink,
			type: 'POST',
			dataType: 'json',
			success: function(result) {
				if(result.status !== 'error') {
					$uvContainer.html(result.html);
				}
			}
		});

		if(typeof $active !== 'undefined' && $active !== $(this))
			$active.removeClass('active');

		$(this).addClass('active');
		$active = $(this);
	});

	//Scrolling buttom to top of the page
	$("#scroll-top-page").click(function() {
	    $('html, body').animate({
	        scrollTop: 0
	    }, 100);
	});
	
};

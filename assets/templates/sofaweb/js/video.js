		/**
		 * Sort jSon data by date
		 */
		var monthNames = [ "January", "February", "March", "April", "May", "June",
			"July", "August", "September", "October", "November", "December" ];
			
		var dayNames= ["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"];
		 
		jQuery.fn.sort = function() {  
			return this.pushStack( [].sort.apply( this, arguments ), []);  
		};  
		function sortDate(a,b){  
			 if (a.datetime == b.datetime){
			   return 0;
			 }
			 return a.datetime> b.datetime ? 1 : -1;  
		}; 
		function sortDateDesc(a,b){  
			return sortDate(a,b) * -1;  
		};
		
		/**
		 * Load Plasyer
		 */
		function getPlayer(data){  
			// Add HTML5 Video Plasyer
			var videoEmbed = $("<video/>");
				videoEmbed.attr('id',data.datetime);	
				videoEmbed.attr('data', data.path + data.thumbnail);
				videoEmbed.attr('title',data.name);	
				videoEmbed.attr('style','cursor: pointer;');
				videoEmbed.attr('autoplay','autoplay');
				videoEmbed.attr('controls','controls');
			
			// Add Sources
			$.each(data.files, function(i,source){
				
				 $("<source/>").attr('src',data.path + source.filename).attr('type',source.type).appendTo(videoEmbed);
				
			});
			
			return videoEmbed;
		}

		/*
		 * Load Video List
		 */
		function loadList(jSonData){
					
			// Add loader class
			$('#video-list').addClass('loader');	

			// Get Video data
			$.getJSON( jSonData, function(data) {
				
				// Sort List
				var rows = $(data.rows).sort(sortDateDesc);

				// Clear results	
				$('#video-list').removeClass('loader');	
				$('#page-info').text('Last update: ' + new Date(data.lastupdate*1000) );	
				
				// Add Video list
				var vMonthOld = '';
				$.each(rows, function(i,item){
					
					// Check Month
					var vDate = new Date(item.datetime*1000);
					var vMonth = vDate.getMonth()  + '-' + vDate.getFullYear() ;
					var vDateNice = dayNames[vDate.getDay()] + " " + vDate.getDate() + ' ' + monthNames[vDate.getMonth()] + ' ' + vDate.getFullYear();
					
					// Add new TAB if new month
					if( vMonthOld !== vMonth ){
						$("<li/>").html('<a href="#tab-'+vMonth+'">'+ monthNames[vDate.getMonth()] + ' ' + vDate.getFullYear() +'</a>').appendTo('#video-tabs');
						videoContainer = $("<div/>").attr('id','tab-'+vMonth).appendTo('#video-list');
					}
					vMonthOld = vMonth;
					
					var videoThumb = $("<a/>").attr('href','/stream/player.html?filename='+item.filename+'&hostname='+item.path+'').attr('title', vDate );
					videoThumb.addClass('thumb');
					videoThumb.addClass('fancybox');
					videoThumb.html('<img src="'+item.path+item.thumbnail+'" alt="'+vDate+'" />');
					// Add Thumbnail to list
					videoThumb.appendTo('#tab-'+vMonth);						
						
				});
				
				// Init Tabs
				$.getCSS("https://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/smoothness/jquery-ui.css");
				$.getScript("/assets/templates/default/js/libs/jquery-ui.min.js", function(){
					setTimeout(function(){				
						$( "#video-list" ).tabs();
					}, 100);
				});		

				// Init fancy box
				if($(".fancybox").length > 0) {
					$.getCSS('/assets/templates/fancybox/jquery.fancybox.css');
					$.getScript("/assets/templates/fancybox/jquery.mousewheel-3.0.6.pack.js", function(){
						$.getScript("/assets/templates/fancybox/jquery.fancybox.pack.js", function(){
							setTimeout(function(){
								$(".fancybox").fancybox({
									type: 'iframe',
									autoSize : true, 
									scrolling: 'no',
									/*fitToView: true,*/
									helpers : {
										title : {
											type : 'media'
										}
									}
								});
							}, 100);
						});
					});        
				}  
			});			
		}	


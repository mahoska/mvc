 $(function(){
	        bloks_total = $('body').find('.js-short-text');
	        if(bloks_total.length){
	            for(i=0; i < bloks_total.length;i++){
	                blok_height = Number($(bloks_total[i]).css('height').replace('px',''));
	                   
	                if(blok_height >60){
	                   $(bloks_total[i]).css('max-height','60px');
	                  $('body').find('.read-next').show();
	                }
	            }
	       }
	    })




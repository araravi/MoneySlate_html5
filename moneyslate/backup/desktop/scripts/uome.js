$(function()
{
	var screen_width = screen.width;
	var currentSlide = 0;
	var maxSlides = 5;
	//This number controls the max slide number, change this will do!!
	
	$(".frame").css('padding-right',function()
	{
		return screen_width-500;
	});
	
	
	
	function move(elem, x)
    {
        $(elem).animate({ left: x }, { duration: 550 });
    }

	function update_slider(index)
	{
		if(index==currentSlide)
		{
			return;
		}
		else
		{
			var elem = $('#slider-frame');
			var screen_width = screen.width;
			move(elem, 200-index * (screen_width));
		
			var bgelem = $("#bg");
			move(bgelem, 550-index * screen_width/4);
			
			//var logoelem = $("#logo");
			//move(logoelem, index*600+800);
			
			var captions = $(".captions");
			$(captions[currentSlide]).fadeOut();
			$(captions[index]).delay(550).queue(function(next){
				if(index!==0)
				{
					//$(".slider-caption").addClass("new-caption");
				}
				else
				{
					//$(".slider-caption").removeClass("new-caption");
				}
				next();
			}).fadeIn();
			
			$("#slider-nav ul li a.selected").removeClass("selected");
			$($("#slider-nav ul li a")[index]).addClass("selected");
			
			currentSlide = index;
		}
	}
	
	$("#next").click(function (){
            update_slider((currentSlide + 1) % maxSlides);
            return false;
        });
	$("#slider-frame").click(function (){
            update_slider((currentSlide + 1) % maxSlides);
            return false;
        });
		
	$('.frame').each(function(navIndex, elem){
            var dot = $('<li><a href="#"><span>' + navIndex + '</span></a></li>');
            $("#slider-nav ul").append(dot);
            dot.find("a").click(function (e)
            {
                update_slider(navIndex);
                return false;
            });
        });
	$("#slider-nav ul li a:first").addClass("selected");
	
	/*
	$('#slider-frame').hover(function(){
		$('#slider-next').fadeIn(200);
	},
	function(){
		$('#slider-next').fadeOut(200);
	});
	*/
	
});
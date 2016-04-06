
$('.home-cptarchive.home-actualites .excerpt').slideToggle();
$('.home-cptarchive.home-actualites').hover(function(){
	$(this).find('.excerpt, .post-thumbnail').slideToggle();
});

/* Progress bar */
/*
var circle = new ProgressBar.Circle('#quelques-chiffres .content > pre', {
    color: '#FCB03C',
    strokeWidth: 2,
    fill: '#aaa'
});

circle.animate(0.7, function() {
    //circle.animate(0);
});
*/

// Show hide content
/*
$('.home-cptarchive.toggle header').click( function(e){
	$(this).next('div').fadeIn();	
});
*/

// Show hide content
/*
$('.home-cptarchive.toggle .menu a').click( function(e){
	e.preventDefault();
	elStr = "#"+$(this).attr('rel');
	$(this).closest('.toggle').find('*[class|="content"].active')
		.animate({
			height:		0,
			opacity:	0
		})
		.toggleClass('active');
		$(elStr)
		.css({display:'block',height:0})
		.animate({
			height:		$(elStr).get(0).scrollHeight,
			opacity:	1
		})
		.toggleClass('active');
});

$('.home-cptarchive.toggle.home-offre').click( function(e){
	elStr = $(this).find('*[class|="content"]');
	$(this).parent().find('*[class|="content"].active')
		.animate({
			height:		0,
			opacity:	0
		})
		.toggleClass('active');
		$(elStr)
		.css({display:'block',height:0})
		.animate({
			height:		$(elStr).get(0).scrollHeight,
			opacity:	1
		})
		.toggleClass('active');
});
*/
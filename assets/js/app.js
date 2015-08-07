$(document).ready(function(){
  
	//CENTER ELEMENT


	var center_height = $(".intro_section--title").height();
	$(".intro_section--title").css("margin-top",-(center_height - 20)/2);


	$( ".instagram--tags" ).each(function() {
	  var center_height_tags = $( this ).height();
	  $( this ).css("margin-top",-(center_height_tags - 20)/2);
	});


	// ONLOAD

	$(".logo").css('opacity','1');
	$(".logo a svg").css('-webkit-transform','translateY(0px)');
	$(".nav-li").css('opacity','1');
	$(".nav-ul").css('-webkit-transform','translateY(0px)');

	$(".intro_section--title").css('opacity','1');

	$(".intro_section--title h2").css('opacity','1');

	//INTRO 1


	var win_height = $( window ).height();

	$(".intro_section--1").css("height",(win_height)-100);

	$( window ).resize(function() {
	  var win_height = $( window ).height();
	  $(".intro_section--1").css("height",(win_height)-100);
	});


	// CLOCK

	function GetClock(){
	var tzOffsetclock = +2; 

	var d=new Date();
	var dx=d.toGMTString();
	dx=dx.substr(0,dx.length -3);
	d.setTime(Date.parse(dx))
	d.setHours(d.getHours()+tzOffsetclock);


	var nday=d.getDay(),nmonth=d.getMonth(),ndate=d.getDate(),nyear=d.getYear(),nhour=d.getHours(),nmin=d.getMinutes(),nsec=d.getSeconds(),ap;

	     if(nhour==0){ap=" AM";nhour=12;}
		else if(nhour<12){ap=" AM";}
		else if(nhour==12){ap=" PM";}
		else if(nhour>12){ap=" PM";nhour-=12;}

	if(nyear<1000) nyear+=1900;
	if(nmin<=9) nmin="0"+nmin;
	if(nsec<=9) nsec="0"+nsec;

	document.getElementById('clock').innerHTML=""+nhour+":"+nmin+":"+nsec+ap+"";
	}

	window.onload=function(){

	  GetClock();
	  setInterval(GetClock,1000);

	}

	


	// IMG ANIM STUDIO

	$('.imgslide--1').each(function(){
    (function($set){
        setInterval(function(){
            var $cur = $set.find('.current_img').removeClass('current_img').fadeIn(3000);
            var $next = $cur.next().length?$cur.next():$set.children().eq(0);
            $next.addClass('current_img').fadeOut(3000);
        },2500);
	    })($(this));
	        
	});

	$('.imgslide--2').each(function(){
    (function($set){
        setInterval(function(){
            var $cur = $set.find('.current_img').removeClass('current_img').fadeIn(3000);
            var $next = $cur.next().length?$cur.next():$set.children().eq(0);
            $next.addClass('current_img').fadeOut(3000);
        },4000);
	    })($(this));
	        
	});


	

	// NAV SCROOL EFFECT


	// Hide Header on on scroll down
	var didScroll;
	var lastScrollTop = 0;
	var delta = 5;
	var navbarHeight = $('nav').outerHeight();

	$(window).scroll(function(event){
	    didScroll = true;
	});

	setInterval(function() {
	    if (didScroll) {
	        hasScrolled();
	        didScroll = false;
	    }
	}, 250);

	function hasScrolled() {
	    var st = $(this).scrollTop();
	    
	    // Make sure they scroll more than delta
	    if(Math.abs(lastScrollTop - st) <= delta)
	        return;
	    
	    // If they scrolled down and are past the navbar, add class .nav-up.
	    // This is necessary so you never see what is "behind" the navbar.
	    if (st > lastScrollTop && st > navbarHeight){
	        // Scroll Down
	        $('nav').removeClass('nav-down').addClass('nav-up');
	    } else {
	        // Scroll Up
	        if(st + $(window).height() < $(document).height()) {
	            $('nav').removeClass('nav-up').addClass('nav-down');
	        }
	    }
	    
	    lastScrollTop = st;
	}



	// ARROW APPEAR

	// get windows height

	

	$(window).scroll(function(){
	    
		var doc_height = $(document).height();
		var win_height = $(window).height();
		var scroll_top = $(document).scrollTop();
		if(scroll_top > (doc_height-win_height)-300){
			$("#arrow_footer svg").css('opacity','1');
			$("#arrow_footer svg").css('top','140px');

		}else{
			$("#arrow_footer svg").css('opacity','0');
			$("#arrow_footer svg").css('top','190px');
		}

	});


	// NAV BURGER


	

	$('.nav-burger').toggle(function () {
	    $(".nav-mobile").fadeIn(300);
	    $(".nav-burger").addClass('nav-burger--toggle');
	}, function () {
	    $(".nav-mobile").fadeOut(300);
	    $(".nav-burger").removeClass('nav-burger--toggle');
	});


});



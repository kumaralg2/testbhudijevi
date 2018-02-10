$(document).ready(function(){



	$('#smLink ul').hide();

   $('#smLink li > a').hover(
      function () {
      //show its submenu
        $(this).parent().children('ul').stop().slideDown(100);
      }
    );
   $('#smLink li').hover(null, 
      function (e) {
      //hide its submenu
        $(this).children('ul').stop().slideUp(100);
      }
   );


$('.jqte-test').jqte();
						   
					   
$('.signUpBlk').hide();					 

$('.signUpBtn').click(function(){
	
	$('.loginBlk').hide();
	
	$('.signUpBlk').show();		

});

$('.logInBtn').click(function(){
	
	$('.signUpBlk').hide();		
	$('.loginBlk').show();	

});



$('.signUpHeader h3 a').click(function(event){
	event.preventDefault();
	$('h3').removeClass('active')
	$(this).parent('h3').addClass('active');
	var url = $(this).attr('href');
	$('.signUpSection').fadeOut(300);
	$( '.'+url).fadeIn(300);
	
	
});


//$("ul.navSub").hide();
//		if($(window).width() > 991){
//			$("ul.navSub").hide();
//			$("li.tsMember").hover(
//			  function () {
//				 $(this).children("ul.navSub").fadeIn('medium');
//			  },
//			  function () {
//				$(this).children("ul.navSub").fadeOut('medium');
//			  }
//			);
//		}

	 $('.dropdown').dropkick();
	
	
	
	

	
		

	

		$("a.handle").click( function(event){
			event.preventDefault();
			if ( $(this).hasClass("fclose") ) {
				$(".slide-out-div").animate({right:"-290"}, 500);	    					
			} else {
				$(".slide-out-div").animate({right:"0"}, 500);
			}
			$(this).toggleClass("fclose");
			return false;
		});	
			
			
		
		
		
		
		
	
		

			

$(".inline").colorbox({
	inline:true,
	innerWidth:440,
	innerHeight:"660",
	fastIframe:false					  
});
	

$('.studentsBox a.inline').click(function(){
	$( ".goBack" ).trigger( "click" );		  
});

$('.products a.popReg').click(function(event){
	event.preventDefault();
	var url = $(this).attr('href');
	$( '.'+url).fadeIn(300);
	$('.products').fadeOut(300);
	$('html, body').animate({
		scrollTop: $(".sectionProducts").offset().top
	}, 500);
});


$('.loginSignUp a').click(function(event){
	event.preventDefault();
	var url = $(this).attr('href');
    
	$('html, body').animate({
		scrollTop: $('.sectionFastTrack').offset().top
	}, 500);
});

$('.goBack').click(function(event){
	event.preventDefault();
	$(this).parent().fadeOut();
	$('.products').fadeIn(300);
	
});



$('.profileList').hide();
$('.profileList:first').show();

$('.studentProfile li a').click(function(event){
	event.preventDefault();
	var url = $(this).attr('href');
	
	$('.profileList').hide();
	$( '.'+url).show();
	
	
});


	

$(".cList").mCustomScrollbar({
	theme:"minimal"
});
	

$('a.scrollDwn').click(function(){
    $('html, body').animate({
        scrollTop: $( $(this).attr('href') ).offset().top
    }, 500);
    return false;
});

$('a.howWorks,.contactDown').click(function(){
    $('html, body').animate({
        scrollTop: $( $(this).attr('href') ).offset().top
    }, 500);
    return false;
});

$("a[href='#top']").click(function() {
  $("html, body").animate({ scrollTop: 0 }, "slow");
  return false;
});



$('.menu').click(function(){
	$(this).toggleClass('close');
	if($(this).hasClass('close')){
		$('nav').fadeIn(500);
	}else{
		$('nav').fadeOut(500);
	}
});

/*	
$(window).on("scroll", function(e) {
	if ($(window).scrollTop() >= $("header").height()) $("header").fadeOut(500);
	else $("header").fadeIn(500);
});
*/

 //Check to see if the window is top if not then display button
        $(window).scroll(function(){
            if ($(this).scrollTop() > 100) {
                $('.goTop').fadeIn();
            } else {
                $('.goTop').fadeOut();
            }
        });

        // Click event to scroll to top
        $('.goTop').click(function(){
            $('html, body').animate({scrollTop : 0},800);
            return false;
        });



		

	
var resizeWidth = 0;         

function resizeDiv () {
//  if (resizeWidth != $(window).width()) {	
//	  	
//		if($(window).width() < 992){	
//		
//						
//			if($('.menu').hasClass('close')){
//				$('nav').show();
//			}else{
//				$('nav').hide();
//			}
//			
//			windowHeight = $(window).innerHeight();
//			$('nav').css('min-height', windowHeight);
//			
//		}else if($(window).width() > 991){
//			$('nav').css('min-height', 'auto');
//			$('nav').show();
//					
//		}
//		
//		
//		
//		
//		
//	 
//	   resizeWidth = $(window).width();
//   }       
 }
		 
resizeDiv();      

$(window).resize(function() { resizeDiv(); });   


$(window).resize(function () {
        
	
		
		if ($(window).width() > 991) {
			 $("ul.navSub").hide();
             $('li.tsMember').on('mouseenter.large', function () {
                 $(this).find('ul.navSub').fadeIn('medium');
             }).on('mouseleave.large', function () {
                 $(this).find('ul.navSub').fadeOut('medium');
             });
         } else {
			 $("ul.navSub").show();
             $('li.tsMember').off('mouseenter.large mouseleave.large');
         }
		 
}).resize(); //to initialize the value


$('.infoBox').hide();
 $('.infoBox:first').show();

$('.tabs li a').each(function(i){      
  $(this).attr('href','infoTab'+(i+1));
}); 

$('.infoBox').each(function(i){
  $(this).addClass('infoTab'+(i+1))
});

$('.tabs li a').click(function(e){
e.preventDefault();
$('.tabs li a').removeClass('active')
$(this).addClass('active');
$('.infoBox').hide();
showInfo =   $(this).attr('href');
$('.'+ showInfo).show();
});


$('.detailBox').hide();
 $('.detailBox:first').show();

$('.tabsList a').each(function(i){      
  $(this).attr('href','tab'+(i+1));
}); 

$('.detailBox').each(function(i){
  $(this).addClass('tab'+(i+1))
});

$('.tabsList a').click(function(e){
e.preventDefault();
$('.tabsList a').removeClass('active')
$(this).addClass('active');
$('.detailBox').hide();
showClass =   $(this).attr('href');
$('.'+ showClass).show();
});




});
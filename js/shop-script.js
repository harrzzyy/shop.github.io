// document
// 	.querySelector('#style-list')
// 	.addEventListener('click', function(e) {
// 		[].slice.call(document.querySelectorAll('#option-list > li img')).forEach(function(el) {
// 			el.classList.remove('active');
// 		});
// 		e.target.classList.add('active');
// 		[]
// 			.slice
// 			.call(document.querySelectorAll('#block-tovar-grid > li'))
// 			.forEach(function(element) {
// 				element.style.float = 'none'
// 			});
// 	});

// document
// 	.querySelector('#style-grid')
// 	.addEventListener('click', function(e) {
// 		[].slice.call(document.querySelectorAll('#option-list > li img')).forEach(function(el) {
// 			el.classList.remove('active');
// 		});
// 		e.target.classList.add('active');
// 		[]
// 			.slice
// 			.call(document.querySelectorAll('#block-tovar-grid > li'))
// 			.forEach(function(element) {
// 				element.style.float = 'left'
// 			});
// 	});
// 	





$(document).ready(function() {
	$("#style-grid").click(function(){

		$("#block-tovar-grid").show();
		$("#block-tovar-list").hide();

		$("#style-grid").attr("src","./images/icon-grid-active.png");
		$("#style-list").attr("src","./images/icon-list.png"); 

		$.cookie('select_style','grid');  	
	});

	$("#style-list").click(function(){

		$("#block-tovar-grid").hide();
		$("#block-tovar-list").show();

		$("#style-list").attr("src","./images/icon-list-active.png");
		$("#style-grid").attr("src","./images/icon-grid.png");

		$.cookie('select_style','list');  
	});
	if ($.cookie('select_style') == 'grid' )
	{
		$("#block-tovar-grid").show();
		$("#block-tovar-list").hide();

		$("#style-grid").attr("src","./images/icon-grid-active.png");
		$("#style-list").attr("src","./images/icon-list.png");     
	}
	else
	{
		$("#block-tovar-grid").hide();
		$("#block-tovar-list").show();

		$("#style-list").attr("src","./images/icon-list-active.png");
		$("#style-grid").attr("src","./images/icon-grid.png");    
	}

	$("#select-sort").on('click', function(){
		$("#sorting-list").slideToggle(200);
	});

	$('#block-category > ul > li > a').click(function(){

		if ($(this).attr('class') != 'active') {

			$('#block-category > ul > li > ul').slideUp(400);
			$(this).next().slideToggle(400);

			$('#block-category > ul > li > a').removeClass('active');
			$(this).addClass('active');
			$.cookie('select_cat', $(this).attr('id'));
		}
		else
		{
			$('#block-category > ul > li > a').removeClass('active');
			$('#block-category > ul > li > ul').slideUp(400);
			$.cookie('select_cat', '');
		}
		
	});

	if ($.cookie('select_cat') != '')
	{
		$('#block-category > ul > li > #'+$.cookie('select_cat')).addClass('active').next().show();
	}


	$('#genpass').click(function(){
		$.ajax({
			type: "POST",
			url: "./functions/genpass.php",
			dataType: "html",
			cache: false,
			success: function(data) {
				$('#reg_pass').val(data);
			}
		});

	});


	$('#reloadcaptcha').click(function(){
		$('#block-captcha > img').attr("src","./reg/reg_captcha.php?r="+ Math.random());
	});
/*
	 $('.top-auth').toggle(
       function() {
           $(".top-auth").attr("id","active-button");
           $("#block-top-auth").fadeIn(200);
       },
       function() {
           $(".top-auth").attr("id","");
           $("#block-top-auth").fadeOut(200);  
       }
    );*/


$('#button-pass-show-hide').click(function(){
 var statuspass = $('#button-pass-show-hide').attr("class");
  
    if (statuspass == "pass-show")
    {
       $('#button-pass-show-hide').attr("class","pass-hide");
       
     			            var $input = $("#auth_pass");
			                var change = "text";
			                var rep = $("<input placeholder='Пароль' type='" + change + "' />")
			                    .attr("id", $input.attr("id"))
			                    .attr("name", $input.attr("name"))
			                    .attr('class', $input.attr('class'))
			                    .val($input.val())
			                    .insertBefore($input);
			                $input.remove();
			                $input = rep;
        
    }else
    {
        $('#button-pass-show-hide').attr("class","pass-show");
        
     			            var $input = $("#auth_pass");
			                var change = "password";
			                var rep = $("<input placeholder='Пароль' type='" + change + "' />")
			                    .attr("id", $input.attr("id"))
			                    .attr("name", $input.attr("name"))
			                    .attr('class', $input.attr('class'))
			                    .val($input.val())
			                    .insertBefore($input);
			                $input.remove();
			                $input = rep;        
       
    }
  }); 

$("#button-auth").click(function() {
        
 var auth_login = $("#auth_login").val();
 var auth_pass = $("#auth_pass").val();

 
 if (auth_login == "" || auth_login.length > 30 )
 {
    $("#auth_login").css("borderColor","#FDB6B6");
    send_login = 'no';
 }else {
    
   $("#auth_login").css("borderColor","#DBDBDB");
   send_login = 'yes'; 
      }

 
if (auth_pass == "" || auth_pass.length > 15 )
 {
    $("#auth_pass").css("borderColor","#FDB6B6");
    send_pass = 'no';
 }else { $("#auth_pass").css("borderColor","#DBDBDB");  send_pass = 'yes'; }



 if ($("#rememberme").prop('checked'))
 {
    auth_rememberme = 'yes';

 }else { auth_rememberme = 'no'; }


 if ( send_login == 'yes' && send_pass == 'yes' )
 { 
  $("#button-auth").hide();
  $(".auth-loading").show();
    
    $.ajax({
  type: "POST",
  url: "./include/auth.php",
  data: "login="+auth_login+"&pass="+auth_pass+"&rememberme="+auth_rememberme,
  dataType: "html",
  cache: false,
  success: function(data) {

  if (data == 'yes_auth')
  {
      location.reload();
  }else
  {
      $("#message-auth").slideDown(400);
      $(".auth-loading").hide();
      $("#button-auth").show();
      
  }
  
}
});  
}
}); 

});

	$(document).ready(function(){

		var readMoreHtml = $(".product_description").html();
		var lessText = readMoreHtml.substr(0,200) ;
		lessText= lessText+"....." ;
		if(readMoreHtml.length > 200)
		{
			$(".product_description").html(lessText);
		}
		else
		{
			$(".product_description").html(readMoreHtml);
		}

		$("body").on("click" , ".more" , function(e){
			e.preventDefault();
			$(".product_description").html(readMoreHtml);
			$(".more").html("- Less");
			$(".more").addClass("less").removeClass("more");
		});


		$("body").on("click" , ".less" , function(e){
			e.preventDefault();
			$(".product_description").html(lessText);
			$(".less").html("+ More");
			$(".less").addClass("more").removeClass("less");
		});
	});

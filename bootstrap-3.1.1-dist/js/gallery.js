$(document).ready(function($){

	$.ajax({
                type:"POST",
                url:"dohvatislike.php",
                dataType:"json",
                data : 
                    {

                     },
                success:function(json){
                	var op = "";
                	for (var i = 0; i < json.length; i++){
                     op += "<img src="+ json[i]+ ">";
                    	
     				}
                  $('.galleria').append(op); 
                
                }
               
            });

	  Galleria.loadTheme('galleria/themes/classic/galleria.classic.min.js');
				Galleria.run('.galleria', {
    transition: 'fade',
    imageCrop: true
 });

	});
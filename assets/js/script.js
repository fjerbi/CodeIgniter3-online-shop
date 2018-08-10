var main = function() {
	
  $('.day').click(function() {
    $(this).next().toggle(300);
    $(this).find('span').toggleClass('glyphicon-minus');
     });
   $('.weekday').find('p').first('.weekdays').text('Today');
   //$('.weekdays:eq(0)').text('Today');
   $('.weekdays:eq(1)').text('Tomorrow');

   };

$(document).ready(main);

//var d = new Date().getDay(); alert(d); 
// 	$('.weekday').each(function(){
		// $(this).data('today');
		
		// });
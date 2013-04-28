
$(document).ready(function(){
var saveTimer;
searchBox = $('#q');
products =  $('#products');
message = $('#message');
preloader = $('#preload');
infoPane =$('#infoPanel');
preloader.css('visibility','hidden');
var results;
var title1;
var search;

/************************************************************************************************************
Functions that handle the input in the search bar and then call the search server ajaxProductSearch()
************************************************************************************************************/
searchBox.on('input',function(e)
{
  // Clearing the timeout prevents
  // saving on every key press
    clearTimeout(saveTimer);
  // If the field is not empty, schedule a search
    if($.trim(searchBox.val()).length > 0) 
    {
        search = $.trim(searchBox.val());
        saveTimer = setTimeout(ajaxProductsSearch, 2000);
    }
});

$('form').submit(function(e)
   {
	  e.preventDefault();
	  if($.trim(searchBox.val()).length > 0) 
	   {
      	clearTimeout(saveTimer);
      	ajaxProductsSearch();
       }
    });
//************************************************************************************************************
//************************************************************************************************************



//************************************************************************************************************
//************************************************************************************************************
function ajaxProductsSearch(){
   products.empty();
   preloader.css('visibility','visible')
   preloader.attr("src","data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wCEAAkGBggGBQkIBwgKCQkKDRYODQwMDRoTFBAWHxwhIB8cHh4jJzEqIyUvJR4eKzssLzM1ODg4LCo9QTw2QTI0ODMBCQoKDgwNDg4LECkYHhgpKSkpKSkpKSkpKSkpKSkpKSkpKSkpKSkpKSkpKSkpKSkpKSkpKSkpKSkpKSkpKSkpKf/AABEIABgAJgMBIgACEQEDEQH/xAAaAAEBAAIDAAAAAAAAAAAAAAAABgUHAgME/8QAKhAAAgEDAgUCBwEAAAAAAAAAAQIDAAQFBhESITFBURNCFCIjUmFxcgf/xAAUAQEAAAAAAAAAAAAAAAAAAAAA/8QAFBEBAAAAAAAAAAAAAAAAAAAAAP/aAAwDAQACEQMRAD8A3jUocxmNR308Wn2htbG3cxteSrxGRh1CDxVNdI8lpKkZ2dkIU+DtyqU0dnMdjdKWcF1KLaRJHgk4wdlk3J+Y9t/zQc7nIZ/S5Fzk5Yspjd9pZIo+CSIH3bDkRVVDKk8KSxMHjkUMrDuD0NYHN6jxMmHyUK3KXHp27BwnzLu3ILv03JPSu3RkqvpOxQSrI8UQSQA80Ye0jsRQZylKUCp3LaPivL6S9x93Jj7mUbS8Chkl/pTyNKUHhb/PReQMmTyk8+wPpLEixRxt93CORNTuQbUWlchF9L15uIKl3GpPxCdkcDqf3zHmlKDZ8LM8CNIvA7KCy+D4pSlB/9k=")

// Issue a request to the proxy
  $.post('results2.php', 
   {
   'search' : searchBox.val()
    },
    
    
//************************************************************************************************************
//************************************************************************************************************    
function(data) 
 {
    //No results found so this happens
     if(data.totalItems == 0)
       {
         preloader.css('visibility','hidden');
         message.css('visibility','visible');
         message.html("We couldn't find anything!").show();
         return false;
        }

     results= data; 
     $.each(data.items, function(i, item)
    {
    	var index= i; 
        message.css('visibility','hidden');
        var html = ' <a class="product" data-price="$ '+item.product.inventories[0]['price']+'" href="'+"negotiate2.php?id="+ ""+index+ "" + "&search=" + ""+ search+ ""+'" target="_self">';
        // If the product has images
        if(item.product.images && item.product.images.length > 0)
         {
	     html += '<img alt="'+item.product.author['name']+'" src="'+ item.product.images[0]['link']+'"/>';
         }
        html+='<span>'+item.product.author['name']+'</span></a> ';
        products.append(html);
       /* var price1 = results.items[index].product.inventories[0]['price'];
        var image1 = results.items[index].product.images[0]['link'];
        var seller1= results.items[index].product.author['name'];
        $.post( "products.php", 
           { id : index, title : results.items[index].product.title, price: price1, image: image1, seller : seller1}
         );
           */
     });

    preloader.css('visibility','hidden');

  },'json');
  //************************************************************************************************************
  //************************************************************************************************************

}// closes the ajaxProductsSearch()

/* Attempt at avoiding using a database :(
$('p').click(function()
{
 title1= results.items[0].product.title;
 $('h2').text(title1);
 });
 
 */

});

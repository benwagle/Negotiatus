
$(document).ready(function(){
var saveTimer;
searchBox = $('#q');
products =  $('#products');
message = $('#message');
preloader = $('#preload');
preloader.css('visibility','hidden');
var results;
var title1;
var search;
var low= -1;
var high= 12;
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

$('#searching').submit(function(e)
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
   $('#next').css('visibility','hidden');
    $('#prev').css('visibility','hidden');
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
    if((index >low) && (index < high))
    {
        var html = ' <a class="product" id = "'+index+'" data-price= "$'+item.product.inventories[0]['price']+ '" href="#" >';
        // If the product has images
        if(item.product.images && item.product.images.length > 0)
         {
	     html += '<img title= "' + item.product.title + '" alt="'+item.product.author['name']+'" src="'+ item.product.images[0]['link']+'"/>';
         }
        html+='<span>'+item.product.author['name']+'</span></a> ';
        products.append(html);
    }
       /* var price1 = results.items[index].product.inventories[0]['price'];
        var image1 = results.items[index].product.images[0]['link'];
        var seller1= results.items[index].product.author['name'];
        $.post( "products.php", 
           { id : index, title : results.items[index].product.title, price: price1, image: image1, seller : seller1}
         );
           */
     });
	$("#splash").css('display','none');
    preloader.css('visibility','hidden');
    $('#next').css('visibility','visible');
    $('#prev').css('visibility','visible');

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
  $(document).on('click', '.product', function(e) {
  var number = this.id;
  var price= results.items[number].product.inventories[0]['price'];
  var seller = results.items[number].product.link;
  var Title= $(this).children('img').attr('title');
  var imageURL= $(this).children('img').attr('src');
  $(".photos").css('background-image', 'url('+imageURL+')');
  $(".price").html("List: $"+ price);
  $(".prodTitle").html(Title.toUpperCase());
  $(".sellerPage").children('a').attr('href', seller);
  $("#negotiate2").css('visibility','visible'); 
  $("#itemNum").attr('value',number); 
  $("#itemSearch").attr('value',searchBox.val()); 
   e.preventDefault();
   });
  
$('#cancel').click(function()
{
$("#negotiate2").css('visibility','hidden');
 });
 
 
 $('#next').click(function()
{
if((low+12) < 100 )
{
   low+=12;
   high+=12;
   ajaxProductsSearch();
 }
 });
 
  $('#prev').click(function()
{
  if(low!= -1)
  {
   low-=12;
   high-=12;
   ajaxProductsSearch();
   }
 });
 
});


  $(document).on('click', '#login', function(e) { 
   $("#loginBox").css('display','inline'); 
   $("#loginText").css('display','block'); 
   $("#registerText").css('display','none'); 
   });
   
   $(document).on('click', '#register', function(e) { 
   $("#loginBox").css('display','inline'); 
   $("#loginText").css('display','none'); 
   $("#registerText").css('display','block'); 
   });
   
   

   
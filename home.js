
$(document).ready(function(){
var saveTimer;
searchBox = $('#q');
products =  $('#products');
message = $('#message');
var results;
var title1;
var search;
var low= -1;
var high= 21;

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
   //products.empty();
   $('#next').css('display','none');
    $('#prev').css('display','none');
 

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
         message.css('visibility','visible');
         message.html("We couldn't find anything!").show();
         return false;
        }
        results1= data; 
        //alert(data['Items']['Item']['ItemAttributes']['Title']);
        //alert(data['Items']['Item'][0]['MediumImage']['URL']);
        var n;
        
        //bad way of doing this
        if(searchBox.val().indexOf("http") != -1)
          {
				if(searchBox.val().indexOf("amazon.com") != -1)
				 {
				   /*
					message.css('visibility','hidden');
					var html = ' <a class="product" id = "single" data-price= "'+data['Items']['Item']['Offers']["Offer"]["OfferListing"]["Price"]['FormattedPrice']+ '" href="#" >';
					// If the product has images
					html += '<img title= "'+data['Items']['Item']['ItemAttributes']['Title']+'" alt="'+data['Items']['Item']['ItemAttributes']['Title']+'" src="'+ data['Items']['Item']['MediumImage']['URL']+'"/>';
					html+='<span>'+data['Items']['Item']['ItemAttributes']['Title']+'</span></a> ';
					products.append(html);
					$("#cont").css('display','none');
					//$('#next').css('display','inline');
					//$('#prev').css('display','inline');
					 $('#container').css('height','900px');
					 */
					 var price= data['Items']['Item']['Offers']["Offer"]["OfferListing"]["Price"]['FormattedPrice'];
					 // var seller = results.items[number].product.link;
					  //var Title= $(this).children('img').attr('title');
					  var Title= data['Items']['Item']['ItemAttributes']['Title'];
					  //var imageURL= $(this).children('img').attr('src');
					  var imageURL= data['Items']['Item']['MediumImage']['URL'];
					  $("#itemPic").attr('src', imageURL);
					  $(".price").html("List: "+ price);
					  $(".prodTitle").html(Title.toUpperCase());
					  $(".sellerPage").children('a').attr('href', searchBox.val() ); 
					  //$("#itemNum").attr('value',number); 
					  //$("#itemSearch").attr('value',searchBox.val()); 
					  $("#title1").attr('value',Title); 
					  $("#image1").attr('value',imageURL);
					  $("#link1").attr('value',searchBox.val()); 
					  $("#price1").attr('value',price); 
					  $("#negotiate2").css('visibility','visible');	 
					 
				 } 	 
				 
				 else
				 {
				   $.ajax({
   			 		 url : 'index.php',
    		 		type : 'post',
     				data : $('#searching').serialize(),
     
     
						success : function(data) 
								{
					
							 Messenger.options = {
							 extraClasses: 'messenger-fixed messenger-on-top',
							 theme: 'air'
								};
			   
							 Messenger().post({
							message: 'Fetching product info, make sure you are logged in!',
							 showCloseButton: true
							 });
							}
      			 	});
      			 	
      			 	 var price= "pending";
					 // var seller = results.items[number].product.link;
					  //var Title= $(this).children('img').attr('title');
					  var Title= "Fetching product info from: </br>" + searchBox.val();
					  //var imageURL= $(this).children('img').attr('src');
					  var imageURL= "N.jpg";
					  $("#itemPic").attr('src', imageURL);
					  $(".price").html("List: "+ price);
					  $(".prodTitle").html(Title);
					  $(".sellerPage").children('a').attr('href', searchBox.val() ); 
					  //$("#itemNum").attr('value',number); 
					  //$("#itemSearch").attr('value',searchBox.val()); 
					  $("#title1").attr('value',Title); 
					  $("#image1").attr('value',imageURL);
					  $("#link1").attr('value',searchBox.val()); 
					  $("#price1").attr('value',price); 
					  $("#negotiate2").css('visibility','visible');	
    	           }
    	  }
    	
    	else
    	{
 		 for(n=0; n<9; n++)
        	{
				message.css('visibility','hidden');
				var html = ' <a class="product" id = "'+n+'" data-price= "'+data['Items']['Item'][n]['Offers']["Offer"]["OfferListing"]["Price"]['FormattedPrice']+ '" href="#" >';
				// If the product has images
				html += '<img title= "'+data['Items']['Item'][n]['ItemAttributes']['Title']+'" alt="'+data['Items']['Item'][n]['ItemAttributes']['Title']+'" src="'+ data['Items']['Item'][n]['MediumImage']['URL']+'"/>';
				html+='<span>'+data['Items']['Item'][n]['ItemAttributes']['Title']+'</span></a> ';
				products.append(html);
    	    }
    	    $("#cont").css('display','none');
			//$('#next').css('display','inline');
			//$('#prev').css('display','inline');
			 $('#container').css('height','900px');
    	}
    	
       /* var price1 = results.items[index].product.inventories[0]['price'];
        var image1 = results.items[index].product.images[0]['link'];
        var seller1= results.items[index].product.author['name'];
     
     /*
     $.each(data.results, function(i, item)
    {
       //alert(item.sitedetails[0].latestoffers[0]['seller']);
    	var index= i; 
        message.css('visibility','hidden');
    if((index >low) && (index < high))
    {
        var html = ' <a class="product" id = "'+index+'" data-price= "$'+item['price']+ '" href="#" >';
        // If the product has images
        if(item.images && item.images.length > 0)
         {
	     html += '<img title= "'+item['name']+'" alt="'+item['name']+'" src="'+ item.images[0]+'"/>';
         }
        html+='<span>'+item.sitedetails[0].latestoffers[0]['seller']+'</span></a> ';
        products.append(html);
    }
       /* var price1 = results.items[index].product.inventories[0]['price'];
        var image1 = results.items[index].product.images[0]['link'];
        var seller1= results.items[index].product.author['name'];
        $.post( "products.php", 
           { id : index, title : results.items[index].product.title, price: price1, image: image1, seller : seller1}
         );
           
     });
     */
	

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
  //var number = this.id;
  // if(number!="single")
//   	var price= results1['Items']['Item'][number]['Offers']["Offer"]["OfferListing"]["Price"]['FormattedPrice'];
//   else
//     var price= results1['Items']['Item']['Offers']["Offer"]["OfferListing"]["Price"]['FormattedPrice'];
 // var seller = results.items[number].product.link;
  var price= $(this).attr('data-price');
  var Title= $(this).children('img').attr('title');
  //var Title= data['Items']['Item']['ItemAttributes']['Title'];
  var imageURL= $(this).children('img').attr('src');
  //var imageURL= data['Items']['Item']['MediumImage']['URL'];
  $("#itemPic").attr('src', imageURL);
  $(".price").html("List: "+ price);
  $(".prodTitle").html(Title.toUpperCase());
  //$(".sellerPage").children('a').attr('href', searchBox.val() ); 
  //$("#itemNum").attr('value',number); 
  //$("#itemSearch").attr('value',searchBox.val()); 
  $("#title1").attr('value',Title); 
  $("#image1").attr('value',imageURL); 
  $("#link1").attr('value',searchBox.val()); 
  $("#price1").attr('value',price); 
  
  $("#negotiate2").css('visibility','visible');
  e.preventDefault();
   });

  
$('.negButton').click(function() {
   // a sample AJAX request
  
  if($('#buyer2').attr('value') == "")
  	{
   		   Messenger.options = {
		     extraClasses: 'messenger-fixed messenger-on-top',
	  	   		theme: 'air'
               }
               
       	 Messenger().post({
        	   message: 'You did not set a price!',
           		showCloseButton: true
           });
    }
    
   else
    {
    
   		$.ajax({
   			  url : 'index.php',
    		 type : 'post',
     		data : $('#negForm').serialize(),
     
     
    		 success : function(data) 
    			 {
    			     $("#buyer").attr('value',''); 
        			 $("#buyer2").attr('value',''); 
       				 $("#negotiate2").css('visibility','hidden'); 
        			
        
       				 Messenger.options = {
	    			 extraClasses: 'messenger-fixed messenger-on-top',
	     			 theme: 'air'
               			};
               
       				 Messenger().post({
           			message: 'Your negotiation has been received!!!',
          			 showCloseButton: true
          			 });
          			 
          			 //products.empty();
     		         //$("#cont").css('display','inline');
      			 }
       
       
     		});
     		
     
     }
});

 
$('#cancel').click(function()
{
	$("#buyer").attr('value',''); 
    $("#buyer2").attr('value',''); 
	$("#negotiate2").css('visibility','hidden');
 });
 
 
 $('#next').click(function()
{
if((low+21) < 100 )
{
   low+=21;
   high+=21;
   ajaxProductsSearch();
 }
 });
 
 
 
  $('#prev').click(function()
{
  if(low!= -1)
  {
   low-=21;
   high-=21;
   ajaxProductsSearch();
   }
 });
 
});


  $(document).on('click', '#login', function(e) { 
   $(".loginBox").css('display','inline'); 
   $(".loginText").css('display','block'); 
  $("#dispMen").css('display','none'); 
   });
   
   $(document).on('click', '.Qs', function(e) { 
   var ansArray= ["Negotiatus is a revolutionary ecommerce platform that allows a buyer to approach any seller for any item. The buyer names their price. The seller then chooses to accept the deal, decline the deal, or continue negotiating until a mutually beneficial deal is reached.", 
   
   					"The retail market is inefficient. Too often deals die before they can even get off the ground. Buyers are happy to negotiate the price for “major purchases” in their lives (has anyone ever paid list price for a house or a car?), but then become mute for all other purchase (clothes, electronics, appliances…the list goes on). Well this just doesn’t seem fair to us. ", 
   					
   					"Get a voice. Stop catering to the whims of sellers. Deal on your own terms. Never pay list price again. Get the products you love for the prices you want. We are here to help. Stop waiting for sites to offer a flash sale and tell you what products you want. If multiple buyers are seeking the same item, Negotiatus will reach out on their behalf to get the best price. ",
   					
   					"All you have to do is register. On the home screen, type in your email address and create a password. You will receive a confirmation email from the Negotiatus team confirming your registration and welcoming you to the ecommerce revolution.",
   					
   					 "Initiate. 1) Search for any item you want. Once you find something, click on the picture to begin negotiating. 2) Drag the Negotiatus logo (insert picture of the N or if possible make the n dragable) \
   					  located on the home screen to your favorites toolbar. Next time you are shopping on a site and do not want to pay list price, click the “n” (insert n) that appears in your favorites toolbar and name your price.\
   					   The item will be transported to your Negotiatus dashboard. Negotiate. Name your price and any other specifications that are necessary (quantity, size, color, etc.), then select “negotiate”. You will receive a confirmation receipt showing the details of your negotiation.\
   					    Also, the item will be transported to your Negotiatus dashboard. Luxuriate. Access your Negotiatus dashboard to count your savings and review all pending negotiations. Feel free to share your success stories via Facebook or Twitter.",
   					 
   					 "Inventory turnover. Your products don’t look as good sitting in a warehouse collecting dust. Detailed analytics. \
   					  1) Understand the demand for your product in real time.\
   					  2) Use our algorithms to determine the optimal price point for your product based on time.\
   					  3) Gauge the health of your brand across social media and message boards.",
   					  
   					 "All you have to do is register. On the home screen, type in your email address and create a password. You will receive a confirmation email from the Negotiatus team confirming your registration and welcoming you to the ecommerce revolution.",
   					 
   					 "Negotiatus will inform you via email when a buyer is interested in your product. FOR REGISTERED SELLERS: the negotiation will be reflected in your dashboard. Use Negotiatus’ custom analytics as a reference to analyze the offer and respond to the buyer via the negotiation room."];
   
   $("#clickedQ").text($(this).text()); 
   var ansID= this.id;
   ansID= ansID.slice(1)-1;
   var answer= ansArray[ansID];
   $("#showAns").text(answer); 
   });
	
   
   function nameTaken()
   {
      alert("ASDAS");
   }
   

   
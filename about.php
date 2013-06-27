<?php
session_start();
require 'sessions.php';

 if(isset($_GET['outszo']))
     logout();

?>

<html>
<head>

<title> About Negotiatus </title>
<link rel="stylesheet" href="home.css">

</head>
<body>
<div class="header">
    <a href="index.php"><img class= "logo" src="logo.png"></a>
    <div id="loginBox">
    
         <form id="loginText" action="login.php" method="post">
    		username:<input type="text" maxlength="30" name="user"/>
    		password:<input type="password" name="pass"/>
    		<input type="submit" value="Login"/>
         </form>
         
         <form id="registerText" action="register.php" method="post">
    		username:<input type="text" maxlength="30" name="user2"/>
    		email:<input type="text" maxlength="30" name="email"/>
    		<br/>
    		password:<input type="password" name="pass1"/>
    		retype password:<input type="password" name="pass2"/>
    		<br/>
    		<input type="submit" value="Register"/>
         </form>
         
    </div>
    <?php 
     if(isLoggedIn()) 
          echo '<div id="menu2"> <a href="index.php">search</a> |&nbsp <a href="dashboard.php">dashboard</a> |&nbsp<a href="?outszo">logout</a></div>';
    else
          echo '<div id="menu"> <a id="login" href="#">login</a>/ <a id="register" href="#">register</a> </div>';
     ?>
</div>  
<b class="about">
<p class="ques"> What is your product? Negotiatus is the new way to shop online. <p>  The current market environment is inefficient: too often deals die before they get off the ground.  Negotiatus allows the buyer to approach any seller and name their own price.  The seller then chooses to accept, decline, or continue negotiating.  Once the terms are set, the buyer checks out, counts his savings, and cannot wait to negotiate again.  
 <br/>
 <br/>
 
<p class="ques"> What is the problem you are solving? </p> Why do customers need you? Who are your competitors? There is a reason why financial markets are so efficient: buyers and sellers let each other know exactly what price they will be willing to pay/accept in order to facilitate deals.  Negotiatus brings this concept to retail by eliminating inefficient pricing to maximize customer satisfaction and seller profits. Negotiatus empowers the buyer to improve their shopping experience, allowing them to get the products they love for the prices they want.  
<br/>
 <br/>
 
Our only real competition is complacency.  Sites such as Ebay, Zaarly, and Priceline approximate the problem but do not venture far enough to solve it.    
 <br/>
 <br/>

<p class="ques"> What is the market size/opportunity? </p> The market is expansive.  It is simple, Negotiauts can be used for any purchase, any transaction (i.e. clothes, books, electronics, B2B).  Buyers are happy to negotiate the price for major purchases in their lives (does anyone pay sticker price for a house or car?) but acquiesce to seller demands for day-to-day items (when was the last time you negotiated the price of a pair of shoes, laptop, or refrigerator?).  Negotiatus opens the buyer’s eyes to a revolutionary way of shopping.  
<br/>
 <br/>
 
<p class="ques"> What is your competitive advantage?</p> Negotiatus is the first mover in an untapped market.  Negotiatus offers a clean interface, allowing buyers to easily search, negotiate, and luxuriate.  Additionally, Negotiatus provides a proprietary matching platform and recommendation engine to further enhance the user experience.  

Negotiatus also allows buyers to create flash sales for products they actually want, not products websites (Groupon... cough...) decide to sell.  Our competitive advantage also delves into the seller experience.  We create price decay curves relative to time, offering a "what's it worth now" function by analyzing the market to recommend the appropriate market price for any product and the opportune time. 

 <br/>
 <br/>
 
<p class="ques"> What is your business model? </p> Negotiatus is a commission based business with packages varying in price depending on the level of service desired by the seller.  All fees are calculated based on a percentage of total sales.  Packages range from hosting to "featured seller" to a comprehensive analytics package.  
<br/>
 <br/>
There has been a trend in seller feedback: trust is disappearing from the market.  Therefore, we align Negotiatus' success with the success of the sellers.  Since the benefits to the buyer are so abundant, it is important to us that sellers realize the opportunity set with variable pricing and targeted analytics is equally as robust. 

<br/>
 <br/>
 
Negotiatus has begun to file a provisional patent for: A method, system and software product that creates a multivariate marketplace for goods and services, offering a mode of exchange and means of variable pricing based on time and quantity
<br/>
 <br/>
 
<p class="ques"> Financial markets are powerful.  By correcting market inefficiencies, the retail market can become equally as powerful.  Welcome to the ecommerce revolution.  </p>
<b>
</body>
</html>
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Safaricom Liz</title>
			
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet" type="text/css">

    <!-- Styles -->
<style>
      body{
    font-family: "Source Sans Pro", sans-serif;
    margin: 0;
    padding: 10px;
       }

    .container {
	display: flex;
    height: 92vh;
    align-items: flex-end;
    justify-content: space-around;
    border: solid;
	border-color: forestgreen;
    width: 49%;	
	border-radius: 1%;
	border-width: thin;	
	float: left;
	bottom: 5%;
    position: absolute;
	left: 4%;
        }
	
	.instructions {
	display: flex;
    height: 90vh;
    align-items: flex-end;
    justify-content: space-around;
    width: 49%;	
	float: right;
      }	
 
 @media (max-width: 1026px) {
    .instructions { display: none; }
	.container {width: 90%;}
}
 
      div#banner { 
	height: 2px;
    position: absolute; 
    top: 0; 
    left: 0; 
    background-color: forestgreen; 
    width: 100%; 
     }
	 
     div#services {
	position: absolute;
    top: 30%;
    font-family: Noto Sans KR,sans-serif;
    font-size: 3vh;
    font-weight: bold;
    text-align: center;
    right: 8%;
     }
	 
     div#main-content { 
    padding-top: 70px;
    }
	
	 div.image {
	content:url(/logo.png);
	position: absolute;
    bottom: 0%;
	right: 0%;
	height: 30%;
	max-width: 100%;
	}​

</style>
</head>
<body onload="startkey"> 
  <div id="banner">

  </div>
<div class="container">
    <div class="content" id="app" style="width: 90%;">
        <botman-tinker api-endpoint="/botman"></botman-tinker>
		<p style="color: forestgreen;">Type "Hi Liz" to start logging your defects.</p>
    </div>
</div>
    <div class="instructions">
	  <div id="services">
Meet Liz!<br>
The virtual Crowd Tester Assistant..<br>
Ready to assist you raise your defects 24/7.<br>
Just follow the instructions. <br>
As She takes through the paces.<br><br>

  </div>
    <div class="image"></div>

    </div>
<script src="/js/app.js"></script>
</body>
</html>
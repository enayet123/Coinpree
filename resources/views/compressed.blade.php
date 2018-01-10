<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
<meta charset=utf-8>
<meta http-equiv=X-UA-Compatible content="IE=edge">
<meta name=viewport content="width=device-width, initial-scale=1">
<title>Coinpree</title>
<link rel=apple-touch-icon sizes=180x180 href=/favicon/apple-touch-icon.png>
<link rel=icon type=image/png sizes=32x32 href=/favicon/favicon-32x32.png>
<link rel=icon type=image/png sizes=16x16 href=/favicon/favicon-16x16.png>
<link rel=manifest href=/favicon/manifest.json>
<link rel=mask-icon href=/favicon/safari-pinned-tab.svg color=#5bbad5>
<link rel="shortcut icon" href=/favicon/favicon.ico>
<meta name=msapplication-config content=/favicon/browserconfig.xml>
<meta name=theme-color content=#ffffff>
<link href="https://fonts.googleapis.com/css?family=Raleway:100,300,600%7CLato:100,400%7COpen+Sans:300" rel=stylesheet>
<style>html,body{margin:0;padding:0;font-family:'Raleway',sans-serif;font-weight:100;background-color:#f8f8f8;width:100%;min-height:600px}header{width:calc(100% - 4em);padding:2em;box-shadow:0 0 10px rgba(0,0,0,0.3)}#shade{position:absolute;top:0;left:0;background-color:rgba(0,0,0,0.3);width:100vw;height:100vh;display:none}#logo{position:absolute;font-size:1.3em;border:1px solid black;border-radius:.125em;box-sizing:content-box;display:inline-block;padding:.1em .125em}#title{font-size:1.5em;margin:0 auto;text-align:center}#title *{font-weight:bold;display:inline-block}#body{padding:calc(((100vh - 100px) / 2) - 50px) 0;text-align:center;font-family:'Lato',sans-serif}@media screen and (max-width:800px){body{font-size:10px}#body{font-size:8px}.number,.currency{border:1px}#logo{font-weight:bold}}@media screen and (min-width:800px){#crypto,#fiat{display:inline-block}}.number,.currency{display:inline-block;text-align:center;font-size:4em}.number,.currency{padding:10px;display:inline-block;border:2px solid lightgrey;border-radius:.2em;text-transform:uppercase}.number{border-top-right-radius:0;border-bottom-right-radius:0;background-color:white;font-weight:400}.currency{background-color:#efefef;border-top-left-radius:0;border-bottom-left-radius:0;font-weight:200}.equals{display:inline;font-size:4.2em!important;padding:0 .1em}.dropdown{display:none;position:absolute;top:calc((100vh / 2) -((64px * 7) / 2));left:calc((100vw / 2) - 50px);height:0;width:0}.dropdown ul{list-style-type:none;padding:0}.dropdown ul li{font-size:40px!important;width:100px;height:50px;background-color:#efefef;text-align:center;line-height:50px;border:2px solid lightgrey;border-radius:.2em;margin:5px}#info{padding:5vh 5vw;font-family:'Open Sans',sans-serif}#info h1{font-size:1.5em}#info *{font-size:1em}footer{height:70px;background-color:#999;width:100%;margin-bottom:20px;line-height:70px}footer a,footer div{display:inline-block;padding:0;color:white}.footer-text{width:calc(70vw - 20px);padding-left:20px;font-family:'Open Sans',sans-serif}.social{width:15vw;text-align:center;-o-transition:background .2s ease-in;-ms-transition:background .2s ease-in;-moz-transition:background .2s ease-in;-webkit-transition:background .2s ease-in;transition:background .2s ease-in;font-size:1.2em}.social:hover{background-color:grey;-o-transition:background .2s ease-in;-ms-transition:background .2s ease-in;-moz-transition:background .2s ease-in;-webkit-transition:background .2s ease-in;transition:background .2s ease-in}.linkedin{background-color:#1e83ae;font-weight:bold}.github{background-color:#24292e}</style>
<script src=https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js></script>
<script>function update(){var a="http://portfolicko.com/api/price?";var b="symbol="+$("#crypto .currency").html();$.get(a+b,function(d){var c=JSON.parse(d);if(c.error==undefined){$("#title div:first-child").html(c.cryptocurrency);$("#title div:last-child").html($("#fiat .currency").html());$("#fiat").attr("data-price",c.price);$("#crypto").attr("data-crypto",$("#crypto .currency").html())}else{$("#crypto .currency").html($("#crypto").data("crypto"))}updateFiat()})}function updateFiat(){$("#fiat .number").html($("#fiat").attr("data-price")*$("#crypto .number").html()*$("#fiat .currency").attr("data-rate"));$("#fiat .number").html(Number(parseFloat($("#fiat .number").html()).toFixed(2)).toLocaleString("en"));document.title=$("#fiat .number").html()+" "+$("#fiat .currency").html()+" Coinpree"}function updateCrypto(){var a=$("#fiat").data("price");$("#crypto .number").html(removeCommas($("#fiat .number").html())/a);$("#crypto .number").html(Number(parseFloat($("#crypto .number").html()).toFixed(10)).toLocaleString("en"))}function removeCommas(a){return Number(a.split(",").join(""))}function getSelectedTextLength(){var a="";if(typeof window.getSelection!="undefined"){a=window.getSelection().toString()}else{if(typeof document.selection!="undefined"&&document.selection.type=="Text"){a=document.selection.createRange().text}}return a.length}function getConversionRates(){var b="https://api.fixer.io/latest?base=USD&symbols=";var a="USD,GBP,EUR,CAD,AUD,JPY,CNY";$(".dropdown ul li:first-child").attr("data-rate",1);$.get(b+a,function(c){$(".dropdown ul li").each(function(){$(this).attr("data-rate",c.rates[$(this).html()])})}).always(function(){selectFiat()})}function selectFiat(){var a="{{ $fiat or 'USD' }}";if(a>""){$(".dropdown ul li").each(function(){if(a==$(this).html()){$("#fiat .currency").html($(this).html());$("#fiat .currency").attr("data-rate",$(this).data("rate"));return false}})}}$(document).ready(function(){$("#crypto .currency").on("keyup",function(){if($("#crypto .currency").html().length==3){if($("#crypto .currency").html()!=$("#crypto").data("crypto")){update()}}});$("#crypto .number").on("keyup",function(){if(!isNaN($(this).html())){updateFiat($(this).html()*$("#fiat").data("price"))}});$("#fiat .number").on("keyup",function(){if(!isNaN(removeCommas($(this).html()))){updateCrypto()}});$("span").on("keypress",function(b){if(b.which==13){return false}});$("span").on("keyup",function(){$("#body >:not(.dropdown)").css("display","inline-block");if(($("body").width()*0.9)<($("#crypto").width()+$(".equals").width()+$("#fiat").width())){$("#body >:not(.dropdown)").css("display","block")}else{$("#body >:not(.dropdown)").css("display","inline-block")}var b="calc(((100vh - 100px) / 2) - "+($("#body").height()/2)+"px) 0";$("#body").css("padding",b)});$(".currency").on("keydown",function(b){if($(this).html().length>2&&b.which!=8&&getSelectedTextLength()==0){return false}});$("#shade").on("click",function(){$(".dropdown").fadeOut("fast",function(){$("#shade").fadeOut()})});$("#fiat .currency").on("click",function(){$(this).blur();$("#shade").fadeIn("fast",function(){$(this).parent().find(".dropdown").fadeIn()})});$(".dropdown ul li").on("click",function(){$("#fiat .currency").html($(this).html());$("#fiat .currency").attr("data-rate",$(this).data("rate"));$(".dropdown").fadeOut("fast",function(){$("#shade").fadeOut("fast",function(){updateFiat();if($("#fiat .currency").html()=="USD"){history.pushState({},"","/")}else{history.pushState({},"",$("#fiat .currency").html())}})})});var a="calc(((100vh - 100px) / 2) - "+($("#body").height()/2)+"px) 0";$("#body").css("padding",a);getConversionRates();setInterval(function(){update()},60000);update()});</script>
</head>
<body>
<div id=shade></div>
<header>
<div id=logo>
COINPREE
</div>
<div id=title>
<div></div> to <div></div>
</div>
</header>
<div id=body>
<div id=crypto>
<span contenteditable=true class=number>1</span>
<span spellcheck=false contenteditable=true class=currency>BTC</span>
</div>
<div class=equals>=</div>
<div id=fiat>
<span contenteditable=true class=number>0</span>
<span spellcheck=false contenteditable=true class=currency data-rate=1>USD</span>
<div class=dropdown>
<ul>
<li>USD</li>
<li>GBP</li>
<li>EUR</li>
<li>CAD</li>
<li>AUD</li>
<li>JPY</li>
<li>CNY</li>
</ul>
</div>
</div>
</div>
<div id=info>
<div>
<h1>About</h1>
<ul>
<li>Coinpree supports hundreds of cryptocurrencies using data from our partner <a href=http://www.portfolicko.com target=_blank>Portfolicko.com</a>.</li>
<li>All prices are initially stored in USD and converted to other currencies using exchange rate data provided by <a href=http://fixer.io target=_blank>fixer.io</a> on demand.</li>
<li>Prices are updated every minute and displayed in the title of the tab allowing you to keep an eye on the price of the cryptocurrency of interest.</li>
<li>The price of each currency is the average selling price calculated using multiple exchanges (Typically excluding outliers)</li>
</ul>
<h1>Usage</h1>
<ol>
<li>Select the cryptocurrency of choice using the 3 letter symbol e.g. BTC, XRP, ETH. (The default is BTC)</li>
<li>Enter data that represents the amount of cryptocurrency or fiat you wish to evaluate against<br>
<ol type=a>
<li>Left Box: Enter the amount of cryptocurrency you wish to evaluate</li>
<li>Right Box: Enter the amount in a fiat currency you wish to see represented as a cryptocurrency</li>
</ol>
</li>
<li>Watch the price of the cryptocurrency change over time</li>
</ol>
<h1>Disclaimer</h1>
<p>Although coinpree prices are produced using sources of which are believed to be reliable, no warranty, expressed or implied, is made regarding accuracy, adequacy, completeness, legality, realiability or usefulness. This disclaimer applied to both isolated and aggregate uses of the information. All information on this site is subject to change without notice.</p>
</div>
</div>
<footer>
<div class=footer-text>© 2018 - Coinpree</div><a href=https://uk.linkedin.com/in/enayet-hussain-a150b77a><div class="linkedin social">in</div></a><a href=https://github.com/enayet123/><div class="github social">GitHub</div></a>
</footer>
</body>
</html>
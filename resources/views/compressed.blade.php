<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-63150348-2"></script>
<script>window.dataLayer=window.dataLayer||[];function gtag(){dataLayer.push(arguments)}gtag("js",new Date());gtag("config","UA-63150348-2");</script>
<meta charset=utf-8>
<meta http-equiv=X-UA-Compatible content="IE=edge">
<meta charset=UTF-8>
<meta name=description content="The quickest and simplest way to convert hundreds of cryptocurrencies with a wide range of fiat currencies. Prices are automatically updated and show in the tab of your browser to help keep track of the cryptocurrency of interest. Convert from BTC, XRP, ETH, BCH, etc. to USD, GBP, CNY, JPY, EUR and many more!">
<meta name=keywords content=Cryptocurrency,Coin,Trading,Blockchain,Bitcoin,BTC>
<meta name=author content="Enayet Hussain">
<meta name=viewport content="width=device-width, initial-scale=1">
<meta name=google-site-verification content=Csz6X8_dgevRyueUHLfL-qsdi_0b2J-rc0Me0L8JnBI />
<title>Coinpree - Cryptocurrency price converter and tracker</title>
<link rel=apple-touch-icon sizes=180x180 href=/favicon/apple-touch-icon.png>
<link rel=icon type=image/png sizes=32x32 href=/favicon/favicon-32x32.png>
<link rel=icon type=image/png sizes=16x16 href=/favicon/favicon-16x16.png>
<link rel=manifest href=/favicon/manifest.json>
<link rel=mask-icon href=/favicon/safari-pinned-tab.svg color=#5bbad5>
<link rel="shortcut icon" href=/favicon/favicon.ico>
<meta name=msapplication-config content=/favicon/browserconfig.xml>
<meta name=theme-color content=#ffffff>
<link href="https://fonts.googleapis.com/css?family=Raleway:100,300,600%7CLato:100,400%7COpen+Sans:300" rel=stylesheet>
<link rel=stylesheet type=text/css href=/css/style.css>
<script src=https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js></script>
<script>function update(){var a="http://portfolicko.com/api/price?";var b="symbol="+$("#crypto .currency").html();$.get(a+b,function(c){result=c["0"][$("#crypto .currency").html().toUpperCase()];if(c["0"].error==undefined){$("#title div:first-child").html(result.name);$("#title div:last-child").html($("#fiat .currency").html());$("#fiat").attr("data-price",result.price);$("#crypto").attr("data-crypto",$("#crypto .currency").html())}else{$("#crypto .currency").html($("#crypto").attr("data-crypto"))}updateFiat()})}function updateFiat(){$("#fiat .number").html($("#fiat").attr("data-price")*removeCommas($("#crypto .number").html())*$("#fiat .currency").attr("data-rate"));$("#fiat .number").html(Number(parseFloat($("#fiat .number").html()).toFixed(2)).toLocaleString("en"));document.title=$("#fiat .number").html()+" "+$("#fiat .currency").html()+" Coinpree - Cryptocurrency price converter"}function updateCrypto(){$("#crypto .number").html(removeCommas($("#fiat .number").html())/parseFloat($("#fiat").attr("data-price")*$("#fiat .currency").attr("data-rate")).toFixed(2));$("#crypto .number").html(Number(parseFloat($("#crypto .number").html()).toFixed(10)).toLocaleString("en"))}function removeCommas(a){return Number(a.split(",").join(""))}function getSelectedTextLength(){var a="";if(typeof window.getSelection!="undefined"){a=window.getSelection().toString()}else{if(typeof document.selection!="undefined"&&document.selection.type=="Text"){a=document.selection.createRange().text}}return a.length}function getConversionRates(){var b="https://api.fixer.io/latest?base=USD&symbols=";var a="USD,GBP,EUR,CAD,AUD,JPY,CNY";$(".dropdown ul li:first-child").attr("data-rate",1);$.get(b+a,function(c){$(".dropdown ul li").each(function(){$(this).attr("data-rate",c.rates[$(this).html()])})}).always(function(){selectFiat()})}function selectFiat(){var a="{{ $fiat or 'USD' }}";if(a>""){$(".dropdown ul li").each(function(){if(a==$(this).html()){$("#fiat .currency").html($(this).html());$("#fiat .currency").attr("data-rate",$(this).data("rate"));return false}})}}$(document).ready(function(){var b;var d=3000;$(document).on("DOMNodeInserted",$.proxy(function(h){if(h.target.parentNode.getAttribute("contenteditable")==="true"){var g=document.createTextNode("");function f(j){if(j.nodeType==3){g.nodeValue+=j.nodeValue.replace(/(\r\n|\n|\r)/gm,"")}else{if(j.nodeType==1&&j.childNodes){for(var e=0;e<j.childNodes.length;++e){f(j.childNodes[e])}}}}f(h.target);h.target.parentNode.replaceChild(g,h.target)}},this));$("#crypto .currency").on("keyup",function(){clearTimeout(b);b=setTimeout(a,d)});$("#crypto .currency").on("keydown",function(){clearTimeout(b)});$("#crypto .currency").focusout(function(){clearTimeout(b);a()});function a(){if($("#crypto .currency").html()!=$("#crypto").data("crypto")){update()}}$("#crypto .number").on("keyup",function(){if(!isNaN(removeCommas($(this).html()))){updateFiat($(this).html()*$("#fiat").data("price"))}});$("#fiat .number").on("keyup",function(){if(!isNaN(removeCommas($(this).html()))){updateCrypto()}});$("span").on("keypress",function(e){if(e.which==13){return false}});$("span").on("keyup",function(){$("#body >:not(.dropdown)").css("display","inline-block");if(($("body").width()*0.9)<($("#crypto").width()+$(".equals").width()+$("#fiat").width())){$("#body >:not(.dropdown)").css("display","block")}else{$("#body >:not(.dropdown)").css("display","inline-block")}var e="calc(((100vh - 100px) / 2) - "+($("#body").height()/2)+"px) 0";$("#body").css("padding",e)});$("#shade").on("click",function(){$(".dropdown").fadeOut("fast",function(){$("#shade").fadeOut()})});$("#fiat .currency").on("click",function(){$(this).blur();$("#shade").fadeIn("fast",function(){$(this).parent().find(".dropdown").fadeIn()})});$(".dropdown ul li").on("click",function(){$("#fiat .currency").html($(this).html());$("#fiat .currency").attr("data-rate",$(this).data("rate"));$(".dropdown").fadeOut("fast",function(){$("#shade").fadeOut("fast",function(){updateFiat();if($("#fiat .currency").html()=="USD"){history.pushState({},"","/")}else{history.pushState({},"",$("#fiat .currency").html())}})})});var c="calc(((100vh - 100px) / 2) - "+($("#body").height()/2)+"px) 0";$("#body").css("padding",c);getConversionRates();setInterval(function(){update()},60000);update()});</script>
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
<span spellcheck=false onclick="document.execCommand('selectAll',false,null)" contenteditable=true class=currency>BTC</span>
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
<li><a href=/>Coinpree</a> supports hundreds of cryptocurrencies using data from our partner <a href=http://www.portfolicko.com target=_blank>Portfolicko.com</a>.</li>
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
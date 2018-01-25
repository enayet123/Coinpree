<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-63150348-2"></script>
        <script>
          window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments);}
          gtag('js', new Date());
          gtag('config', 'UA-63150348-2');
        </script>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta charset="UTF-8">
        <meta name="description" content="The quickest and simplest way to convert hundreds of cryptocurrencies with a wide range of fiat currencies. Prices are automatically updated and show in the tab of your browser to help keep track of the cryptocurrency of interest. Convert from BTC, XRP, ETH, BCH, etc. to USD, GBP, CNY, JPY, EUR and many more!">
        <meta name="keywords" content="Cryptocurrency,Coin,Trading,Blockchain,Bitcoin,BTC">
        <meta name="author" content="Enayet Hussain">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="google-site-verification" content="Csz6X8_dgevRyueUHLfL-qsdi_0b2J-rc0Me0L8JnBI" />

        <!-- Site title will change dynamically -->
        <title>Coinpree - Cryptocurrency price converter and tracker</title>

        <!-- Favicon -->
        <link rel="apple-touch-icon" sizes="180x180" href="/favicon/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/favicon/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/favicon/favicon-16x16.png">
        <link rel="manifest" href="/favicon/manifest.json">
        <link rel="mask-icon" href="/favicon/safari-pinned-tab.svg" color="#5bbad5">
        <link rel="shortcut icon" href="/favicon/favicon.ico">
        <meta name="msapplication-config" content="/favicon/browserconfig.xml">
        <meta name="theme-color" content="#ffffff">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,300,600%7CLato:100,400%7COpen+Sans:300" rel="stylesheet">

        <!-- Styles and scripts -->
        <link rel="stylesheet" type="text/css" href="/css/style.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        <script>
            // Updates currency price
            function update() {
                // Parts of API link
                var link = 'http://portfolicko.com/api/price?';
                var symbol = "symbol=" + $("#crypto .currency").html();
                // Executes data fetch
                $.get(link + symbol, function(data) {
                    result = data["0"][$("#crypto .currency").html().toUpperCase()];
                    if (data["0"].error == undefined) {
                        // Update header bar
                        $('#title div:first-child').html(result.name);
                        $('#title div:last-child').html($("#fiat .currency").html());
                        // Store data
                        $('#fiat').attr('data-price', result.price);
                        $('#crypto').attr('data-crypto', $("#crypto .currency").html());
                    } else { // Revert currency if not exist
                        $('#crypto .currency').html($('#crypto').attr('data-crypto'));
                    }
                    updateFiat();
                });
            }
            // Update fiat price of cryptocurrency
            function updateFiat() {
                $('#fiat .number').html($('#fiat').attr('data-price') * removeCommas($('#crypto .number').html()) * $('#fiat .currency').attr('data-rate'));
                $('#fiat .number').html(Number(parseFloat($('#fiat .number').html()).toFixed(2)).toLocaleString('en'));
                document.title = $("#fiat .number").html() + " " + $("#fiat .currency").html() + " Coinpree - Cryptocurrency price converter";
            }
            // Update amount of cryptocurrency worth in relation to fiat
            function updateCrypto() {
                $('#crypto .number').html(removeCommas($('#fiat .number').html()) / parseFloat($('#fiat').attr('data-price')*$('#fiat .currency').attr('data-rate')).toFixed(2));
                $('#crypto .number').html(Number(parseFloat($('#crypto .number').html()).toFixed(10)).toLocaleString('en'));
            }
            // Returns a number that can be read by inNaN
            function removeCommas(num) {
                return Number(num.split(",").join(""));
            }
            // Checks if any text is selected 
            function getSelectedTextLength() {
                var text = "";
                if (typeof window.getSelection != "undefined")
                    text = window.getSelection().toString();
                else if (typeof document.selection != "undefined" && document.selection.type == "Text")
                    text = document.selection.createRange().text;
                return text.length;
            }
            // Store todays conversion rates
            function getConversionRates() {
                // Parts of API link
                var link = 'https://api.fixer.io/latest?base=USD&symbols=';
                var symbols = "USD,GBP,EUR,CAD,AUD,JPY,CNY";
                // Set USD to base
                $('.dropdown ul li:first-child').attr('data-rate', 1);
                // Executes data fetch
                $.get(link + symbols, function(data) {
                    // Store exchange rates
                    $('.dropdown ul li').each(function() {
                        $(this).attr('data-rate', data.rates[$(this).html()]);
                    });
                }).always(function() {
                    // Apply user selected fiat
                    selectFiat();
                });
            }
            // Applies user selected currency
            function selectFiat() {
                var id = "{{ $fiat or 'USD' }}"; // Blade inserts user selected currency
                if (id > "")
                    $('.dropdown ul li').each(function() { // Finds currency
                        if (id == $(this).html()) {
                            $('#fiat .currency').html($(this).html());
                            $('#fiat .currency').attr('data-rate', $(this).data('rate'));
                            return false;
                        }
                    });
            }
            $(document).ready(function() {
                // Cryptocurrency change timer
                var typingTimer;
                var doneTypingInterval = 3000;  
                // Prevent styled content entering span
                $(document).on("DOMNodeInserted", $.proxy(function (e) {
                    if (e.target.parentNode.getAttribute("contenteditable") === "true") {
                        var newTextNode = document.createTextNode("");
                        function antiChrome(node) {
                            if (node.nodeType == 3) {
                                newTextNode.nodeValue += node.nodeValue.replace(/(\r\n|\n|\r)/gm, "")
                            }
                            else if (node.nodeType == 1 && node.childNodes) {
                                    for (var i = 0; i < node.childNodes.length; ++i) {
                                        antiChrome(node.childNodes[i]);
                                    }
                            }
                        }
                        antiChrome(e.target);
                        e.target.parentNode.replaceChild(newTextNode, e.target);
                    }
                }, this));
                // Cryptocurrency type delayed change
                $('#crypto .currency').on('keyup', function() {
                    clearTimeout(typingTimer); // Clear existing timer
                    typingTimer = setTimeout(doneTyping, doneTypingInterval); // Start again
                });
                $('#crypto .currency').on('keydown', function () {
                    clearTimeout(typingTimer); // Clear existing timer
                });
                $('#crypto .currency').focusout(function() {
                    clearTimeout(typingTimer); // Clear existing timer
                    doneTyping(); // Execute early
                });
                function doneTyping() {
                    // check it is not the same currency
                    if ($('#crypto .currency').html() != $('#crypto').data('crypto'))
                        update();
                }
                // Cryptocurrency value input change
                $('#crypto .number').on('keyup', function() {
                    if (!isNaN(removeCommas($(this).html())))
                        updateFiat($(this).html() * $('#fiat').data('price'));
                });
                // Fiat value input change
                $('#fiat .number').on('keyup', function() {
                    if (!isNaN(removeCommas($(this).html())))
                        updateCrypto();
                });
                // Prevent pressing enter
                $('span').on('keypress', function (event) {
                    if (event.which == 13) return false;
                });
                // Check for extreme input length
                $('span').on('keyup', function() {
                    $('#body >:not(.dropdown)').css('display', 'inline-block');
                    if (($('body').width() * 0.9) < ($('#crypto').width() + $('.equals').width() + $('#fiat').width()))
                        $('#body >:not(.dropdown)').css('display', 'block');
                    else
                        $('#body >:not(.dropdown)').css('display', 'inline-block');
                    // Resize padding
                    var size = 'calc(((100vh - 100px) / 2) - ' + ($('#body').height()/2) + 'px) 0';
                    $('#body').css('padding', size);
                });
                // User clicks away on shade
                $("#shade").on("click", function() {
                    $(".dropdown").fadeOut("fast", function() {
                        $("#shade").fadeOut();
                    });
                });
                // User triggered currency selection
                $("#fiat .currency").on("click", function() {
                    $(this).blur();
                    $("#shade").fadeIn("fast", function() {
                        $(this).parent().find(".dropdown").fadeIn();
                    });
                });
                // New currency selected
                $('.dropdown ul li').on("click", function() {
                    $('#fiat .currency').html($(this).html());
                    $('#fiat .currency').attr('data-rate', $(this).data('rate'));
                    $(".dropdown").fadeOut("fast", function() {
                        $("#shade").fadeOut("fast", function() {
                            updateFiat();
                            if ($('#fiat .currency').html() == "USD")
                                history.pushState({}, '', '/');
                            else
                                history.pushState({}, '', $('#fiat .currency').html());
                        });
                    });
                });
                // Verify correct padding
                var size = 'calc(((100vh - 100px) / 2) - ' + ($('#body').height()/2) + 'px) 0';
                $('#body').css('padding', size);
                // Get currency conversion rates
                getConversionRates();
                // Update every minute
                setInterval(function() {
                    update();
                }, 60000);
                update();
            });
        </script>
    </head>
    <body>
        <div id="shade"></div>
        <header>
            <div id="logo">
                COINPREE
            </div>
            <div id="title">
                <div></div> to <div></div>
            </div>
        </header>
        <div id="body">
            <div id="crypto">
                <span contenteditable="true" class="number">1</span>
                <span spellcheck="false" onclick="document.execCommand('selectAll',false,null)" contenteditable="true" class="currency">BTC</span>
            </div>
            <div class="equals">=</div>
            <div id="fiat">
                <span contenteditable="true" class="number">0</span>
                <span spellcheck="false" contenteditable="true" class="currency" data-rate="1">USD</span>
                <div class="dropdown">
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
        <div id="info">
            <div>
                <h1>About</h1>
                <ul>
                    <li><a href="/">Coinpree</a> supports hundreds of cryptocurrencies using data from our partner <a href="http://www.portfolicko.com" target="_blank">Portfolicko.com</a>.</li>
                    <li>All prices are initially stored in USD and converted to other currencies using exchange rate data provided by <a href="http://fixer.io" target="_blank">fixer.io</a> on demand.</li>
                    <li>Prices are updated every minute and displayed in the title of the tab allowing you to keep an eye on the price of the cryptocurrency of interest.</li>
                    <li>The price of each currency is the average selling price calculated using multiple exchanges (Typically excluding outliers)</li>
                </ul>
                <h1>Usage</h1>
                <ol>
                    <li>Select the cryptocurrency of choice using the 3 letter symbol e.g. BTC, XRP, ETH. (The default is BTC)</li>
                    <li>Enter data that represents the amount of cryptocurrency or fiat you wish to evaluate against<br>
                        <ol type="a">
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
            <div class="footer-text">© 2018 - Coinpree</div><a href="https://uk.linkedin.com/in/enayet-hussain-a150b77a"><div class="linkedin social">in</div></a><a href="https://github.com/enayet123/"><div class="github social">GitHub</div></a>
        </footer>
    </body>
</html>

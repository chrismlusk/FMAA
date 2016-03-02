$(window).load(function()
{
// Define the style variables
var $font = "'Roboto',sans-serif";
var $font_weight = "normal";
var $text_color = "#414c56";
var $link_color = "#137cc8";
var $name_color = "#12202c";
var $subtext_color = "#9fa9b1";
var $sublink_color = "#9fa9b1";
var $header = "display: none !important;";
var $stream_border = "1px solid rgb(232, 232, 232)";

// Apply the styles
$("iframe").contents().find('head').append('<style>.html, body, h1, h2, h3, blockquote, p, ol, ul, li, img, iframe, button, .tweet-box-button{font-family:'+$font+' !important;font-weight:'+$font_weight+' !important;} .thm-dark .retweet-credit,.h-feed, .stats strong{color:' + $text_color + ' !important;} a:not(.follow-button):not(.tweet-box-button):not(.expand):not(.u-url), .load-more{color:' + $link_color + ' !important;} .timeline-header {' + $header + '} .timeline .stream {border-top:' + $stream_border + ' !important; border-bottom:' + $stream_border + ' !important;} .p-name{color:'+$name_color+' !important;} span.p-nickname, .u-url, .expand{color:'+$sublink_color+' !important;} .retweet-credit{color:' + $subtext_color + ' !important;}</style>');
});
$(document).ready(function(){
    $('html base').remove();
    var shortcut_icon = $('head link[rel="shortcut icon"]');
    var attr = shortcut_icon.attr('href');
    shortcut_icon.attr('href', attr.substr(1));
})
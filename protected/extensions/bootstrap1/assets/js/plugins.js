// Avoid `console` errors in browsers that lack a console.
(function() {
    var method;
    var noop = function () {};
    var methods = [
    'assert', 'clear', 'count', 'debug', 'dir', 'dirxml', 'error',
    'exception', 'group', 'groupCollapsed', 'groupEnd', 'info', 'log',
    'markTimeline', 'profile', 'profileEnd', 'table', 'time', 'timeEnd',
    'timeStamp', 'trace', 'warn'
    ];
    var length = methods.length;
    var console = (window.console = window.console || {});

    while (length--) {
        method = methods[length];

        // Only stub undefined methods.
        if (!console[method]) {
            console[method] = noop;
        }
    }
}());
$('#myTab a').click(function (e) {
    e.preventDefault();
    $(this).tab('show');
})


$(".collapse").collapse({
    toggle: true
})
function equalHeight(group) {
 tallest = 0;
 group.each(function() {
  thisHeight = $(this).height();
  if(thisHeight > tallest) {
   tallest = thisHeight;
}
});
 group.height(tallest);
}
$(document).ready(function() {
 equalHeight($(".column"));
});

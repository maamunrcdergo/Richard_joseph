/*
 * @package WP-@IllusiveDesign
 * @subpackage IllusiveDesign
 * @since IllusiveDesign 1.0
 * 2015(c) IllusiveDesign
 */

jQuery(document).ready(function () {
    jQuery('#parallax-nav').localScroll(800);

    //.parallax(xPosition, speedFactor, outerHeight) options:
    //xPosition - Horizontal position of the element
    //inertia - speed to move relative to vertical scroll. Example: 0.1 is one tenth the speed of scrolling, 2 is twice the speed of scrolling
    //outerHeight (true/false) - Whether or not jQuery should use it's outerHeight option to determine when a section is in the viewport
    jQuery('#intro').parallax("50%", 0.1);
    jQuery('#second').parallax("50%", 0.1);
    jQuery('.bg').parallax("50%", 0.4);
    jQuery('#third').parallax("50%", 0.1);

});
jQuery(document).ready(function () {
    jQuery('.topbar-nav-menu').localScroll(800);
    jQuery('#Content-4-widgets');

});
jQuery(document).ready(function() {
    jQuery( ".widget_services_widget .widget-caption h3:first" ).addClass( "current" );
    jQuery(".widget-caption a").click(function(event) {
        event.preventDefault();
        jQuery(this).parent().addClass("current");
        jQuery(this).parent().siblings().removeClass("current");
        var tab = jQuery(this).attr("href");
        jQuery(".service_tab_content").not(tab).css("display", "none");
        jQuery(tab).fadeIn();
    });
});
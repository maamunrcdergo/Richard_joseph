/*
 * @author: Anup
 */
    var state = {};
;
(function($) {
    $(document).ready(function() {
        $('form.quote-form-short').on('submit', function() {
            var form = $(this);
            form.find('.message').remove();
            var full_form = form.find('input[name="full_form_action"]').val();
            if (full_form == '1') {
                console.log(full_form);
                return true;
            } else {
                form.find('input[name="full_form_action"]').val('0');
                form.find('input[name="secquerty_code"]').removeClass('error');
                var form_data = form.serialize();
                var loadder = $('<div class="quote-loader"></div>');
                var message = $('<div class="message"></div>');
                $.ajax({
                    url: QouteAjax.ajaxurl,
                    data: form_data,
                    type: 'POST',
                    dataType: 'json',
                    success: function(responces) {
                        if (responces.type == 'error' && responces.error_type == 'secquerty') {
                            form.find('input[name="secquerty_code"]').addClass('error');
                        } else if (responces.type == 'error') {
                            form.prepend(message);
                            message.html(responces.msg).addclass('error');
                            reloadSecquerty(form, responces.secquerty);
                        } else if (responces.type == 'success') {
                            form.html('');
                            form.prepend(message);
                            message.html(responces.msg).addclass('success');

                        }
                        loadder.remove();
                    },
                    beforeSend: function() {
                        form.prepend(loadder);
                    }

                });
                return false;
            }
        });
        $('#btn-form-submit-more').on('click', function() {
            var form = $(this).parents('form.quote-form-short');
            form.find('input[name="full_form_action"]').val('1');
        });


    });
    function reloadSecquerty(form, secquerty) {
        form.find('input[name="secquerty_result"]').val(secquerty.result);
        form.find('label[for="secquerty_code"]').text(secquerty.label);
    }

    $(window).scroll(function() {
        var st = $(window).scrollTop();
        if (50 <= parseInt(st)) {
            $("#quote_miniform").css({top: parseInt(st) + 50});
        } else {
            $("#quote_miniform").css({top: '35px'});
        }

    });
    var screenQuery = 'screen and (max-width: 992px)';

    $(window).on('load resize', function() {
        state.matchesQuery = window.matchMedia(screenQuery).matches;
        if (window.matchMedia(screenQuery).matches === true) {
            
              $("#quote_miniform").css({top: '35px'});
             
        }else{
            
        }
       
    });
})(jQuery);
function getQuoteForm(button) {
    var left_button = jQuery(button).offset().left;
    if (jQuery(button).parents('div').hasClass('sticky-menu-holder')) {
        var st = jQuery(window).scrollTop();
        jQuery("#quote_miniform").css({top: parseInt(st) + 50});
    } else {
        jQuery("#quote_miniform").css({top: '35px'});
    }
    //jQuery("#quote_miniform").css({left: parseInt(left_button)});
    jQuery('a.get-quote').toggleClass('toggled')
    jQuery("#quote_miniform").slideToggle();
    return false;
}
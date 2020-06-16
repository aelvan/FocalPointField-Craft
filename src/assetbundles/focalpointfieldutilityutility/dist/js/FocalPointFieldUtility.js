/**
 * Focal Point Field plugin for Craft CMS
 *
 * FocalPointFieldUtility Utility JS
 *
 * @author    André Elvan
 * @copyright Copyright (c) 2019 André Elvan
 * @link      http://www.vaersaagod.no
 * @package   FocalPointField
 * @since     2.0.0
 */

$(document).ready(function () {
    $('.focal-point-utility-button').on('click', function (e) {
        $('.focal-point-utility-button').attr('disabled', 'disabled').addClass('disabled');
        $('.focal-point-utility-spinner').show();
        console.log('yo');
        
        $.ajax(Craft.getActionUrl('focal-point-field/default/create-tasks'), {
            success: function (data) {
                $('.focal-point-utility-spinner').hide();
                if (data && data.success===true) {
                    $('.focal-point-utility-response').html('<em>Migration jobs has been created.</em>');
                } else {
                    $('.focal-point-utility-response').html('<strong>An error occured!</strong>');
                }
            }
        });
    });
});

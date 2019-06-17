jQuery(document).ready(function() { console.log('Document is ready ...');

    jQuery('#text_application_name').focus();

    jQuery('#btn_submit_page').on('click', function() { console.log('#form_search_box is submitted ...');


        if ( !jQuery('text_application_name').val() ) {
            // alert('ok');
        }



        // var url = '';
        // var data = {
        //     'text_application_name': jQuery('#text_application_name').val()
        // };
        // var ajax_form_search_box = jQuery.ajax({
        //     'url': url
        //     ,'data': data
        //     ,'dataType': 'json'
        //     ,'error': function(jqXHR, textStatus, errorThrown){
        //         console.log('error jqXHR : ');
        //         console.log(jqXHR);
        //     }
        //     ,'success': function(response){
        //         console.log(response);
        //         alert(response.message);
        //         jQuery('#text_application_name').focus();
        //     }
        // }); // ajax_form_search_box end
        // return false;
    }); // #form_search_box on submit end


}); // ready end

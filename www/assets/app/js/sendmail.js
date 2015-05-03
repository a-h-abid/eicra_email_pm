$(document).ready(function(){

    var messageLinesEl = $('#message-lines'),
        ccLinesEl = $('#mail-cc-placeholder'),
        ccLine = $('.mail-cc-row').first().clone();

    // Remove CC Line on load
    $('.mail-cc-row').remove();

    // On Mail Send Action
    $('#eicra-email-form').on('submit',function(e){
        var self = $(this);

        return confirm('Ready to Submit?');
    });

    // Add CC
    $('.cc-line-add').on('click', function(e){
        e.preventDefault();

        var newCcLine = ccLine.clone();
    
        ccLinesEl.append(newCcLine);
    });

    // Remove CC
    $('.cc-line-remove').on('click', function(e){
        e.preventDefault();
        
        $('.mail-cc-row').last().remove();
    });

    // Add Message Line
    $('.message-line-add').on('click', function(e){
        e.preventDefault();
        
        var firstLine = messageLinesEl.find('li').first().clone();
        firstLine.find('input').val('');    
        
        messageLinesEl.append(firstLine);
    });

    // Remove Message Line
    $('.message-line-remove').on('click', function(e){
        e.preventDefault();
        
        if (messageLinesEl.find('li').length == 1)
            return false;

        messageLinesEl.find('li').last().remove();
    });

});
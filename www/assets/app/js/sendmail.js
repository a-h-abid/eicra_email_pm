$(document).ready(function(){

    var messageLinesEl = $('#message-lines');

    $('.message-line-add').on('click',function(e){
        e.preventDefault();
        
        var line = messageLinesEl.find('li').first().clone();

        line.find('input').val('');

        messageLinesEl.append(line);
    });

    $('.message-line-remove').on('click',function(e){
        e.preventDefault();
        
        if (messageLinesEl.find('li').length == 1)
            return false;

        messageLinesEl.find('li').last().remove();
    });

});
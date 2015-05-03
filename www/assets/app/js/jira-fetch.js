$(document).ready(function(){

    var messageLinesEl = $('#message-lines');


    $('#jira-client-login').on('submit', function(e){
        e.preventDefault();
        
        var self = $(this),
            url = self.attr('action'),
            btnSubmit = self.find('input[type="submit"]'),
            btnText = btnSubmit.val(), 
            formData = self.serialize(),
            btnInsert = $('#jira-insert-issues'),
            openIssues = $('#open-issues-placeholder'),
            errorBlock = self.find('.jira-login-errors'),
            numberedList = $('<ol/>'),
            x = 2;

        btnSubmit.prop('disabled',true).val('Processing...');
        btnInsert.prop('disabled',true);
        errorBlock.html('');
        
        $.ajax({
            url : url,
            type : "post",
            timeout : 60000,
            data : formData,
            dataType : 'json'
        })
        .done(function(response){
            if (response.status == true)
            {
                if (response.issues.length == 0)
                {
                    openIssues.html('<em>You have no open issues today, So Relax .... :)</em>');
                }
                else
                {
                    btnInsert.prop('disabled', false);

                    var listItem = $('<li/>'),
                        checkBox = $('<input type="checkbox" class="jira-issue" name="jira-issue[]" />'),
                        issueKey = $('<strong />'),
                        issueSummary = $('<span />'),
                        issueStatus = $('<em />'),
                        statusCodes = response.jira_status_codes;

                    $.each(response.issues, function(i,issue){
                        checkBox.val( [issue.key, '-', statusCodes[issue.status]].join(' ') );
                        issueKey.html( ['<strong>', issue.key , '</strong>'].join('') );
                        issueSummary.html( [' ->', issue.summary].join(' ') );
                        issueStatus.html( ['<em>(', statusCodes[issue.status], ')</em>'].join(' ') );

                        listItem.html('');
                        listItem.append(checkBox)
                                .append(issueKey)
                                .append(issueSummary)
                                .append(issueStatus);

                        numberedList.append(listItem);    
                    });

                    openIssues.html(numberedList);
                }
            }
            else
            {
                errorBlock.text(response.errors);
            }
        })
        .fail(function(xhr, errorType, response){
            errorBlock.text(errorType);
        })
        .always(function(response){
            btnSubmit.prop('disabled',false).val(btnText);
        });

    });

    $('#jira-insert-issues').on('click', function(e){
        e.preventDefault();

        var self = $(this),
            closeButton = $('#jira-close-issues'),
            openIssues = $('#open-issues-placeholder'),
            checkedIssues = openIssues.find(':input:checked'),
            firstLine = messageLinesEl.find('li').first().clone();
        
        firstLine.find('input').val('');    

        if (checkedIssues.length > 0)
        {
            messageLinesEl.html('');
            $.each(checkedIssues, function(i, item){
                firstLine.find('input').val( $(item).val() );

                messageLinesEl.append( firstLine );
            });
        }

        closeButton.trigger('click');

    });

});
<div class="modal fade jira-login-issue-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="gridSystemModalLabel">Jira - My Open Issues</h4>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="col-md-4 col-sm-3">
                        <h1>Login Client</h1>

                        <form id="jira-client-login" role="form" action="<?php echo $app->urlFor('jira-fetch-issues') ?>">
                            <div class="form-group">
                                <input type="text" required="required" class="form-control" name="jira_username" value="<?php echo APP_EICRA_JIRA_USERNAME ?>" placeholder="Username" />
                                <input type="password" required="required" class="form-control" name="jira_password" value="<?php echo APP_EICRA_JIRA_PASSWORD ?>" placeholder="Password" />
                            </div>

                            <div class="form-group">
                                <input type="submit" class="btn btn-success" name="submit" value="Login &amp; Fetch Issues" />
                            </div>

                            <div class="jira-login-errors alert alert-danger">
                            </div>
                        </form>

                    </div>

                    <div class="col-md-8 col-sm-9">
                        <h1>My Open Issues</h1>

                        <div id="open-issues-placeholder">
                        </div>

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" id="jira-close-issues" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="jira-insert-issues" disabled="disabled">Insert</button>
            </div>
        </div>
    </div>
</div>
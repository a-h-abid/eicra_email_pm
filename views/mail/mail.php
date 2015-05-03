<h1>Send Mail to PM</h1>

<form name="eicra-email-form" id="eicra-email-form" class="form form-horizontal" role="form" method="post" action="<?php echo $app->urlFor('send-email') ?>" enctype="multipart/form-data">

    <div class="clearfix">
        
        <div class="col-md-10 toggle-editor-mode">
            <div class="col-md-4">
                
                <div class="list-group">
                    <label>Send To</label>
                    <div class="clearfix">
                        <div class="col-sm-6">
                            <input type="text" required="required" name="send_to_name" placeholder="Name" value="<?php echo APP_EICRA_SENDTO_NAME ?>" class="form-control" />
                        </div>
                        <div class="col-sm-6">
                            <input type="text" required="required" name="send_to_email" placeholder="Email" value="<?php echo APP_EICRA_SENDTO_EMAIL ?>" class="form-control" />
                        </div>
                    </div>
                </div>

                <div class="list-group">
                    <label>Send From</label>
                    <div class="clearfix">
                        <div class="col-sm-6">
                            <input type="text" required="required" name="send_from_name" placeholder="Name" value="<?php echo APP_EICRA_SENDFROM_NAME ?>" class="form-control" />
                        </div>
                        <div class="col-sm-6">
                            <input type="text" required="required" name="send_from_email" placeholder="Email" value="<?php echo APP_EICRA_SENDFROM_EMAIL ?>" class="form-control" />
                        </div>
                    </div>
                </div>

                <div class="list-group">
                    <label>Mailing System</label>
                    <select required="required" class="form-control" name="mailing_system">
                        <option <?php if(APP_EICRA_MAILING_SYSTEM == 'hotmail') echo 'selected="selected"' ?> value="hotmail">Hotmail</option>
                        <option <?php if(APP_EICRA_MAILING_SYSTEM == 'gmail') echo 'selected="selected"' ?> value="gmail">Gmail</option>
                        <option <?php if(APP_EICRA_MAILING_SYSTEM == 'yahoo') echo 'selected="selected"' ?> value="yahoo">Yahoo!</option>
                    </select>
                </div>

                <div class="list-group">
                    <label>User Info</label>
                    <div class="clearfix">
                        <div class="col-sm-6">
                            <input class="form-control" required="required" placeholder="Email" name="user_email" type="email" value="<?php ECHO APP_EICRA_USER_EMAIL ?>" />
                        </div>
                        <div class="col-sm-6">
                            <input class="form-control" required="required" placeholder="Password" name="user_password" type="password" value="<?php ECHO APP_EICRA_USER_PASSWORD ?>" />
                        </div>
                    </div>
                </div>

                <div class="list-group">
                    <label>CC</label>
                    <div id="mail-cc-placeholder">
                        <div class="clearfix mail-cc-row">
                            <div class="col-sm-6">
                                <input type="text" required="required" name="send_cc_name[]" placeholder="Name" value="" class="form-control input-sm" />
                            </div>
                            <div class="col-sm-6">
                                <input type="text" required="required" name="send_cc_email[]" placeholder="Email" value="" class="form-control input-sm" />
                            </div>
                        </div>
                    </div>
                    <div class="clearfix btn-group" style="margin-top:10px">
                        <button class="btn btn-primary cc-line-add">Add</button>
                        <button class="btn btn-danger cc-line-remove">Remove</button>
                    </div>
                </div>

            </div>
            
            <div class="col-md-8">
                <div class="col-md-6">
                    <label>Subject</label>
                    <input type="text" class="form-control" required="required" name="subject" value="My Report for <?php echo date('Y-m-d') ?>" />
                </div>

                <div class="col-md-6">
                    <label>Header Message</label>
                    <textarea name="header_message" required="required" class="form-control textarea-compact"><?php
                        echo "Greetings,\n"
                            . "\n"
                            . "Todays tasks report: ";
                    ?></textarea>
                </div>
                
                <div class="col-md-12" style="margin-bottom:10px;">
                    <label>Message Lines</label>
                    <ol id="message-lines" class="list-group">
                        <li class="list-group-item">
                            <input type="text" required="required" class="form-control" name="message_lines[]" value="" />
                        </li>
                        <li class="list-group-item">
                            <input type="text" required="required" class="form-control" name="message_lines[]" value="" />
                        </li>
                    </ol>
                    
                    <div class="btn-group">
                        <button class="btn btn-primary message-line-add">Add</button>
                        <button class="btn btn-danger message-line-remove">Remove</button>
                    </div>

                </div>

                <div class="col-md-6">
                    <label>Signature</label>
                    <textarea name="signature" required="required" class="form-control textarea-compact" row="2"><?php
                        echo 'Thank You,'."\n"
                            ."\n"
                            ."- ". APP_EICRA_SENDFROM_NAME;
                    ?></textarea>
                </div>
                <div class="col-md-6">
                    <label>Attachments</label>
                    <input type="file" name="attachments" multiple="multiple" />
                </div>
            </div>
        </div>

        <div class="text-center col-md-2">
            
            <div class="btn-group-vertical">
                <button type="submit" class="btn btn-success btn-block btn-lg message-send-action">Send</button>
                <button type="button" class="btn btn-primary btn-block btn-lg" data-toggle="modal" data-target=".jira-login-issue-modal">Jira</button>
            </div>

        </div>

    </div>

</form>

<?php include 'views/jira/modal-jira-login-issues.php' ?>
<h1>Send Mail to PM</h1>

<form name="eicra-email-form" id="eicra-email-form" class="form form-horizontal" role="form" method="post" action="<?php echo $app->urlFor('send-email') ?>">

    <div class="clearfix">
        
        <div class="col-md-10 toggle-editor-mode">
            <div class="col-md-4">
                
                <div class="list-group">
                    <label>Send To</label>
                    <div class="clearfix">
                        <input type="text" required="required" name="send_to_name" placeholder="Name" value="<?php echo APP_EICRA_SENDTO_NAME ?>" class="form-control" />
                        <input type="text" required="required" name="send_to_email" placeholder="Email" value="<?php echo APP_EICRA_SENDTO_EMAIL ?>" class="form-control" />
                    </div>
                </div>

                <div class="list-group">
                    <label>Send From</label>
                    <div class="clearfix">
                        <input type="text" required="required" name="send_from_name" placeholder="Name" value="<?php echo APP_EICRA_SENDFROM_NAME ?>" class="form-control" />
                        <input type="text" required="required" name="send_from_email" placeholder="Email" value="<?php echo APP_EICRA_SENDFROM_EMAIL ?>" class="form-control" />
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
                    <input class="form-control" required="required" placeholder="Email" name="user_email" type="email" value="<?php ECHO APP_EICRA_USER_EMAIL ?>" />
                    <input class="form-control" required="required" placeholder="Password" name="user_password" type="password" value="<?php ECHO APP_EICRA_USER_PASSWORD ?>" />
                </div>

            </div>
            
            <div class="col-md-8">
                <div class="col-md-6">
                    <label>Subject</label>
                    <input type="text" class="form-control" required="required" name="subject" value="My Report for <?php echo date('Y-m-d') ?>" />
                </div>

                <div class="col-md-6">
                    <label>Header Message</label>
                    <textarea name="header_message" required="required" class="form-control"><?php
                        echo "Greetings,\n"
                                . "\n"
                                . "Todays tasks report: ";
                    ?></textarea>
                </div>
                
                <div class="col-md-12">
                    <label>Message Lines</label>
                    <ol id="message-lines" class="list-group">
                        <li class="list-group-item"><input type="text" required="required" class="form-control" name="message_lines[]" value="" /></li>
                        <li class="list-group-item"><input type="text" required="required" class="form-control" name="message_lines[]" value="" /></li>
                        <li class="list-group-item"><input type="text" required="required" class="form-control" name="message_lines[]" value="" /></li>
                    </ol>
                    
                    <div class="btn-group">
                        <button class="btn btn-primary message-line-add">Add</button>
                        <button class="btn btn-danger message-line-remove">Remove</button>
                    </div>

                </div>

                <div class="form-group">
                    <label>Signature</label>
                    <textarea name="signature" required="required" class="form-control"><?php
                        echo 'Thank You,'."\n"
                                ."\n"
                                ."- ". APP_EICRA_SENDFROM_NAME;
                    ?></textarea>
                </div>
            </div>
        </div>

        <div class="text-center col-md-2">
            
            <div class="btn-group-vertical">
                <button type="submit" class="btn btn-success btn-block btn-lg message-send-action">Send</button>
            </div>

        </div>

    </div>

</form>
<?php
    $errorMessage = '';
    if ( isset( $_POST['submitted'] ) ) {
        if ( trim( $_POST['checking'] ) !== '' ) {
            $errorMessage = 'Go fuck yourself, screen reading scum.';
            $captchaError = true;
        } else {
            $contactName = trim( $_POST['contactName'] );
            $contactEmail = trim( $_POST['contactEmail'] );
            $comments = trim( $_POST['comments'] );

            if ( $contactName === '' ) {
                $errorMessage .= 'Please enter a name before submitting the form. ';
                $hasError = true;
            }
            if ( $contactEmail === '' ) {
                $errorMessage .= 'Please enter an email address before submitting the form. ';
                $hasError = true;
            } else if ( !preg_match("^[A-Z0-9._%-]+@[A-Z0-9._%-]+.[A-Z]{2,4}$", $contactEmail ) ) {
                $errorMessage .= 'That doesn\'t appear to be a valid email address. Please make sure you entered your address correctly. ';
                $hasError = true;
            }
            if ( $comments === '' ) {
                $errorMessage .= 'Please send a message before submitting the form. ';
                $hasError = true;
            }
        }

        if ( !isset( $hasError ) || $hasError == false ) {
            $emailTo = 'zachw38@gmail.com';
            $subject = 'BLoFISH Website Message from ' . $contactName;
            $mailBody = "Name: $contactName \n\nEmail: $contactEmail \n\nComments: $comments";
            $headers = 'From: BLoFISH <'.$emailTo.'>'."\r\n".'Reply-To: '.$contactEmail;

            mail( $emailTo, $subject, $mailBody, $headers );

            $emailSent = true;
        }
    }
?>

<?php if ( isset( $hasError ) || isset( $captchaError ) ) { ?>
    <p class="woocommerce-error">
        Oh no! Something went wrong!
        <br>
        <br>
        <?php echo $errorMessage; ?>
        <br>
        <br>
        Please try again, or just <a href="mailto:blofishclothing@gmail.com">email us</a> directly.
    </p>
<?php } ?>
<?php if ( isset( $emailSent ) && $emailSent == true ) { ?>
    <p class="woocommerce-info">
        Your email was sent successfully. We'll be in touch with you soon!
    </p>
<?php } ?>
<form action="<?php the_permalink(); ?>" id="contactForm" method="post">
    <div class="form">
        <fieldset>
            <label for="contactName">Name</label>
            <input type="text" name="contactName" class="requiredField" placeholder="First and last name" value="<?php if(isset($_POST['contactName'])) echo $_POST['contactName'];?>">
        </fieldset>
        <fieldset>
            <label for="contactEmail">Email Address</label>
            <input type="text" name="contactEmail" class="requiredField" placeholder="example@domain.com" value="<?php if(isset($_POST['contactEmail'])) echo $_POST['contactEmail'];?>">
        </fieldset>
        <fieldset>
            <label for="comments">Message</label>
            <textarea name="comments" class="requiredField" placeholder="Say what you need to say...">
                <?php if(isset($_POST['comments'])) echo $_POST['comments'];?>
            </textarea>
        </fieldset>
        <input type="hidden" name="submitted" value="true" />
        <button type="submit" class="button">Send</button>
    </div>
    <div class="screenReader">
        <label for="checking" class="screenReader">Don't you dare put anything in this field if you're trying to submit this form.</label>
        <input type="text" name="checking" class="screenReader" value="<?php if(isset($_POST['checking'])) echo $_POST['checking'];?>">
    </div>
</form>

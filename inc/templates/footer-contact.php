<?php 
         $contactInfoData = get_field('contact_info', 'option');
        $contactAddress = $contactInfoData['address'];
        $contactPhone  = $contactInfoData['phone'];
        $contactEmail = $contactInfoData['email_address'];
     
        ?>
<div class="contact-info-wrapper">
    <div class="svg-wrapper">
        <svg height="16" viewBox="0 0 28 40" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path
                d="M14 0C6.26 0 0 6.26 0 14C0 24.5 14 40 14 40C14 40 28 24.5 28 14C28 6.26 21.74 0 14 0ZM14 19C11.24 19 9 16.76 9 14C9 11.24 11.24 9 14 9C16.76 9 19 11.24 19 14C19 16.76 16.76 19 14 19Z"
                fill="black" />
        </svg>


    </div>

    <a class="info" href="https://maps.app.goo.gl/xJASPpdQXkLBvPM99" target="_blank">
        <?php echo $contactAddress['address'];  ?>
    </a>
</div>
<div class="contact-info-wrapper">
    <div class="svg-wrapper"><svg width="30" height="16" viewBox="0 0 30 30" fill="none"
            xmlns="http://www.w3.org/2000/svg">
            <path
                d="M27.0061 20.4167L22.7728 19.9333C21.7561 19.8167 20.7561 20.1667 20.0395 20.8833L16.9728 23.95C12.2561 21.55 8.38946 17.7 5.98946 12.9667L9.07279 9.88333C9.78946 9.16667 10.1395 8.16667 10.0228 7.15L9.53946 2.95C9.33946 1.26667 7.92279 0 6.22279 0H3.33946C1.45612 0 -0.110544 1.56667 0.00612246 3.45C0.889456 17.6833 12.2728 29.05 26.4895 29.9333C28.3728 30.05 29.9395 28.4833 29.9395 26.6V23.7167C29.9561 22.0333 28.6895 20.6167 27.0061 20.4167Z"
                fill="black" />
        </svg>

    </div>

    <a class="info" href="tel: <?php echo $contactPhone['phone_number']; ?>">
        <?php echo $contactPhone['phone_number'];  ?>
    </a>
</div>
<div class="contact-info-wrapper">
    <div class="svg-wrapper"> <svg style="height: 14px !important;" height="16" viewBox="0 0 50 40" fill="none"
            xmlns="http://www.w3.org/2000/svg">
            <path
                d="M45 0H5C2.25 0 0.025 2.25 0.025 5L0 35C0 37.75 2.25 40 5 40H45C47.75 40 50 37.75 50 35V5C50 2.25 47.75 0 45 0ZM45 10L25 22.5L5 10V5L25 17.5L45 5V10Z"
                fill="black" />
        </svg>

    </div>

    <a class="info" href="mailto: <?php echo $contactEmail['email']; ?>">
        <?php echo $contactEmail['email'];  ?>
    </a>
</div>


<?php 
        
?>
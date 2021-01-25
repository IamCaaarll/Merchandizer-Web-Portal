<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <meta name="author" content="Bounty Inc.">
        <title>Merchandizer Web Portal</title>
        <?php $this->load->view('links'); ?>
    </head>

    <?php $this->load->view('EBody'); ?> 

    <?php $this->load->view('footer'); ?>
    <?php $this->load->view('scripts'); ?>    
    <script src="<?php echo base_url(); ?>assets/controllers/launcher/launcher.js"></script>
    <?php $this->load->view('sammy'); ?>
</body>
</html>
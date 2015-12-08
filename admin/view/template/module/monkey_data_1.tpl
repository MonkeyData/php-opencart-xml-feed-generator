<?php echo $header; ?>
<div id="content">
    <div class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <?php echo $breadcrumb['separator']; ?><a
                href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
        <?php } ?>
    </div>
    <?php if (isset($error_warning)) { ?>
    <div class="warning"><?php echo $error_warning; ?></div>
    <?php } ?>
    <div class="box">
        <div class="heading">
            <h1><img src="view/image/module.png" alt=""/> Monkey Data</h1>
        </div>
         <div class="content">
            URL Adresa: <br />
            <?php
            $ssl_or_not = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') ? 'https://' : 'http://';
            echo $ssl_or_not . $_SERVER['HTTP_HOST'] . '/admin/monkey_data_cron.php?hash=' . $hash;
            ?>

        </div>
        </div>  </div>
    <script type="text/javascript"><!--

        //--></script>
    <?php echo $footer; ?>
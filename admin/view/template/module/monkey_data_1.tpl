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

        <style>
            @import url(https://fonts.googleapis.com/css?family=Dosis);
            @import url(https://fonts.googleapis.com/css?family=Roboto);

            #MonkeyData-Configuration-Page {
                text-align: center;
                font-family: Roboto, sans-serif;
                margin: 0 auto;
                display: table;
                width: 70%;
            }

            .MonkeyData-Headline-Text {
                font-family: Dosis, sans-serif;
                color: #132a42!important;
                font-size: 29px;
                font-weight: 900;
                text-transform: uppercase;
                padding-top: 20px;
                padding-bottom: 20px;
            }

            .MonkeyData-Errors {
                padding-top: 20px;
                padding-bottom: 20px;
                font-family: Roboto, sans-serif;
                text-decoration: none !important;
                text-shadow: 0 2px 3px rgba(1,1,1,0.2);
                font-size: 12px;
                font-weight: 900;
                display: table;
                margin: 0 auto;
            }

            .MonkeyData-Error {
                margin-top: 10px;
                color: #f8ebec;
                background-color: #c7292b;
                padding: 5px 10px 5px 10px;
                border-radius: 5px;
            }

            .MonkeyData-Error-Mark {
                font-size: 14px;
                margin-right: 10px;
                float: left;
            }

            .MonkeyData-Error-Message {
                padding: 15px;
            }

            .MonkeyData-Content {
                padding-bottom: 50px;
                font-size: 16px;
            }

            .MonkeyData-Link {
                min-width: 70px;
                box-shadow: none;
                border-radius: 2px;
                text-align: center;
                outline: 0;
                text-decoration: none !important;
                text-shadow: 0 2px 3px rgba(1,1,1,0.2);
                color: white !important;
                font-weight: 900;
                text-transform: uppercase;
                padding: 15px;
                font-family: Roboto, sans-serif;
                display: inline-block;
                width: 35%;
            }

            .MonkeyData-Connect-Link {
                background: #31bc12 linear-gradient(to top, #27a00c 0, #2bb60d 100%);
                border: 1px solid #269b0c;
            }

            .MonkeyData-Dashboard-Link {
                background: #5194da linear-gradient(to top, #5194da 0, #5194da 100%);
                border: 1px solid #5194da;
            }

            .MonkeyData-Text {
                color: #7896b5;
                padding-bottom: 20px;
                padding-top: 20px;
            }

            .MonkeyData-Configuration-footer {
                width: 100%;
                text-align:center;

            }

            .MonkeyData-Configuration-border {
                background-image: url("https://www.monkeydata.com/support/files/1461056760v1rjURQfvhIE8MzmSTfsRMHO1SCMMfg8.gif");
                background-size: 450px 3px;
                height: 3px;
                max-width: 100%;
            }

            .MonkeyData-Configuration-logo-image {
                margin: 20px;
                max-width: 200px;
                max-height: 100px;
            }
        </style>

        <div class="panel panel-default">

            <div id="MonkeyData-Configuration-Page">
                <div class="MonkeyData-Configuration-border"></div>

                <div class="MonkeyData-Headline-Text">
                    <div>
                        THERE IS ONLY ONE STEP
                        <br/>
                        BETWEEN YOU AND MONKEYDATA
                    </div>
                </div>

                <?php if (count($errors) > 0) : ?>
                <div class="MonkeyData-Errors">
                    <?php foreach ($errors as $error) {
                            echo "<div class=\"MonkeyData-Error\">";
                    echo "<span class=\"MonkeyData-Error-Mark\"> &#x2716; </span>";
                    echo $error;
                    echo "</div>";
                }?>
            </div>
            <?php else : ?>
            <div class="MonkeyData-Content">
                <div class="MonkeyData-Text"> I want to register to MonkeyData app <br/> and connect my online store </div>
                <a href="<?php $url ?>" class="MonkeyData-Link MonkeyData-Connect-Link" target="_blank">
                    REGISTER TO APPLICATION
                </a>
                <div class="MonkeyData-Text"> I have already MonkeyData account <br/> and I just want to go to dashboards </div>
                <a href="https://app.monkeydata.com" class="MonkeyData-Link MonkeyData-Dashboard-Link" target="_blank">
                    GO TO DASHBOARDS
                </a>
            </div>
            <?php endif; ?>

            <div class="MonkeyData-Configuration-footer">
                <div class="MonkeyData-Configuration-border"></div>

                <img class="MonkeyData-Configuration-logo-image" src="https://www.monkeydata.com/support/files/1461056730r9BLTLaKA6PwVyXqxZwZlAO1GqCCHpvY.png" />
            </div>
        </div>
    </div>
</div>
<?php echo $footer; ?>


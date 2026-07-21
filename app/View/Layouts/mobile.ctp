<?php                                    ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>CRM VMP</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <?php
    echo $this->Html->css('bootstrap');
    echo $this->Html->css('font-awesome.min');
    echo $this->Html->css('style.min');
    echo $this->Html->css('skin-blue.min');
    ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    <style>
        /*  loading style */
        #loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            display: none;
        }

        .loading-spinner {
            border: 4px solid rgba(255, 255, 255, 0.3);
            border-top: 4px solid #fff;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>

</head>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

        <!-- Main Header -->

        <div class="content-wrapper">
            <section class="content-header">
                <?php
                echo $this->Session->flash();
                echo $this->fetch('content');
                ?>
            </section>
            <section class="content">
            </section>
        </div>
        <footer class="main-footer">
            <div class="pull-right hidden-xs">
                CRM VMP
            </div>
            <strong>Copyright &copy; <?php echo date("Y"); ?> <a href="#">ICOZ</a>.</strong> All rights reserved.
        </footer>
        <div class="control-sidebar-bg"></div>
    </div>
    <div id="loading-overlay">
        <div class="loading-spinner"></div>
    </div>
    <?php
    echo $this->Html->script('jquery-2.2.3.min');
    echo $this->Html->script('bootstrap.min');
    echo $this->Html->script('app.min');
    ?>
</body>
<script>
    $(window).load(function() {
        var text1 = $("#flashMessage").text();
        var htm1 = "<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> <strong>Alert!</strong>&nbsp;&nbsp;" + text1;
        $("#flashMessage").html(htm1);
        $("#flashMessage").attr("class", "alert alert-success fade in");
        $("#flashMessage").attr("style", "background:#3c8dbc !important;border-color:#3c8dba;");
        var text2 = $("#authMessage").text();
        var htm2 = "<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> <strong>Alert!</strong>&nbsp;&nbsp;" + text2;
        $("#authMessage").html(htm2);
        $("#authMessage").attr("class", "alert alert-danger fade in");
        var h = $(window).height();
        $(".sidebar-menu").height(h - 45);
    });

    function searchmenu(va) {
        var v = va.toLowerCase();
        var menu = document.getElementById("menu");
        for (i = 0; i < menu.getElementsByTagName('li').length; i++) {
            var lien = menu.getElementsByTagName('li')[i].innerText.toLowerCase();
            menu.getElementsByTagName('li')[i].style.display = "none";
            menu.getElementsByTagName('li')[0].style.display = "block";
            if (lien.indexOf(v) !== -1) {
                menu.getElementsByTagName('li')[i].style.display = "block";
                menu.getElementsByTagName('li')[i].parentNode.style.display = "block";
            }
        }
        for (j = 0; j < menu.getElementsByTagName('ul').length; j++) {
            if (va === "") {
                $(".treeview ul:eq(" + j + ")").hide();
            }
        }
    }


    $(document).ready(function() {
        $(".btn_spiner").on("click", function() {
            $("#loading-overlay").css('display', 'flex');
        });
    });
</script>

</html>
<?php //echo $this->element('sql_dump');   
?>
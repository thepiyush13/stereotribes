<style>
    .box {background-color: #ccc; margin: 2px;}
    .xdropdown-menu {
        position: absolute;
        top: 100%;
        left: -8px;
        z-index: 1000;
        display: none;
        float: left;
        min-width: 160px;
        padding: 5px 0;
        margin: 2px 0 0;
        font-size: 14px;
        list-style: none;
        background-color: #fff;
        border: 1px solid #ccc;
        border: 1px solid rgba(0,0,0,0.15);
        /*border-top: 1px solid #fff;*/
        /*border-radius: 4px;*/
        -webkit-box-shadow: 0 6px 12px rgba(0,0,0,0.175);
        box-shadow: 0 6px 12px rgba(0,0,0,0.175);
        background-clip: padding-box;
    }

    .open>.xdropdown-menu{
        display: block;

    }

    .tpr-default {
        background-color: #fff;
        border: none;
        margin: 3px;
        cursor: pointer;
    }

    .open>.tpr-default {
        background-color: #ccc;
    }



    .xdropdown-menu {
        min-width: 50px;
    }
    .xdropdown-menu li a  {
        display: inline-block;
        color: #000;

    }

    .xdropdown-menu li {
        display: inline-block;
        width: 60px;
        font-size: 12px;
        padding-left: 5px;
    }
    .tpr {
        position: relative;
    }
    .btn {
        border: 0;
        padding: 3px;
        /*border: 1px solid;*/  
        font-size: 12px;
    }
    .xtimer-container {
        background-color: #fff;
        border: 1px solid;
        padding: 10px;
        /*width: 70%;*/
        position: relative;
        /*top: 45px;*/
        left: 10px;
        z-index: 1000;
        display: inline-block;

    }

    .timer-container {
        position: fixed;
        top: 100%;
        left: 250px;
        z-index: 1000;
        float: left;
        background-color: #fff;
        padding: 5px 0;
        border: 1px solid #ccc;


        /*border-radius: 4px;*/
        -webkit-box-shadow: 0 6px 12px rgba(0,0,0,0.175);
        box-shadow: 0 6px 12px rgba(0,0,0,0.175);

    }
    .tagsinput {
        border: 0;
        height: auto;
    }
    .tpr-group{
        position: relative;
        display: inline-block;
        vertical-align: middle;
    }
    .tagsinput .tag {
        border-radius: 0px;
        background-color: #41cac0;
        color: #ffffff;
        cursor: pointer;
        margin-right: 5px;
        margin-bottom: 5px;
        overflow: hidden;
        line-height: 15px;
        padding: 5px;
        position: relative;
        vertical-align: middle;
    }
    .tagsinput-add {
        background-color: #d6dbdf;
        border-radius: 3px;
        color: #ffffff;
        cursor: pointer;
        margin-bottom: 5px;
        padding: 6px 9px;
        display: inline-block;
        zoom: 1;
        transition: 0.25s;
        -webkit-backface-visibility: hidden;
    }
    .tagsinput-add:before {
        content: "\f067";
        font-family: "FontAwesome";
    }
    .tagsinput input {
        display: none;
    }

    .tagsinput-add-container {
        display: inline-block;
        line-height: 13px;
        vertical-align: middle;
    }

    .tagsinput .tag:hover {
        background-color: #39b1a8;
        color: #ffffff;
        padding: 5px;
    }

    .tagsinput-remove-link:before {
        color: #ffffff;
        content: "";
        font-family: "FontAwesome";
        display: none;
    }
</style>

<?php $this->renderPartial('/_partials/_search_panel', array('href' => '/admin/feeds/schedule')) ?>
<div class="row">
    <div class="col-lg-12">
        <!--source schedule start-->
        <section class="panel">
            <table class="table table-hover personal-task">
                <tbody>
                <thead>
                    <tr>
                        <th>URL</th>
                        <th>Provider</th>
                        <th>Last Updated On</th>
                        <th> schedule</th>
                        <th>status</th>
                    </tr>
                </thead>
                <tr>
                    <td>http://inkoniq.com</td>
                    <td>Inkoniq IT Solutions Pvt. Ltd.</td>
                    <td>Mon 21, 2014</td>
                    <td>
<!--                        <input name="tagsinput" id="tagsinput" class="tagsinput" value="" style="display: none;">-->
                        <div class="test1 tpr"></div>

                    </td>
                    <td>ACTIVE</td>
                </tr>

                </tbody>
            </table>
        </section>
        <!--source Schedule end-->
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.test1').tpr({interval: 15}, ["01:00", "04:30", "06:15", "06:30"]);
    })
</script>
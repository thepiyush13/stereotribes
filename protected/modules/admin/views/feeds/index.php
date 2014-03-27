<?php //echo "<pre>", print_r($categories), "</pre>";     ?>

<?php $this->renderPartial('/_partials/_search_panel', array('href' => '/admin/feeds/addfeedurls')) ?>
<link href="/css/schedular-custom.css" rel="stylesheet">

<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <!--        <header class="panel-heading">
                        Feeds List
                    </header>-->
            <table class="table table-striped table-advance table-hover">
                <thead>
                    <tr>
                        <th>Name of Provider/ URL</th>
                        <th class="hidden-phone">Category</th>
                        <th class="hidden-phone">Schedule</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $schedule = "";
                    if ($feeds && !empty($feeds)) {
                        foreach ($feeds as $key => $feed) {
                            $urlArray = parse_url($feed['url']);
                            //$urlResource = "http://feeds.readfiend.local/".strtolower($feed['name'])."/bucket/".substr(str_replace("/", "_", $urlArray['path']),1).".xml";
                            
                            //$urlResource = "feeds.readfiend.local/p/".strtolower($feed['name'])."/path/".substr(str_replace("/", "_", $urlArray['path']),1);
                            $urlResource = "feeds.jumpcatch.com/p/".strtolower($feed['name'])."/path/".substr(str_replace("/", "_", $urlArray['path']),1);
                            $urlResource = "feeds.readfiend.com/p/".strtolower($feed['name'])."/path/".substr(str_replace("/", "_", $urlArray['path']),1);
                            $url = "/admin/feeds/validate/url/".$urlResource;
                            $schedule = explode(',', $feed['schedule']);

                            echo '                            
<script>
    $(document).ready(function() {
        var sc = ' . json_encode($schedule, true) . ';
        console.log(sc);
        $("#' . $key . '").tpr({interval: 15}, sc);//["01:00", "04:30", "06:15", "06:30"]);
    })
</script>';


                            $statusClass = "style='border-left:3px solid #FF6C60'";
                            if ($feed['status'] == 'ACTIVE') {
                                $statusClass = "style='border-left:3px solid #41CAC0'";
                            } else if ($feed['status'] == 'INACTIVE') {
                                $statusClass = "style='border-left:3px solid #F1C500'";
                            }
                            $feedCategory = "";
                            $feedCatArr = explode(',', $feed['category']);
                            if ($feedCatArr) {
                                foreach ($feedCatArr as $fc) {
                                    foreach ($categories as $cat) {
                                        if ($cat['id'] == $fc) {
                                            $feedCategory .= "<span class='badge label-info'>" . $cat['name'] . "</span>";
                                            break;
                                        }
                                    }
                                }
                            }

                            echo '<tr>
                            <td ' . $statusClass . '><a href=' . $url . '>'.$feed["url"].'</a><br/><a href="/admin/feeds/profile/' . $feed["provider"] . '/' . $feed["name"] . '">' . $feed["name"] . '</a></td>
                            <td class="hidden-phone style="width:15%">' . $feedCategory . '</td>
                            <td class="hidden-phone" style="width:35%"><div id="' . $key . '" class="test1 tpr"></div></td>
                            <td>
                                <a href="/admin/feeds/addfeedurls/edit/' . $feed["id"] . '" data-toggle="modal" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a>
                                <button class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></button>
                            </td>
                        </tr>';
                        }
                    }
                    ?>
                </tbody>
            </table>





            <!--        <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade" style="display: none;">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                                    <h4 class="modal-title">Edit Feeds</h4>
                                </div>
            <?php //$this->renderPartial('_add_feeds', array('flag' => 'edit','providers' => $providers, 'categories' => $categories))?>
                            </div>
                        </div>
                    </div>-->
        </section>
    </div>
</div>

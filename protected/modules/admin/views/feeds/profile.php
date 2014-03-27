
<div class="col-lg-12">
    <section class="panel">
        <header class="panel-heading">
            <?php
                echo '<h2>' . $_GET['provider_name'] . '</h2>';
            ?>
        </header>
        <table class="table table-striped table-advance table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th class="hidden-phone">URL</th>
                    <th>Schedule</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($feedsList && !empty($feedsList)) {
                    foreach ($feedsList as $provider) {
                        $schedule = explode(',', $provider['schedule']);
                        $scheduleLabels = "";
                        if($schedule) {
                            foreach($schedule as $sch) {
                                $scheduleLabels .= ' <span class="label label-primary">'.$sch.'</span>';
                            }
                        }
                        echo '<tr>
                            <td>'.$provider["id"].'</td>
                            <td class="hidden-phone">' . $provider["url"] . '</td>
                            <td>'.$scheduleLabels.'</td>
                            <td><span class="label label-info label-mini">ACTIVE</span></td>
                            <td>
                                <button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button>
                                <button class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></button>
                            </td>
                        </tr>';
                    }
                }
                ?>
            </tbody>
        </table>

    </section>
</div>
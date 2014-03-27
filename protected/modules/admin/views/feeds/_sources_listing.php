<div class="col-lg-12">
    <section class="panel">
<!--        <header class="panel-heading">
            Providers List
        </header>-->
        <table class="table table-striped table-advance table-hover">
            <thead>
                <tr>
                    <th>Name of Provider</th>
                    <th class="hidden-phone">URL</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($providers && !empty($providers)) {
                    foreach ($providers as $provider) {
                        echo '<tr>
                            <td><a href="/admin/feeds/profile/'.$provider["id"].'/'.$provider["name"].'">' . $provider["name"] . '</a></td>
                            <td class="hidden-phone">' . $provider["url"] . '</td>
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
<div class="col-lg-12">
    <!--source schedule start-->
    <section class="panel">
        <header class='panel-heading'> Schedule Sources </header>
        <table class="table table-hover personal-task">
            <tbody>
                <tr>
                    <td>URL</td>
                    <td>Last Updated On</td>
                    <td> schedule</td>
                    <td>status</td>
                    <td>Next Schedule</td>
                </tr>

                <?php
                for ($i = 1; $i < 11; $i++) {
                    echo '
                    <tr>
                        <td>URL #' . $i . '</td>
                        <td>
                            <span class="badge bg-important">2014-27-01 10:30:00 AM</span>
                        </td>
                        <td>
                            <div class="input-group date form_datetime-component">
                              <input type="text" class="form-control" readonly="" size="16">
                              <span class="input-group-btn">
                                <button type="button" class="btn btn-danger date-set"><i class="fa fa-calendar"></i></button>
                              </span>
                            </div>
                        </td>
                        
                        <td>
                            ACTIVE
                        </td>
                        <td>
                            <div class="input-group date form_datetime-component">
                              <input type="text" class="form-control" readonly="" size="16">
                              <span class="input-group-btn">
                                <button type="button" class="btn btn-danger date-set"><i class="fa fa-calendar"></i></button>
                              </span>
                            </div>
                        </td>
                    </tr>';
                }
                ?>
            </tbody>
        </table>
    </section>
    <!--source Schedule end-->
</div>
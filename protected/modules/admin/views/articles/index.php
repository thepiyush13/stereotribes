

<div class="row">
    <div class="col-lg-3">
            <form class="form-inline" role="form">
                <div class="form-group">
                    <input type="text" class="form-control" id="searchByName" placeholder="Search">
                </div>
                <button type="submit" class="btn btn-success">Search</button>

                <!--<a href="<?php //echo $href      ?>" type="button" class="btn btn-info pull-right"><?php echo (isset($label)) ? $label : '+ Add Feeds' ?></a>-->
            </form>

    </div>


     <div class="col-lg-8">
        <ul class="unstyled inbox-pagination">
            <?php echo "<li><span>" . (($pages->pageSize * $pages->currentPage) + 1) . " - " . (($pages->currentPage + 1) * $pages->pageSize) . " of {$totalCount}</span></li>"; ?>
            <li>
                <a href="/admin/articles/index/page/<?php echo ($pages->currentPage == 0) ? "" : ($pages->currentPage) ?>" class="np-btn"><i class="fa fa-angle-left  pagination-left"></i></a>
            </li>
            <li>
                <a href="/admin/articles/index/page/<?php echo ($pages->currentPage == 0) ? 2 : ($pages->currentPage + 2) ?>" class="np-btn"><i class="fa fa-angle-right pagination-right"></i></a>
            </li>
        </ul>
     </div>
</div>


<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <!--        <header class="panel-heading">
                        Providers List
                    </header>-->
            <table class="table table-striped table-advance table-hover">
                <thead>
                    <tr>
                        <th>Provider</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Published</th>
                        <th>Categories</th>
                        <th>Article Categories</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($articles && !empty($articles)) {
                        $_articles = array();
                        //group categories
                        foreach ($articles as $article) {
                            if (array_key_exists($article['id'], $_articles)) {
                                $_articles[$article['id']]['categories'][] = ($article['category_name']) ? $article['category_name'] : 'No Category';
                            } else {
                                $_articles[$article['id']] = $article;
                                $_articles[$article['id']]['categories'][] = ($article['category_name']) ? $article['category_name'] : 'No Category';
                                ;
                            }
                        }
                        
                        

                        foreach ($_articles as $article) {
                            //Readfiend Category
                            $RFCategory = $clsLbl = '';
                            foreach ($article['categories'] as $cat) {
                                $clsLbl = ($cat == 'No Category') ? 'label-info' : 'label-primary';

                                $RFCategory .= "<span class='badge $clsLbl'>" . $cat . "</span>";
                            }


                            $category = "";
                            $catString = explode(',', $article['category']);
                            foreach ($catString as $cat) {
                                $category .= "<span class='badge'>" . $cat . "</span>";
                            }

                            echo '<tr>
                            <td><a href="/admin/articles/?providerId=' . $article["providerId"] . '">' . $article["provider_name"] . '</a></td>
                            <td class="hidden-phone">' . Utils::trucateString($article["title"], 50) . '</td>
                            <td>' . Utils::trucateString($article["description"], 140) . '</td>
                            <td class="hidden-phone">' . Utils::dateDifference(strtotime($article["pubDate"])) . '</td>
                            <td class="hidden-phone">' . $RFCategory . '</td>
                            <td class="hidden-phone">' . $category . '</td>
                            <td>
                                <button class="btn btn-success btn-xs"><i class="fa fa-check"></i></button>
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

</div>

<div class="pull-right custom-pager-ul mtop20">
    <?php
    $this->widget('CLinkPager', array(
        'pages' => $pages,
        'header' => "",
    ))
    ?>
</div>
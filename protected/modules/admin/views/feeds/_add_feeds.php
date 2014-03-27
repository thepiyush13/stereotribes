<link href="/css/schedular-custom.css" rel="stylesheet">
<div class='col-lg-12'>
    <section class='panel'>
        <header class='panel-heading'> Add Feeds </header>
        <div class='panel-body'>
            <form name="addfeeds" method="POST" action="/admin/feeds/addfeedurls/">
                <div class='form-group'>
                    <label>Source Type</label>
                    <select name="feedType" class='form-control'>
                        <option value="rss">RSS Feeds</option>
                        <option value="atom">Atoms</option>
                    </select>
                </div>

                <div class='form-group'>
                    <label>Category</label>
                    <select name="feedCategory[]" class='form-control' id="feed-category" multiple="multiple">
                        <option value="">Select Category</option>
                        <?php
                        if ($categories && !empty($categories)) {
                            foreach ($categories as $category) {
                                echo '<option value="' . $category["id"] . '">' . $category["name"] . '</option>';
                            }
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <label>Schedule</label>
                    <div class="schedule tpr"></div>
                </div>

                <div class='form-group'>
                    <label>Provider</label>
                    <select name="feedProvider" class='form-control'>
                        <option value="">Select Provider</option>
                        <?php
                        if ($providers && !empty($providers)) {
                            foreach ($providers as $provider) {
                                echo '<option value="' . $provider["id"] . '">' . $provider["name"] . '</option>';
                            }
                        }
                        ?>
                    </select>
                </div>

                <div class='form-group'> 
                    <label>URL</label>
                    <input class="form-control" type="text" name="feedUrl" value=""/>
                </div>

                <div class='form-group'>
                    <input type='submit' class='btn btn-success' value='Save'/>
                    <a type='button' href="/admin/feeds/" class='btn btn-danger'>Cancel</a>
                </div>
            </form>
        </div>
    </section>
</div>


<script>
    $(document).ready(function() {
        $('.schedule').tpr({interval: 15}, ["01:00", "04:30", "06:15", "06:30"]);
    })
</script>
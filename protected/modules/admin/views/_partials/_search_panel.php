<div class="row">
    <div class="col-lg-12">
        <div class="mail-option">
            <form class="form-inline" role="form">
                <div class="form-group">
                    <input type="text" class="form-control" id="searchByName" placeholder="Search By Name">
                </div>
                <button type="submit" class="btn btn-success">Search</button>
                
                <a href="<?php echo $href ?>" type="button" class="btn btn-info pull-right"><?php echo (isset($label)) ? $label : '+ Add Feeds'?></a>
            </form>
            
        </div>
    </div>
</div>
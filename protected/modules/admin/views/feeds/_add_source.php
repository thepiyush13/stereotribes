<div class="row">
    <div class='col-lg-5'>
        <section class='panel'>
            <header class='panel-heading'> Add Sources </header>
            <div class='panel-body'>
                <form name="addsources" method="POST" action="/admin/feeds/addsources/">
                    <div class='form-group'>
                        <label>Source Type</label>
                        <select name="sourceType" class='form-control'>
                            <option value="rss">RSS Feeds</option>
                            <option value="article">Articles</option>
                        </select>
                    </div>
                    <div class='form-group'> 

                        <label>URL</label>
                        <div class='input-group'>
                            <select name='sourceProvider' class='form-control'>
                                <option value='url1'>Url 1</option>
                                <option value='url2'>Url 2</option>
                                <option value='url3'>Url 3</option>
                                <option value='url4'>Url 4</option>
                            </select>
                            <input class='form-control' type='text' name='newSourceInput' value=''/>
                            <span class='input-group-btn'>
                                <button type='button' class='btn btn-info' name='newSourceBtn'>+Add</button>
                            </span>
                        </div>
                        
                    </div>

                    <div class='form-group'>
                        <input type='submit' class='btn btn-success' value='Save'/>
                    </div>
                </form>
            </div>
        </section>
    </div>
</div>
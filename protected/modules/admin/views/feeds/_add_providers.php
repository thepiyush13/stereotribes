
<div class='col-lg-12'>
    <section class='panel'>
        <header class='panel-heading'> Add Providers </header>
        <div class='panel-body'>
            <form name="addsources" method="POST" action="/admin/feeds/addsources/">
               
                <div class='form-group'>
                    <label>Name</label>
                    <input class="form-control" type="text" name="providerName" value=""/>
                </div>

                <div class='form-group'> 
                    <label>URL</label>
                    <input class="form-control" type="text" name="providerUrl" value=""/>
                </div>

                <div class='form-group'>
                    <input type='submit' class='btn btn-success' value='Save'/>
                    <a type='button' href="/admin/feeds/providers" class='btn btn-danger'>Cancel</a>
                </div>
                
            </form>
        </div>
    </section>
</div>

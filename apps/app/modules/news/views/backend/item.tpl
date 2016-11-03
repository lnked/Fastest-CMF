<form action="" method="POST" enctype="multipart/form-data">
    <input type="text">

    <div class="loading-indicator-container">
        <button type="submit" data-request="onSave" data-request-data="redirect:0" data-hotkey="ctrl+s, cmd+s" data-load-indicator="Saving Location..." class="btn btn-primary" data-disposable="">Save</button>
        <button type="button" data-request="onSave" data-request-data="close:1" data-hotkey="ctrl+enter, cmd+enter" data-load-indicator="Saving Location..." class="btn btn-default" data-disposable="">Save and close</button>
        <button type="button" class="oc-icon-trash-o btn-icon danger pull-right" data-request="onDelete" data-load-indicator="Deleting Location..." data-request-confirm="Do you really want to delete this location?"></button>
        
        <span class="btn-text">
            or <a href="#">Cancel</a>
        </span>
    </div>
</form>
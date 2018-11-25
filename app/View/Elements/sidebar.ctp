<aside class="sidebar">
    <div class="sidebar-title">
        <span>USER</span>
    </div>
    <div class="sidebar-user">
        <div class="sidebar-user-image">
            <span><?php echo ucfirst($this->Session->read('Auth.User.username')) ?></span>
        </div>
        <div class="sidebar-user-logout">
            <a class="button" href="<?php echo $url."users/logout" ?>">Logout</a>
        </div>
    </div>
    <div class="sidebar-title">
        <span>Folder Location</span>
        <i class="fa icon-plus sidebar-add" title="Create Main Folder"></i>
    </div>
    <div class="sidebar-treeview">
        <div class="sidebar-treeview-wrapper" id="folders" oncontextmenu="return false;">
        </div>
    </div>
</aside>
<input type="hidden" id="url" value="<?php echo $url; ?>">
<style type="text/css">
    a.button {
    -webkit-appearance: button;
    -moz-appearance: button;
    appearance: button;

    text-decoration: none;
    color: initial;
    padding: 5px;
    width: 100px;
    background: #ff5757;
    border: 1px solid red;
    border-radius: 3px;
    color: #fff;
    cursor: pointer;
}
</style>
<header class="header-wrapper">
    <div class="logo-wrapper">
        <a href="/data_archiving">
            <img src="../img/common/logo.png" alt="LSPU" class="logo-image"/>
            <span class="logo-name">LSPU</span>
        </a>
    </div>
    <div class="header-login-info">
        <div class="header-datetime">
            <span><?php echo date('F d, Y ') ?><span id="txt"></span></span>
        </div>
        <div class="header-project-title">
            <span>Data Archiving Management System</span>
        </div>
    </div>
</header>

<div class="sidebar-navigation">
    <nav class="navigation">
        <?= $this->element('sidebar'); ?>
        <ul class="navigation-list">
            <li class="navigation-item">
                <a href="<?php echo $url ?>users/" class="navigation-link <?php echo $this->request->param('controller') == 'users' && $this->request->param('action') == 'index' ? 'active': ''; ?>">Home</a>
            </li>
            <?php if ($this->Session->read('Auth.User.role') == 1): ?>
            <li class="navigation-item">
                <a href="<?php echo $url ?>users/add" class="navigation-link <?php echo $this->request->param('controller') == 'users' && $this->request->param('action') == 'add' ? 'active': ''; ?>">Add User</a>
            </li>
            <?php endif; ?>
            <li class="navigation-item">
                <a href="<?php echo $url ?>archives/add" class="navigation-link <?php echo $this->request->param('controller') == 'archives' && $this->request->param('action') == 'add' ? 'active': ''; ?>">Add Files</a>
            </li>
            <li class="navigation-item">
                <a href="<?php echo $url ?>archives/" class="navigation-link">Activity</a>
            </li>
            <li class="navigation-search-wrapper">
                <div class="navigation-search">
                    <div class="search_selectbox-wrapper">
                        <select class="search_box">
                            <option>Categories</option>
                            <option>Name</option>
                            <option>Author</option>
                        </select>
                    </div>
                    <div class="search_input-wrapper">
                        <input type="text" class="search_input">
                    </div>
                    <div class="search-button-wrapper">
                        <button class="search-button">Search</button>
                    </div>
                </div>
            </li>
        </ul>
    </nav>
</div>
<div class="title">
    <h1></h1>
</div>
<script type="text/javascript">
    function startTime() {
    var today = new Date();
    var h = today.getHours();
    var m = today.getMinutes();
    var s = today.getSeconds();
    m = checkTime(m);
    s = checkTime(s);
    document.getElementById('txt').innerHTML =
    h + ":" + m + ":" + s;
    var t = setTimeout(startTime, 500);
    }
    function checkTime(i) {
    if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
        return i;
    }
</script>
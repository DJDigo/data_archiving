<header class="header-wrapper">
    <div class="logo-wrapper">
        <a href="/data_archiving">
            <img src="../img/common/logo.png" alt="LSPU" class="logo-image"/>
            <span class="logo-name">Laguna State Polytechnic University - San Pablo City Campus</span>
        </a>
    </div>
    <div class="header-login-info">
        <div class="header-datetime">
            <span><?php echo date('F d, Y ') ?><span id="txt"></span></span>
        </div>
        <div class="header-project-title">
            <span>Document Archiving Management System</span>
        </div>
    </div>
</header>
<div class="sidebar-navigation">
    <nav class="navigation">
        <?= $this->element('sidebar'); ?>
        <ul class="navigation-list">
            <li class="navigation-item">
                <a href="<?php echo $url ?>users/" class="navigation-link <?php echo $this->request->param('controller') == 'users' && $this->request->param('action') == 'index' ? 'active': ''; ?>">HOME</a>
            </li>
            <?php if ($this->Session->read('Auth.User.role') == 1): ?>
            <li class="navigation-item">
                <a href="<?php echo $url ?>archives/add" class="navigation-link <?php echo $this->request->param('controller') == 'archives' && $this->request->param('action') == 'add' ? 'active': ''; ?>">ADD FILES</a>
            </li>
            <?php endif; ?>
            <li class="navigation-item">
                <a href="<?php echo $url ?>archives/index" class="navigation-link <?php echo $this->request->param('controller') == 'archives' && $this->request->param('action') == 'index' ? 'active': ''; ?>">MANAGED FILES</a>
            </li>
            <li class="navigation-item">
                <a href="<?php echo $url ?>users/lists" class="navigation-link <?php echo $this->request->param('controller') == 'users' && ($this->request->param('action') == 'lists' || $this->request->param('action') == 'add' ) ? 'active': ''; ?>">MANAGED ACCOUNT</a>
            </li>
            <?php if ($this->Session->read('Auth.User.role') == 1): ?>
            <!-- <li class="navigation-item">
                <a href="<?php echo $url ?>users/lists" class="navigation-link">Users List</a>
            </li> -->
            <?php endif; ?>
            <li class="navigation-item">
                <a href="<?php echo $url ?>logs/" class="navigation-link">ACTIVITY</a>
            </li>
            <?php if ($this->Session->read('Auth.User.role') == 1): ?>
            <li class="navigation-item">
                <a href="<?php echo $url ?>archives/deleted" class="navigation-link">DELETED</a>
            </li>
            <?php endif; ?>
            <li class="navigation-search-wrapper">
                <div class="navigation-search">
                    <form action="<?php echo $url ?>archives/search" method="GET">
                        <div class="search_selectbox-wrapper">
                            <select class="search_box" name="option">
                                <option value="1" <?php echo (isset($_GET['option']) && $_GET['option'] == 1) ? "selected" : '' ?> >Categories</option>
                                <option value="2" <?php echo (isset($_GET['option']) && $_GET['option'] == 2) ? "selected" : '' ?>>File Name</option>
                                <option value="3" <?php echo (isset($_GET['option']) && $_GET['option'] == 2) ? "selected" : '' ?>>Control Number</option>
                                <option value="4" <?php echo (isset($_GET['option']) && $_GET['option'] == 2) ? "selected" : '' ?>>Description</option>
                            </select>
                        </div>
                        <div class="search_input-wrapper">
                            <input type="text" class="search_input" name="name" autocomplete="off" value="<?php echo (isset($_GET['name'])) ? $_GET['name'] : '' ?>">
                        </div>
                        <div class="search-button-wrapper">
                            <button class="search-button">Search</button>
                        </div>
                    </form>
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
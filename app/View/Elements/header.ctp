<header class="header-wrapper">
    <div class="logo-wrapper">
        <a href="/data_archiving">
            <img src="../img/common/logo.png" alt="LSPU" class="logo-image"/>
            <span class="logo-name">LSPU</span>
        </a>
    </div>
    <div class="header-login-info">
        <div class="header-datetime">
            <span>August 30, 2018  &nbsp;&nbsp; 10:00:00</span>
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
                <a href="/data_archiving/home" class="navigation-link">Home</a>
            </li>
            <li class="navigation-item">
                <a href="/data_archiving/users/add" class="navigation-link active">Add User</a>
            </li>
            <li class="navigation-item">
                <a href="/data_archiving/" class="navigation-link">Add Files</a>
            </li>
            <li class="navigation-item">
                <a href="/data_archiving/" class="navigation-link">Activity</a>
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
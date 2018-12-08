<div class="container">
  <?= $this->element('header'); ?>
  <div class="content">
    <div class="content-title">
      <h2>Home</h2>
    </div>
    <div class="content-wrapper">
      <div class="dashboard">
        <ul>
          <li class="dashboard-item">
            <div class="dashboard-count">
              <i class="fa icon-user"></i>
              <span><?php echo $user_count ?></span>
            </div>
            <div class="dashboard-title">
              <span>Number Of Users</span>
            </div>
          </li>

          <li class="dashboard-item">
            <div class="dashboard-count">
              <i class="fa icon-file"></i>
              <span><?php echo $file_count ?></span>
            </div>
            <div class="dashboard-title">
              <span>Number Of Files</span>
            </div>
          </li>

          <li class="dashboard-item">
            <div class="dashboard-count">
              <i class="fa icon-folder-open"></i>
              <span><?php echo $folder_count ?></span>
            </div>
            <div class="dashboard-title">
              <span>Number Of Folders</span>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </div>
</div>
<div class="container">
    <?= $this->element('header'); ?>
    <div class="content">
        <div class="content-title">
            <h2>Deleted Files</h2>
        </div>
        <div class="content-wrapper">
        <?php echo $this->Flash->render(); ?> 
            <div class="activity-table">
                <table id="activity-table" class="table table-bordered stripe">
                    <thead>
                        <tr>
                            <td>ID</td>
                            <td>File Name</td>
                            <td>Date Deleted</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($archives as $archive): ?>
                        <tr>
                            <td><?php echo $archive['Archive']['id'] ?></td>
                            <td><?php echo $archive['Archive']['image'] ?></td>
                            <td><?php echo $archive['Archive']['deleted_date'] ?></td>
                            <td>
                                <div class="button-restore-wrapper">
                                    <a href="<?php echo $url.'archives/restore/'.$archive['Archive']['id'] ?>" class="button-restore">Restore</a>
                                </div>
                                <div class="button-restore-wrapper">
                                    <a href="<?php echo $url.'archives/hard_delete/'.$archive['Archive']['id'] ?>" class="button-delete" data-id="<?php echo $archive['Archive']['id'] ?>">Delete</a>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<style>
.activity-table tbody td,
.file-list tbody td {
    text-align: center;
}
</style>
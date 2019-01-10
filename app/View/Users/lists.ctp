<div class="container">
    <?= $this->element('header'); ?>
    <div class="content">
        <div class="content-title">
            <h2>Users List</h2>
        </div>
        <?php echo $this->Flash->render() ?>
        <div class="content-wrapper">
            <div class="users-list">
                <table id="activity-table" class="table table-bordered stripe">
                    <thead>
                        <tr>
                            <td>ID</td>
                            <td>Username</td>
                            <td>Position</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($users as $key => $value): ?>
                        <tr>
                            <td><?php echo $value['User']['id'] ?></td>
                            <td><?php echo $value['User']['username'] ?></td>
                            <td><?php echo ucfirst($value['User']['position']) ?></td>
                            <td>
                                <div class="button-delete-wrapper">
                                    <a href="<?php echo $url.'users/delete/'.$value['User']['id'] ?>" class="button-delete">Delete</a>
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
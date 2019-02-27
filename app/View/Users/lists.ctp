<div class="container">
    <?= $this->element('header'); ?>
    <div class="content">
        <div class="content-title">
            <h2>Users List</h2>
        </div>
        <?php echo $this->Flash->render() ?>
        <div class="content-wrapper" style="padding: 20px 0;">
            <a href="/data_archiving/users/add" class="add-user">+ Add User</a>
            <div class="users-list">
                <table id="activity-table" class="table table-bordered stripe">
                    <thead>
                        <tr>
                            <td>Username</td>
                            <td>Position</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($users as $key => $value): ?>
                        <tr>
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
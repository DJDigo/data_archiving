<div class="container">
    <?= $this->element('header'); ?>
    <div class="content">
        <div class="content-title">
            <h2>Users List</h2>
        </div>
        <div class="content-wrapper">
            <div class="users-list">
                <table id="activity-table" class="table table-bordered stripe">
                    <thead>
                        <tr>
                            <td>ID</td>
                            <td>Last Name, First Name</td>
                            <td>Email Address</td>
                            <td>Position</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1001</td>
                            <td>Dela Cruz, Juan</td>
                            <td>delacruzjuan@gmail.com</td>
                            <td>missionary</td>
                            <td>
                                <div class="button-delete-wrapper">
                                    <button class="button-delete">Delete</button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>1002</td>
                            <td>Dela Cruz, Juana</td>
                            <td>delacruzjuana@gmail.com</td>
                            <td>dogs</td>
                            <td>
                                <div class="button-delete-wrapper">
                                    <button class="button-delete">Delete</button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <?= $this->element('header'); ?>
    <div class="content">
        <div class="content-title">
            <h2>Deleted Files</h2>
        </div>
        <div class="content-wrapper">
        <?php echo $this->Session->flash(); ?> 
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
                        <tr>
                            <td>101</td>
                            <td>File Name1</td>
                            <td>2018-12-12</td>
                            <td>
                                <div class="button-restore-wrapper">
                                    <button class="button-restore">Restore</button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>102</td>
                            <td>File Name2</td>
                            <td>2018-12-12</td>
                            <td>
                                <div class="button-restore-wrapper">
                                    <button class="button-restore">Restore</button>
                                </div>
                            </td>
                        </tr>
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
<script type="text/javascript">
    $(function () {
        $('.button-restore').on('click', function() {
            alert('dsa');
        });
    });
</script>
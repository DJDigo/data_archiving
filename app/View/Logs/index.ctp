<div class="container">
    <?= $this->element('header'); ?>
    <div class="content">
        <div class="content-title">
            <h2>Activity Logs</h2>
        </div>
        <div class="content-wrapper" style="padding: 12px 0;">
        <button class="clear-all">Clear All</button>
        <?php echo $this->Session->flash(); ?> 
            <div class="activity-table">
                <table id="activity-table" class="table table-bordered stripe">
                    <thead>
                        <tr>
                            <td>Date</td>
                            <td>Description</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($logs as $log):  ?>
                        <tr>
                            <td style="text-align: center"><?php echo $log['Log']['created'] ?></td>
                            <td><?php echo $log['Log']['description'] ?></td>
                            <td>
                                <div class="button-delete-wrapper">
                                    <button class="button-delete" data-id="<?php echo $log['Log']['id'] ?>">Delete</button>
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
<script type="text/javascript">
    $(function () {
        $('.button-delete').on('click', function() {
            if (confirm("Are you sure you want to delete this?")) {
                let id = $(this).data('id');
                window.location.href = "<?php echo $url ?>logs/delete/"+id;
            } else {
                return false;
            }
        });
    });
</script>
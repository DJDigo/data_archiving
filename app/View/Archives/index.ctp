<div class="container">
    <?= $this->element('header'); ?>
    <div class="content">
        <div class="content-title">
            <h2>Activity Logs</h2>
        </div>
        <div class="content-wrapper">
        <?php echo $this->Session->flash(); ?> 
            <div class="activity-table">
                <table id="activity-table" class="table table-bordered stripe">
                    <thead>
                        <tr>
                            <td>File Name</td>
                            <td>Date</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($archives as $key => $val):  ?>
                        <tr>
                            <td><?php echo strlen($val['Archive']['image']) > 30 ? substr($val['Archive']['image'],0,30)."..." : $val['Archive']['image']; ?></td>
                            <td><?php echo $val['Archive']['created'] ?></td>
                            <td>
                                <div class="button-delete-wrapper">
                                    <button class="button-delete" data-id="<?php echo $val['Archive']['id'] ?>">Delete</button>
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
            let id = $(this).data('id');
            window.location.href = "<?php echo $url ?>archives/delete/"+id;
        });
    });
</script>
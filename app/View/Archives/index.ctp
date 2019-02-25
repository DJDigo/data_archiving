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
                            <td>Control Number</td>
                            <td>Filename</td>
                            <td>Date</td>
                            <td>Private</td>
                            <td>Delete</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($archives as $key => $val):  ?>
                        <tr>
                            <td><?php echo $val['Archive']['control_number'] ?></td>
                            <td><?php echo strlen($val['Archive']['image']) > 30 ? substr($val['Archive']['image'],0,30)."..." : $val['Archive']['image']; ?></td>
                            <td><?php echo $val['Archive']['created'] ?></td>
                            <td>
                                <?php if($val['Archive']['is_private'] == 1): ?>
                                <div class="button-delete-wrapper is_private" >
                                    <button class="button-delete" data-id="<?php echo $val['Archive']['id'] ?>" id="0">Private</button>
                                </div>
                                <?php else: ?>
                                <div class="button-restore-wrapper">
                                    <button class="button-restore is_private" data-id="<?php echo $val['Archive']['id'] ?>" id="1">Public</button>
                                </div>
                                <?php endif; ?>
                            </td>
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
            if (confirm("Are you sure you want to delete this?")) {
                let id = $(this).data('id');
                window.location.href = "<?php echo $url ?>archives/delete/"+id;
            } else {
                return false;
            }
        });

        $('.is_private').on('click', function () {
            let id = $(this).attr('id');
            let arhive_id = $(this).attr('data-id');
            let message = id == 0 ? 'private' : 'public';
            
            if (confirm("Are you sure you want make it "+message+"?")) {
                window.location.href = "<?php echo $url ?>archives/private/?is_private="+id+"&id="+arhive_id;
            } else {
                return false;
            }
        });
    });
</script>
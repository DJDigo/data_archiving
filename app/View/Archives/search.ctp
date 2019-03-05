<div class="container">
    <?= $this->element('header'); ?>
    
    <div class="content">
        <div class="content-title">
            <h2>Search Files</h2>
        </div>
        <div class="content-wrapper">
            <div class="file-list">
                <table id="file-list" class="table table-bordered stripe">
                    <thead>
                        <tr>
                            <td>File Name</td>
                            <td>Category</td>
                            <td>Date</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if(!empty($archives)): ?>
                    <?php foreach($archives as $key => $data): ?>
                        <tr>
                            <td><?php echo strlen($data['Archive']['image']) > 20 ? substr($data['Archive']['image'],0,20)."..." : $data['Archive']['image']; ?></td>
                            <td style="width:300px; text-align: center"><?php echo $data['Location']['Category']['name'] ?></td>
                            <td><?php echo $data['Archive']['created'] ?> </td>
                            <td>
                                <div class="button-view-wrapper">
                                    <button class="button-view" id="<?php echo $data['Archive']['id'] ?>">View</button>
                                </div>
                                <div class="button-delete-wrapper">
                                    <a href="<?php echo $url."archives/delete/".$data['Archive']['id'] ?>" class="button-delete">Delete</a>
                                </div>
                            </td>
                        </tr>
                        <div class="modal" id="showModal-<?php echo $data['Archive']['id'] ?>">
                            <div class="modal-container">
                                <div class="modal-image-wrapper">
                                    <img src="<?php echo $url.'app/webroot/files/'.$data['Location']['path'].'/'.$data['Archive']['image'] ?>" alt="image" class="modal-image"/>
                                </div>
                                <div class="modal-image-content">
                                    <ul>
                                        <li class="modal-content-list">
                                            <label class="modal-content-label">File Name:</label>
                                            <div class="modal-content-info">
                                                <span><?php echo strlen($data['Archive']['image']) > 30 ? substr($data['Archive']['image'],0,30)."..." : $data['Archive']['image']; ?></span>
                                            </div>
                                        </li>
                                        <li class="modal-content-list">
                                            <label class="modal-content-label">Date:</label>
                                            <div class="modal-content-info">
                                                <span><?php echo $data['Archive']['created'] ?></span>
                                            </div>
                                        </li>
                                        <li class="modal-content-list">
                                            <label class="modal-content-label">Control No:</label>
                                            <div class="modal-content-info">
                                                <span><?php echo $data['Archive']['control_number'] ?></span>
                                            </div>
                                        </li>
                                        <li class="modal-content-list">
                                            <label class="modal-content-label">Description:</label>
                                            <div class="modal-content-info">
                                                <span><?php echo $data['Archive']['description'] ?></span>
                                            </div>
                                        </li>
                                        <li class="modal-content-list">
                                            <label class="modal-content-label">Category:</label>
                                            <div class="modal-content-info">
                                                <span><?php echo $data['Location']['Category']['name'] ?></span>
                                            </div>
                                        </li>
                                    </ul>
                                    <div class="modal-button-wrapper">
                                        <button class="button-close" id="<?php echo $data['Archive']['id'] ?>">Close</button>
                                        <button class="button-print">Print</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <?php endif ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
// Datatable
    $('#file-list').dataTable({
        "lengthMenu": [ 10, 50, 100 ],
        "lengthChange": true,
        "searching": false,
        "info": true,
        "iDisplayLength":10,
        'pagingType': 'full_numbers',
        "autoWidth": false
    });

</script>
<div class="container">
    <?= $this->element('header'); ?>
    
    <div class="content">
        <div class="content-title">
            <h2>Add User</h2>
        </div>
        <div class="content-wrapper">
            <?php echo $this->Form->create('Archive', [
                'type'    => 'post', 
                'enctype' => 'multipart/form-data', 
                'class'   => 'form-container'
            ]); ?>
                <div class="form-field">
                    <label class="form-label">File Upload: <span class="form-note">*(accepts jpg/png only)</span></label>
                    <div class="form-input-wrapper">
                        <div class="form-image-uploaded">
                            <img src="../img/common/fallback-file.png" class="js-image-uploaded">
                        </div>
                        <div class="form-upload-input">
                            <?php 
                                echo $this->Form->input('image.upload', array(
                                    'label'  => false,
                                    'type'   => 'file',
                                    'accept' => "image/*",
                                    'div'    => false,
                                    'class'  => 'js-upload-image'
                                ));
                            ?>
                            <span class="error-message js-error-image"></span>
                        </div>
                    </div>
                </div>
                <div class="form-field">
                    <label class="form-label">File Name:</label>
                    <div class="form-input-wrapper">
                        <?php 
                            echo $this->Form->input('name', [
                                'label'     => false,
                                'type'      => 'text',
                                'required'  => false,
                                'div'       => false,
                                'class'     => 'form-input js-file-name',
                                'maxlength' => 255,
                            ]);
                        ?>
                        <?php echo $this->Form->error('name'); ?>
                        <!-- <span class="error-message">error</span> -->
                    </div>
                </div>
                <div class="form-field">
                    <label class="form-label">Category:</label>
                    <div class="form-input-wrapper">
                        <select class="form-input js-category">
                            <option value="">---Select Category---</option>
                            <?php foreach($categories as $category): ?>
                                <option value="<?php echo $category['Category']['id'] ?>"><?php echo $category['Category']['name']; ?></option>
                            <?php endforeach;?>
                        </select>
                        <!-- <span class="error-message">error</span> -->
                    </div>
                </div>
                <div class="form-field file-location">
                    <label class="form-label">File Location:</label>
                    <div class="form-input-wrapper">
                        <select class="form-input js-file-location" name="data[Archive][location_id]">
                        </select>
                        <!-- <span class="error-message">error</span> -->
                    </div>
                </div>
                <div class="form-field">
                    <label class="form-label">Description:</label>
                    <div class="form-input-wrapper">
                        <?php 
                            echo $this->Form->input('description', [
                                'label'     => false,
                                'type'      => 'textarea',
                                'required'  => false,
                                'div'       => false,
                                'class'     => 'form-textarea',
                                'maxlength' => false,
                            ]);
                        ?>
                        <!-- <span class="error-message">error</span> -->
                    </div>
                </div>
                <div class="form-button-wrapper">
                    <label class="form-label"></label>
                    <input type="submit" class="form-button" value="Create">
                </div>
            <?php echo $this->Form->end(); ?>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(function () {
        let url = $('#url').val();
        $('html').delegate('.js-category','change',function() {
            $('.file-location').show();
            let category_id = $(this).val();
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: url + "archives/get_locations",
                data: {category_id},
                success: function (response) {
                    $('.js-file-location').html('');
                    response.forEach((value,key) => {
                        $('.js-file-location').append('<option value="'+ value['Location']['id'] +'">'+ value['Location']['path'] +'</option>')
                    });
                }
            });
        });
    });
</script>
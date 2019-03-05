<div class="container">
    <?= $this->element('header'); ?>
    
    <div class="content">
        <div class="content-title">
            <h2>Add Files</h2>
        </div>
        <div class="content-wrapper">
            <?php echo $this->Form->create('Archive', [
                'type'    => 'post', 
                'enctype' => 'multipart/form-data', 
                'class'   => 'form-container'
                ]);
            ?>
            <?php echo $this->Session->flash();?>
                <div class="form-field">
                    <label class="form-label">File Upload: <span class="form-note">*(accepts jpg/png only)</span></label>
                    <div class="form-input-wrapper js-fileupload">
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
                        </div>
                        <span class="error-message js-error-image"><?php echo $this->Form->error("image") ?></span>
                    </div>
                    <a class="add-more-upload">+ Add More File</a>
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
                    </div>
                </div>
                <div class="form-field">
                    <label class="form-label">Control Number:</label>
                    <div class="form-input-wrapper">
                        <?php 
                            echo $this->Form->input('control_number', [
                                'label'     => false,
                                'type'      => 'number',
                                'required'  => false,
                                'div'       => false,
                                'class'     => 'form-input',
                                'maxlength' => 255
                            ]);
                        ?>
                        <!-- <span class="error-message"><?php echo $this->Form->error("control_number") ?></span> -->
                    </div>
                </div>
                <div class="form-field">
                    <label class="form-label">Category:</label>
                    <div class="form-input-wrapper">
                        <select class="form-input js-category" name="data[Archive][category]">
                            <option value="">---Select Category---</option>
                            <?php foreach($categories as $category): ?>
                                <option value="<?php echo $category['Category']['id'] ?>"><?php echo $category['Category']['name']; ?></option>
                            <?php endforeach;?>
                        </select>
                        <span class="error-message"><?php echo $this->Form->error("category") ?></span>
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

        $('html').delegate('.add-more-upload', 'click', function () {
            let addFile = `
                <div class="form-upload-input">
                    <input type="file" class="js-upload-image">
                </div>
            `
            $('.js-fileupload').append(addFile);
        });
    });
</script>
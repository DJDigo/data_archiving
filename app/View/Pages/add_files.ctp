<div class="container">
    <?= $this->element('header'); ?>
    
    <div class="content">
        <div class="content-title">
            <h2>Add User</h2>
        </div>
        <div class="content-wrapper">
           <form class="form-container">
                <div class="form-field">
                    <label class="form-label">File Upload: <span class="form-note">*(accepts jpg/png only)</span></label>
                    <div class="form-input-wrapper">
                        <input type="file" class="js-upload-image">
                        <span class="error-message js-error-image"></span>
                    </div>
                </div>

                <div class="form-field">
                    <label class="form-label">File Name:</label>
                    <div class="form-input-wrapper">
                        <input type="text" class="form-input js-file-name">
                        <!-- <span class="error-message">error</span> -->
                    </div>
                </div>

                <div class="form-field">
                    <label class="form-label">Category:</label>
                    <div class="form-input-wrapper">
                        <select class="form-input js-category">
                        </select>
                        <!-- <span class="error-message">error</span> -->
                    </div>
                </div>

                <div class="form-field file-location">
                    <label class="form-label">File Location:</label>
                    <div class="form-input-wrapper">
                        <select class="form-input js-file-location">
                        </select>
                        <!-- <span class="error-message">error</span> -->
                    </div>
                </div>

                <div class="form-field">
                    <label class="form-label">Control No:</label>
                    <div class="form-input-wrapper">
                        <input type="number" class="form-input">
                        <!-- <span class="error-message">error</span> -->
                    </div>
                </div>
                <div class="form-field">
                    <label class="form-label">Date:</label>
                    <div class="form-input-wrapper">
                        <input type="text" class="form-input datepicker" readonly>
                        <!-- <span class="error-message">error</span> -->
                    </div>
                </div>
                <div class="form-field">
                    <label class="form-label">Description:</label>
                    <div class="form-input-wrapper">
                        <textarea class="form-textarea"></textarea>
                        <!-- <span class="error-message">error</span> -->
                    </div>
                </div>

                <div class="form-button-wrapper">
                    <label class="form-label"></label>
                    <input type="submit" class="form-button" value="Create">
                </div>
            </form>
        </div>
    </div>
</div>
<div class="container">
    <?= $this->element('header'); ?>
    
    <div class="content">
        <div class="content-title">
            <h2>Add User</h2>
        </div>
        <div class="content-wrapper">
           <form class="form-container form-container-adduser">
                <div class="flash-error">
                    <i class="fa icon-exclamation error-icon"></i>
                    <span>Ako error</span>
                </div>
                <div class="flash-success">
                    <i class="fa icon-ok error-icon"></i>
                    <span>Ako hindi error</span>
                </div>
                <div class="form-field">
                    <label class="form-label">Username:</label>
                    <div class="form-input-wrapper">
                        <input type="text" class="form-input">
                        <span class="error-message">error</span>
                    </div>
                </div>
                <div class="form-field">
                    <label class="form-label">Password:</label>
                    <div class="form-input-wrapper">
                        <input type="text" class="form-input">
                        <span class="error-message">error</span>
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
<div class="container">
    <?= $this->element('header'); ?>

    <?= $this->element('sidebar'); ?>
    
    <div class="content">
        <div class="content-title">
            <h2>Add User</h2>
        </div>
        <div class="content-wrapper">
           <form class="form-container">
                <div class="form-field">
                    <label class="form-label">Username:</label>
                    <input type="text" class="form-input">
                </div>
                <div class="form-field">
                    <label class="form-label">Password:</label>
                    <input type="text" class="form-input">
                </div>
                <div class="form-button-wrapper">
                    <input type="submit" class="form-button" value="Create">
                </div>
            </form>
        </div>
    </div>
</div>
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
                    <label class="form-label">File Name:</label>
                    <div class="form-input-wrapper">
                        <span>Menandro_oba_san.jpg</span>
                    </div>
                </div>
                <div class="form-field">
                    <label class="form-label">Control No:</label>
                    <div class="form-input-wrapper">
                        <span>123124</span>
                    </div>
                </div>
                <div class="form-field">
                    <label class="form-label">Date:</label>
                    <div class="form-input-wrapper">
                        <span>2018-08-30</span>
                    </div>
                </div>
                <div class="form-field">
                    <label class="form-label">Description:</label>
                    <div class="form-input-wrapper">
                        <span>Lorem ipsum dolor sit amet consectetur adipisicing elit. Praesentium quam dolore nulla illum ipsum inventore temporibus id tempore enim quasi eveniet architecto excepturi, pariatur assumenda doloribus sed sunt, reprehenderit iure!</span>
                    </div>
                </div>
                <div class="form-field">
                    <label class="form-label">Category:</label>
                    <div class="form-input-wrapper">
                        <span>Category2</span>
                    </div>
                </div>
                <div class="form-button-wrapper">
                    <label class="form-label"></label>
                    <input type="submit" class="form-button" value="Confirm">
                </div>
            </form>
        </div>
    </div>
</div>
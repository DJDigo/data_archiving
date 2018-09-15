<div class="container">
    <?= $this->element('header'); ?>
    <div class="content">
        <div class="content-title">
            <h2>Add User</h2>
        </div>
        <div class="content-wrapper">
            <?php 
                echo $this->Form->create("User", [
                    "class" => "form-container form-container-adduser",
                    "type"  => "POST"
                ]); 
            ?>
            <?php echo $this->Flash->render(); ?>
            <div class="form-field">
                <label class="form-label">Username:</label>
                <div class="form-input-wrapper">
                    <?php 
                        echo $this->Form->input("username", [
                            "type"     => "text",
                            "label"    => false,
                            "div"      => false,
                            "required" => false,
                            "class"    => "form-input"
                        ]);
                    ?>
                </div>
            </div>
            <div class="form-field">
                <label class="form-label">Password:</label>
                <div class="form-input-wrapper">
                    <?php 
                        echo $this->Form->input("password", [
                            "type"     => "password",
                            "label"    => false,
                            "div"      => false,
                            "required" => false,
                            "class"    => "form-input"
                        ]);
                    ?>
                </div>
            </div>
            <div class="form-field">
                <label class="form-label">Confirm Password:</label>
                <div class="form-input-wrapper">
                    <?php 
                        echo $this->Form->input("password_confirm", [
                            "type"     => "password",
                            "label"    => false,
                            "div"      => false,
                            "required" => false,
                            "class"    => "form-input"
                        ]);
                    ?>
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
</div>
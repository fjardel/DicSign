<section class="container" >            
    <div class="row">
        <div class="twelve columns Administrators form" >
        <?php echo $this->Session->flash(); ?>
        <?php echo $this->Form->create('User'); ?>
            <fieldset>
                <legend>
                    <?php echo __('Please enter your username and password'); ?>
                </legend>
                <?php echo $this->Form->input('username');
                echo $this->Form->input('password');
            ?>
            </fieldset>
        <?php echo $this->Form->end(__('Login')); ?>
        </div>
    </div>
</section>
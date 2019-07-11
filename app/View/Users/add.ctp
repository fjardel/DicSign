<section class="container" >            
    <div class="row">
        <div class="twelve columns Administrators form" >
        <?php echo $this->Form->create('User'); ?>
            <fieldset>
                <legend><?php echo __('Add User'); ?></legend>
                <?php echo $this->Form->input('username');
                echo $this->Form->input('password');
                echo $this->Form->input('role', array(
                    'options' => array('admin' => 'Admin', 'author' => 'Author')
                ));
            ?>
            </fieldset>
        <?php echo $this->Form->end(__('Submit')); ?>
        </div>
    </div>
</section>

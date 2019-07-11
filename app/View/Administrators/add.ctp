<section class="container" >            
    <div class="row">
        <div class="twelve columns Administrators form" >
        <?php echo $this->Form->create('Administrator'); ?>
            <fieldset>
                <legend><?php echo __('Add Administrators'); ?></legend>
                <?php 
                echo $this->Form->input('nome');
                echo $this->Form->input('username');
                echo $this->Form->input('email');
                echo $this->Form->input('password');
                echo $this->Form->input('matricula');
                echo $this->Form->input('faculdade');
                echo $this->Form->input('curso');
                
            ?>
            </fieldset>
        <?php echo $this->Form->end(__('Submit')); ?>
        </div>
    </div>
</section>

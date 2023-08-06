

<script type="text/javascript">
// use mousetrap library
Mousetrap.bind(['alt+r'], function(e) {
        location.href =
                "<?php echo $this->Html->url(array(
                        'plugin' => 'webzash',
                        'controller' => 'entries',
                        'action' => 'add', 'receipt'
                )); ?>";
        return false;
});
Mousetrap.bind(['alt+p'], function(e) {
        location.href =
                "<?php echo $this->Html->url(array(
                        'plugin' => 'webzash',
                        'controller' => 'entries',
                        'action' => 'add', 'payment'
                )); ?>";
        return false;
});
Mousetrap.bind(['alt+c'], function(e) {
        location.href =
                "<?php echo $this->Html->url(array(
                        'plugin' => 'webzash',
                        'controller' => 'entries',
                        'action' => 'add', 'contra'
                )); ?>";
        return false;
});
Mousetrap.bind(['alt+j'], function(e) {
        location.href =
                "<?php echo $this->Html->url(array(
                        'plugin' => 'webzash',
                        'controller' => 'entries',
                        'action' => 'add', 'journal'
                )); ?>";
        return false;
});
Mousetrap.bind(['alt+e'], function(e) {
        location.href =
                "<?php echo $this->Html->url(array(
                        'plugin' => 'webzash',
                        'controller' => 'entries',
                        'action' => 'index'
                )); ?>";
        return false;
});
Mousetrap.bind(['alt+a'], function(e) {
        location.href =
                "<?php echo $this->Html->url(array(
                        'plugin' => 'webzash',
                        'controller' => 'accounts',
                        'action' => 'show'
                )); ?>";
        return false;
});
Mousetrap.bind(['alt+l'], function(e) {
        location.href =
                "<?php echo $this->Html->url(array(
                        'plugin' => 'webzash',
                        'controller' => 'ledgers',
                        'action' => 'add'
                )); ?>";
        return false;
});

</script>

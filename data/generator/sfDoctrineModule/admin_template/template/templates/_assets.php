[?php slot('menu', '<?php echo $this->params['route_prefix'] ?>') ?]
<?php if (isset($this->params['css']) && ($this->params['css'] !== false)): ?> 
[?php use_stylesheet('<?php echo $this->params['css'] ?>', 'first') ?] 
<?php endif; ?>
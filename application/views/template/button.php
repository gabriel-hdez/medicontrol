<?php if(isset($btnIcon)):?>
<div class="fixed-action-btn">
  <a class="btn-floating btn-large red tooltipped bicolor no-imprimir" data-position="left" data-tooltip="<?php echo $btnTooltip;?>" href="<?php echo $btnAction;?>">
    <i class="large material-icons "><?php echo $btnIcon;?></i>
  </a>
  <ul>
    <!-- <li><a class="btn-floating red"><i class="material-icons">insert_chart</i></a></li>
    <li><a class="btn-floating yellow darken-1"><i class="material-icons">format_quote</i></a></li>
    <li><a class="btn-floating green"><i class="material-icons">publish</i></a></li>
    <li><a class="btn-floating blue"><i class="material-icons">attach_file</i></a></li> -->
  </ul>
</div>
<?php endif;?>
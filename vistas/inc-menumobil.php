

<li class="hidden-sm hidden-md hidden-lg">
    <a href="v-perfil.php" class="menu-mobil"><i class="fa fa-user fa-fw"></i><?=$idioma['Mi Perfil']?></a>

</li>

<?php if(sizeof($notifs)>0) { ?>

    <li class="hidden-sm hidden-md hidden-lg">
        <a href="v-notificaciones.php" class="menu-mobil"><i class="fa fa-bell fa-fw"></i><?=$idioma['Notificaciones']?> <i class="notif"><?=sizeof($notifs)?></i></a>

    </li>


<?php } ?>
<li class="hidden-sm hidden-md hidden-lg">
    <a href="../index.php?controller=Login&amp;action=logout" class="menu-mobil" style="color:darkred"><i class="fa fa-close fa-fw"></i><?=$idioma['Salir']?></a>

</li>

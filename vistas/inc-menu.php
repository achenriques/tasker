<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">

            <li>

                <a href="v-dashboard.php"><i class="fa fa-dashboard fa-fw"></i>Dashboard</a>

            </li>

            <li>
                <a href="v-dashboard.php"><i class="fa fa-tasks fa-fw"></i><?=$idioma['Tareas']?><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="v-mistareas.php"><?=$idioma['Mis Tareas']?></a>
                        <a href="v-altatarea.php"><i class="fa fa-plus-circle fa-fw"></i><?=$idioma['Nueva Tarea']?></a>
                    </li>

                </ul>
            </li>
            <li>
                <a href="v-calendario.php"><i class="fa fa-calendar fa-fw"></i><?=$idioma['Mis Calendarios']?><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">

                    <?php foreach ($calendarios as $calendario) { ?>

                        <li>
                            <a href="v-calendario.php?idCalendario=<?=$calendario->getIdCalendario()?>"><i class="fa fa-circle fa-fw" style="color:<?=$calendario->getColor()?>"></i><?=$calendario->getNombreCalendario()?></a>
                        </li>

                    <?php } ?>

                    <li>
                        <a href="v-miscalendarios.php"><i class="fa fa-wrench fa-fw"></i><?=$idioma['Gestionar Calendarios']?></a>

                    </li>

                    <li>
                        <a href="v-altacalendario.php"><i class="fa fa-plus-circle fa-fw"></i><?=$idioma['Nuevo Calendario']?></a>

                    </li>

                </ul>
                <!-- /.nav-second-level -->
            </li>
            <li>
                <a href="v-consultagrupo.php"><i class="fa fa-group fa-fw"></i><?=$idioma['Mis Grupos']?><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">

                    <?php foreach ($groupsUsr as $group) { ?>

                        <li>
                            <a href="v-panelgrupo.php?idGrupo=<?=$group->getIdGrupo()?>"><?=$group->getNombreGrupo()?></a>
                        </li>

                    <?php } ?>

                    <li>
                        <a href="v-consultagrupo.php"><i class="fa fa-wrench fa-fw"></i><?=$idioma['Gestionar Grupos']?></a>

                    </li>

                    <li>
                        <a href="v-altagrupo.php?return=consultagrupo"><i class="fa fa-plus-circle fa-fw"></i><?=$idioma['Nuevo Grupo']?></a>

                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>

            <?php include("inc-menumobil.php"); ?>


        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>
<!-- /.navbar-static-side -->
</nav>
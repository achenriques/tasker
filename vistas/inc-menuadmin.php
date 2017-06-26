<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">

            <li>

                <a href="v-admindashboard.php"><i class="fa fa-dashboard fa-fw"></i>Dashboard</a>

            </li>

            <li>
                <a href="v-listarusuarios.php"><?=$idioma['Usuarios']?></a>
            </li>
            <li>
                <a href="v-consultagrupo.php?return=consultagrupo"><?=$idioma['Grupos']?></a>
            </li>

            <li>
                <a href="v-tareas.php"><?=$idioma['Tareas']?></a>
            </li>
            <li>
                <a href="v-consultadocumento.php"><?=$idioma['Documentos']?></a>
            </li>

            <li>
                <a href="#"><?=$idioma['Pruebas']?><span class="fa arrow"></span></a>

                <ul class="nav nav-second-level">


                    <li>

                        <a href="v-tcn.php"><?=$idioma['Formularios']?></a>

                    </li>


                </ul>

            </li>


            <li

            <?php include("inc-menumobil.php"); ?>
        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>
<!-- /.navbar-static-side -->
</nav>
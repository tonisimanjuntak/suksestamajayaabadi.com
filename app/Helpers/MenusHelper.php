<?php  
    function generateLink($dataMenus, $controllerPath)
    {

        if ($dataMenus['urlmenus'] != null) {
            $url = url($dataMenus['urlmenus']);            
        }else{
            $url = url('/');            
        }

        if ($controllerPath == $dataMenus['urlmenus']) {
            $classActive = 'active';
        }else{
            $classActive = '';
        }
        echo '
            <li class="nav-item">
                <a href="' . $url . '" class="nav-link ' . $classActive . '">
                    <i class="nav-icon ' . $dataMenus['iconmenus'] .  '"></i>
                    <p>' . $dataMenus['menus'] . '</p>
                </a>
            </li>
        ';
    }
?>
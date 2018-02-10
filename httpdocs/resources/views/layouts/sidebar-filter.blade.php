




<div class="col-md-2 blockSearch">
    <div class="subCategoriesBlk ">
        <h2>Sector</h2>
        <?php
            DB::statement('SET SESSION group_concat_max_len = 1000000');
            
            $menus = DB::select(DB::raw("					
                SELECT x.aSectorID ,x.tSectorName, GROUP_CONCAT( concat( y.aAspIntCatID,'~~~',y.tAspIntCategory,'!!',z.url_name)
                SEPARATOR  ':::' ) as submenus
                FROM tblsectormaster x
                LEFT JOIN tblcourseaspintcategory y ON x.aSectorID = y.nSectorid
                LEFT JOIN tbltakshashila_url z ON y.id_url = z.id_url
                GROUP BY x.aSectorID ORDER BY  x.nSortorder
            "));
            
            $subCategorymenuObj = DB::select(DB::raw("
                SELECT a.aAspIntCatID, GROUP_CONCAT( CONCAT( b.tAspirationinterest,  '!!', c.url_name ) 
                SEPARATOR  '::::' ) AS subcategory_menus		
                FROM tblcourseaspintcategory a
                LEFT JOIN tblaspirationinterests b ON a.aAspIntCatID = b.naspintcatid
                INNER JOIN tbltakshashila_url c ON c.id_url = b.id_url
                GROUP BY a.aAspIntCatID")); 
            
            $subCategory = array();
            if($subCategorymenuObj){
                $subCategorymenuArray = json_decode(json_encode($subCategorymenuObj), True);
                foreach ($subCategorymenuArray as $subKey => $subValue) {            	
                        $subCategory[$subValue['aAspIntCatID']] = $subValue['subcategory_menus'];
                }
             }
                    
            ?>
        <ul id="smLink">
            @foreach($menus as $menu)
            <li class="sumMenu" <?php if( isset($_GET['s']) && $_GET['s']== $menu->aSectorID ){ echo 'class="active"'; } ?>>
                <a href="/course-catalogue/?s={{$menu->aSectorID}}">{{$menu->tSectorName}}</a>
                @if($menu->submenus)
                <ul class="subListMenu">
                    <?php
                        $submenu = explode (':::',$menu->submenus);
                        
                        foreach ($submenu as $sbmenu) 
                        {
                            list($key,$value) = explode('~~~',$sbmenu);
                            list($menuName,$url) = explode('!!',$value);
                            if(Request::server('REQUEST_URI') == '/'.$url) {
                                echo 'class="active"';
                            }
                            echo "<li><a href='/{$url}' title='{$menuName}'>{$menuName}</a>";

                            if(array_key_exists($key, $subCategory)){

                                $subCategoryMenu = explode ('::::',$subCategory[$key]);
                                echo "<ul class='subListMenu'>";
                                foreach ($subCategoryMenu as $subKey => $subValue) {
                                        list($subMenuName,$subUrl) = explode('!!',$subValue);
                                        echo "<li><a href='/{$subUrl}' title='{$subMenuName}'>{$subMenuName}</a></li>";
                                }
                                echo "</ul>";
                            }
                            echo "</li>";                        
                        }
                    ?>	
                </ul>
                @endif
            </li>
            @endforeach
        </ul>
    </div>
</div>
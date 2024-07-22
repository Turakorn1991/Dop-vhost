<ol>
    <?php foreach ($report_list as $item):?>
        <li><?php
            if($item->mock){
                echo "<a href='{$item->url}?{$item->params}'>{$item->title}</a> >> <a href='{$item->url}/pdf?{$item->params}'>pdf</a>";
            }else{
                echo $item->title;
            }
            ?></li>
    <?php endforeach;?>
</ol>
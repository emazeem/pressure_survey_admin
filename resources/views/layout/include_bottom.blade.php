@if(isset($include_bottom))
    <?php $include_bottom = explode(',',$include_bottom); ?>
    <?php $path = 'layout.includes'; ?>
    @for($i=0; $i < count($include_bottom); $i++)
        <?php $file_path = $path . '.' . $include_bottom[$i]; ?>
        @include($file_path)
    @endfor
@endif
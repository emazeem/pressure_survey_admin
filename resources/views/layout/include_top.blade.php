@if(isset($include_top))
    <?php $include_top = explode(',',$include_top); ?>
    <?php $path = 'layout.includes'; ?>
    @for($i=0; $i < count($include_top); $i++)
        <?php $file_path = $path . '.' . $include_top[$i]; ?>
        @include($file_path)
    @endfor
@endif
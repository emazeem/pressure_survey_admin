(function( $ ){
    $.fn.IUploader = function(options) {
       var element = $(this);
       var settings = $.extend({
            // These are the defaults.
            dist_url: "assets/",
            name : 'file_input_name',
        }, options );
       var fileBuffer_array = [];
       if(element.length > 0){
        var element_count = 1;
            $(this).each(function(){
                var temp_buffer_array = {
                    'buffer' :  new DataTransfer(),
                    'init_num' : 0
                }
                fileBuffer_array.push(temp_buffer_array);
                $(this).attr('data-elem-count',(element_count-1));
                $(this).addClass('iUploader-input-'+element_count+'');
                $(this).hide();
                var input_id = $(this).attr('id');
                var html = genrate_html(element_count);
                $(this).after(html);

                // Events
                
                element_count++;
            });

            function genrate_html(el_c) {
                var html = '';
                var dist_url_var = settings.dist_url;
                html += '<div class="iUploader trigger" data-input="#iUploader-input-0'+el_c+'"><div class="iUploader-container">';
                html += '<div class="iUploader-assets"><div class="iUploader-assets-inner iUploader-inner-0'+el_c+'"></div></div>';
                html += '<div class="iUploader-uploader-trigger">';
                html += '<div class="iUploader-uploader-trigger-inner-main"><div class="iUploader-uploader-trigger-inner">'
                html += '<div class="iUploader-uploader-trigger-image"><img src="'+dist_url_var+'images/icons/clicp.png" alt="" class="iUploader-icon">Click to Upload</div>'
                html += '</div></div></div>';
                html += '</div></div>';
                return html;
            }

            function genrate_inner_html(index,name,file_input,file_data,asset_div,input_name){
                var TempfileBuffer = new DataTransfer();
                TempfileBuffer.items.add(file_data);
                var count_id = random_id();
                var dist_url_var = settings.dist_url;

                var plug_id  = $(file_input).attr('data-elem-count');
                var html = '<div class="iUploader-single-asset iUploader-assets-'+count_id+'"><div class="iUploader-single-asset-preview"><img src="" alt="" class="iUploader-single-asset-image" id="iUploader-preview-'+count_id+'"></div>'
                html += '<div class="iUploader-single-asset-name iUploader-name-'+count_id+'">'+name+'</div><input type="file" class="iUploader-input" name="'+input_name+'[]" id="iUploader-image-input-'+count_id+'"><div class="iUploader-single-asset-actions"><div class="iUploader-single-asset-actions-inner">'
                html += '<div class="iUploader-single-asset-option"><div class="iUploader-single-asset-option-inner remove" data-id="#iUploader-input-01" data-index="'+count_id+'" data-remove=".iUploader-assets-'+count_id+'"><button class="iUploader-button iUploader-button-0'+index+'"><img src="'+dist_url_var+'images/icons/trash.png" alt="" class="iUploader-icon"></button>'
                html += '</div></div></div></div></div>';
                // Append HTML
                $(asset_div).prepend(html);
                // Add Images
                document.getElementById('iUploader-image-input-'+count_id+'').files = TempfileBuffer.files;
                // Render Image
                readURL(file_data,'#iUploader-preview-'+count_id,index);
            }

            function readURL(file_data,image_element,index) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $(image_element).attr('src', e.target.result);
                }
                reader.readAsDataURL(file_data);
            }

            $(document).on('click','.iUploader.trigger',function() {
                var iUploader_input = $(this).attr('data-input');
                $(iUploader_input).trigger("click");
            });

            $(document).on('change','input.iUploader-input',function(){
                var input_name = $(this).attr('data-name');
                var input_id = $(this).attr('id');
                var elem_count = $(this).attr('data-elem-count');
                var inner_div = '.iUploader-inner-0'+(parseInt(elem_count)+1);
                var fileBuffer = fileBuffer_array[elem_count].buffer;
                var files_attached = document.getElementById(input_id).files;
                var files_count = files_attached.length;
                for (var i=0; i < files_count; i++) {
                    var file_data = files_attached[i];
                    fileBuffer_array[elem_count].buffer.items.add(file_data);
                }

                var files_attached = document.getElementById(input_id).files;
                var files_count = files_attached.length;
                var file_input = this;
                for (var i=0; i < files_count; i++) {
                    var file_index = i;
                    var file_name = file_data.name;
                    genrate_inner_html(fileBuffer_array[elem_count].init_num,file_name,file_input,files_attached[i],inner_div,input_name);
                    fileBuffer_array[elem_count].init_num++;
                }
            });

            $(document).on('click','.iUploader-single-asset-option-inner.remove',function(e) {
                e.stopPropagation();
                var file_input_field = $(this).attr('data-id');
                var file_input_field_index = $(this).attr('data-index');
                var to_remove = $(this).attr('data-remove');
                $(to_remove).remove();
            });

            function random_id() {
                return ((Date.now())+Math.random(99999)).toFixed(0);
            }

       }
       return this;
    }; 
 })( jQuery );
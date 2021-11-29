@component('admin.layouts.main')

    @slot('title')
        Admin - Edit User - {{ config('app.name') }}
    @endslot

<?php
//pr($page);
$templates = CustomHelper::getTemplates('pages');

$routeName = CustomHelper::getAdminRouteName();


$parent_id = (isset($page->parent_id))?$page->parent_id:$parent_id;
$name = (isset($page->name))?$page->name:'';
$title = (isset($page->title))?$page->title:'';
$heading = (isset($page->heading))?$page->heading:'';
$brief = (isset($page->brief))?$page->brief:'';
$template = (isset($page->template))?$page->template:'';
$content = (isset($page->content))?$page->content:'';
$status = (isset($page->status))?$page->status:'';
$featured = (isset($page->featured))?$page->featured:'';

$meta_title = (isset($page->meta_title))?$page->meta_title:'';
$meta_keyword = (isset($page->meta_keyword))?$page->meta_keyword:'';
$meta_description = (isset($page->meta_description))?$page->meta_description:'';
$image = (isset($page->image))?$page->image:'';
$banner_image = (isset($page->banner_image))?$page->banner_image:'';

$storage = Storage::disk('public');
//pr($storage);
$path = 'cms_pages/';
$old_image = $image;

$banner_old_image = $banner_image;
$image_req = '';
$link_req = '';
?>

    <div class="row">

        <div class="col-md-12">

            <h2>{{ $page_heading }}</h2>

            @include('snippets.errors')
            @include('snippets.flash')

            <div class="ajax_msg"></div>
			<div class="bgcolor">
            <form method="POST" action="" accept-charset="UTF-8" enctype="multipart/form-data" role="form">
                {{ csrf_field() }}

                <input type="hidden" name="parent_id" value="{{$parent_id}}">

                <div class="form-group  col-md-4{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label for="name" class="control-label required">Name:</label>

                    <input type="text" name="name" value="{{ old('name', $name) }}" id="name" class="form-control"  maxlength="255" />

                     @include('snippets.errors_first', ['param' => 'name'])
                </div>

                <div class="form-group  col-md-4{{ $errors->has('title') ? ' has-error' : '' }}">
                    <label for="title" class="control-label required">Title:</label>

                    <input type="text" name="title" value="{{ old('title', $title) }}" id="title" class="form-control"  maxlength="255" required />

                    @include('snippets.errors_first', ['param' => 'title'])
                </div>

                <div class="form-group  col-md-4{{ $errors->has('heading') ? ' has-error' : '' }}">
                    <label for="heading" class="control-label">Heading:</label>

                    <input type="text" name="heading" value="{{ old('heading', $heading)}}" id="heading" class="form-control"  maxlength="255" />

                    @include('snippets.errors_first', ['param' => 'heading'])
                </div>


                 <div class="form-group  col-md-4{{ $errors->has('template') ? ' has-error' : '' }}">
                    <label for="template" class="control-label">Tempalate:</label>

                    <select class="form-control" name="template">
                        <option value="">Select</option>
                        <?php
                       
                        if(!empty($templates) && count($templates) > 0){
                            foreach ($templates as $tKey => $tVal){
                                $selected = '';
                                if($template == $tKey){
                                    $selected = 'selected';
                                }
                                ?>
                                <option value="{{$tKey}}" {{$selected}}>{{$tVal}}</option>
                                <?php
                            }
                        }
                        ?>
                    </select>
                    @include('snippets.errors_first', ['param' => 'template'])
                </div>

                <div class="form-group  col-md-12{{ $errors->has('brief') ? ' has-error' : '' }}">
                    <label class="control-label">Brief:</label>

                    <textarea name="brief" class="form-control" ><?php echo old('brief', $brief); ?></textarea>    

                    @include('snippets.errors_first', ['param' => 'brief'])
                </div>

				<div class="clearfix"></div>
                <div class="form-group  col-md-12{{ $errors->has('content') ? ' has-error' : '' }}">
                	<label for="content" class="control-label">Content:</label>

                	<textarea name="content" id="content" class="form-control ckeditor" ><?php echo old('content', $content); ?></textarea>    

                	@include('snippets.errors_first', ['param' => 'content'])
                </div>


                <?php
                $image_required = $image_req;
                if($id > 0){
                    $image_required = '';
                }
                ?>
                <div class="col-md-12">
                <div class="col-md-6">

                    <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
                        <label for="sort_order" class="control-label {{ $image_required }}">Image:</label>

                        <input type="file" id="image" name="image"/>

                        @include('snippets.errors_first', ['param' => 'image'])
                    </div>
                    <?php
                    if(!empty($image)){
                        if($storage->exists($path.$image))
                        {
                            ?>
                            <div class="col-md-2 image_box">
                             <img src="{{ url('public/storage/'.$path.'thumb/'.$image) }}" style="width: 100px;"><br>
                             <a href="javascript:void(0)" data-id="{{ $id }}" data='image' class="del_image">Delete</a>
                         </div>
                         <?php        
                     }

                     ?>
                     <?php
                 }
                 ?>
                 <input type="hidden" name="old_image" value="{{ $old_image }}">
             </div>


             <div class="col-md-6">

             	<div class="form-group{{ $errors->has('banner_image') ? ' has-error' : '' }}">
             		<label for="sort_order" class="control-label {{ $image_required }}">Banner Image:</label>

             		<input type="file" id="banner_image" name="banner_image"/>

             		@include('snippets.errors_first', ['param' => 'banner_image'])
             	</div>
             	<?php
             	if(!empty($banner_image)){
             		if($storage->exists($path.$banner_image))
             		{
             			?>
             			<div class="col-md-2 image_box">
             				<img src="{{ url('public/storage/'.$path.'thumb/'.$banner_image) }}" style="width: 100px;"><br>
             				<a href="javascript:void(0)" data-id="{{ $id }}" data='banner_image' class="del_image">Delete</a>
             			</div>
             			<?php        
             		}

             		?>
             		<?php
             	}
             	?>
             	<input type="hidden" name="banner_old_image" value="{{ $banner_old_image }}">
             </div>
         </div>

                <hr>
				<div class="col-md-12">
                <h3>SEO:</h3>
				</div>
				
                <div class="form-group col-md-4{{ $errors->has('meta_title') ? ' has-error' : '' }}">
                	<label for="meta_title" class="control-label">Meta Title:</label>

                	<input type="text" name="meta_title" value="{{ old('meta_title', $meta_title)}}" id="meta_title" class="form-control"  />    

                	@include('snippets.errors_first', ['param' => 'meta_title'])
                </div>

                <div class="form-group col-md-4{{ $errors->has('meta_keyword') ? ' has-error' : '' }}">
                	<label for="meta_keyword" class="control-label" maxlength="688" >Meta Keyword:</label>

                	<input type="text" name="meta_keyword" value="{{ old('meta_keyword', $meta_keyword)}}" id="meta_keyword" class="form-control"  />    

                	@include('snippets.errors_first', ['param' => 'meta_keyword'])
                </div>

                <div class="form-group col-md-4{{ $errors->has('meta_description') ? ' has-error' : '' }}">
                	<label for="meta_description" class="control-label">Meta Description:</label>

                	<textarea name="meta_description" id="meta_description"  class="form-control" >{{ old('meta_description', $meta_description) }}</textarea>    

                	@include('snippets.errors_first', ['param' => 'meta_description'])
                </div>

                <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }} col-md-12">
                    <label class="control-label">Status:</label>
                    &nbsp;&nbsp;
                    Active: <input type="radio" name="status" value="1" <?php echo ($status == '1')?'checked':''; ?> checked>
                    &nbsp;
                    Inactive: <input type="radio" name="status" value="0" <?php echo ( strlen($status) > 0 && $status == '0')?'checked':''; ?> >

                    @include('snippets.errors_first', ['param' => 'status'])
                </div>

                <div class="form-group{{ $errors->has('featured') ? ' has-error' : '' }} col-md-12">
                    <label class="control-label ">Featured:</label>

                    <input type="checkbox" name="featured" value="1" <?php echo ($featured == '1')?'checked':''; ?> />

                    @include('snippets.errors_first', ['param' => 'featured'])
                </div>
				
				 <div class="clearfix"></div>
                <div class="form-group col-md-12">
                    <button class="btn btn-success"><i class="fa fa-save"></i> Save</button>

                    <a href="{{ route('admin.cms.index') }}" class="btn btn-lg btn-primary" title="Cancel">Cancel</a>
                </div>
				<br/><br/>

            </form>
			</div>
        </div>       

        
    </div>


@slot('bottomBlock')

    <script type="text/javascript" src="{{ url('public/js/ckeditor/ckeditor.js') }}"></script>

    <script type="text/javascript">
    	/*var content = document.getElementById('content');
    	CKEditor.replace(content);*/

        var editor = CKEDITOR.replace('content', {
                //filebrowserImageBrowseUrl: "{{url('public/storage/products/ck')}}",
                filebrowserImageUploadUrl: "<?php echo url($routeName.'/ck_upload?type=blogs&csrf_token='.csrf_token());?>"
            });
    </script>

    <script type="text/javascript">

        $(document).ready(function(){

            $(".del_image").click(function(){

                var current_sel = $(this);

                var image_id = $(this).attr('data-id');

                var type = $(this).attr('data');

                //alert(type); return false;

                conf = confirm("Are you sure to Delete this Image?");

                if(conf){

                    var _token = '{{ csrf_token() }}';

                    $.ajax({
                        url: "{{ route($routeName.'.cms.ajax_delete_image') }}",
                        type: "POST",
                        data: {image_id , type},
                        dataType:"JSON",
                        headers:{'X-CSRF-TOKEN': _token},
                        cache: false,
                        beforeSend:function(){
                         $(".ajax_msg").html("");
                     },
                     success: function(resp){
                        if(resp.success){
                            $(".ajax_msg").html(resp.msg);
                            current_sel.parent('.image_box').remove();
                        }
                        else{
                            $(".ajax_msg").html(resp.msg);
                        }

                    }
                });
                }

            });

        });
    </script>

@endslot

@endcomponent
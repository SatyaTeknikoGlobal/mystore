@include('admin.common.sidebar')

<?php
$BackUrl = CustomHelper::BackUrl();
$routeName = CustomHelper::getAdminRouteName();
$parent_id = (request()->has('parent_id'))?request()->parent_id:'';
?>


   <div class="clearfix"></div>
  
  <div class="content-wrapper">
    <div class="container-fluid">

      <div class="row">
        <div class="col-lg-12">
       
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">CMS Pages({{ count($pages) }})
                 <a href="{{ route('admin.cms.add', ['parent_id'=>$parent_id, 'back_url'=>$BackUrl]) }}" class="btn btn-light px-5" style='float: right;'><i class="fa fa-plus"></i> Add CMS</a>
              </h5>
              <br>
                <?php
            if(!empty($pages) && count($pages) > 0){
                ?>
              <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Title</th>
                      <th scope="col">Slug</th>
                      <th scope="col">Status</th>
                      <th scope="col">Date Created</th>
                      <th scope="col">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                     <?php
                     $i=1;
                        foreach($pages as $page){

                            $child_url = 'javascript:void(0)';
                            $title = $page->title;

                            if(!empty($page->children) && $page->children->count() > 0 ){
                                $child_url = 'cms?parent_id='.$page->id.'&back_url='.rawurlencode($BackUrl);
                                $title = '<i class="fa fa-list"></i> <strong>'.$page->title.'</strong>';
                            }
                        ?>
                    <tr>
                      <th scope="row">{{$i++}}</th>
                      <td><a href="{{$child_url}}"> <?php echo $title; ?></td>
                      <td><?php echo $page->slug; ?></td>
                     <td>{{ CustomHelper::getStatusStr($page->status) }}</td>
                                <td>{{ CustomHelper::DateFormat($page->created_at, 'd/m/Y') }}</td>
                      <td><a href="{{ route($routeName.'.cms.add', ['parent_id'=>$page->id, 'back_url'=>$BackUrl]) }}" title="Add Child Page" ><i class="fa fa-plus"></i></a>
                                    &nbsp;

                                    <a href="{{ route($routeName.'.cms.edit', [$page->id, 'back_url'=>$BackUrl]) }}" class=""><i class="fa fa-edit"></i> </a>

                                    <?php
                                    if($page->children->count() == 0){
                                        ?>
                                        <a href="javascript:void(0)" class="sbmtDelForm" title="Delete" ><i class="fa fa-trash"></i></a>

                                        <form style="display: inline-block;" method="POST" action="{{ route($routeName.'.cms.delete', [$page['id'], 'back_url'=>$BackUrl]) }}" accept-charset="UTF-8" role="form" onsubmit="return confirm('Do you really want to remove this?');" class="delForm">
                                            {{ csrf_field() }}
                                        </form>
                                        <?php
                                    }
                                    else{
                                        ?>
                                        <a href="javascript:void(0)" title="Delete" onclick="alert('please remove Child associated with this Parent first!')" ><i class="fa fa-trash"></i></a>
                                        <?php
                                    } ?>

                                </td>
                    </tr>
                      <?php
                        }
                        ?>
                  </tbody>
                </table>
                 <?php
       }else{
        ?>
        <div class="alert alert-warning">There are no CMS Pages at the present.</div>
        <?php

       }
           ?>
              </div>
            </div>
          </div>
        </div>
      </div><!--End Row-->
    
    <!--start overlay-->
      <div class="overlay toggle-menu"></div>
    <!--end overlay-->

    </div>
    <!-- End container-fluid-->
    
    </div><!--End content-wrapper-->
   <!--Start Back To Top Button-->
    <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
    <!--End Back To Top Button-->
@include('admin.common.footer')
 <script type="text/javascript">
        $(document).on("click", ".sbmtDelForm", function(e){
            e.preventDefault();

            $(this).siblings("form.delForm").submit();                
        });
    </script>
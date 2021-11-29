@include('admin.common.sidebar')

    <?php
    $BackUrl = CustomHelper::BackUrl();
    $routeName = CustomHelper::getAdminRouteName();
    $parent_id = (request()->has('parent_id'))?request()->parent_id:'';
    ?>
   <!--  <div class="row">

        <div class="col-md-12">

            <h1>CMS Pages ({{ count($pages) }})

                 <a href="{{ route('admin.cms.add', ['parent_id'=>$parent_id, 'back_url'=>$BackUrl]) }}" class="btn btn-sm btn-success pull-right"><i class="fa fa-plus"></i> Add CMS</a>
            </h1>

            @include('snippets.errors')
            @include('snippets.flash') -->
            <div class="row" id="table-striped-dark">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">CMS Pages ({{ count($pages) }})</h4>
                <a href="{{ route('admin.cms.add', ['parent_id'=>$parent_id, 'back_url'=>$BackUrl]) }}" class="btn btn-sm btn-success" style='float: right;'><i class="fa fa-plus"></i> Add CMS</a>
              </div>
              <div class="card-content">

            <?php
            if(!empty($pages) && count($pages) > 0){
                ?>

                 <div class="table-responsive">
                    <table class="table table-striped table-dark mb-0">

                        <tr>
                            <th width="35%" class="text-center">Title</th>
                            <th width="30%" class="text-center">Slug</th>
                            <th width="10%" class="text-center">Status</th>
                            <th width="10%" class="text-center">Date Created</th>
                            <th width="15%" class="text-center">Action</th>
                        </tr>

                        
                        <?php
                        foreach($pages as $page){

                            $child_url = 'javascript:void(0)';
                            $title = $page->title;

                            if(!empty($page->children) && $page->children->count() > 0 ){
                                $child_url = 'cms?parent_id='.$page->id.'&back_url='.rawurlencode($BackUrl);
                                $title = '<i class="fa fa-list"></i> <strong>'.$page->title.'</strong>';
                            }
                        ?>
                            <tr>
                                <td> <a href="{{$child_url}}"> <?php echo $title; ?></a>
                                   </td>
                                <td><?php echo $page->slug; ?></td>
                                <td>{{ CustomHelper::getStatusStr($page->status) }}</td>
                                <td>{{ CustomHelper::DateFormat($page->created_at, 'd/m/Y') }}</td>


                                <td>

                                    <a href="{{ route($routeName.'.cms.add', ['parent_id'=>$page->id, 'back_url'=>$BackUrl]) }}" title="Add Child Page" ><i class="fas fa-plus"></i></a>
                                    &nbsp;

                                    <a href="{{ route($routeName.'.cms.edit', [$page->id, 'back_url'=>$BackUrl]) }}" class=""><i class="fas fa-edit"></i> </a>

                                    <?php
                                    if($page->children->count() == 0){
                                        ?>
                                        <a href="javascript:void(0)" class="sbmtDelForm" title="Delete" ><i class="fas fa-trash-alt"></i></a>

                                        <form style="display: inline-block;" method="POST" action="{{ route($routeName.'.cms.delete', [$page['id'], 'back_url'=>$BackUrl]) }}" accept-charset="UTF-8" role="form" onsubmit="return confirm('Do you really want to remove this?');" class="delForm">
                                            {{ csrf_field() }}
                                        </form>
                                        <?php
                                    }
                                    else{
                                        ?>
                                        <a href="javascript:void(0)" title="Delete" onclick="alert('please remove Child associated with this Parent first!')" ><i class="fas fa-trash-alt"></i></a>
                                        <?php
                                    } ?>

                                
                                </td>

                            </tr>
                        <?php
                        }
                        ?>
                    </table>
                </div>
           <?php
       }else{
        ?>
        <div class="alert alert-warning">There are no CMS Pages at the present.</div>
        <?php

       }
           ?>

        </div>

    </div>

@include('admin.common.footer')

    <script type="text/javascript">
        $(document).on("click", ".sbmtDelForm", function(e){
            e.preventDefault();

            $(this).siblings("form.delForm").submit();                
        });
    </script>
    

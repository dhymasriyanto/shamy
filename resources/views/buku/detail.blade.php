<?php
/**
 * Created by Pizaini <pizaini@uin-suska.ac.id>
 * Date: 22/12/2019
 * Time: 22:27
 *
 * @var string $searchQuery
 */
use App\Libs\AppHelpers;
$title = 'Pencarian';
$appendTitle = AppHelpers::appendTitle($title, true);
?>

@extends($appLayout)

@section('title', $appendTitle)

@section('main_content')
    <div class="main_content_app d-none">
        <div id="app">
            <div class="wrapper">
                <div class="container-fluid">
                    <!-- Page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">
                                @include('partials.breadcrumb', ['breadcrumbs' => ['search.index' => 'Pencarian']])
                                <h4 class="page-title"><?=$title?></h4>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-8">
                            <div class="card-box task-detail">
                                <div class="dropdown float-right">
                                    <a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false">
                                        <i class="mdi mdi-dots-vertical"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item">Action</a>
                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item">Another action</a>
                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item">Something else</a>
                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item">Separated link</a>
                                    </div>
                                </div>
                                <div class="media mb-3">
                                    <img class="d-flex mr-3 rounded-circle avatar-md" alt="64x64" src="assets/images/users/user-2.jpg">
                                    <div class="media-body">
                                        <h4 class="media-heading mt-0">Michael Zenaty</h4>
                                        <span class="badge badge-danger">Urgent</span>
                                    </div>
                                </div>

                                <h4>Code HTML email template for welcome email</h4>

                                <p class="text-muted">
                                    At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint cupiditate non sunt in culpa qui officia deserunt animi est laborum et
                                </p>

                                <p class="text-muted">
                                    Consectetur adipisicing elit. Voluptates, illo, iste
                                    itaque voluptas corrupti ratione reprehenderit magni similique Tempore quos
                                    delectus asperiores libero voluptas quod perferendis erum ipsum dolor sit.
                                </p>

                                <div class="row task-dates mb-0 mt-2">
                                    <div class="col-lg-6">
                                        <h5 class="font-600 m-b-5">Start Date</h5>
                                        <p> 22 March 2016 <small class="text-muted">1:00 PM</small></p>
                                    </div>

                                    <div class="col-lg-6">
                                        <h5 class="font-600 m-b-5">Due Date</h5>
                                        <p> 17 April 2016 <small class="text-muted">12:00 PM</small></p>
                                    </div>
                                </div>
                                <div class="clearfix"></div>

                                <div class="task-tags mt-2">
                                    <h5>Tags</h5>
                                    <input type="text" value="Amsterdam,Washington,Sydney" data-role="tagsinput" placeholder="add tags"/>
                                </div>

                                <div class="assign-team mt-4">
                                    <h5>Assign to</h5>
                                    <div>
                                        <a href="#"> <img class="rounded-circle avatar-sm" alt="64x64" src="assets/images/users/user-2.jpg"> </a>
                                        <a href="#"> <img class="rounded-circle avatar-sm" alt="64x64" src="assets/images/users/user-3.jpg"> </a>
                                        <a href="#"> <img class="rounded-circle avatar-sm" alt="64x64" src="assets/images/users/user-5.jpg"> </a>
                                        <a href="#"> <img class="rounded-circle avatar-sm" alt="64x64" src="assets/images/users/user-8.jpg"> </a>
                                        <a href="#"><span class="add-new-plus"><i class="mdi mdi-plus"></i> </span></a>
                                    </div>
                                </div>

                                <div class="attached-files mt-4">
                                    <h5>Attached Files </h5>
                                    <ul class="list-inline files-list">
                                        <li class="list-inline-item file-box">
                                            <a href=""><img src="assets/images/attached-files/img-1.jpg" class="img-fluid img-thumbnail" alt="attached-img" width="80"></a>
                                            <p class="font-13 mb-1 text-muted"><small>File one</small></p>
                                        </li>
                                        <li class="list-inline-item file-box">
                                            <a href=""><img src="assets/images/attached-files/img-2.jpg" class="img-fluid img-thumbnail" alt="attached-img" width="80"></a>
                                            <p class="font-13 mb-1 text-muted"><small>Attached-2</small></p>
                                        </li>
                                        <li class="list-inline-item file-box">
                                            <a href=""><img src="assets/images/attached-files/img-3.jpg" class="img-fluid img-thumbnail" alt="attached-img" width="80"></a>
                                            <p class="font-13 mb-1 text-muted"><small>Dribbble shot</small></p>
                                        </li>
                                        <li class="list-inline-item file-box ml-2">
                                            <div class="fileupload add-new-plus">
                                                <span><i class="mdi-plus mdi"></i></span>
                                                <input type="file" class="upload">
                                            </div>
                                        </li>
                                    </ul>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="text-right m-t-30">
                                                <button type="submit" class="btn btn-success waves-effect waves-light">
                                                    Save
                                                </button>
                                                <button type="button"
                                                        class="btn btn-light waves-effect">Cancel
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div><!-- end col -->

                        <div class="col-md-4">
                            <div class="card-box">
                                <div class="dropdown float-right">
                                    <a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false">
                                        <i class="mdi mdi-dots-vertical"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item">Action</a>
                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item">Another action</a>
                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item">Something else</a>
                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item">Separated link</a>
                                    </div>
                                </div>

                                <h4 class="header-title mt-0 mb-3">Comments (6)</h4>

                                <div>

                                    <div class="media mb-3">
                                        <div class="d-flex mr-3">
                                            <a href="#"> <img class="media-object rounded-circle avatar-sm" alt="64x64" src="assets/images/users/user-1.jpg"> </a>
                                        </div>
                                        <div class="media-body">
                                            <h5 class="mt-0">Mat Helme</h5>
                                            <p class="font-13 text-muted mb-0">
                                                <a href="" class="text-primary">@Michael</a>
                                                Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque
                                                ante sollicitudin commodo.
                                            </p>
                                            <a href="" class="text-success font-13">Reply</a>
                                        </div>
                                    </div>

                                    <div class="media mb-3">
                                        <div class="d-flex mr-3">
                                            <a href="#"> <img class="media-object rounded-circle avatar-sm" alt="64x64" src="assets/images/users/user-2.jpg"> </a>
                                        </div>
                                        <div class="media-body">
                                            <h5 class="mt-0">Media heading</h5>
                                            <p class="font-13 text-muted mb-0">
                                                <a href="" class="text-primary">@Michael</a>
                                                Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque sollicitudin purus odio.
                                            </p>
                                            <a href="" class="text-success font-13">Reply</a>

                                            <div class="media my-2">
                                                <div class="d-flex mr-3">
                                                    <a href="#"> <img class="media-object rounded-circle avatar-sm" alt="64x64" src="assets/images/users/user-3.jpg"> </a>
                                                </div>
                                                <div class="media-body">
                                                    <h5 class="mt-0">Nested media heading</h5>
                                                    <p class="font-13 text-muted mb-0">
                                                        <a href="" class="text-primary">@Michael</a>
                                                        Cras sit amet nibh libero, in gravida nulla vel metus scelerisque ante sollicitudin purus odio.
                                                    </p>
                                                    <a href="" class="text-success font-13">Reply</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="media mb-3">
                                        <div class="d-flex mr-3">
                                            <a href="#"> <img class="media-object rounded-circle avatar-sm" alt="64x64" src="assets/images/users/user-1.jpg"> </a>
                                        </div>
                                        <div class="media-body">
                                            <h5 class="mt-0">Mat Helme</h5>
                                            <p class="font-13 text-muted mb-0">
                                                <a href="" class="text-primary">@Michael</a>
                                                Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque
                                                ante sollicitudin commodo cras purus.
                                            </p>
                                            <a href="" class="text-success font-13">Reply</a>
                                        </div>
                                    </div>

                                    <div class="media mb-3">
                                        <div class="d-flex mr-3">
                                            <a href="#"> <img class="media-object rounded-circle avatar-sm" alt="64x64" src="assets/images/users/user-1.jpg"> </a>
                                        </div>
                                        <div class="media-body">
                                            <h5 class="mt-0">Mat Helme</h5>
                                            <p class="font-13 text-muted mb-0">
                                                <a href="" class="text-primary">@Michael</a>
                                                Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque
                                                ante sollicitudin commodo cras.
                                            </p>
                                            <a href="" class="text-success font-13">Reply</a>
                                        </div>
                                    </div>

                                    <div class="media mb-3">
                                        <div class="d-flex mr-3">
                                            <a href="#"> <img class="media-object rounded-circle avatar-sm" alt="64x64" src="assets/images/users/user-1.jpg"> </a>
                                        </div>
                                        <div class="media-body">
                                            <input type="text" class="form-control input-sm" placeholder="Some text value...">
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div><!-- end col -->
                    </div>

                </div>
            </div>
        </div>

        {{--Define your javascript below--}}
        <script type="text/javascript" src="{{asset('js/buku/detail.js')}}"></script>
    </div>

@endsection

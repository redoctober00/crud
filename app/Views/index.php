<!doctype html>
<html lang="en" data-bs-theme="auto">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors" />
    <meta name="generator" content="Astro v5.13.2" />
    <title>CRUD - API</title>
    <link rel="stylesheet" href="<?=APP_URL;?>/public/assets/vendor/sweetalert2/sweetalert2.min.css">
    <script src="<?= APP_URL;?>/public/assets/vendor/bootstrap/js/color-modes.js"></script>
    <link href="<?= APP_URL;?>/public/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <meta name="theme-color" content="#712cf9" />
    <link href="<?= APP_URL;?>/public/assets/vendor/bootstrap/css/navbar-fixed.css" rel="stylesheet" />
    <!-- Font Awesome via CDN (copy-paste into <head>) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
</head>

<body ng-app="WebApp" ng-controller="MainCtrl" ng-init="getInfo()">

    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Finals</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
                aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav me-auto mb-2 mb-md-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>


                </ul>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" ng-model="searchText.$" aria-label="Search" />
                    <button class="btn btn-outline-success" type="submit">
                        Search
                    </button>
                </form>
            </div>
        </div>
    </nav>
    <main class="container">
        <div class="bg-body-tertiary p-5 rounded">

            <div class="row">
                <div class="col-lg-6">
                    <h1>CRUD API Sample</h1>
                </div>
                <div class="col-lg-6">
                    <button class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#add-info">
                        <i class="fa fa-plus"></i> Add New
                    </button>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="text-center">No.</th>
                                <th>First Name</th>
                                <th>Middle Name</th>
                                <th>Last Name</th>
                                <th class="text-center">Photo</th>
                                <th class="text-center" width="300">Option</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat="record in records | filter:searchText track by $index" style="vertical-align: middle;">
                                <td class="text-center">{{ $index + 1 }}</td>
                                <td>{{record.fname}}</td>
                                <td>{{record.mname}}</td>
                                <td>{{record.lname}}</td>
                                <td class="text-center"><img src="<?= APP_URL ?>/public/assets/uploads/{{ record.photo }}" style="width: 128px; object-fit:contain"></td>
                                <td class="text-center">
                                <a href="#" data-bs-toggle="modal" data-bs-target="#upload-photo"
                                        ng-click="editInfo(record.id)" style="text-decoration: none;"><i class="fa fa-upload"></i> Upload Photo</a>    
                                <a href="#" data-bs-toggle="modal" data-bs-target="#edit-info"
                                        ng-click="editInfo(record.id)" style="text-decoration: none;"><i class="fa fa-edit"></i> Edit</a> 
                                <a href="#"
                                        ng-click="deleteInfo(record.id)" style="text-decoration: none;"><i class="fa fa-trash"></i> Delete</a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="add-info" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form ng-submit="saveInfo()">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">New Info</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="fname" class="form-label">First Name</label>
                                <input type="text" class="form-control" id="fname" ng-model="data.fname" />
                            </div>
                            <div class="mb-3">
                                <label for="mname" class="form-label">Middle Name</label>
                                <input type="text" class="form-control" id="mname" ng-model="data.mname" />
                            </div>
                            <div class="mb-3">
                                <label for="lname" class="form-label">Last Name</label>
                                <input type="text" class="form-control" id="lname" ng-model="data.lname" />
                            </div>
                        </div>
                        <div class="modal-footer d-flex justify-content-between align-items-center">
                            <button type="button" class="btn btn-sm btn-secondary"
                                data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="edit-info" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form ng-submit="updateInfo(form.id)">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Info</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="fname" class="form-label">First Name</label>
                                <input type="text" class="form-control" id="fname" ng-model="form.fname" />
                            </div>
                            <div class="mb-3">
                                <label for="mname" class="form-label">Middle Name</label>
                                <input type="text" class="form-control" id="mname" ng-model="form.mname" />
                            </div>
                            <div class="mb-3">
                                <label for="lname" class="form-label">Last Name</label>
                                <input type="text" class="form-control" id="lname" ng-model="form.lname" />
                            </div>
                        </div>
                        <div class="modal-footer d-flex justify-content-between align-items-center">
                            <button type="button" class="btn btn-sm btn-secondary"
                                data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <!-- Modal -->
        <div class="modal fade" id="upload-photo" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="post" action="<?= APP_URL ?>/sample/upload-photo" enctype="multipart/form-data">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Upload photo</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="fname" class="form-label">Attach Photo</label>
                                <input type="text" name="id"  class="form-control" ng-model="form.id" style="display: none;" />
                                <input type="file" name="file" class="form-control" id="file" />
                            </div>
                        </div>
                        <div class="modal-footer d-flex justify-content-between align-items-center">
                            <button type="button" class="btn btn-sm btn-secondary"
                                data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


    </main>
    <script src="<?= APP_URL;?>/public/assets/vendor/jquery/jquery.js" type="text/javascript"></script>
    <script src="<?= APP_URL;?>/public/assets/vendor/bootstrap/js/bootstrap.bundle.min.js" class="astro-vvvwv3sm">
    </script>
    <script src="<?=APP_URL;?>/public/assets/vendor/sweetalert2/sweetalert2.min.js">
    </script>
    <script src="<?=APP_URL;?>/public/assets/vendor/angularjs/angular.min.js">
    </script>
    <script type="text/javascript">
    const base_url = "<?=APP_URL;?>/";
    </script>
    <script src="<?=APP_URL;?>/public/assets/controller/sample.js?ver=1.0"></script>
</body>

</html>
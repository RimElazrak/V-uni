
<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from www.urbanui.com/melody/template/pages/layout/boxed-layout.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 15 Sep 2018 06:05:54 GMT -->
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Melody Admin</title>
  <!-- plugins:css -->
  <link rel="shortcut icon" href="assets/images/V-logo-mini.svg" />

  <link rel="stylesheet" href="assets/vendors/iconfonts/font-awesome/css/all.min.css">
  <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.addons.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="assets/css/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="assets/images/favicon.png" />
</head>


<body class="boxed-layout">
  <div class="container-scroller">
    <!-- partial:../../partials/_navbar.html -->
    <?php include ('account/nav/nav_account.php') ?>

      <!-- partial =======================================MAI PANEL -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="page-header">
            <h3 class="page-title">
              Dashboard
            </h3>
          </div>
          
          
          <div class="col-md-4 grid-margin stretch-card" style="float: right;  ">
           
            <div class="card">
              <div class="card-body">
                <!-- Dummy Modal Starts -->
                <!-- Dummy Modal Ends -->
                <!-- Add Post -->
                <div class="text-center">
                  <button type="button" class="btn btn-secondary btn-lg btn-block"data-toggle="modal" data-target="#exampleModal-bla">
                    Add new post...
                    <i class="btn-icon-append fas fa-plus"></i>
                  </button>
                </div>
                <div class="modal fade" id="exampleModal-bla" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel-bla" aria-hidden="true" style="display: none;">
                  <div class="modal-dialog" role="document">
                  
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel-bla">ADD TEXT A?D FILES </h5>
                        
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">×</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <DIV class="card">
                          <div class="card-body">
                          <h4 class="card-title">Basic Tab</h4>
                          <p class="card-description">Horizontal bootstrap tab</p>
                          <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                              <a class="nav-link active show" id="home-tab" data-toggle="tab" href="#text-1" role="tab" aria-controls="home-1" aria-selected="true">text</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile-1" role="tab" aria-controls="profile-1" aria-selected="false">Add file</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact-1" role="tab" aria-controls="contact-1" aria-selected="false">le3ba 5ra</a>
                            </li>
                          </ul>

                          <div class="tab-content">
                            <div class="tab-pane fade active show" id="text-1" role="tabpanel" aria-labelledby="home-tab">
                              <div class="media">
                                
                                <div class="media-body">
                                  <textarea id="maxlength-textarea" class="form-control" maxlength="200" rows="7" placeholder="Type something..."></textarea>
                                </div>
                              </div>
                            </div>
                            <div class="tab-pane fade" id="profile-1" role="tabpanel" aria-labelledby="profile-tab">
                              <div class="media">
                                <div class="media-body">
                                  <div class="form-group">
                              
                                    <!-- Upload image -->
                                    
                                    <div id="fileuploader">
                                    <div class="ajax-upload-dragdrop" style="vertical-align: top; width: 400px;">
                                    <div class="ajax-file-upload" style="position: relative; overflow: hidden; cursor: default;">
                                      Upload
                                      <form method="POST" action="YOUR_FILE_UPLOAD_URL" enctype="multipart/form-data" style="margin: 0px; padding: 0px;">
                                        <input type="file" id="ajax-upload-id-1590863929165" name="myfile[]" accept="*" multiple="" style="position: absolute; cursor: pointer; top: 0px; width: 100%; height: 100%; left: 0px; z-index: 100; opacity: 0;">
                                      </form>
                                    </div>
                                    <span><b>Drag &amp; Drop Files</b></span>
                                    </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="tab-pane fade" id="contact-1" role="tabpanel" aria-labelledby="contact-tab">
                              <h4>Contact us </h4>
                              <p>
                                Feel free to contact us if you have any questions!
                              </p>
                              <p>
                                <i class="fa fa-phone text-info"></i>
                                +123456789
                              </p>
                              <p>
                                <i class="far fa-envelope-open text-success"></i>
                                contactus@example.com
                              </p>
                            </div>
                          </div>
                        </div>
                        </DIV>
                        
                      </div>
                      
                      <div class="modal-footer">
                        <button type="button" class="btn btn-success">Submit</button>
                        <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Modal Ends -->
              </div>
                
              <div class="border-bottom pt-2">
                <!-- seperation line -->
              </div> 
              <br>

              <!--  Calendar  -->

              <div class="card-body">
                <h4 class="card-title">
                  <i class="fas fa-calendar-alt"></i>
                  Calendar
                </h4>
                <div id="inline-datepicker-example" class="datepicker"></div>
              </div>
                
              
            </div>
          </div>
        <!--  post  -->
          

          
          <!--  Post Existing -->
 
            <div class="col-md-8 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <img class="img-sm rounded-circle image-layer-item" src="assets/images/faces/face3.jpg" alt="profile">
                  <label for="exampleTextarea1" style="font-weight: 700; margin-left: 7px;"> yassine zeghloul
                  </label><br> <br>
                  
                  <h6>
                    slv li 3endo td dial ostad isifto ha l3ar rani tnakt 3lia. lmohim a drari matnssawnach ..
                  </h6>
      
                  <br>
                  <div class="border-top pt-2">
                    <!-- seperation line -->
                  </div>
                  <div class="d-flex justify-content-around">
                    <button type="button" class="btn btn-inverse-danger btn-fw">
                      Like 
                      <i class="fa fa-heart"></i>
                    </button>
                    <button onclick="togglecomments()" id = "button4" type="button" class="btn btn-inverse-warning btn-fw">
                      Show comments <i class="fa fa-comment"></i></button>
                    
                  </div>

                  <div class="border-bottom pt-2">
                    <!-- seperation line -->
                  </div>
                  <div class="add-items d-flex">
					<input type="text" class="form-control todo-list-input" placeholder="What do you need to do today?">
                    <button type="button"id="add-task" class="btn btn-outline-secondary btn-icon-text">
                      <i class="fa fa-paper-plane " ></i>                          
                    </button>
                   
                  </div> <br>
                
                
                  <!-- COMMENTS -->  
                  
                  <ul class="solid-bullet-list">
                    <li>
                      <div class="d-flex align-items-start profile-feed-item">
                        <img src="assets/images/faces/face13.jpg" alt="profile" class="img-sm rounded-circle">
                        <div class="ml-4">
                          <h6>
                            Mason Beck
                            <small class="ml-4 text-muted"><i class="far fa-clock mr-1"></i>10 hours</small>
                          </h6>
                          <p>
                            There is no better advertisement campaign that is low cost and also successful at the same time.
                          </p>
                          <p class="small text-muted mt-2 mb-0">
                            <span>
                              <i class="fa fa-star mr-1"></i>4
                            </span>
                            <span class="ml-2">
                              <i class="fa fa-comment mr-1"></i>11
                            </span>
                            <span class="ml-2">
                              <i class="fa fa-mail-reply"></i>
                            </span>
                          </p>
                        </div>
                      </div>
                    </li>
                    <div id = "hello">
                      <li>
                        <div class="d-flex align-items-start profile-feed-item">
                          <img src="assets/images/faces/face13.jpg" alt="profile" class="img-sm rounded-circle">
                          <div class="ml-4">
                            <h6>
                              Mason Beck
                              <small class="ml-4 text-muted"><i class="far fa-clock mr-1"></i>10 hours</small>
                            </h6>
                            <p>
                              There is no better advertisement campaign that is low cost and also successful at the same time.
                            </p>
                            <p class="small text-muted mt-2 mb-0">
                              <span>
                                <i class="fa fa-star mr-1"></i>4
                              </span>
                              <span class="ml-2">
                                <i class="fa fa-comment mr-1"></i>11
                              </span>
                              <span class="ml-2">
                                <i class="fa fa-mail-reply"></i>
                              </span>
                            </p>
                          </div>
                        </div>
                      </li>
                      <li>
                        <div class="d-flex align-items-start profile-feed-item">
                          <img src="assets/images/faces/face13.jpg" alt="profile" class="img-sm rounded-circle">
                          <div class="ml-4">
                            <h6>
                              Mason Beck
                              <small class="ml-4 text-muted"><i class="far fa-clock mr-1"></i>10 hours</small>
                            </h6>
                            <p>
                              There is no better advertisement campaign that is low cost and also successful at the same time.
                            </p>
                            <p class="small text-muted mt-2 mb-0">
                              <span>
                                <i class="fa fa-star mr-1"></i>4
                              </span>
                              <span class="ml-2">
                                <i class="fa fa-comment mr-1"></i>11
                              </span>
                              <span class="ml-2">
                                <i class="fa fa-mail-reply"></i>
                              </span>
                            </p>
                          </div>
                        </div>
                      </li>
                    </div>
                  </ul>
                  
                  
                  

                </div>
            </div>
            </div>
            <div class="col-md-8 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                 
             
                  <div class="border-top pt-3">
                    <!-- seperation line -->
                  </div>
                  <div class="add-items d-flex">
                    <input type="text" class="form-control" placeholder="Type Something..">
                    <button class="add btn btn-primary font-weight-bold todo-list-add-btn">Add</button>
                  </div>
                  <ul class="solid-bullet-list">
                    <li>
                      <img class="img-sm rounded-circle image-layer-item" src="assets/images/faces/face3.jpg" alt="profile">
                      <label for="exampleTextarea1" style="font-weight: 700; margin-left: 7px;"> yassine zeghloul</label>

                      <h5>
                        <span class="float-right text-muted font-weight-normal small">8:30 AM</span>
                      </h5>
                      <p class="text-muted">tanbghik a fatima !</p>
                    </li>
                    <li>
                      <img class="img-sm rounded-circle image-layer-item" src="assets/images/faces/face3.jpg" alt="profile">
                      <label for="exampleTextarea1" style="font-weight: 700; margin-left: 7px;"> yassine zeghloul</label>

                      <h5>
                        <span class="float-right text-muted font-weight-normal small">8:30 AM</span>
                      </h5>
                      <p class="text-muted">tanbghik a fatima 2  !</p>
                    </li>
                  </ul>
                  <div class="border-top pt-3">
                    <!-- seperation line -->
                  </div>
                  
                </div>
            </div>
            </div>
         
        


          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                  <div class="d-md-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center mb-3 mb-md-0">
                      <button class="btn btn-social-icon btn-facebook btn-rounded">
                        <i class="fab fa-facebook-f"></i>
                      </button>
                      <div class="ml-4">
                        <h5 class="mb-0">Facebook</h5>
                        <p class="mb-0">813 friends</p>
                      </div>
                    </div>
                    <div class="d-flex align-items-center mb-3 mb-md-0">
                      <button class="btn btn-social-icon btn-twitter btn-rounded">
                        <i class="fab fa-twitter"></i>
                      </button>
                      <div class="ml-4">
                        <h5 class="mb-0">Twitter</h5>
                        <p class="mb-0">9000 followers</p>
                      </div>
                    </div>
                    <div class="d-flex align-items-center mb-3 mb-md-0">
                      <button class="btn btn-social-icon btn-google btn-rounded">
                        <i class="fab fa-google-plus-g"></i>
                      </button>
                      <div class="ml-4">
                        <h5 class="mb-0">Google plus</h5>
                        <p class="mb-0">780 friends</p>
                      </div>
                    </div>
                    <div class="d-flex align-items-center">
                      <button class="btn btn-social-icon btn-linkedin btn-rounded">
                        <i class="fab fa-linkedin-in"></i>
                      </button>
                      <div class="ml-4">
                        <h5 class="mb-0">Linkedin</h5>
                        <p class="mb-0">1090 connections</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:../../partials/_footer.html -->
        <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2018 <a href="https://www.urbanui.com/" target="_blank">Urbanui</a>. All rights reserved.</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i class="far fa-heart text-danger"></i></span>
          </div>
        </footer>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- plugins:js -->
  <script src="assets/vendors/js/vendor.bundle.base.js"></script>
  <script src="assets/vendors/js/vendor.bundle.addons.js"></script>
  <!-- endinject -->
  <tester id="tags_tag_autosize_tester" style="position: absolute; top: -9999px; left: -9999px; width: auto; font-size: 13px; font-family: helvetica; font-weight: 400; letter-spacing: 0px; white-space: nowrap;">LOV</tester>
  <!-- inject:js -->
  <script src="assets/js/off-canvas.js"></script>
  <script src="assets/js/hoverable-collapse.js"></script>
  <script src="assets/js/misc.js"></script>
  <script src="assets/js/settings.js"></script>
  <script src="assets/js/todolist.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="assets/js/dashboard.js"></script>
  <!-- End custom js for this page-->
 
  <!-- Custom js for this page-->
 <script src="assets/js/formpickers.js"></script>
 <script src="assets/js/form-addons.js"></script>
 <script src="assets/js/x-editable.js"></script>
 <script src="assets/js/dropify.js"></script>
 <script src="assets/js/dropzone.js"></script>
 <script src="assets/js/jquery-file-upload.js"></script>
 <script src="assets/js/formpickers.js"></script>
 <script src="assets/js/form-repeater.js"></script>
 <script src="assets/js/test.js"></script>
 <script src="assets/js/modal-demo.js"></script>
 <!-- End custom js for this page-->

  <input type="file" multiple="multiple" class="dz-hidden-input" style="visibility: hidden; position: absolute; top: 0px; left: 0px; height: 0px; width: 0px;">


</body>



<!-- Mirrored from www.urbanui.com/melody/template/pages/layout/boxed-layout.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 15 Sep 2018 06:05:55 GMT -->
</html>

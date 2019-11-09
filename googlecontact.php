<?php  
    session_start();
    if(!isset($_SESSION["user"])) {
    header("location:login.php");
    }
    include_once('model/user.php');
    $current_user = unserialize($_SESSION["user"]); 
    include_once('model/contact.php');
    include_once('model/label.php');   
    if(isset($_POST['create-label'])) {
        Label::createToDB($_REQUEST["name"]);
    }
    if(isset($_POST['create-contact'])) {
        Contact::createToDB($_REQUEST["name"], $_REQUEST["phone"], $_REQUEST["email"], $_REQUEST["regency"]);
    }
    if(isset($_REQUEST['delete-contact'])) {
        Contact::deleteToDB($_REQUEST['delete-id-contact']);
    }
    $lsLabel = Label::getListLabelDB();
    if(isset($_REQUEST['label_id'])) {
        // var_dump( );
        $lsFromDB = Label::getListContactOfLabel($_REQUEST['label_id']);
    }
    else{
        $lsFromDB = Contact::getListFromDB();
    }    
   
  
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Google Contact</title>
    <!-- bootstrap 4 -->
    <link rel="stylesheet"
        href="https://unpkg.com/bootstrap-material-design@4.1.1/dist/css/bootstrap-material-design.min.css"
        integrity="sha384-wXznGJNEXNG1NFsbm0ugrLFMQPWswR3lds2VeinahP8N0zJw9VWSopbjv2x7WCvX" crossorigin="anonymous">
    <!-- material ison -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/animate.css/3.2.0/animate.min.css">
    <!-- custom css -->
    <link rel="stylesheet" href="css/demo.css" />
</head>

<body>
    <!-- header -->
    <header>
        <div class="d-flex align-items-center h-100">
            <div class="left-block d-flex align-items-center h-100">
                <div class="toggle-menu h-100 ml-1 mr-1 click-hide-menu">
                    <i class="material-icons">menu</i>
                </div>
                <div class="header-title h-100">
                    <a href="googlecontact.php" class="h-100 d-flex align-items-center">
                        <i class="material-icons">account_circle</i>
                        <span>Danh bạ</span>
                    </a>
                </div>
            </div>
            <div class="center-block flex-grow-1 h-100">
                <form action="" class="h-100 search-form position-relative">
                    <i class="material-icons">search</i>
                    <input type="text" placeholder="Tìm kiếm">
                </form>
            </div>
        </div>
    </header>
    <main>
        <div class="d-flex">
            <nav>
                <div class="mb-3">
                    <button class="new-contact d-flex align-items-center" data-toggle="modal"
                        data-target="#modalNewContact">
                        <span class="VfPpkd-Q0XOV" aria-hidden="true"><svg width="36" height="36" viewBox="0 0 36 36"><path fill="#34A853" d="M16 16v14h4V20z"></path><path fill="#4285F4" d="M30 16H20l-4 4h14z"></path><path fill="#FBBC05" d="M6 16v4h10l4-4z"></path><path fill="#EA4335" d="M20 16V6h-4v14z"></path><path fill="none" d="M0 0h36v36H0z"></path></svg></span>
                        <span>Tạo liên hệ</span>
                    </button>
                    <div class="modal fade" id="modalNewContact" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Tạo địa chỉ liên hệ mới</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                     <form action="" method="post">
                                        <div class="row">
                                            <div class="col-2 text-center">
                                                <i class="material-icons big">account_circle</i>
                                            </div>
                                            <div class="col-10">
                                                <input type="text" name = "name" class="form-control" placeholder="Họ Tên">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-2 text-center">
                                                <i class="material-icons">
                                                    account_balance
                                                </i>
                                            </div>
                                            <div class="col-5">
                                                <input type="text" class="form-control" placeholder="Công ty">
                                            </div>
                                            <div class="col-5">
                                                <input type="text" name="regency" class="form-control" placeholder="Chức danh">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-2 text-center">
                                                <i class="material-icons">
                                                    email
                                                </i>
                                            </div>
                                            <div class="col-10">
                                                <input type="text" name="email" class="form-control" placeholder="Email">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-2 text-center">
                                                <i class="material-icons">
                                                    phone
                                                </i>
                                            </div>
                                            <div class="col-10">
                                                <input type="text" name="phone" class="form-control" placeholder="Phone">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-2 text-center">
                                                <i class="material-icons">
                                                    note
                                                </i>
                                            </div>
                                            <div class="col-10">
                                                <input type="text" class="form-control" placeholder="Ghi chú">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                                            <button type="submit" name="create-contact" class="btn btn-primary font-weight-bold">Lưu</button>
                                        </div>
                                    </form>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
                <div class="main-menu">
                    <div class="list-menu">
                        <!-- group one -->
                        <div class="item-menu active">
                            <a href="googlecontact.php" class="has-number">
                                <i class="material-icons">
                                    person_outline
                                </i>
                                <span class="name">Danh bạ</span>
                                <span> <?php echo Contact::coutContactDB()?></span>
                            </a>
                        </div>
                        <div class="item-menu">
                            <a href="#">
                                <i class="material-icons">
                                    history
                                </i>
                                <span>Thường xuyên liên hệ</span>
                            </a>
                        </div>
                        <div class="item-menu">
                            <a href="#">
                                <i class="material-icons">
                                    filter_none
                                </i>
                                <span>Liên hệ trùng lặp</span>
                            </a>
                        </div>

                        <!-- line -->
                        <div class="line"></div>
                        <!-- group two collapse -->
                        <div class="item-menu has-sub-menu">
                            <a data-toggle="collapse" href="#collapseTab" role="button" aria-expanded="false"
                                aria-controls="collapseTab">
                                <i class="material-icons">
                                    keyboard_arrow_up
                                </i>
                                <span>Nhãn</span>
                            </a>
                        </div>
                        <div class="list-tab list-menu collapse" id="collapseTab">
                            <!-- list label here -->
                            <?php 
                                foreach($lsLabel as $key => $value){
                                  ?>
                            <div class="item-menu">
                             
                                <a id= "<?php echo $value->id?>" href="googlecontact.php?label_id=<?php echo $value->id?>" class="has-number">
                                    <i class="material-icons">
                                    label
                                    </i>
                                    <span class="name-label name"><?php echo $value->name?></span>
                                    <span class="number-label"><?php  echo Label::coutContactByIdDB($value->id);?></span>
                                    <div class="group-action">
                                        <span class="edit material-icons" role="button" data-toggle="modal" data-target="#modalEditLabel">
                                            edit
                                        </span>
                                        <span class="remove material-icons" role="button" data-toggle="modal" data-target="#modalDeleteLabel">
                                            delete_outline
                                        </span>
                                    </div>
                                </a>
                               
                            </div>
                            <?php 
                                }
                            ?>
                            <!-- add label -->
                            <div class="item-menu">
                                <a href="#" role="button" data-toggle="modal" data-target="#modalNewLabel">
                                    <i class="material-icons">
                                        add
                                    </i>
                                    <span>Tạo nhãn</span>
                                </a>
                            </div>
                        </div>

                        <!-- line -->
                        <div class="line"></div>
                        <!-- group three -->
                        <div class="item-menu">
                            <a href="#">
                                <i class="material-icons">
                                    play_for_work
                                </i>
                                <span>Nhập</span>
                            </a>
                        </div>
                        <div class="item-menu">
                            <a href="#">
                                <i class="material-icons">
                                    cloud_download
                                </i>
                                <span>Xuất</span>
                            </a>
                        </div>
                        <div class="item-menu">
                            <a href="#">
                                <i class="material-icons">
                                    print
                                </i>
                                <span>In</span>
                            </a>
                        </div>

                        <!-- line -->
                        <div class="line"></div>
                        <!-- group four -->
                        <div class="item-menu">
                            <a href="#">
                                <i class="material-icons">
                                    system_update_alt
                                </i>
                                <span>Liên hệ khác</span>
                            </a>
                        </div>
                    </div>
                </div>
            </nav>
            <section>
                <div class="table-title d-flex align-items-center">
                    <div>Tên</div>
                    <div>Email</div>
                    <div>Số điện thoại</div>
                    <div>Chức danh công ty</div>
                </div>
                <p>Danh bạ (<?php echo sizeof($lsFromDB)?>)</p>

            
                
                
                <?php 
                foreach($lsFromDB as $key => $value){
                  ?>
                  <!-- list item -->
                  <div  class="table-list">
                    <div class="table-item d-flex position-relative">
                        <div class="name">
                            <img src="http://qnimate.com/wp-content/uploads/2014/03/images2.jpg" alt="">
                            <span class="contact-name"><?php echo $value->name?></span>
                        </div>
                        <div class="contact-email"><?php echo $value->email?></div>
                        <div class="contact-phone"><?php echo $value->phone?></div>
                        <div class="contact-regency"><?php echo $value->regency?></div>
                        <div class="action-row position-absolute">
                            <span class="edit material-icons btn-edit-contact" role="button" data-toggle="modal"
                                data-target="#modalEditContact">
                                edit
                            </span>
                            <span data-id= "<?php echo $value->id ?>" class="remove material-icons btn-delete-contact" role="button" data-toggle="modal"
                                data-target="#modalDeleteContact">
                                delete_outline
                            </span>
                        </div>
                    </div>
                </div>
                <?php 
                } ?>
                 
         </section>
        </div>
    </main>


    <!-- modal here-->
    <!-- modal new label -->
    <div class="modal fade" id="modalNewLabel" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Tạo nhãn mới</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" method="post">
                <div class="modal-body">                   
                        <div class="row">
                            <div class="col">
                                <input type="text" name="name" class="form-control" placeholder="Tạo nhãn">
                            </div>
                        </div>                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                    <button  name="create-label" id="btn-create" type="submit" class="btn btn-primary font-weight-bold">Lưu</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- modal edit label -->
    <div class="modal fade" id="modalEditLabel" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Đổi tên nhãn</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="row">
                            <div class="col">
                                <input type="text" class="form-control">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                    <button type="button" class="btn btn-primary font-weight-bold">Lưu</button>
                </div>
            </div>
        </div>
    </div>
    <!-- modal delete label -->
    <div class="modal fade" id="modalDeleteLabel" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Xóa nhãn này</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1"
                                value="option1" checked>
                            <label class="form-check-label" for="exampleRadios1">
                                Lưu giữ tất cả liên hệ và xóa nhãn này
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2"
                                value="option2">
                            <label class="form-check-label" for="exampleRadios2">
                                Xóa tất cả các liên hệ và xóa nhãn này
                            </label>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                    <button type="button" class="btn btn-primary font-weight-bold">Xóa</button>
                </div>
            </div>
        </div>
    </div>
    <!-- modal edit contact -->
    <div class="modal fade" id="modalEditContact" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Tạo địa chỉ liên hệ mới</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="row">
                                <div class="col-2 text-center">
                                    <i class="material-icons big">account_circle</i>
                                </div>
                                <div class="col-10">
                                    <input type="text" class="form-control contact-name" placeholder="Họ Tên">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-2 text-center">
                                    <i class="material-icons">
                                        account_balance
                                    </i>
                                </div>
                                <div class="col-5">
                                    <input type="text" class="form-control" placeholder="Công ty">
                                </div>
                                <div class="col-5">
                                    <input type="text" class="form-control contact-regency" placeholder="Chức danh">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-2 text-center">
                                    <i class="material-icons">
                                        email
                                    </i>
                                </div>
                                <div class="col-10">
                                    <input type="text" class="form-control contact-email" placeholder="Email">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-2 text-center">
                                    <i class="material-icons">
                                        note
                                    </i>
                                </div>
                                <div class="col-10">
                                    <input type="text" class="form-control contact-note" placeholder="Ghi chú">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                        <button type="button" class="btn btn-primary font-weight-bold">Lưu</button>
                    </div>
                </div>
            </div>
    </div>
    <!-- modal delete contact -->
    <div class="modal fade" id="modalDeleteContact" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Xóa liên hệ này</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>                
                <form  action="" method="POST" >           
                <div class="modal-footer">                      
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                        <button type="submit" name ="delete-contact" class="btn btn-primary font-weight-bold">Xóa</button>                      
                        <input type="text" id="d-id" class="hide" name="delete-id-contact" value="" hidden>
                                  
                </div>
                </form> 
                
            </div>
        </div>
    </div>

    <!-- library js -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://unpkg.com/popper.js@1.12.6/dist/umd/popper.js"
        integrity="sha384-fA23ZRQ3G/J53mElWqVJEGJzU0sTs+SvzG8fXVWP+kJQ1lwFAOkcUOysnlKJC33U" crossorigin="anonymous">
    </script>
    <script src="https://unpkg.com/bootstrap-material-design@4.1.1/dist/js/bootstrap-material-design.js"
        integrity="sha384-CauSuKpEqAFajSpkdjv3z9t8E7RlpJ1UP0lKM/+NdtSarroVKu069AlsRPKkFBz9" crossorigin="anonymous">
    </script>
    <script>
        $(document).ready(function () {
            $('body').bootstrapMaterialDesign();
        });
    </script>
    <!-- custom js -->

    <script src="js/demo.js"></script>
    <script>
        
    	$(document).on("click", ".btn-delete-contact", function(){
            var instance = this;
            var id =$(instance).attr("data-id") 
            $("#d-id").val(id);
            console.log( $("#d-id").val());
        });
        $(document).on("click", ".btn-edit-contact", function(){
            var instance = this;
            $("#hidden-id").val($(this).parents("tr").attr("data-id"));
        });
        
     
    </script>
    


</body>

</html>
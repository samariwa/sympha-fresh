<!-- admin-page start -->
<section class="admin-page-section d-flex align-items-center" style="background-image: url('assets/images/admin/profile-bg.jpg'); background-size: cover;">
    <div class="aps-wrapper w-100">
        <div class="container">
            <div class="row justify-content-center justify-content-md-start">
                <div class="admin-content-area">
                    <div class="admin-thumb">
                        <img src="assets/images/admin/thumbnail-avatar.png" alt="">
                        <a href="#" class="image-change-option"><i class="fas fa-camera"></i></a>
                    </div>
                    <div class="admin-content">
                        <h4 class="name"><?php echo $userDetails->first_result()->firstname.' '.$userDetails->first_result()->lastname; ?></h4>
                        <p class="desc"><?php echo $userDetails->first_result()->email; ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- admin-page end -->
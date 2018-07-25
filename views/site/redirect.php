<?php
    $this->title = "List Master - redirect";
?>
<div class="col-md-12 text-center redirect" style="color: #fff; margin-top: 50px">
    <p>Đăng nhập thành công !</p>
    <p>Tự động điều hướng trong 2s</p>
    <p><i>Nếu trang không tự động điều hướng vui lòng bấm vào <a href="<?= $url ?>">đây</a></i></p>
</div>

<script>
    window.setTimeout(function(){

        // Move to a new location or you can do something else
        window.location.href = "<?= $url ?>";

    }, 2000);
</script>
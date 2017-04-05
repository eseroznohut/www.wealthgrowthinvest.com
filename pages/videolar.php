
<div class="breadcrumbs">
    <div class="container">
        <span typeof="v:Breadcrumb">
            <a rel="v:url" property="v:title" href="/anasayfa.html" class="home">
                <?php echo $db->Cevirmen("anasayfa", $language_id, 1); ?>
            </a>
        </span>
        <span typeof="v:Breadcrumb">
            <span id="current_page" property="v:title">
                <?php echo $db->Cevirmen("videolar", $language_id, 1); ?>
            </span>
        </span>
    </div>
</div>




<div id="primary" class="content-area  container">
    <div class="row">
        <div class="col-md-12">
            <h1 class="portfolio__title">
                <?php
                echo $db->Cevirmen("videolar", $language_id, 1);
                $title =  $db->Cevirmen("videolar", $language_id, 1);

                ?>
            </h1>
        </div>

        <div class="col-md-12">

            <?php
            $videolar = $db->select("select *from video");

            if(count($videolar) == 0){

                echo $db->Cevirmen("Henüz video eklenmedi", $language_id, 1).".<br/><br/><br/>";

            }

            foreach ($videolar as $video)
            {
            ?>
            
            <div class="video-item col-md-3" data-id="<?php echo $video["url"]; ?>" data-title="<?php echo $db->Cevirmen($video["ad"], $language_id, 1); ?>">
                <div class="video-image">
                    <img class="img-responsive" src="http://img.youtube.com/vi/<?php echo $video["url"]; ?>/0.jpg" alt="<?php echo $video[0]["ad"]; ?>" />
                </div>
                <div class="video-title">
                    <p>
                        <?php echo $db->Cevirmen($video["ad"], $language_id, 1); ?>
                    </p>
                </div>
            </div>

            <?php } ?>



        </div>

    </div>
</div>

<style>
    .video-item {
        padding: 10px;
        float: left;
        min-height: 320px !important;
        cursor:pointer;
    }


    .video-title p {
        text-transform: capitalize;
        padding: 5px;
        font-weight: lighter !important;
        font-size:14px;
    }
</style>



<script>
    $(function () {
        $(".video-item").click(function () {
            var title = $(this).attr("data-title");
            var url = $(this).attr("data-id");
            $("#videoDialog").append('<iframe width="420" height="315" src="https://www.youtube.com/embed/' + url + '?autoplay=1"></iframe>');
            $("#videoDialog").attr("title", title).dialog({ height: 'auto', width: 'auto', modal: true, resizable: false });
        });
    });
</script>


    <div id="videoDialog" style="width:420px;height:315px;padding:0px;">
        
    </div>



<script src="../assets/jquery-ui.min.js"></script>

<link href="../assets/jquery-ui.min.css" rel="stylesheet" />
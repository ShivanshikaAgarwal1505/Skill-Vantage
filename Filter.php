<?php
    include_once("./Header.php");

    include_once("./Nav.php");
    include_once("sessionCheck.php");
?>
<section>
    <div class="container-fluid p-5 m-5">
        <h1>?php search</h1>
        <div class="row">
            <div class="col-lg-3">
                <h4>Filters</h4>

            </div>
            <div class="col-lg-8">
                <div class="row">
                    <div class="col-3">
                    <?php
                        include("./card.php");
                    ?>
                    </div>
                    <div class="col-3">
                    <?php
                        include("./card.php");
                    ?>
                    </div>
                    <div class="col-3">
                    <?php
                        include("./card.php");
                    ?>
                    </div>
                    <div class="col-3">
                    <?php
                        include("./card.php");
                    ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
    include_once("./footer.php");

    include_once("./Foot.php");
?>